<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\PaypalSettings;

class PaymentSettingController extends Controller
{
    public function index()
    {
        $paypalSetting = PaypalSettings::first();
        return view('backend.admin.payment-settings.index', compact('paypalSetting'));
    }
}
