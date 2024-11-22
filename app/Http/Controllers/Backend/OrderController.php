<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CanceledOrderDataTable;
use App\DataTables\CompletedOrderDataTable;
use App\DataTables\DeliveredOrderDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\OrderDataTable;
use App\DataTables\PendingOrderDataTable;
use App\DataTables\ProcessedOrderDataTable;
use App\Models\Orders;

class OrderController extends Controller
{
    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.orders.index');
    }

    public function pendingOrder(PendingOrderDataTable $dataTable)
    {

        return $dataTable->render('backend.admin.orders.pending-order');
    }

    public function processedOrders(ProcessedOrderDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.orders.processed-order');
    }

    public function deliveredOrders(DeliveredOrderDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.orders.delivered-order');
    }

    public function canceledOrders(CanceledOrderDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.orders.canceled-order');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Orders::with([
            'orderDetails.variantColors.variant.product',
            'orderDetails.variantColors.color',
            'orderDetails.variantColors.variant.storage',
            'coupon'
        ])->findOrFail($id);

        $subTotal = $order->orderDetails->sum('total_price');

        $totalDiscount = 0;
        if ($order->coupon) {
            if ($order->coupon->discount_type === 'percent') {
                $totalDiscount = $subTotal * ($order->coupon->discount / 100);
            } elseif ($order->coupon->discount_type === 'amount') {
                $totalDiscount = $order->coupon->discount * 1000;
            }
        }

        // Tổng tiền sau giảm giá
        $totalAfterDiscount = max($subTotal - $totalDiscount, 0); // Đảm bảo không âm

        return view('backend.admin.orders.show', compact('order', 'subTotal', 'totalDiscount', 'totalAfterDiscount'));
    }





    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Orders::findOrFail($id);

        $order->orderProducts()->delete();
        $order->transaction()->delete();

        $order->delete();

        return response(['status' => 'success', 'message' => 'Deleted successfully!']);
    }

    public function changeOrderStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:orders,id',
            'status' => 'required|string'
        ]);

        try {
            $order = Orders::findOrFail($request->id);
            $order->status = $request->status;
            $order->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Order status updated successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update order status. ' . $e->getMessage()
            ], 500);
        }
    }


    public function changePaymentStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:orders,id',
            'status' => 'required|string|in:pending,completed'
        ]);

        try {
            $order = Orders::findOrFail($request->id);
            $order->payment_status = $request->status;
            $order->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Payment status updated successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update payment status. ' . $e->getMessage()
            ], 500);
        }
    }
}
