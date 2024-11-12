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
}
