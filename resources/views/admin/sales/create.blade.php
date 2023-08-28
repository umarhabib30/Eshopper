@extends('admin.layout')
@section('title', 'Create Sales')
@section('pagename', 'Create Sale')

@section('content')

    <div class="container mt-3">
        <h2>Create Sale</h2>
        <form enctype="multipart/form-data" id="form-sales">
            <div class="row">
                <div class="col-sm-4 mb-3 mt-3">
                    <label for="category_id">Select Category</label>
                    <select class="form-control" id="category_id" class="category_id" name="cat_id">
                        <option>Select</option>
                        @foreach (App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4 mb-3 mt-3">
                    <label for="sub-category">Sub-Category</label>
                    <select class="form-control" id="sub-category" class="subcategory_id" name="subcat_id">
                    </select>
                </div>
                <div class="col-sm-4 mb-3 mt-3">
                    <label for="products">Product</label>
                    <select class="form-control" id="products" class="subcategory_id" name="">
                    </select>
                </div>
                <div class="col-sm-6 mb-3 mt-3">
                    <label for="product_name">Product Name</label>
                    <input type="text" class="remove-input form-control" id="product_name" name="" readonly>
                </div>
                <div class="col-sm-6 mb-3 mt-3">
                    <label for="product_price">Product Price</label>
                    <input type="number" class="remove-input form-control" id="product_price" name="" readonly>
                </div>
                <div class="col-sm-6 mb-3 mt-3">
                    <label for="product_stock">Stock</label>
                    <input type="number" class="remove-input form-control" id="product_stock" name="" readonly>
                </div>
                <div class="col-sm-6 mb-3 mt-3">
                    <label for="product_qty">Quantity</label>
                    <input type="number" class="remove-input form-control" id="product_qty" name="">
                </div>
                <div class="col-sm-6 mb-3 mt-3">
                    <img src="" alt="" class="remove-pic" id="product_image" width="80px" height="80px">
                </div>
                <div class="col-sm-6 mb-3 mt-3">
                    <label for="product_subtotal">Sub Total</label>
                    <input type="number" class="remove-input form-control" id="product_subtotal" name="" readonly>
                </div>
                <input type="hidden" name="product_id" id="product_id">
            </div>
            <button type="submit" class="upload btn btn-primary pull-right">Add Item</button>
    </div>
    </form>
    </div>

    <!-----------------table to show Items------------------>
    <div class="container mb-5">
        <div class="row">
            <div class="col">
                <table class="table sales_table" id="sales-table">
                    <thead>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Stock</th>
                        <th>Subtotal</th>
                        <th>Remove</th>
                    </thead>
                    <tbody>

                    </tbody>
                    <label for="grandtotal">Toal Quantity :&#160;</label>
                    <input type="number" name="grand_qty" value="0" id="grand_qty" readonly> &nbsp;
                    <label for="grandtotal">Grand Total :&#160;</label>
                    <input type="number" id="grandtotal" value="0" readonly>
                </table>
                <hr>
                <form action="{{ route('admin.sales.store') }}" method="POST" id="sales-store">
                    <input type="hidden" name="grandtotal" id="grandtotal" value="0" readonly required>
                    <input type="hidden" name="grand_qty" value="0" id="grand_qty" readonly required>

                    <button type="submit" class="upload btn btn-primary pull-right" id="store_invoice">Store and generate invoice</button>
                </form>
            </div>
        </div>
    </div><br><br>

    <!-------------------hidden invoice table----------------------->
    <div class="page-content-wrapper " id="to_print">

        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-20">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12">
                                    <div class="invoice-title">
                                        <h4 class="pull-right font-16" id="invoice_id"><strong>Order # 000</strong></h4>
                                        <h3 class="m-t-0">
                                            <img src="assets/images/logo.png" alt="logo" height="42" />
                                        </h3>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-6 m-t-30">
                                            <address>
                                                <strong>Payment Method : </strong>Cash
                                            </address>
                                        </div>
                                        <div class="col-6 m-t-30 text-right">
                                            <address>
                                                <strong>Order Date:</strong>
                                                {{ Carbon\Carbon::now()->format('d-m-Y') }}
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="panel panel-default">
                                        <div class="p-2">
                                            <h3 class="panel-title font-20"><strong>Order summary</strong></h3>
                                        </div>
                                        <div class="">
                                            <div class="table-responsive">
                                                <table class="table" id="invoice_table">
                                                    <thead>
                                                        <tr>
                                                            <td><strong>Item</strong></td>
                                                            <td class="text-center"><strong>Price</strong></td>
                                                            <td class="text-center"><strong>Quantity</strong>
                                                            </td>
                                                            <td class="text-right"><strong>Totals</strong></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- foreach ($order->lineItems as $line) or some such thing here -->

                                                    </tbody>
                                                </table>
                                                <hr>
                                                <h5 class="pull-right" id="invoice_total">Grand Totoal : 00</h5>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div> <!-- end row -->

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div><!-- container-fluid -->


    </div> <!-- Page content Wrapper -->

@endsection

@section('script')
    <script>
        var p_qty = 0;
        let ids = [];
        $(document).ready(function() {
           $('#to_print').hide();

            $('body').on('change', '#category_id', function(e) {
                e.preventDefault();
                var cat_id = this.value;
                subcat(cat_id);

            });
            $('body').on('change', '#sub-category', function(e) {
                e.preventDefault();
                var subcat_id = this.value;
                products(subcat_id);

            });
            $('body').on('change', '#products', function(e) {
                e.preventDefault();
                var product_id = this.value;
                product_details(product_id);
            });
            $('body').on('change', '#product_qty', function(e) {
                e.preventDefault();
                var prev = $(this).attr('data-val');
                var quantity = $('#product_qty').val();
                var price = $('#product_price').val();
                var product_id = $('#products').val();
                let data = {
                    id: product_id,
                    expectsJson: true,
                };
                $.ajax({
                    url: "{{ route('admin.sales.product.details') }}",
                    type: 'post',
                    data: data,
                    success: function(response) {
                        var remaining_stock = response.stock - quantity;

                        if (remaining_stock < 0) {
                            toastr.warning('Stock is not available');
                            $('#product_qty').val(p_qty);
                        } else {
                            $('#product_subtotal').val(quantity * price);
                            $('#product_stock').val(response.stock - quantity);
                            p_qty = quantity;
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        var myWindow = window.open("", "MsgWindow", "width=500,height=250");
                        myWindow.document.write(error.responseText);
                    }
                });
            });
            $('body').on('click', '#increase-qty', function(e) {
                e.preventDefault();
                var product_id = $(this).attr('product_id');
                var quantity = $('#qty-' + product_id).html();
                var q = parseInt(quantity);
                var qty = q + 1;
                var stock = $('#stock-' + product_id).html();
                var price = $('#price-' + product_id).html();
                var subtotal = $('#subtotal-' + product_id).html();
                $.ajax({
                    success: function(response) {
                        var remaining_stock = parseInt(stock) - 1;

                        if (remaining_stock < 0) {
                            toastr.warning('Stock is not available');
                        } else {
                            $('*#qty-' + product_id).html(q + 1);
                            $('#stock-' + product_id).html(parseInt(stock) - 1);
                            $('*#subtotal-' + product_id).html(parseInt(subtotal) + parseInt(
                                price));
                            var new_subtotal = parseInt(subtotal) + parseInt(price);
                            var total = $('#grandtotal').val();
                            var grandtotal = parseInt(total) + parseInt(price);
                            var quantity = $('#grand_qty').val();
                            var grand_quantity = parseInt(quantity) + 1;
                            $('*#grand_qty').attr('value', grand_quantity);
                            $('*#grandtotal').attr('value', grandtotal);
                            $('#invoice_total').html('Grand Total : ' + grandtotal);
                            $('[id^="form-row-' + product_id + '"]').remove();

                            $('#sales-store').append(
                                '<input type="hidden" name="product_id[]" value="' +
                                product_id + '" id="form-row-' + product_id +
                                '"><input type="hidden" name="product_qty[]" value="' +
                                qty + '" id="form-row-' + product_id +
                                '"><input type="hidden" name="subtotal[]" value="' +
                                new_subtotal +
                                '" id="form-row-' + product_id + '">');

                        }
                    },
                    error: function(error) {
                        console.log(error);
                        var myWindow = window.open("", "MsgWindow", "width=500,height=250");
                        myWindow.document.write(error.responseText);
                    }
                });
            });
            $('body').on('click', '#decrease-qty', function(e) {
                e.preventDefault();
                var product_id = $(this).attr('product_id');
                var quantity = $('#qty-' + product_id).html();
                var q = parseInt(quantity);
                var qty = q - 1;
                var stock = $('#stock-' + product_id).html();
                var price = $('#price-' + product_id).html();
                var subtotal = $('#subtotal-' + product_id).html();
                $.ajax({
                    success: function(response) {
                        var remaining_stock = parseInt(stock) + 1;

                        if (remaining_stock < 0) {
                            toastr.warning('Stock is not available');
                        } else {
                            $('*#qty-' + product_id).html(q - 1);
                            $('#stock-' + product_id).html(parseInt(stock) + 1);
                            $('*#subtotal-' + product_id).html(parseInt(subtotal) - parseInt(
                                price));
                            var new_subtotal = parseInt(subtotal) - parseInt(price);
                            var total = $('#grandtotal').val();
                            var grandtotal = parseInt(total) - parseInt(price);
                            var quantity = $('#grand_qty').val();
                            var grand_quantity = parseInt(quantity) - 1;
                            $('*#grand_qty').attr('value', grand_quantity);
                            $('*#grandtotal').attr('value', grandtotal);
                            $('#invoice_total').html('Grand Total : ' + grandtotal);
                            $('[id^="form-row-' + product_id + '"]').remove();

                            $('#sales-store').append(
                                '<input type="hidden" name="product_id[]" value="' +
                                product_id + '" id="form-row-' + product_id +
                                '"><input type="hidden" name="product_qty[]" value="' +
                                qty + '" id="form-row-' + product_id +
                                '"><input type="hidden" name="subtotal[]" value="' +
                                new_subtotal +
                                '" id="form-row-' + product_id + '">');

                        }
                    },
                    error: function(error) {
                        console.log(error);
                        var myWindow = window.open("", "MsgWindow", "width=500,height=250");
                        myWindow.document.write(error.responseText);
                    }
                });
            });
            $('body').on('submit', '#form-sales', function(e) {
                e.preventDefault();

                $.ajax({

                    success: function() {
                        var product_id = $('#product_id').val();
                        var subcat_id = $('#sub-category').val();
                        var check = document.getElementById('row-' + product_id);
                        if (check) {
                            toastr.warning('This product already exist');
                        } else {

                            var name = $('#product_name').val();
                            var price = $('#product_price').val();
                            var qty = $('#product_qty').val();
                            var subtotal = $('#product_subtotal').val();
                            var stock = $('#product_stock').val();
                            if (qty <= 0) {
                                toastr.warning('Quantity should be at leat 1');
                            } else {
                                //--------appending values to product list table
                                $('.sales_table').append('<tr id="row-' + product_id +
                                    '"><td>' +
                                    name +
                                    '</td><td id="price-' + product_id + '">' + price +
                                    '</td><td><button class="btn" id="decrease-qty" product_id=' +
                                    product_id + '>-</button><p class="btn" id="qty-' +
                                    product_id + '">' + qty +
                                    '</p><button class="btn" id="increase-qty" product_id=' +
                                    product_id + '>+</button></td><td id="stock-' +
                                    product_id + '">' + stock + '</td><td id="subtotal-' +
                                    product_id + '">' + subtotal +
                                    '</td><td><button class="btn btn-primary"  id="remove_row" product-id=' +
                                    product_id + ' >Remove</button></td? </tr>');

                                //-------appending value to hidden form to store to database
                                var total = $('#grandtotal').val();
                                var grandtotal = parseInt(total) + parseInt(subtotal);
                                var quantity = $('#grand_qty').val();
                                var grand_quantity = parseInt(quantity) + parseInt(qty);
                                $('*#grand_qty').attr('value', grand_quantity);
                                $('*#grandtotal').attr('value', grandtotal);
                                $('#invoice_total').html('Grand Total : ' + grandtotal);

                                $('#sales-store').append(
                                    '<input type="hidden" name="product_id[]" value="' +
                                    product_id + '" id="form-row-' + product_id +
                                    '"><input type="hidden" name="product_qty[]" value="' +
                                    qty + '" id="form-row-' + product_id +
                                    '"><input type="hidden" name="subtotal[]" value="' +
                                    subtotal +
                                    '" id="form-row-' + product_id + '">');
                                $('*.remove-input').attr('value', '');
                                $('.remove-pic').attr('src', '');
                                p_qty = 0;
                                products(subcat_id);

                                //-----------appending values to hidden invoice table
                                $('#invoice_table').append('<tr id="row-' + product_id +
                                    '"><td>' +
                                    name +
                                    '</td><td class="text-center" id="price-' + product_id +
                                    '">' + price +
                                    '</td><td class="text-center"><p class="btn" id="qty-' +
                                    product_id + '">' + qty +
                                    '</p></td><td class="text-right" id="subtotal-' +
                                    product_id + '">' + subtotal +
                                    '</td></tr>');

                            }

                        }

                    },
                    error: function(error) {
                        console.log(error);
                        var myWindow = window.open("", "MsgWindow", "width=500,height=250");
                        myWindow.document.write(error.responseText);
                    }
                });
            });
            $('body').on('click', '#remove_row', function(e) {
                e.preventDefault();
                var id = $(this).attr('product-id');
                var subtotal = $('#subtotal-' + id).html();
                var quantity = $('#qty-' + id).html();
                //var div = document.getElementById('row-' + id);
                //div.remove();
                $('*#row-'+id).remove();

                var total = $('#grandtotal').val();
                var grandtotal = parseInt(total) - parseInt(subtotal);
                var qty = $('#grand_qty').val();
                var grand_quantity = parseInt(qty) - parseInt(quantity);
                $('*#grand_qty').attr('value', grand_quantity);
                $('*#grandtotal').attr('value', grandtotal);
                p_qty = 0;
                $('[id^="form-row-' + id + '"]').remove();

            });

            $('body').on('submit', '#sales-store', function(e) {
                e.preventDefault();
                var gt = $('#grandtotal').val();
                if (gt == 0) {
                    toastr.warning('Please Add items first');
                } else {
                    $.ajax({
                        url: $(this).attr("action"),
                        type: $(this).attr("method"),
                        dataType: "JSON",
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            console.log(response.id);
                            $('#sales-table tbody').empty();
                            $('#invoice_id').html("Order # "+response.id);
                            $('*#grand_qty').attr('value', '0');
                            $('*#grandtotal').attr('value', '0');
                            $("[id^='form-row-']").remove();
                            toastr.success('Sale Stores Successfull', 'Done');
                            var id = response.id;
                            var oldpage = document.body.innerHTML;
                            var printpage = document.getElementById('to_print').innerHTML;
                            document.body.innerHTML = printpage;
                            window.print();
                            document.body.innerHTML= oldpage;
                            $('#invoice_table tbody').empty();
                            $('#invoice_id').html("Order # 000");
                        },
                        error: function(error) {
                            console.log(error);
                            var myWindow = window.open("", "MsgWindow", "width=500,height=250");
                            myWindow.document.write(error.responseText);
                        }
                    });

                }

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

        function products(subcat_id) {
            let data = {
                id: subcat_id,
                expectsJson: true,
            };
            $.ajax({
                url: "{{ route('admin.sales.subcategory.products') }}",
                type: 'post',
                data: data,
                success: function(response) {
                    console.log(response);
                    $('#products').html(
                        '<option value="">-- Select Product --</option>');
                    $.each(response, function(key, value) {
                        $("#products").append('<option value="' + value
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


        function product_details(product_id) {

            let data = {
                id: product_id,
                expectsJson: true,
            };
            $.ajax({
                url: "{{ route('admin.sales.product.details') }}",
                type: 'post',
                data: data,
                success: function(response) {
                    console.log(response);
                    var check = document.getElementById('row-' + response.id);
                    if (check) {
                        toastr.warning('This product already exist');
                    } else {
                        $('#product_id').val(response.id);
                        $('#product_name').val(response.name);
                        $('#product_price').val(response.price);
                        $('#product_stock').val(response.stock);
                        $('#product_qty').val('0');
                        $('#product_subtotal').val('0');
                        $('#product_image').attr('src', response.image);
                    }

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
