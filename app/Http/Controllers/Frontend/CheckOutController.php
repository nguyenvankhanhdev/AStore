<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class CheckOutController extends Controller
{
    protected $paymentController;
    public function __construct(PaymentController $paymentController) {
       $this->paymentController = $paymentController;
    }

    public function checkOut(Request $request)
    {
        $paymentMethod = $request->paymentMethod;
        Log::info('Data check out: ' . json_encode($request->all()));
        switch ($paymentMethod) {
            case 1:
                return $this->paymentController->payWithCOD($request);
            case 2:
                return $this->paymentController->payWithVNPAY($request);
            default:
                return response()->json(['error' => 'Phương thức thanh toán không hợp lệ'], 400);
        }
    }
    public function checkOutPayPal(Request $request)
    {
        return $this->paymentController->payWithPaypal($request);
    }
}
