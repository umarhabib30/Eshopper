<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function store(Request $request)
    {
        SubCategory::create([
            'name'=>$request->name,
            'parent_id'=>$request->category,
        ]);
        return response()->json();
    }

    public function index()
    {
        $subcategories = SubCategory::all();
        return view('admin.subcategory.index',['subcategories'=>$subcategories]);
    }

    public function edit($id)
    {
        $subcategory = SubCategory::find($id);
        return view('admin.subcategory.update',['subcategory'=>$subcategory]);
    }

    public function update(Request $request)
    {
        $subcategory = SubCategory::find($request->id);
        $subcategory->update($request->all());
        return redirect()->route('admin.subcategory.index');
    }

    public function delete(Request $request)
    {

        $subcat = SubCategory::find($request->id);
        $subcat->delete();
        return response()->json();
    }

    public function products($id)
    {
        $subcat = SubCategory::find($id);
        $products = $subcat->products;
        return view('admin.subcategory.product',['products'=>$products]);

    }
}
