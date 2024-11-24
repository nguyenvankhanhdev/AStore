<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Accessories;
use App\Models\Products;
use App\Models\SubCategories;
use Illuminate\Http\Request;

class ProductSupportController extends Controller
{
    public function index(Request $request)
    {
        $product = Products::findOrFail($request->product);
        $accessories = Accessories::where('pro_id', $product->id)->get();
        $subcategory=SubCategories::all();
        return view('backend.admin.product.support.index', compact('product','accessories','subcategory'));
    }

    public function store(Request $request)
    {
        $accessory=new Accessories();
        $accessory->pro_id=$request->pro_id;
        $accessory->sub_cate_id=$request->subcate_id;
        $accessory->save();
        return redirect()->route('admin.product-support.index', ['product' => $request->pro_id])->with('success', 'Link Successfully');
    }

    public function destroy(Request $request)
    {
        $accessory = Accessories::where('pro_id', $request->pro_id)
                                ->where('sub_cate_id', $request->subcate_id)
                                ->first();
        $accessory->delete();
        return redirect()->route('admin.product-support.index', ['product' => $request->pro_id])->with('success', 'Unlink Successfully');
    }
}
