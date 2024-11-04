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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userCount = User::count();
        $categoryCount = Categories::count();
        $totalOrders = Orders::count();
        $todaysOrders = Orders::whereDate('created_at', Carbon::today())->count();

        // Lấy đơn hàng trong ngày
        $todaysOrdersData = Orders::whereDate('created_at', Carbon::today())
            ->where('status', 'delivered')
            ->get();

        // Tính lợi nhuận trong PHP
        $dailyProfit = $todaysOrdersData->sum(function ($order) {
            return $order->total_amount - $order->cost_price;
        });

        // Lấy đơn hàng trong tháng
        $monthlyOrdersData = Orders::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->where('status', 'delivered')
            ->get();

        $monthlyProfit = $monthlyOrdersData->sum(function ($order) {
            return $order->total_amount - $order->cost_price;
        });

        // Lấy đơn hàng trong năm
        $yearlyOrdersData = Orders::whereYear('created_at', Carbon::now()->year)
            ->where('status', 'delivered')
            ->get();

        $yearlyProfit = $yearlyOrdersData->sum(function ($order) {
            return $order->total_amount - $order->cost_price;
        });

        // Truyền dữ liệu vào view
        return view('backend.admin.dashboard.index', compact(
            'userCount',
            'categoryCount',
            'totalOrders',
            'todaysOrders',
            'dailyProfit',
            'monthlyProfit',
            'yearlyProfit'
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
    public function login(){
        return view('backend.auth.login');
    }
}
