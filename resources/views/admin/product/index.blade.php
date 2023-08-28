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
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $key => $product)
                    <tr id="product-{{ $product->id }}">

                        <td>{{ ++$key }}</td>
                        <td id="name-{{$product->id}}">{{ $product->name }}</td>
                        <td id="price-{{$product->id}}">{{ $product->price }}</td>
                        <td id="cat-{{$product->id}}">{{ $product->category->name }}</td>
                        <td id="subcat-{{$product->id}}">{{ $product->subcategory->name }}</td>
                        <td id="stock-{{$product->id}}">{{ $product->stock }}</td>
                        <td id="stock-limit-{{$product->id}}">{{ $product->stock_limit }}</td>
                        <td>
                            <textarea name="" id="description-{{$product->id}}" cols="40" rows="3" readonly>{{ $product->description }}</textarea>
                        </td>
                        <td><img src="{{ $product->image }}" width="100px" height="100px" id="image-{{$product->id}}"></td>
                        <td><button product-id="{{ $product->id }}" class="btn btn-danger edit_data">Edit</button></td>
                        <td><button class="delete btn btn-primary" product-id="{{ $product->id }}">Delete</button></td>

                    </tr>
                @endforeach

            </tbody>
    </div>
    </table>

@endsection
@section('modal')

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-dialog-scrollable ">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Product</h4>
                    <button type="button" class="btn-close close_modal" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    {{--  body start --}}
                    <div class="container mt-3">
                        <form action="{{ route('admin.product.update') }}" method="POST" enctype="multipart/form-data"
                            id="form-update">
                            @csrf
                            <input type="hidden" name="id" id="produc_id">
                            <div class="row">
                                <div class="col-sm-12 mb-3 mt-3">
                                    <label for="name">Product Name</label>
                                    <input type="texr" class="form-control" id="name" name="name">
                                </div>
                                <div class="col-sm-12 mb-3 mt-3">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price" name="price">
                                </div>
                                <div class="col-sm-6 mb-3 mt-3">
                                    <label for="stock">Stock</label>
                                    <input type="number" class="form-control" id="stock" name="stock">
                                </div>
                                <div class="col-sm-6 mb-3 mt-3">
                                    <label for="stock_limit">Stock Limit</label>
                                    <input type="number" class="form-control" id="stock_limit" name="stock_limit">
                                </div>
                                <div class="col-sm-6 mb-3 mt-3">
                                    <label for="category_id">Category</label>
                                    <select class="form-control" id="category_id" class="category_id" name="cat_id">

                                    </select>
                                </div>
                                <div class="col-sm-6 mb-3 mt-3">
                                    <label for="category">Sub-Category</label>
                                    <select class="form-control" id="sub-category" name="subcat_id">
                                    </select>
                                </div>
                                <div class="col-sm-12 mb-3 mt-3">
                                    <label for="description">Description</label>
                                    <textarea id="description" class="form-control" rows="3" name="description"></textarea>
                                </div>
                                <div class="col-sm-12 mb-3 mt-3">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                            </div>


                    </div>
                    {{--  body end --}}
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary close_modal" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Update</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

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
            $('body').on('click', '.edit_data', function(e) {
                e.preventDefault();
                let product_id = $(this).attr('product-id');
                edit(product_id);
            });
            $('body').on('click', '.close_modal', function(e) {
                e.preventDefault();
                $('#myModal').hide();

            });
            $('body').on('change', '#category_id', function(e) {
                e.preventDefault();
                var cat_id = this.value;
                subcat(cat_id);
            });
            $('body').on('submit', '#form-update', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr("action"),
                    type: $(this).attr("method"),
                    dataType: "JSON",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#name-'+response.updated.id).html(response.updated.name);
                        $('#price-'+response.updated.id).html(response.updated.price);
                        $('#cat-'+response.updated.id).html(response.category.name);
                        $('#subcat-'+response.updated.id).html(response.subcategory.name);
                        $('#stock-'+response.updated.id).html(response.updated.stock);
                        $('#stock-limit-'+response.updated.id).html(response.updated.stock_limit);
                        $('#description-'+response.updated.id).html(response.updated.description);
                        $('#image-'+response.updated.id).attr('src',response.updated.image);
                        $('#myModal').hide();
                    },
                    error: function(error) {
                        console.log(error);
                        var myWindow = window.open("", "MsgWindow", "width=500,height=250");
                        myWindow.document.write(error.responseText);
                    }
                });
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
                    var div = document.getElementById('product-' + id);
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

        function edit(id) {
            let data = {
                id: id,
                expectsJson: true,
            };
            $.ajax({
                url: "{{ route('admin.product.edit') }}",
                type: 'post',
                data: data,
                success: function(response) {
                    console.log(response);
                    document.getElementById('form-update').reset();
                    $('#produc_id').val(response.product.id);
                    $('#name').val(response.product.name);
                    $('#price').val(response.product.price);
                    $('#stock').val(response.product.stock);
                    $('#stock_limit').val(response.product.stock_limit);
                    $('#category_id').html('<option value="'+response.product.cat_id+'">'+response.category.name+'</option>');
                    $.each(response.all_cat, function(key, value)
                    {
                        if(response.product.cat_id==value.id)
                            {return;}
                        $("#category_id").append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    $('#sub-category').html('<option value="'+response.product.subcat_id+'">'+response.subcategory.name+'</option>');
                    $.each(response.all_subcat, function(key, value)
                    {
                        if(response.product.subcat_id==value.id)
                            {return;}
                        $("#sub-category").append('<option value="' + value.id + '">' + value.name + '</option>');
                    });

                    $('#description').html(response.product.description);
                    $('#myModal').show();
                },
                error: function(error) {
                    console.log(error);
                    var myWindow = window.open("", "MsgWindow", "width=500,height=250");
                    myWindow.document.write(error.responseText);
                }
            });
        }


        function subcat(cat_id) {

            let data = {
                id: cat_id,
                expectsJson: true,
            };
            $.ajax({
                url: "{{ route('admin.product.subcategory') }}",
                type: 'post',
                data: data,
                success: function(response) {
                    console.log(response);
                    $('#sub-category').html(
                        '<option value="">-- Select Sub-Category --</option>');
                    $.each(response, function(key, value) {
                        $("#sub-category").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });


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

@section('script')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection
