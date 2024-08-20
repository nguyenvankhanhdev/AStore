<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Str;
use App\Models\SubCategories;
use App\Models\Categories;
use App\Traits\ImageUploadTrait;

class ProductController extends Controller
{
    use ImageUploadTrait;
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.product.index');
    }
    public function create()
    {
        $categories = Categories::all();
        return view('backend.admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:products,name'],
            'quantity' => ['required'],
            'long_description' => ['max:600'],
            'short_description' => ['string'],
            'category' => ['required'],
            'image' => ['required', 'image', 'max:3000'],
            'status' => ['required'],
        ]);

        $image = $this->uploadImage($request, 'image', 'uploads');
        $product = new Products();
        $product->image = $image ?: $product->image;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->cate_id = $request->category;
        $product->sub_cate_id = $request->sub_category;
        $product->long_description = $request->long_description;
        $product->short_description = $request->short_description;
        $product->quantity = $request->quantity;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Product created successfully');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $product = Products::findOrFail($id);
        $categories = Categories::all();
        $subCategories = SubCategories::where('cate_id', $product->cate_id)->get();
        return view('backend.admin.product.edit', compact('product', 'categories', 'subCategories'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:products,name,' . $id],
            'quantity' => ['required'],
            'long_description' => ['max:600'],
            'short_description' => ['string'],
            'category' => ['required'],
            'image' => ['image', 'max:3000'],
            'status' => ['required'],
        ]);

        $product = Products::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $this->uploadImage($request, 'image', 'uploads');
            $product->image = $image ?: $product->image;
        }

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->cate_id = $request->category;
        $product->sub_cate_id = $request->sub_category;
        $product->long_description = $request->long_description;
        $product->short_description = $request->short_description;
        $product->quantity = $request->quantity;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully');
    }



    public function destroy(string $id)
    {
        $product = Products::findOrFail($id);
        $product->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $product = Products::findOrFail($request->id);
        $product->status = $request->status == 'true' ? 1 : 0;
        $product->save();
        return response(['message' => 'Status has been updated!']);
    }
    public function getSubCategories(Request $request)
    {
        $subCategories = SubCategories::where('cate_id', $request->id)->get();

        return $subCategories;
    }
}
