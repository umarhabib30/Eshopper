@extends('admin.layout')
@section('title', 'Create Category')
@section('pagename', 'Create Category')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="card m-b-20 card-body">
                <h3 class="text-center">Create Category</h3>

                <div class="mb-3 mt-3">
                    <label for="email">Category Name</label>
                    <input type="texr" class="name form-control" id="name" placeholder="Enter Category Name"
                        name="name" required>
                </div>
                <button type="submit" class="store btn btn-primary waves-effect waves-light">Create</button>


            </div>
        </div>
    </div>

@endsection
@section('script')

    <script>
        $(document).ready(function() {
            $('body').on('click', '.store', function(e) {
                e.preventDefault();
                store();
            });
        });


        function store() {
            var name = $('.name').val();
            let data = {
                name: name,
                expectsJson: true,
            };
            $.ajax({
                url: "{{ route('admin.category.store') }}",
                type: 'post',
                data: data,
                success: function(response) {
                    $('.name').val("");
                    toastr.success('Category created success fully', 'Done');
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
