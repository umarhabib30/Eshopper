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
                    <th>Sub-category</th>
                    <th>Stock</th>
                    <th>Limit</th>
                    <th>Description</th>
                    <th>Image</th>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $key => $product)
                    <tr id="product-{{$product->id}}">

                        <td>{{ ++$key }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{$product->subcategory->name}}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{$product->stock_limit}}</td>
                        <td>{{ $product->description }}</td>
                        <td><img src="{{ $product->image }}" width="100px" height="100px"></td>
                        <td><a href="{{route('admin.product.edit',$product->id)}}" class="btn btn-danger">Edit</a></td>
                        <td><button type="submit" class="delete btn btn-primary" product-id="{{$product->id}}">Delete</button></td>

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
        $(document).ready(function() {
            $('body').on('click', '.delete', function(e) {
                e.preventDefault();
                let id = $(this).attr('product-id');
                destroy(id);
            });
        });


        function destroy(id) {
            let data = {
                id: id,
                expectsJson: true,
            };
            $.ajax({
                url: "{{ route('admin.product.delete') }}",
                type: 'post',
                data: data,
                success: function(response) {
                    var div = document.getElementById('product-'+id);
                    div.style.visibility = "hidden";
                    div.style.display = "none";
                    toastr.success('Product deleted Successfully', 'Deleted');
                },
                error: function(error) {
                    console.log(error);
                    var myWindow = window.open("", "MsgWindow", "width=500,height=250");
                    myWindow.document.write(error.responseText);
                }
            });
        }



    </script>

@endsection
