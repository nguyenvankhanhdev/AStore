<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Order;
use App\Models\Orders;
use App\Models\Ratings;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $categoryCount = Categories::count();
        $totalOrders = Orders::count();
        $todaysOrders = Orders::whereDate('created_at', Carbon::today())->count();

        $pendingOrderCount = Orders::where('status', 'pending')->count();

        $canceledOrderCount = Orders::where('status', 'canceled')->count();
        $completedOrderCount = Orders::where('status', 'completed')->count();

        $todaysOrdersData = Orders::whereDate('created_at', Carbon::today())->get();
        $todayPendingOrderCount = Orders::whereDate('created_at', Carbon::today())
            ->where('status', 'pending')
            ->count();


        $dailyProfit = $todaysOrdersData
            ->where('status', 'completed')
            ->sum(function ($order) {
                return $order->total_amount;
            });

        // dd($dailyProfit);
        $todaysTotalQuantity = $todaysOrdersData->sum('quantity');


        $monthlyOrdersData = Orders::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)

            ->where(['status'=> 'completed'])

            ->get();

        $monthlyProfit = $monthlyOrdersData->sum(function ($order) {
            return $order->total_amount;
        });

        $yearlyOrdersData = Orders::whereYear('created_at', Carbon::now()->year)

            ->where(['status' => 'completed'])
            ->get();

        $yearlyProfit = $yearlyOrdersData->sum(function ($order) {
            return $order->total_amount - $order->cost_price;
        });
        $totalReview = Ratings::count();
        return view('backend.admin.dashboard.index', compact(
            'userCount',
            'categoryCount',
            'totalOrders',
            'todaysOrders',
            'dailyProfit',
            'todaysTotalQuantity',
            'pendingOrderCount',
            'canceledOrderCount',
            'completedOrderCount',
            'monthlyProfit',
            'yearlyProfit',
            'todayPendingOrderCount',
            'totalReview'
        ));
    }

    public function profile()
    {
        return view('backend.admin.profile.index');
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,'.Auth::user()->id],
            'image' => ['image', 'max:2048']
           ]);


           $user = Auth::user();

           if($request->hasFile('image')){
                if(File::exists(public_path($user->image))){
                    File::delete(public_path($user->image));
                }
                $image = $request->image;
                $imageName = rand().'_'.$image->getClientOriginalName();
                $image->move(public_path('uploads'), $imageName);

                $path = "/uploads/".$imageName;

                $user->image = $path;
           }

           $user->name = $request->name;
           $user->email = $request->email;
           $user->save();

           toastr()->success('Profile Updated Successfully!');
           return redirect()->back();
    }
    public function updatePass(Request $request, string $id){
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required','confirmed', 'min:8']
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        toastr()->success('Profile Password Updated Successfully!');
        return redirect()->back();
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
