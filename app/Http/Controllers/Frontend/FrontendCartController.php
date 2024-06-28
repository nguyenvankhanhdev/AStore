<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Districts;
use Illuminate\Http\Request;
use App\Models\Provinces;


class FrontendCartController extends Controller
{


    public function getDistricts($province_id)
    {
        $districts = Provinces::find($province_id)->districts;
        return response()->json($districts);
    }

    public function getWards($district_id)
    {
        $wards = Districts::find($district_id)->wards;
        return response()->json($wards);
    }

    public function index()
    {
        $provinces = Provinces::all();
        return view('frontend.user.home.cart', compact('provinces'));
    }
}
