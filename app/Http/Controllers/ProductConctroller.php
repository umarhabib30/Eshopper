<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductConctroller extends Controller
{
    public function store(Request $request)
    {
        Product::create($request->all());
        return response()->json();
    }

    public function index()
    {
        $products = Product::all();
        return view('admin.product.index',['products'=>$products]);
    }

    public function delete(Request $request)
    {
        $product = Product::find($request->id);
        $product->delete();
        return response()->json();
    }

    public function edit(Request $request)
    {
        $product = Product::find($request->id);
        $category= $product->category;
        $subcategory= $product->subcategory;
        $all_cat = Category::all();
        $all_subcat = SubCategory::where('parent_id',$product->cat_id)->get();

        return response()->json([
            'product'=>$product,
            'category'=>$category,
            'subcategory'=>$subcategory,
            'all_cat'=>$all_cat,
            'all_subcat'=>$all_subcat,
        ]);
    }
    public function update(Request $request)
    {

        $product = Product::find($request->id);
        $product->update($request->all());
        $updated = Product::find($request->id);
        $category= $updated->category;
        $subcategory= $updated->subcategory;
        return response()->json([
            'updated'=>$updated,
            'category'=>$category,
            'subcategory'=>$subcategory,

        ]);
    }

    public function limited()
    {
        $products = Product::whereColumn('stock','<=','stock_limit')->get();
        return view('admin.product.limited',['products'=>$products]);
    }
}
