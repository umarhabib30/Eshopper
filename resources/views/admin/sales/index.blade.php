@extends('admin.layout')
@section('title')
    Sales
@endsection
@section('pagename')
    Sales
@endsection
@section('content')
    <div class="container mb-5">
        <form action="{{ route('admin.sales.graph') }}" method="POST" id="graph">
            <div class="row">
                <div class="col-sm-2">
                    <label for="duration">Select Duration</label>
                    <select name="duration" id="duration" class="form-select form-select-lg" style="width: 100%; height:25px">
                        <option value="1">Weekly</option>
                        <option value="2">Monthly</option>
                        <option value="3">Yearly</option>
                    </select>
                </div>
                <div class="col-sm-2" id="weekly">
                    <label for="date">Select Date </label>
                    <input type="date" name="date" class="mydate" id="date">
                </div>
                <div class="col-sm-2" id="monthly">
                    <label for="date">Select Month </label>
                    <input type="month" name="month" class="mydate" id="date">
                </div>
                <div class="col-sm-2" id="yearly">
                    <label for="year">Select Year </label>
                    <select name="year" id="year">
                        <option value="">---Select year----</option>
                    </select>
                </div>
                <div class="col-sm-2 ">
                    <br>
                    <button type="submit" id="show" class="btn btn-primary btn-sm align-bottom">Show Sales</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

    <body>

        <div id="myPlot" style="width:100%;"></div>

        <script>
            const xArray = [];
            const yArray = [];

            const data = [{
                x: xArray,
                y: yArray,
                type: "bar"
            }];

            const layout = {
                title: "Sales report"
            };

            Plotly.newPlot("myPlot", data, layout);
        </script>
    @endsection
    @section('script')
        <script>
            $(document).ready(function() {
                $('#weekly').show();
                $('#monthly').hide();
                $('#yearly').hide();
                for(let i=1999; i<= 2550;i++)
                {
                    $('#year').append('<option value="'+i+'">'+i+'</option>');
                }
            });
            $('body').on('submit', '#graph', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr("action"),
                    type: $(this).attr("method"),
                    dataType: "JSON",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        const xArray = [];
                        const yArray = [];

                        const data = [{
                            x: response.dates,
                            y: response.count,
                            type: "bar"
                        }];

                        const layout = {
                            title: "Sales report"
                        };

                        Plotly.newPlot("myPlot", data, layout);
                    },
                    error: function(error) {
                        console.log(error);
                        var myWindow = window.open("", "MsgWindow", "width=500,height=250");
                        myWindow.document.write(error.responseText);
                    }
                });
            });


            $(document).ready(function() {
                $('body').on('change', '#duration', function(e) {
                    e.preventDefault();
                    var option = $('#duration').val();

                    if (option == 1) {
                        $('#weekly').show();
                        $('#monthly').hide();
                        $('#yearly').hide();
                    } else if (option == 2) {
                        $('#monthly').show();
                        $('#weekly').hide();
                        $('#yearly').hide();
                    } else if (option == 3) {
                        $('#yearly').show();
                        $('#monthly').hide();
                        $('#weekly').hide();


                    }

                });
            });
        </script>
    @endsection
