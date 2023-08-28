<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function store(Request $request)
    {
       $response= Category::create([
            'name'=> $request->name,
        ]);
       return response()->json($response);

    }

    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index',['categories'=>$categories]);
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.update',['category'=>$category]);
    }

    public function update(Request $request)
    {
        $category = Category::find($request->id);
        $category->update($request->all());
        return redirect()->route('admin.category.index');
    }

    public function delete(Request $request)
    {

        $category = Category::find($request->id);
        $category->delete();
        return response()->json();
    }

    public function subcat(Request $request)
    {

        $subcat = SubCategory::where('parent_id',$request->id)->get();
        return response()->json($subcat);
    }

    public function products($id)
    {

        $category = Category::find($id);
        $products= $category->products;
       
        return view('admin.category.product',['products'=>$products]);
    }
}
