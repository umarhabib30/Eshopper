@extends('admin.layout')
@section('title', 'Sales')
@section('pagename', 'Sales')
@section('content')

    <div class="container">
        <table class="table" id="categories">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Item Quantity</th>
                    <th>Bill</th>
                    <th>Show Items</th>
                    <th>Generate Invoice</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($sales as $key => $sale)

                        <tr>
                            <td>{{$sale->id }}</td>
                            <td> {{Carbon\Carbon::parse($sale->created_at)->toFormattedDateString()}}</td>
                            <td>{{Carbon\Carbon::parse($sale->created_at)->format('h:i A')}}</td>
                            <td>{{ $sale->grand_qty }}</td>
                            <td>{{ $sale->grandtotal }}</td>
                            <td><a href="{{route('admin.sales.items',$sale->id)}}" class="btn btn-danger">Show</a></td>
                            <td><a href="{{route('admin.sales.invoice',$sale->id)}}" class="btn btn-danger">Generate</a></td>
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
