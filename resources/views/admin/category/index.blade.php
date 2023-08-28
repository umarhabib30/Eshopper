@extends('admin.layout')
@section('title', 'Categories')
@section('pagename', 'Categories')
@section('content')

    <div class="container">
        <table class="table" id="categories">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Products</th>
                    <th>Edit</th>
                    <th>Delete</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($categories as $key => $category)

                        <tr id="row-{{$category->id}}">

                            <td>{{ ++$key }}</td>
                            <td>{{ $category->name }}</td>
                            <td><a href="{{route('admin.category.products',$category->id)}}" class="btn btn-danger">Show</a></td>
                            <td><a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-danger">Edit</a></td>
                            <td><button type="submit" class="delete btn btn-primary" category-id="{{ $category->id }}">Delete</button></td>
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
          $("#categories").dataTable();
       });

    $(document).ready(function() {
        $('body').on('click', '.delete', function(e) {
            e.preventDefault();
            let id = $(this).attr('category-id');
            destroy(id);
        });
    });


    function destroy(id) {
        let data = {
            id: id,
            expectsJson: true,
        };
        $.ajax({
            url: "{{ route('admin.category.delete') }}",
            type: 'post',
            data: data,
            success: function(response) {
                var div = document.getElementById('row-'+id);
                div.style.visibility="hidden";
                div.style.display="none";
                toastr.success('Category deleted Successfully', 'Deleted');
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
