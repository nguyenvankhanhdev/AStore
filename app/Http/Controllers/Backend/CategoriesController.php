<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CategoriesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\SubCategories;
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
        $category = new Categories();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();
        return redirect()->route('admin.categories.index')->with('success', 'Create successfully');
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
            'name' => ['required', 'max:200', 'unique:categories,name,' . $id],
        ]);
        $category = Categories::findOrFail($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();
        return redirect()->route('admin.categories.index')->with('success', 'Update successfully');
    }
    public function destroy(string $id)
    {
        $categories = Categories::findOrFail($id);
        $subCategories = SubCategories::where('cate_id', $categories->$id)->count();
        if ($subCategories > 0) {
            return response(['status' => 'error', 'message' => 'This items contain, sub items for delete this you have to delete the sub items first!']);
        }
        $categories->delete();
        return response(['status' => 'success','message'=> 'Deleted Successfully!']);
    }
}
