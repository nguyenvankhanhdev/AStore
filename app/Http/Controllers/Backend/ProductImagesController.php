<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductImagesDataTable   ;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use App\Models\Products;
use App\Models\ProductImages;

class ProductImagesController extends Controller
{
    use ImageUploadTrait;
    public function index(Request $request, ProductImagesDataTable $dataTable)
    {
        $product = Products::findOrFail($request->product);
        return $dataTable->render('backend.admin.product.image-gallery.index-gallery', compact('product'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'image.*' => ['required', 'image', 'max:2048']
        ]);

        /** Handle image upload */
        $imagePaths = $this->uploadMultiImage($request, 'image', 'uploads');

        foreach($imagePaths as $path){
            $productImageGallery = new ProductImages();
            $productImageGallery->image = $path;
            $productImageGallery->pro_id = $request->product;
            $productImageGallery->save();
        }
        toastr('success', 'Uploaded successfully');
        return redirect()->back();
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        $productImage = ProductImages::findOrFail($id);
        $this->deleteImage($productImage->image);
        $productImage->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
