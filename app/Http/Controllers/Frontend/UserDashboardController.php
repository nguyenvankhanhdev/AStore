<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Models\Orders;
use App\Models\Wishlist;
use App\Models\Ratings;
use App\DataTables\RatingsDataTable;
class UserDashboardController extends Controller
{
    public function index():View
    {
        $orderTotal = Orders::where('user_id', auth()->id())->count();
        $orderCompleted = Orders::where(['status'=>'completed','user_id'=>auth()->id()])->count();
        $orderPending = Orders::where(['status'=> 'pending','user_id'=>auth()->id()])->count();
        $wishlist = Wishlist::where('user_id', auth()->id())->count();
        $ratings = Ratings::where('user_id', auth()->id())->count();
        return view('frontend.user.dashboard.dashboard', compact('orderTotal', 'orderCompleted', 'orderPending', 'wishlist', 'ratings'));
    }
    public function reviews(RatingsDataTable $dataTable)
    {
        return $dataTable->render('frontend.user.dashboard.reviews.index');
    }


}
