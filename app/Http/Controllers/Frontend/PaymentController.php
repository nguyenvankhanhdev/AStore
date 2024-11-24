<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use App\Models\Coupon;
use App\Models\OrderDetails;
use App\Models\PaypalSettings;
use App\Models\UserAddress;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\UserCoupons;
use App\Models\VariantColors;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mail;
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
        $provider = new PayPalClient($config);
        $provider->getAccessToken();
        $request->validate([
            'info' => 'required|array',
            'address' => 'required|array',
            'total_amount' => 'required|numeric',
            'productIds' => 'required|array|min:1',
        ]);

        session([
            'coupon_id' => $request->coupon_id,
            'order_point' => $request->point,
            'order_info' => $request->info,
            'address' => $request->address,
            'order_product_ids' => $request->productIds,
            'order_total_amount' => $request->total_amount,
        ]);

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
                            'message' => 'Xin chờ 1 chút !!!.',
                            'redirect' => $link['href'],
                        ]
                    );
                }
            }
        } else {
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
            $info = Session::get('order_info');
            $address = Session::get('address');

            if (!$info || !$address) {
                return redirect()->route('user.paypal.cancel')->with('error', 'Required information missing.');
            }
            $userAddress = $this->getOrCreateUserAddress($info, $address);

            session(['user_address' => $userAddress->toJson()]);

            $updatePoint = User::find(auth()->id());
            $updatePoint->point += session('order_point');
            $updatePoint->save();
            $this->storeOrder('Paypal', 'pending', 'completed', session('user_address'));

            session()->forget('user_address');
            $this->clearSession();


            return redirect()->route('booking.success')->withSuccess('Thanh toán thành công');
        }

        return redirect()->route('user.paypal.cancel')->with('error', 'Payment was not successful.');
    }
    private function getOrCreateUserAddress($info, $address)
    {
        if (isset($address[0]) && $address[0] != null) {
            $userAddress = UserAddress::find($address[0]);
            if (!$userAddress) {
                $userAddress = new UserAddress();
                $userAddress->user_id = auth()->id();
                $userAddress->address = $address[3];
                $userAddress->name = $info[0];
                $userAddress->phone = $info[1];
                $userAddress->email = $info[2];
                $userAddress->province = $address[0];
                $userAddress->district = $address[1];
                $userAddress->ward = $address[2];
                $userAddress->save();
            }
            return $userAddress;
        }
        return null;
    }
    public function paypalCancel()
    {
        return redirect()->route('user.paypal.payment')->withErrors('Thanh toán bị hủy');
    }
    public function clearSession()
    {
        Session::forget('order_info');
        Session::forget('order_product_ids');
        Session::forget('order_total_amount');
        Session::forget('user_address');
        Session::forget('order_point');
        Session::forget('user_address');
        Session::forget('coupon_id');
    }
    public function payWithCOD(Request $request)
    {
        $request->validate([
            'info' => 'required|array',
            'address' => 'required|array',
            'total_amount' => 'required|numeric',
            'productIds' => 'required|array|min:1',
        ]);

        session([
            'coupon_id' => $request->coupon_id,
            'order_point' => $request->point,
            'order_product_ids' => $request->productIds,
            'order_total_amount' => $request->total_amount,
        ]);

        $info = $request->info;
        $address = $request->address;

        $userAddress =  $this->getOrCreateUserAddress($info, $address);

        $updatePoint = User::find(auth()->id());
        $updatePoint->point += $request->point;
        $updatePoint->save();

        session(['user_address' => $userAddress->toJson()]);

        $this->storeOrder('COD', 'pending', 'pending', session('user_address'));


        $this->clearSession();

        $returnData = [
            'status' => 'success',
            'message' => 'Đặt hàng thành công',
            'redirect' => route('booking.success')
        ];
        return response()->json($returnData);
    }
    public function storeOrder($payment_method, $status, $payment_status, $addressJson)
    {
        $order = new Orders();
        $order->total_amount = session('order_total_amount');
        $order->user_id = auth()->id();
        $order->status = $status;
        $order->order_date = Carbon::now()->format('Y-m-d H:i:s');
        $order->address = $addressJson;
        $order->payment_status = $payment_status;
        $order->payment_method = $payment_method;
        $user_coupon_id = UserCoupons::where('unique_code',session('coupon_id'))->first();

        if ($user_coupon_id) {
            $coupon = Coupon::find($user_coupon_id->coupon_id);
            $coupon->total_used += 1;
            $coupon->quantity -= 1;
            $order->coupon_id = $coupon->id;
            $coupon->save();
            $user_coupon_id->delete();
        }
        else{
            $order->coupon_id = null;
        }
        $order->save();
        $orderDetails = [];

        foreach (session('order_product_ids') as $productId) {
            $cartItem = Carts::where('user_id', auth()->id())
                ->where('variant_color_id', $productId)
                ->first();
            $quantity = $cartItem->quantity;
            $variant = VariantColors::find($productId);
            if ($variant) {
                $orderDetail = new OrderDetails();
                $variant->quantity -= $quantity;
                $variant->save();

                $orderDetail->order_id = $order->id;
                $orderDetail->variant_color_id = $productId;
                $orderDetail->quantity = $quantity;
                $orderDetail->total_price = ($variant->price - $variant->offer_price) * $quantity;
                $orderDetail->save();
                $orderDetails[] = $orderDetail;
            }

            $cartItem->delete();
        }
        Session::forget('coupon');

        $address = json_decode($order->address);
        $user = auth()->user();
        Mail::send('frontend.emails.order_confirmation', [
            'user' => $user,
            'orders' => $order,
            'address' => $address,
            'orderDetails' => $orderDetails
        ], function ($message) use ($address) {
            $message->to($address->email)->subject('Xác nhận đơn hàng của bạn');
        });
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
            'coupon_id' => $request->coupon_id,
            'order_point' => $request->point,
            'order_info' => $request->info,
            'address' => $request->address,
            'order_product_ids' => $request->productIds,
            'order_total_amount' => $request->total_amount,
        ]);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return');
        $vnp_TmnCode = env('VNPAY_TMN_CODE');
        $vnp_HashSecret = env('VNPAY_HASH_SECRET');
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
            'message' => 'Xin chờ 1 chút !!!.',
            'redirect' => $vnp_Url,
        ]);
    }
    public function vnpay_return(Request $request)
    {
        $vnp_HashSecret = env('VNPAY_HASH_SECRET');
        if (!$this->verifySecureHash($request->all(), $vnp_HashSecret, $request->vnp_SecureHash)) {
            return response()->json(['status' => 'error', 'message' => 'Sai chữ ký']);
        }

        if ($request->vnp_ResponseCode == '00') {
            DB::beginTransaction();
            try {
                $info = Session::get('order_info');
                $address = Session::get('address');

                $updatePoint = User::find(auth()->id());
                $updatePoint->point += session('order_point');
                $updatePoint->save();

                $userAddress = $this->getOrCreateUserAddress($info, $address);
                session(['user_address' => $userAddress->toJson()]);

                $this->storeOrder('VNPAY', 'pending', 'completed', session('user_address'));

                DB::commit();
                $this->clearSession();
                session()->forget('user_address');

                session()->forget('checkbox-' . $request->productIds);

                return redirect()->route('booking.success')->withSuccess('Đặt hàng thành công');
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Order processing failed: ' . $e->getMessage());
                return response()->json(['status' => 'failed', 'message' => 'Xử lý đơn hàng không thành công. ' . $e->getMessage()]);
            }
        } else {
            return $this->handleVnpResponseCode($request->vnp_ResponseCode);
        }
    }
    private function verifySecureHash($inputData, $vnp_HashSecret, $vnp_SecureHash)
    {
        $inputData = collect($inputData)->except('vnp_SecureHash')->toArray();
        ksort($inputData);
        $hashData = http_build_query($inputData, '', '&');
        $generatedSecureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        return $generatedSecureHash === $vnp_SecureHash;
    }
    private function handleVnpResponseCode($code)
    {
        $messages = [
            '10' => 'Giao dịch không thành công do: Khách hàng xác thực thông tin thẻ/tài khoản không đúng quá 3 lần',
            '11' => 'Giao dịch không thành công do: Đã hết hạn chờ thanh toán. Xin quý khách vui lòng thực hiện lại giao dịch',
            '12' => 'Giao dịch không thành công do: Thẻ/Tài khoản của khách hàng bị khóa.',
            '13' => 'Giao dịch không thành công do Quý khách nhập sai mật khẩu xác thực giao dịch (OTP). Xin quý khách vui lòng thực hiện lại giao dịch.',
            '24' => 'Thanh toán bị hủy',
        ];

        $message = $messages[$code] ?? 'Thanh toán không thành công';
        if ($code === '24') {
            return redirect()->route('cart.index')->with('message', $message);
        }

        return response()->json(['status' => 'error', 'message' => $message]);
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
        session([
            'order_point' => $request->point,
            'order_info' => $request->info,
            'address' => $request->address,
            'order_product_ids' => $request->productIds,
            'order_total_amount' => $request->total_amount
        ]);

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua ATM MoMo";
        $amount = $request->total_amount;
        $orderId = time() . "";
        $redirectUrl = route('momo.return');
        $ipnUrl = route('momo.return');
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
        $jsonResult = json_decode($result, true);
        if (isset($jsonResult['payUrl'])) {
            return response()->json([
                'status' => 'success',
                'message' => 'Xin chờ 1 chút !!!.',
                'redirect' => $jsonResult['payUrl'],
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'redirect' => route('cart.index'),
                'message' => 'Failed to create MoMo order.'
            ]);
        }
    }
    public function momo_return(Request $request)
    {
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $resultCode = $request->resultCode;
        $signature = $request->signature;

        $rawHash = "amount=" . $request->amount . "&extraData=" . $request->extraData . "&message=" . $request->message . "&orderId=" . $request->orderId . "&orderInfo=" . $request->orderInfo . "&orderType=" . $request->orderType . "&partnerCode=" . $request->partnerCode . "&payType=" . $request->payType . "&requestId=" . $request->requestId . "&responseTime=" . $request->responseTime . "&resultCode=" . $resultCode . "&transId=" . $request->transId;
        $generatedSignature = hash_hmac("sha256", $rawHash, $secretKey);

        if ($generatedSignature === $signature && $resultCode == '0') {
            DB::beginTransaction();
            try {
                $info = Session::get('order_info');
                $address = Session::get('address');

                $updatePoint = User::find(auth()->id());
                $updatePoint->point += session('order_point');
                $updatePoint->save();

                $userAddress = $this->getOrCreateUserAddress($info, $address);

                session(['user_address' => $userAddress->toJson()]);
                $this->storeOrder('MoMo', 'pending', 'completed', session('user_address'));

                DB::commit();
                $this->clearSession();
                return redirect()->route('booking.success')->withSuccess('Thanh toán thành công');
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('MoMo payment handling failed: ' . $e->getMessage());
                return redirect()->route('cart.index')->withErrors('Order processing failed.');
            }
        } else {
            return redirect()->route('cart.index')->withErrors('Payment verification failed or payment was not successful.');
        }
    }

    public function payWithMOMO_QR(Request $request)
    {
        session([
            'coupon_id' => $request->coupon_id,
            'order_point' => $request->point,
            'order_info' => $request->info,
            'address' => $request->address,
            'order_product_ids' => $request->productIds,
            'order_total_amount' => $request->total_amount
        ]);

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $request->total_amount;
        $orderId = time() . "";
        $redirectUrl = route('momo.return');
        $ipnUrl = route('momo.return');
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
        if (isset($jsonResult['payUrl'])) {
            return response()->json([
                'status' => 'success',
                'message' => 'Xin chờ 1 chút !!!.',
                'redirect' => $jsonResult['payUrl'],
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'redirect' => route('cart.index'),
                'message' => 'Failed to create MoMo order.'
            ]);
        }
    }



    public function payWithZALOPAY(Request $request)
    {
        session([
            'coupon_id' => $request->coupon_id,
            'order_point' => $request->point,
            'order_info' => $request->info,
            'address' => $request->address,
            'order_product_ids' => $request->productIds,
            'order_total_amount' => $request->total_amount
        ]);
        $config = [
            "app_id" => 553,
            "key1" => "9phuAOYhan4urywHTh0ndEXiV3pKHr5Q",
            "key2" => "Iyz2habzyr7AG8SgvoBCbKwKi3UzlLi3",
            "endpoint" => "https://sb-openapi.zalopay.vn/v2/create"
        ];

        $embeddata = json_encode([
            "redirecturl" => route('zalopay.callback'),
        ]);

        $items = '[]';
        $transID = rand(0, 10000000);
        $order = [
            "app_id" => $config["app_id"],
            "app_time" => round(microtime(true) * 1000),
            "app_trans_id" => date("ymd") . "_" . $transID,
            "app_user" => "user123",
            "item" => $items,
            "embed_data" => $embeddata,
            "amount" => $request->total_amount,
            "description" => "Thanh toán qua ZALO PAY #$transID",
            "bank_code" => ""
        ];

        // Generate MAC
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

        // Send request to ZaloPay
        $context = stream_context_create([
            "http" => [
                "header" => "Content-type: application/x-www-form-urlencoded\r\n",
                "method" => "POST",
                "content" => http_build_query($order)
            ]
        ]);

        $resp = file_get_contents($config["endpoint"], false, $context);
        $result = json_decode($resp, true);

        if ($result['return_code'] == 1) {
            return response()->json([
                'status' => 'success',
                'message' => 'Xin đợi 1 lát',
                'redirect' => $result['order_url']
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => $result['return_message'] ?? 'Something went wrong',
        ]);
    }
    public function callbackZALOPAY(Request $request)
    {
        $info = Session::get('order_info');
        $address = Session::get('address');

        $updatePoint = User::find(auth()->id());
        $updatePoint->point += session('order_point');
        $updatePoint->save();

        $userAddress = $this->getOrCreateUserAddress($info, $address);

        session(['user_address' => $userAddress->toJson()]);
        $this->storeOrder('ZALOPAY', 'pending', 'completed', session('user_address'));
        DB::commit();
        $this->clearSession();
        return redirect()->route('booking.success')->withSuccess('Thanh toán thành công');
    }

    public function booking_success()
    {
        return view('frontend.user.home.booking_success');
    }

    public function sendMail(Request $request)
    {

        $orders = Orders::find(81);
        $data = [
            'name' => 'Nguyễn Văn Khánh',
            'orders' => $orders
        ];
        Mail::send('frontend.mail.test', $data, function ($message) {
            $message->to('nguyenkhanh13082003@gmail.com') // Địa chỉ email người nhận
                ->subject('Thông báo đơn hàng mới');
        });
    }
}
