<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\UserOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\OrderCancel;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Products;
use App\Models\RatingImages;
use App\Models\Ratings;
use App\Models\VariantColors;
use App\DataTables\OrderCancelDataTable;
use App\DataTables\UserCancelOrderDataTable;
use App\DataTables\UserCompleteOrderDataTable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;

class UserOrderController extends Controller
{

    public function index(UserOrderDataTable $dataTable)
    {
        return $dataTable->render('frontend.user.dashboard.order.index');
    }
    public function show($id)
    {
        $order = Orders::find($id);
        $arrayOrderDetailId = OrderDetails::getIdsByOrderId($order->id);
        $arrayOrderDetailIdInRating = Ratings::filterExistingOrderDetails($arrayOrderDetailId);
        return view('frontend.user.dashboard.order.show', compact('order', 'arrayOrderDetailIdInRating'));
    }

    public function rating(Request $request)
    {
        $rating = new Ratings();
        $rating->user_id = Auth::id();
        $rating->pro_id = $request->pro_id;
        $rating->orderdetail_id = $request->orderdetail_id;
        $rating->content = $request->content;
        $rating->point = $request->point; // Số sao đánh giá
        $rating->save();

        $averageRating = Ratings::getAverageRating($request->pro_id);

        // Cập nhật lại điểm trung bình của sản phẩm
        $product = Products::find($request->pro_id);
        if ($product) {
            $product->point = $averageRating; // Cập nhật lại thuộc tính point
            $product->save();
        }

        $ratingId = $rating->id;

        if ($request->hasFile('ratingImages')) {
            foreach ($request->file('ratingImages') as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $imageName);

                $ratingImage = new RatingImages();
                $ratingImage->rating_id = $ratingId;
                $ratingImage->image = 'uploads/' . $imageName;
                $ratingImage->save();
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Đánh giá của bạn đã được gửi!'
        ]);
    }
    public function cancelOrder(Request $request)
    {
        // Tìm đơn hàng
        $order = Orders::find($request->id);

        // Kiểm tra sự tồn tại của đơn hàng và quyền của người dùng
        if (!$order || $order->user_id !== auth()->id()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Đơn hàng không tồn tại hoặc không thuộc quyền của bạn.'
            ], 404);
        }

        // Kiểm tra trạng thái của đơn hàng
        if (in_array($order->status, ['canceled', 'completed', 'delivered'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không thể hủy đơn hàng đã được xử lý hoặc giao hàng.'
            ], 400);
        }

        // Lấy danh sách chi tiết đơn hàng
        $details = OrderDetails::where('order_id', $order->id)->get();

        Log::info('Details: ' . json_encode($details));
        foreach ($details as $detail) {
            // Tìm VariantColors liên quan đến sản phẩm
            $variantColors = VariantColors::find($detail->variant_color_id);
            \Log::info('VariantColors: ' . json_encode($variantColors));
            // Nếu không tìm thấy, bỏ qua sản phẩm này
            if ($variantColors) {
                \Log::info('Quantity detail: ' . $detail->quantity);
                $variantColors->quantity += $detail->quantity;
                \Log::info('Quantity: ' . $variantColors->quantity);
                $variantColors->save();
            }
        }

        \Log::info('Order ID: ' . $order->id);
        // Tạo bản ghi hủy đơn hàng
        $orderCancel = new OrderCancel();
        $orderCancel->order_id = $order->id;
        $orderCancel->reason = $request->reason;
        $orderCancel->order_cancel_date = Carbon::now();
        $orderCancel->save();

        // Cập nhật trạng thái đơn hàng
        $order->status = 'canceled';
        $order->save();

        // Trả về JSON thông báo thành công
        return response()->json([
            'status' => 'success',
            'message' => 'Đơn hàng đã được hủy!'
        ]);
    }


    public function allCancelOrder(UserCancelOrderDataTable $dataTable)
    {
        return $dataTable->render('frontend.user.dashboard.order.cancel');
    }
    public function allCompleteOrder(UserCompleteOrderDataTable $dataTable)
    {
        return $dataTable->render('frontend.user.dashboard.order.complete');
    }
}
