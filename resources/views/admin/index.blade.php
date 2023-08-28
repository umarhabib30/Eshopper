@extends('admin/layout')
@section('title','Dashboard')

@section('pagename','Dashboard')

@section('content')

<div class="page-content-wrapper ">

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="mini-stat clearfix bg-primary">
                    <span class="mini-stat-icon"><i class="dripicons-shopping-bag"></i></span>
                    <div class="mini-stat-info text-right text-white">

                        <span class="counter">{{App\Models\Product::count()}}</span>
                        Total Products
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="mini-stat clearfix bg-primary">
                    <span class="mini-stat-icon"><i class="mdi mdi-buffer"></i></span>
                    <div class="mini-stat-info text-right text-white">
                        <span class="counter">{{App\Models\Category::count()}}</span>
                        Total Categories
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="mini-stat clearfix bg-primary">
                    <span class="mini-stat-icon"><i class="mdi mdi-cube-outline"></i></span>
                    <div class="mini-stat-info text-right text-white">
                        <span class="counter">{{App\Models\Sales::count()}}</span>
                        Total Sales
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="mini-stat clearfix bg-primary">
                    <span class="mini-stat-icon"><i class="mdi mdi-currency-btc"></i></span>
                    <div class="mini-stat-info text-right text-white">

                        <span class="counter">{{App\Models\Sales::sum('grandtotal')}}</span>
                        Total Revenue
                    </div>
                </div>
            </div>
        </div>


    </div><!-- container-fluid -->

</div> <!-- Page content Wrapper -->

@endsection
