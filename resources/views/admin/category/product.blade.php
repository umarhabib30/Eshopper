@extends('admin.layout')
@section('title', 'Products')
@section('pagename', 'Products')
@section('content')

    <div class="container">
        <table class="table" id="products">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Sub-Category</th>
                    <th>Stock</th>
                    <th>Limit</th>
                    <th>Description</th>
                    <th>Image</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($products as $key => $product)
                    <tr >

                        <td>{{ ++$key }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->subcategory->name }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->stock_limit }}</td>
                        <td><textarea name="" id="" cols="40" rows="3">{{ $product->description }}</textarea></td>
                        <td><img src="{{ $product->image }}" width="100px" height="100px"></td>

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
