<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\UserOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Products;
use App\Models\RatingImages;
use App\Models\Ratings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
    public function index(UserOrderDataTable $dataTable)
    {
        return $dataTable->render('frontend.user.dashboard.order.index');
    }
    public function show($id)
    {
        $order = Orders::find($id);
        $arrayOrderDetailId=OrderDetails::getIdsByOrderId($order->id);
        $arrayOrderDetailIdInRating=Ratings::filterExistingOrderDetails($arrayOrderDetailId);
        return view('frontend.user.dashboard.order.show', compact('order','arrayOrderDetailIdInRating'));
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
    $order = Orders::find($request->id);

    if ($order) {
        $order->status = 'canceled';
        $order->save();

        return response()->json(['message' => 'Đơn hàng đã được hủy']);
    }

    return response()->json(['message' => 'Không tìm thấy đơn hàng'], 404);
}

}
