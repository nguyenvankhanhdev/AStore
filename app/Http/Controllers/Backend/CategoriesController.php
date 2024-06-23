<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CategoriesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index(CategoriesDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.categories.index');
    }

    public function create()
    {
        return view('backend.admin.categories.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200', 'unique:categories,name'],
        ]);
        $category =new Categories();
        $category->name = $request->name;
        $category->slug= Str::slug($request->name);
        $category->save();
        toastr()->success('Category successfully', 'Success');
        return redirect()->route('admin.categories.index');
    }
    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        $categories = Categories::findOrFail($id);
        return view('backend.admin.categories.edit', compact('categories'));
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200', 'unique:categories,name,'.$id],
        ]);
        $category = Categories::findOrFail($id);
        $category->name = $request->name;
        $category->slug= Str::slug($request->name);
        $category->save();
        toastr()->success('Update successfully!', 'Success');
        return redirect()->route('admin.categories.index');
    }
    public function destroy(string $id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();
        toastr()->success('Delete successfully!', 'Success');
        return redirect()->route('admin.categories.index');
    }
}
