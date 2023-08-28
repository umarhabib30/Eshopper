@extends('admin.layout')
@section('title','Sub-Categories')
@section('pagename','Sub-Categories')
@section('content')

<div class="container">
    <table class="table" id="sub-categories">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Parent Category</th>
            <th>Products</th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>
        </thead>
        <tbody>

            @foreach ($subcategories as $key=> $subcategory)
            <tr id="row-{{$subcategory->id}}">

                <td>{{++$key}}</td>
                <td>{{$subcategory->name}}</td>
                <td>{{$subcategory->category->name}}</td>
                <td><a href="{{route('admin.subcategory.products',$subcategory->id)}}" class="btn btn-danger">Show</a></td>
                <td><a href="{{route('admin.subcategory.edit',$subcategory->id)}}" class="btn btn-danger">Edit</a></td>
                <td><button type="submit" class="delete btn btn-primary" subcat-id={{$subcategory->id}}>Delete</button></td>
            </tr>
            @endforeach

        </tbody>
</div>
</table>

@endsection
@section('script')
<script>
    $(function()
       {
          $("#sub-categories").dataTable();
       });
    $(document).ready(function() {
        $('body').on('click', '.delete', function(e) {
            e.preventDefault();
            let id = $(this).attr('subcat-id');
            destroy(id);
        });
    });


    function destroy(id) {
        let data = {
            id: id,
            expectsJson: true,
        };
        $.ajax({
            url: "{{ route('admin.subcategory.delete') }}",
            type: 'post',
            data: data,
            success: function(response) {
                var div = document.getElementById('row-'+id);
                div.style.visibility="hidden";
                div.style.display="none";
                toastr.success('Sub-Category deleted Successfully', 'Deleted');
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
