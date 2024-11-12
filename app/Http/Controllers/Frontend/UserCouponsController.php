<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\CouponDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\UserCouponsDataTable;
use App\Models\Coupon;
use App\Models\User;
use App\Models\UserCoupons;

class UserCouponsController extends Controller
{
    public function index(UserCouponsDataTable $couponDataTable)
    {
        return $couponDataTable->render('frontend.user.dashboard.coupons.index');
    }
    public function showcoupons(CouponDataTable $couponDataTable)
    {

        return $couponDataTable->render('frontend.user.dashboard.coupons.showcoupons');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function redeem(Request $request)
    {

        $user = User::find(auth()->id());
        $couponId = $request->input('coupon_id');
        $coupon = Coupon::find($couponId);

        if ($user->point >= $coupon->required_points) {
            $user->point -= $coupon->required_points;
            $user->save();
            UserCoupons::create([
                'user_id' => $user->id,
                'coupon_id' => $couponId,
            ]);

            return response()->json(['status' => 'success', 'message' => 'Đổi thành công']);
        }

        return response()->json(['status' => 'error', 'message' => 'Bạn không đủ điểm để đổi mã giảm giá này.']);
    }

    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

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
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {}


    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id) {}
}
