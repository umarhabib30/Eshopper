@extends('admin.layout')
@section('title','Invoice')
@section('pagename')
    Invoice
@endsection
@section('content')
<div class="page-content-wrapper ">

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-12">
                                <div class="invoice-title">
                                    <h4 class="pull-right font-16"><strong>Order # 12345</strong></h4>
                                    <h3 class="m-t-0">
                                        <img src="assets/images/logo.png" alt="logo" height="42"/>
                                    </h3>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-6 m-t-30">
                                        <address>
                                            <strong>Payment Method : </strong>Cash

                                        </address>
                                    </div>
                                    <div class="col-6 m-t-30 text-right">
                                        <address>
                                            <strong>Order Date:</strong>
                                            {{Carbon\Carbon::parse($sale->created_at)->toFormattedDateString()}}
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="panel panel-default">
                                    <div class="p-2">
                                        <h3 class="panel-title font-20"><strong>Order summary</strong></h3>
                                    </div>
                                    <div class="">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <td><strong>Item</strong></td>
                                                    <td class="text-center"><strong>Price</strong></td>
                                                    <td class="text-center"><strong>Quantity</strong>
                                                    </td>
                                                    <td class="text-right"><strong>Totals</strong></td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                @foreach ($saleitems as $key => $item)
                                                <tr>
                                                    <td>{{$item->product->name}}</td>
                                                    <td class="text-center">{{$item->product->price}}</td>
                                                    <td class="text-center">{{$item->product_qty}}</td>
                                                    <td class="text-right">{{$item->subtotal}}</td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <hr>
                                            <h5 class="pull-right">Grand Totoal : {{$sale->grandtotal}} </h5>
                                        </div>

                                        <div class="hidden-print">
                                            <div class="pull-right">
                                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div> <!-- end row -->

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div><!-- container-fluid -->


</div> <!-- Page content Wrapper -->
@endsection

