<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Provinces;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Validator;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = UserAddress::where('user_id', auth()->id())->get();
        return view('frontend.user.dashboard.address.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = Provinces::all();
        return view('frontend.user.dashboard.address.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'province' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'address' => 'required',
        ]);
        $address = new UserAddress();
        $address->user_id = auth()->id();
        $address->name = $request->name;
        $address->phone = $request->phone;
        $address->email = $request->email;
        $address->province = $request->province;
        $address->district = $request->district;
        $address->ward = $request->ward;
        $address->address = $request->address;
        $address->save();
        return  redirect()->route('user.address.index')->withSuccess('Tạo đia chỉ thành công');
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
        $address = UserAddress::findOrFail($id);
        $provinces = Provinces::all();
        return view('frontend.user.dashboard.address.edit', compact('address', 'provinces'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $address = UserAddress::findOrFail($id);

        // Validate required fields
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);

        $address->name = $request->input('name');
        $address->email = $request->input('email');
        $address->phone = $request->input('phone');
        $address->address = $request->input('address');

        if ($request->has('province') && $request->input('province') !== $address->province) {
            $address->province = $request->input('province');
        }
        if ($request->has('district') && $request->input('district') !== $address->district) {
            $address->district = $request->input('district');
        }
        if ($request->has('ward') && $request->input('ward') !== $address->ward) {
            $address->ward = $request->input('ward');
        }
        $address->save();
        return redirect()->route('user.address.index')->withSuccess('Cập nhật thành công.');
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        $address = UserAddress::findOrFail($id);
        $address->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
