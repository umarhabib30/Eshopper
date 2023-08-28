@extends('admin.layout')
@section('title', 'Sale items')
@section('pagename', 'Sale items')
@section('content')

    <div class="container">
        <table class="table" id="products">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($saleitems as $key => $saleitem)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $saleitem->product->name }}</td>
                        <td>{{ $saleitem->product_qty }}</td>
                        <td>{{ $saleitem->subtotal }}</td>
                        <td><img src="{{ $saleitem->product->image }}" width="40px" height="40px"></td>

                    </tr>
                @endforeach

            </tbody>
    </div>
    </table>

@endsection


@section('script')
    <script>
        $(function() {
            $("#products").dataTable();
        });


    </script>
@endsection

@section('script')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection
