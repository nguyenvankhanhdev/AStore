<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SubCategoriesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\SubCategories;
use Illuminate\Support\Str;

class SubCategoriesController extends Controller
{
    public function index(SubCategoriesDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.sub-categories.index');
    }
    public function create()
    {
        $categories = Categories::all();
        return view('backend.admin.sub-categories.create', compact('categories'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'max:200', 'unique:sub_categories,name'],
            'category' => ['required'],

        ]);
        $subCategory = new SubCategories();
        $subCategory->name = $request->name;
        $subCategory->slug = Str::slug($request->name);
        $subCategory->cate_id = $request->category;
        $subCategory->save();
        return redirect()->route('admin.sub-categories.index')->with('success', 'Create successfully');
    }
    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        $categories = Categories::all();
        $subCategory = SubCategories::findOrFail($id);
        return view('backend.admin.sub-categories.edit', compact('categories', 'subCategory'));
    }
    public function update(Request $request, string $id)
    {
        //dd($request->all());
        $request->validate([
            'name' => ['required', 'max:200', 'unique:sub_categories,name'],
            'category' => ['required'],

        ]);
        $subCategory = SubCategories::findOrFail($id);
        $subCategory->name = $request->name;
        $subCategory->slug = Str::slug($request->name);
        $subCategory->cate_id = $request->category;
        $subCategory->save();
        return redirect()->route('admin.sub-categories.index')->with('success', 'Update successfully');
    }
    public function destroy(string $id)
    {
        $subCategory = SubCategories::findOrFail($id);
        $subCategory->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
