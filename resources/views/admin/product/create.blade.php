@extends('admin.layout')
@section('title', 'Create Product')
@section('pagename', 'Create Product')

@section('content')

    <div class="container mt-3">
        <h2>Create Product</h2>
        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data" id="form-save">
            <div class="row">
                <div class="col-sm-12 mb-3 mt-3">
                    <label for="name">Product Name</label>
                    <input type="texr" class="form-control" id="name" placeholder="Enter Product Name" name="name">
                </div>
                <div class="col-sm-12 mb-3 mt-3">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" placeholder="Enter price" name="price">
                </div>
                <div class="col-sm-6 mb-3 mt-3">
                    <label for="category_id">Category</label>
                    <select class="form-control" id="category_id" class="category_id" name="cat_id">
                        <option>Select</option>
                        @foreach (App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6 mb-3 mt-3">
                    <label for="sub-category">Sub-Category</label>
                    <select class="form-control" id="sub-category" class="subcategory_id" name="subcat_id">
                    </select>
                </div>
                <div class="col-sm-6 mb-3 mt-3">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control" id="stock" placeholder="Number of products in stock"
                        name="stock">
                </div>
                <div class="col-sm-6 mb-3 mt-3">
                    <label for="stock_limit">Stock Limit</label>
                    <input type="number" class="form-control" id="stock_limit" placeholder="Put Stock Limit"
                        name="stock_limit">
                </div>
                <div class="col-sm-12 mb-3 mt-3">
                    <label for="description">Description</label>
                    <textarea id="description" class="form-control" rows="3" placeholder="Write the description of the product"
                        name="description"></textarea>
                </div>
                <div class="col-sm-12 mb-3 mt-3">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                </div>
            </div>

            <button type="submit" class="upload btn btn-primary">Create</button>
        </form>
    </div>


@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('body').on('change', '#category_id', function(e) {
                e.preventDefault();
                var cat_id = this.value;
                subcat(cat_id);

            });
            $('body').on('submit', '#form-save', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr("action"),
                    type: $(this).attr("method"),
                    dataType: "JSON",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                       document.getElementById('form-save').reset();
                       toastr.success('Product Added Successfully','Done');

                    },
                    error: function(error) {
                        console.log(error);
                        var myWindow = window.open("", "MsgWindow", "width=500,height=250");
                        myWindow.document.write(error.responseText);
                    }
                });
            });

        });


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


<!--------------------------------------------------------------->
