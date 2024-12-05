<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdminCouponDataTable;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class AdminCouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AdminCouponDataTable $adminCouponDataTable)
    {
        return $adminCouponDataTable->render('backend.admin.coupon.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons',
            'name' => 'required',
            'quantity' => 'required',
            'discount_type' => 'required',
            'discount' => 'required',
            'max_use' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'required_points' => 'required',
            'status' => 'required',
        ]);
        $coupon = new Coupon();
        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->quantity= $request->quantity;
        $coupon->status = $request->status;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->required_points = $request->required_points;
        $coupon->discount_type = $request->discount_type;
        $coupon->discount = $request->discount;
        $coupon->max_use = $request->max_use;
        $coupon->save();

        toastr()->success('Thêm mã giảm giá thành công');
        return redirect()->route('admin.admincoupon.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = Coupon::find($id);
        return view('backend.admin.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'code' => 'required|unique:coupons,code,'.$id,
            'name' => 'required',
            'quantity' => 'required',
            'discount_type' => 'required',
            'discount' => 'required',
            'max_use' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'required_points' => 'required',
            'status' => 'required',
        ]);
        $coupon = Coupon::find($id);
        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->quantity= $request->quantity;
        $coupon->status = $request->status;
        $coupon->discount_type = $request->discount_type;
        $coupon->discount = $request->discount;
        $coupon->max_use = $request->max_use;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->required_points = $request->required_points;
        $coupon->save();
        return redirect()->route('admin.admincoupon.index')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return response()->json(['status' => 'success', 'message' => 'Xóa thành công']);
    }
    public function changeStatus(Request $request)
    {
        $coupon = Coupon::findOrFail($request->id);
        $coupon->status = !$coupon->status;
        $coupon->save();
        return response()->json(['status' => 'success', 'message' => 'Cập nhật trạng thái thành công']);
    }
}
