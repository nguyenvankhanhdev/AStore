<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\UserOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    public function index(UserOrderDataTable $dataTable)
    {
        return $dataTable->render('frontend.user.dashboard.order.index');
    }
    public function show($id)
    {
        $order = Orders::find($id);
        return view('frontend.user.dashboard.order.show', compact('order'));
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
