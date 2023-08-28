<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sales;
use App\Models\SalesItem;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;

class SaleController extends Controller
{
    public function products(Request $request)
    {
        $subcat = SubCategory::find($request->id);
        $products = $subcat->products;
        return response()->json($products);
    }

    public function productDetails(Request $request)
    {

        $product = Product::find($request->id);
        return response()->json($product);
    }

    public function store(Request $request)
    {
       $sale = Sales::create([
        'grandtotal'=>$request->grandtotal,
        'grand_qty'=>$request->grand_qty,
       ]);
       foreach($request->product_id as $key=>$product_id)
       {
            SalesItem::create([
                'sale_id'=>$sale->id,
                'product_id'=>$product_id,
                'product_qty'=>$request->product_qty[$key],
                'subtotal'=>$request->subtotal[$key],
            ]);
            $product = Product::find($product_id);
            $quantity = $product->stock - $request->product_qty[$key];
           $product->update([
            'stock'=>$quantity,
           ]);
       }
       return response()->json($sale);
    }

    public function graph(Request $request)
    {

        //dd($request->date);

        $date = Carbon::parse($request->date);
        $date2=Carbon::parse($request->date);
        if($request->duration == 1)
        {
            $newdate = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
            $days = $date->addDays(7);
            $week = Carbon::createFromFormat('Y-m-d H:i:s', $days)->format('Y-m-d');
            $sales = Sales::selectRaw('Day(created_at) as day, SUM(grandtotal) as count')->whereBetween('created_at',[$newdate,$week])->groupBy('day')->orderBy('day')->get();
             $dates=[];
             $counts=[];
                for($i=0; $i<7; $i++)
                {
                    $count =0;
                    $s2= Carbon::createFromFormat('Y-m-d H:i:s', $date2)->format('d');
                   foreach($sales as $sale)
                   {
                        if($sale->day == $s2)
                        {
                            $count= $sale->count;
                            break;
                        }
                   }
                   array_push($dates,$s2);
                   array_push($counts,$count);
                   $sday = $date2->addDays(1);
                   $s2= Carbon::createFromFormat('Y-m-d H:i:s', $sday)->format('d');
                }

        }
        else if($request->duration == 2)
        {
            $month = Carbon::createFromFormat('Y-m',$request->month)->format('m');
            $year = Carbon::createFromFormat('Y-m',$request->month)->format('Y');
            $sales = Sales::selectRaw('Day(created_at) as day, sum(grandtotal) as count')->whereMonth('created_at',$month)->whereYear('created_at',$year)->groupBy('day')->orderBy('day')->get();
            $days= Carbon::now()->month($month)->daysInMonth;
            $dates=[];
            $counts=[];
            for($i=1; $i<=$days;$i++)
            {
                $count =0;
                foreach($sales as $sale)
                {
                    if($sale->day == $i)
                    {
                        $count = $sale->count;
                        break;
                    }
                }
                array_push($dates,$i);
                array_push($counts,$count);
            }
        }
        else if($request->duration == 3)
        {
            $sales= Sales::selectRaw('Month(created_at) as day, sum(grandtotal) as count')->whereYear('created_at',$request->year)->groupBy('day')->orderBy('day')->get();
            $dates = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            $counts=[];
            for($i=1 ; $i<=12;$i++)
            {
                $count=0;
                foreach($sales as $sale)
                {
                    if($sale->day == $i)
                    {
                        $count = $sale->count;
                    }
                }
                array_push($counts,$count);
            }

        }
        return response()->json([
            'dates'=>$dates,
            'count'=>$counts,
        ]);

    }

    public function all_sales()
    {
        $sales = Sales::all();
        return view('admin.sales.sales',['sales'=>$sales]);
    }

    public function show_items($id)
    {

        $sale = Sales::find($id);
        $saleitems= $sale->sale_items;
        return view('admin.sales.items',['saleitems'=>$saleitems]);
    }

    public function invoice($id)
    {

        $sale = Sales::find($id);
        $saleitems= $sale->sale_items;

        return view('admin.sales.invoice',['sale'=>$sale, 'saleitems'=>$saleitems]);

    }


}//end of class
