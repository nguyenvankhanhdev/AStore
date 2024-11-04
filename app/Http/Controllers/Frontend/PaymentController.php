<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use App\Models\OrderDetails;
use App\Models\PaypalSettings;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\VariantColors;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    public function paypalConfig()
    {
        $paypalSetting = PaypalSettings::first();
        $config = [
            'mode'    => $paypalSetting->mode === 1 ? 'live' : 'sandbox',
            'sandbox' => [
                'client_id'         => $paypalSetting->client_id,
                'client_secret'     => $paypalSetting->secret_key,
                'app_id'            => 'APP-80W284485P519543T',
            ],
            'live' => [
                'client_id'         => $paypalSetting->client_id,
                'client_secret'     => $paypalSetting->secret_key,
                'app_id'            => '',
            ],

            'payment_action' => 'Sale',
            'currency'       => $paypalSetting->currency_name,
            'notify_url'     => '',
            'locale'         => 'en_US',
            'validate_ssl'   =>  true,
        ];
        return $config;
    }
    public function payWithPaypal(Request $request)
    {
        $config = $this->paypalConfig();
        $paypalSetting = PaypalSettings::first();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        session([
            'order_info' => $request->info,
            'order_address' => $request->address,
            'order_product_ids' => $request->productIds,
            'order_total_amount' => $request->total_amount,
        ]);

        // Create the order
        $amountValue = round($request->total_amount / 25000, 2);
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('user.paypal.success'),
                "cancel_url" => route('user.paypal.cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => $config['currency'],
                        "value" => $amountValue,
                    ]
                ]
            ]
        ]);

        // Check if the response is valid
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return response()->json(
                        [
                            'status' => 'success',
                            'redirect' => $link['href'],
                        ]
                    );
                }
            }
        } else {
            // Log the error and redirect to cancel

            return response()->json([
                'status' => 'failed',
                'message' => 'Failed to create PayPal order.'
            ]);
        }
    }
    public function paypalSuccess(Request $request)
    {
        $config = $this->paypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();
        $orderId = $request->token ?? $request->orderID;
        if (!$orderId) {
            return redirect()->route('user.paypal.cancel')->withErrors('Order ID is missing.');
        }
        $response = $provider->capturePaymentOrder($orderId);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $this->storeOrder('PayPal', 'pending');
            $this->clearSession();
            return redirect()->route('booking.success')->withSuccess('Thanh toán thành công');
        }

        return redirect()->route('user.paypal.cancel')->with('error', 'Payment was not successful.');
    }
    public function paypalCancel()
    {
        return redirect()->route('user.paypal.payment')->withErrors('Thanh toán bị hủy');
    }
    public function clearSession()
    {
        session()->forget('order_info');
        session()->forget('order_address');
        session()->forget('order_product_ids');
        session()->forget('order_total_amount');
    }
    public function payWithCOD(Request $request)
    {
        $request->validate([
            'info' => 'required|array',
            'address' => 'required|array',
            'total_amount' => 'required|numeric',
            'productIds' => 'required|array|min:1',
        ]);
        $user = auth()->user();
        $currentDateTime = Carbon::now()->format('Y-m-d H:i:s');
        if (empty($request->productIds) || !is_array($request->productIds)) {
            return response()->json(['status' => 'error', 'message' => 'Không có sản phẩm được chọn'], 400);
        }
        $order = new Orders();
        $order->total_amount = $request->total_amount;
        $order->user_id = $user->id;
        $order->name = $request->info[1];
        $order->status = 'pending';
        $order->order_date = $currentDateTime;
        $order->address = $request->address[1];
        $order->payment_method = 'COD';
        $order->save();
        foreach ($request->productIds as $productId) {
            $cartItem = Carts::where('user_id', $user->id)->where('variant_color_id', $productId)->first();
            if ($cartItem) {
                $quantity = $cartItem->quantity;
                $variant = VariantColors::find($productId);
                if ($variant) {
                    $orderDetail = new OrderDetails();
                    $orderDetail->order_id = $order->id;
                    $orderDetail->variant_color_id = $productId;
                    $orderDetail->quantity = $quantity;
                    $orderDetail->total_price = $variant->price * $quantity;
                    $orderDetail->save();
                }
                $cartItem->delete();
            }
        }
        $returnData = [
            'variant' => $request->productIds,
            'status' => 'success',
            'message' => 'Đặt hàng thành công',
            'redirect' => route('booking.success')
        ];
        return response()->json($returnData);
    }
    public function payWithVNPAY(Request $request)
    {
        $request->validate([
            'info' => 'required|array',
            'address' => 'required|array',
            'total_amount' => 'required|numeric',
            'productIds' => 'required|array|min:1',
        ]);
        session([
            'order_info' => $request->info,
            'order_address' => $request->address,
            'order_product_ids' => $request->productIds,
            'order_total_amount' => $request->total_amount,
        ]);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return');
        $vnp_TmnCode = "2GFOARF6";
        $vnp_HashSecret = "01EKYM991EWOIUI4F1AL2V52R7KJE5TK";
        $vnp_TxnRef = rand(1, 1000000);
        $vnp_OrderInfo = 'Thanh toán hóa đơn';
        $vnp_OrderType = 'AStore';
        $vnp_Amount = $request->total_amount * 100;
        $vnp_Locale = 'VM';
        $vnp_BankCode = 'VNPAY';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        return response()->json([
            'status' => 'success',
            'redirect' => $vnp_Url,
        ]);
    }
    public function storeOrder($payment_method, $paymentStatus)
    {
        $order = new Orders();
        $order->total_amount = session('order_total_amount');
        $order->user_id = auth()->id();
        $order->name = json_encode(session('order_info'), JSON_UNESCAPED_UNICODE); // Prevent Unicode escaping
        $order->status = $paymentStatus;
        $order->order_date = Carbon::now()->format('Y-m-d H:i:s'); // Correct datetime format for MySQL
        $order->address = json_encode(session('order_address'), JSON_UNESCAPED_UNICODE); // Prevent Unicode escaping
        $order->payment_method = $payment_method;
        $order->save();

        foreach (session('order_product_ids') as $productId) {
            $cartItem = Carts::where('user_id', auth()->id())
                ->where('variant_color_id', $productId)
                ->first();
            $quantity = $cartItem->quantity;
            $variant = VariantColors::find($productId);
            if ($variant) {
                $orderDetail = new OrderDetails();
                $orderDetail->order_id = $order->id;
                $orderDetail->variant_color_id = $productId;
                $orderDetail->quantity = $quantity;
                $orderDetail->total_price = $variant->price * $quantity;
                $orderDetail->save();
            }
            $cartItem->delete();
        }
    }
    public function vnpay_return(Request $request)
    {
        $vnp_HashSecret = "01EKYM991EWOIUI4F1AL2V52R7KJE5TK";
        $vnp_SecureHash = $request->vnp_SecureHash;

        $inputData = $request->except('vnp_SecureHash');
        ksort($inputData);
        $hashData = '';
        foreach ($inputData as $key => $value) {
            $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
        }
        $generatedSecureHash = hash_hmac('sha512', ltrim($hashData, '&'), $vnp_HashSecret);
        if ($generatedSecureHash === $vnp_SecureHash) {
            if ($request->vnp_ResponseCode == '00') {
                DB::beginTransaction();
                try {

                    $this->storeOrder('VNPAY', 'pending');
                    DB::commit();
                    $this->clearSession();

                    session()->forget('checkbox-' . $request->productIds);
                    return redirect()->route('booking.success')->with('success', 'Đặt hàng thành công');
                } catch (\Exception $e) {
                    DB::rollBack();
                    return response()->json(['status' => 'failed', 'message' => 'Xử lý đơn hàng không thành công.' . $e->getMessage()]);
                }
            } elseif ($request->vnp_ResponseCode == '10') {
                return redirect()->route('cart.index')->with('message', 'Giao dịch không thành công do: Khách hàng xác thực thông tin thẻ/tài khoản không đúng quá 3 lần');
            } elseif ($request->vnp_ResponseCode == '11') {
                return redirect()->route('cart.index')->with('message', 'Giao dịch không thành công do: Đã hết hạn chờ thanh toán. Xin quý khách vui lòng thực hiện lại giao dịch');
            } elseif ($request->vnp_ResponseCode == '12') {
                return redirect()->route('cart.index')->with('message', 'Giao dịch không thành công do: Thẻ/Tài khoản của khách hàng bị khóa.');
            } elseif ($request->vnp_ResponseCode == '13') {
                return redirect()->route('cart.index')->with('message', 'Giao dịch không thành công do Quý khách nhập sai mật khẩu xác thực giao dịch (OTP). Xin quý khách vui lòng thực hiện lại giao dịch.');
            } elseif ($request->vnp_ResponseCode == '24') {
                return redirect()->route('cart.index')->with('message', 'Thanh toán bị hủy');
            } else {
                return response()->json(['status' => 'error', 'message' => 'Thanh toán không thành công']);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Sai chữ ký']);
        }
    }
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

        $result = curl_exec($ch);

        curl_close($ch);
        return $result;
    }
    public function payWithMOMO_ATM(Request $request)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua ATM MoMo";
        $amount = "10000";
        $orderId = time() . "";
        $redirectUrl = "http://127.0.0.1:8000/bookingSuccess";
        $ipnUrl = route('cart.index');
        $extraData = "";
        $requestId = time() . "";
        $requestType = "payWithATM";
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json
        return redirect()->to($jsonResult['payUrl']);
    }
    public function payWithMOMO_QR(Request $request)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = "100000";
        $orderId = time() . "";
        $redirectUrl = route('booking.success');
        $ipnUrl = route('booking.success');
        $extraData = "";
        $requestId = time() . "";
        $requestType = "captureWallet";
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);
        return redirect()->to($jsonResult['payUrl']);
    }
    public function callbackZALOPAY(Request $request)
    {
        $result = [];
        $key2 = "Iyz2habzyr7AG8SgvoBCbKwKi3UzlLi3"; // Callback Key

        try {

            $postdata = file_get_contents('php://input');
            $postdatajson = json_decode($postdata, true);
            Log::info("Raw callback data: " . $postdata);
            if (!isset($postdatajson["data"]) || !isset($postdatajson["mac"])) {
                throw new \Exception("Thiếu dữ liệu callback");
            }
            $mac = hash_hmac("sha256", $postdatajson["data"], $key2);
            $requestmac = $postdatajson["mac"];

            // Kiểm tra callback hợp lệ
            if (strcmp($mac, $requestmac) != 0) {

                Log::error("Callback không hợp lệ: mac không khớp.");
                $result["return_code"] = -1;
                $result["return_message"] = "mac không khớp";
            } else {

                $datajson = json_decode($postdatajson["data"], true);
                Log::info("Thanh toán thành công: " . json_encode($datajson));


                $result["return_code"] = 1;
                $result["return_message"] = "success";
            }
        } catch (\Exception $e) {
            Log::error("Lỗi trong quá trình xử lý callback: " . $e->getMessage());
            $result["return_code"] = 0; // ZaloPay sẽ callback lại (tối đa 3 lần)
            $result["return_message"] = $e->getMessage();
        }

        return redirect()->route('booking.success');
    }
    public function payWithZALOPAY(Request $request)
    {
        $config = [
            "app_id" => 553,
            "key1" => "9phuAOYhan4urywHTh0ndEXiV3pKHr5Q",
            "key2" => "Iyz2habzyr7AG8SgvoBCbKwKi3UzlLi3",
            "endpoint" => "https://sb-openapi.zalopay.vn/v2/create"
        ];

        $embeddata = json_encode([
            "callback_url" => "https://afe6-2402-800-63b9-8670-70c2-7109-1100-4832.ngrok-free.app/user/zalo-pay-callback",
        ]);

        $items = '[]';
        $transID = rand(0, 1000000);
        $order = [
            "app_id" => $config["app_id"],
            "app_time" => round(microtime(true) * 1000),
            "app_trans_id" => date("ymd") . "_" . $transID,
            "app_user" => "user123",
            "item" => $items,
            "embed_data" => $embeddata,
            "amount" => 10000,
            "description" => "Thanh toán qua ZALO PAY #$transID",
            "bank_code" => "",

        ];

        $data = implode("|", [
            $order["app_id"],
            $order["app_trans_id"],
            $order["app_user"],
            $order["amount"],
            $order["app_time"],
            $order["embed_data"],
            $order["item"],
        ]);
        $order["mac"] = hash_hmac("sha256", $data, $config["key1"]);


        $context = stream_context_create([
            "http" => [
                "header" => "Content-type: application/x-www-form-urlencoded\r\n",
                "method" => "POST",
                "content" => http_build_query($order)
            ]
        ]);

        $resp = file_get_contents($config["endpoint"], false, $context);
        $result = json_decode($resp, true);

        Log::info("Callback received " . $order['mac']);

        if ($result['return_code'] == 1) {
            return redirect()->to($result['order_url']);
        }

        foreach ($result as $key => $value) {
            echo "$key: $value<br>";
        }
    }
    public function booking_success()
    {
        return view('frontend.user.home.booking_success');
    }
}
