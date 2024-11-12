<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;


class UserDashboardController extends Controller
{
    public function index():View
    {
        return view('frontend.user.dashboard.dashboard');
    }


}
