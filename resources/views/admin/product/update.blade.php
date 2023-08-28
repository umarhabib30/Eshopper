@extends('admin.layout')
@section('title', 'Update Product')
@section('pagename', 'Update Product')

@section('content')

    <div class="container mt-3">
        <h2>Update Product</h2>
        <form action="{{ route('admin.product.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">
            <div class="row">
                <div class="col-sm-12 mb-3 mt-3">
                    <label for="name">Product Name</label>
                    <input type="texr" class="form-control" id="name" name="name" value="{{ $product->name }}">
                </div>
                <div class="col-sm-12 mb-3 mt-3">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}">
                </div>
                <div class="col-sm-6 mb-3 mt-3">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ $product->stock }}">
                </div>
                <div class="col-sm-6 mb-3 mt-3">
                    <label for="stock_limit">Stock Limit</label>
                    <input type="number" class="form-control" id="stock_limit" name="stock_limit"
                        value="{{ $product->stock_limit }}">
                </div>
                <div class="col-sm-6 mb-3 mt-3">
                    <label for="category_id">Category</label>
                    <select class="form-control" id="category_id" name="cat_id">
                        @foreach (App\Models\Category::all() as $category)
                            <option @if ($product->cat_id == $category->id) selected @endif value="{{ $category->id }}">
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6 mb-3 mt-3">
                    <label for="category">Sub-Category</label>
                    <select class="form-control" id="sub-category" name="subcat_id">
                        @foreach (App\Models\SubCategory::where('parent_id',$product->cat_id)->get() as $subcategory)
                            <option @if ($product->subcat_id == $subcategory->id) selected @endif value="{{ $subcategory->id }}">
                                {{ $subcategory->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12 mb-3 mt-3">
                    <label for="description">Description</label>
                    <textarea id="description" class="form-control" rows="3" name="description">{{ $product->description }}"</textarea>
                </div>
                <div class="col-sm-12 mb-3 mt-3">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
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
