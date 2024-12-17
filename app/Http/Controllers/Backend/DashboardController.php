<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Order;
use App\Models\Orders;
use Illuminate\Http\Request;
use App\Models\User;
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
            ->where(['status' => 'completed'])

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
            'todayPendingOrderCount'
        ));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
