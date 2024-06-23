<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {

    }
    public function index()
    {
        $ab= 'hello world';
        return view('backend.admin.layouts.master',compact('ab'));
    }
}
