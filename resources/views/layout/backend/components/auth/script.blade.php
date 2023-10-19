<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

<script src="{{ asset('assets/backend/js/jquery-3.6.0.min.js') }}"></script>

<script src="{{ asset('assets/backend/js/feather.min.js') }}"></script>

<script src="{{ asset('assets/backend/js/jquery.slimscroll.min.js') }}"></script>

<script src="{{ asset('assets/backend/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('assets/backend/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('assets/backend/plugins/apexchart/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/apexchart/chart-data.js') }}"></script>

<script src="{{ asset('assets/backend/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/sweetalert/sweetalerts.min.js') }}"></script>

<script src="{{ asset('assets/backend/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/backend/plugins/toastr/toastr.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script src="{{ asset('assets/backend/js/script.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

            $(".customer_contactno").keyup(function() {
                var query = $(this).val();

                if (query != '') {

                    $.ajax({
                        url: "{{ route('customer.checkduplicate') }}",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            query: query
                        },
                        dataType: 'json',
                        success: function(response) {
                           // console.log(response['data']);
                            if(response['data'] != null){
                                alert('Already Existed');
                                $('.customer_contactno').val('');
                            }
                        }
                    });
                }
            });


            $(".employee_contactno").keyup(function() {
                var query = $(this).val();

                if (query != '') {

                    $.ajax({
                        url: "{{ route('employee.checkduplicate') }}",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            query: query
                        },
                        dataType: 'json',
                        success: function(response) {
                           // console.log(response['data']);
                            if(response['data'] != null){
                                alert('Already Existed');
                                $('.employee_contactno').val('');
                            }
                        }
                    });
                }
            });


            $(".supplier_contactno").keyup(function() {
                var query = $(this).val();

                if (query != '') {

                    $.ajax({
                        url: "{{ route('supplier.checkduplicate') }}",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            query: query
                        },
                        dataType: 'json',
                        success: function(response) {
                           // console.log(response['data']);
                            if(response['data'] != null){
                                alert('Already Existed');
                                $('.supplier_contactno').val('');
                            }
                        }
                    });
                }
            });

            $(".product_name").keyup(function() {
                var query = $(this).val();
                var productsession_id = $(".productsession_id").val();
                var productcategory_id = $(".productcategory_id").val();

                if (query != '') {

                    $.ajax({
                        url: "{{ route('product.checkduplicate') }}",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            query: query,
                            productsession_id: productsession_id,
                            productcategory_id: productcategory_id
                        },
                        dataType: 'json',
                        success: function(response) {
                           // console.log(response['data']);
                            if(response['data'] != null){
                                alert('Already Existed');
                                $('.product_name').val('');
                            }
                        }
                    });
                }
            });

            $(".purchase_product").keyup(function() {
                var query = $(this).val();

                if (query != '') {

                    $.ajax({
                        url: "{{ route('purchase_product.checkduplicate') }}",
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            query: query
                        },
                        dataType: 'json',
                        success: function(response) {
                           // console.log(response['data']);
                            if(response['data'] != null){
                                alert('Already Existed');
                                $('.purchase_product').val('');
                            }
                        }
                    });
                }
            });


           
                //var productsession_id = $('.productsession_id').val();
                //    $.ajax({
                //        url: '/getcategories/',
                //        type: 'get',
                 //       data: {
                 //           _token: "{{ csrf_token() }}",
                 //           productsession_id: productsession_id,
                 //       },
                 //       dataType: 'json',
                 //       success: function(response) {
                  //         // console.log(response);
                 //           var len = response.length;
                 //           $('.productcategory_id').empty();

                 //           var $select = $(".productcategory_id").append(
                 //               $('<option>', {
                   //                 value: '0',
                 //                   text: 'Select'
                 //               }));
                 //           $(".productcategory_id").append($select);

                   //         for (var i = 0; i < len; i++) {
                   //             $(".productcategory_id").append($('<option>', {
                  //                  value: response[i].id,
                  //                  text: response[i].name
                  //              }));
                   //         }

                  //      }
                  //  });





                


    });

    function customercheck()
    {
        var mobile = $('.customer_contactno').val();

        if(mobile.length>10){
            $('.customer_contactno').val('');

        }
    }

    function employeecheck()
    {
        var mobile = $('.employee_contactno').val();

        if(mobile.length>10){
            $('.employee_contactno').val('');

        }
    }

    function suppliercheck()
    {
        var mobile = $('.supplier_contactno').val();

        if(mobile.length>10){
            $('.supplier_contactno').val('');

        }
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#category-img-tag').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#productimage").change(function(){
        readURL(this);
    });



    function readURLtwo(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#category-img-tagtwo').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#productimagetwo").change(function(){
        readURLtwo(this);
    });


    function readURLthree(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#category-img-tagthree').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#productimagethree").change(function(){
        readURLthree(this);
    });




                $(document).ready(function() {
                    var sessionid = '1';
                    $.ajax({
                        type: 'get',
                        url: '/GetAutosearchProducts/',
                        data: {
                                _token: "{{ csrf_token() }}",
                                sessionid: sessionid,
                            },
                        dataType: 'json',
                        success: function (response) {
                            //console.log(response);
                            $('.select2PS').html('');

                            var $select = $(".select2PS").append(
                                $('<option>', {
                                    value: '0',
                                    text: 'Select Product...'
                                }));
                            $(".select2PS").append($select);


                            var output = response.length;
                            for (var i = 0; i < output; i++) {

                                //console.log(response[i].product_id);



                                $(".select2PS").append($('<option>', {
                                    value: response[i].id,
                                    text:  response[i].product_name + ' - ₹ ' + response[i].product_price,
                                }));
                            }
                        }
                    });


                   
                           // $("#select2PS").select2({
                            //    templateResult: formatOptions
                           // });
                            
                        

                }); 
               // function formatOptions (state) 
              //  {
             //           if (!state.id) { return state.text; }

                //        console.log(state.style);

                //        <!-- here i am creating a route of the images folder -->

               //         var $state = $(
                //                '<span ><img sytle="display: inline-block;" src="' + state.src + '"  /> ' + state.text + '</span>'
                //                );

                //            return $state;
                //}

                $('.category_type').first().addClass('active');
                var cat_id = $('.category_type').first().data('cat_id');
                var sessionid = $('.category_type').first().data('session_id');

                
                // if (window.location.href.indexOf("http://127.0.0.1:8000/zworktechnology/sales/edit") > -1) {
                //     var url = $(location).attr('href');
                //     var parts = url.split("/");
                //     var last_part = parts[parts.length-1];

                    
                // }else if (window.location.href.indexOf("http://127.0.0.1:8000/zworktechnology/sales/create") > -1) {
                //     var last_part = '';
                // }
                

                if (window.location.href.indexOf("https://annapooranifoods.com/zworktechnology/sales/edit") > -1) {
                    var url = $(location).attr('href');
                    var parts = url.split("/");
                    var last_part = parts[parts.length-1];

                    
                }else if (window.location.href.indexOf("https://annapooranifoods.com/zworktechnology/sales/create") > -1) {
                    var last_part = '';
                }

              
                

                            $.ajax({
                                url: '/getselectedcat_products/',
                                type: 'get',
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    catogry_id: cat_id,
                                    sessionid: sessionid,
                                    last_part: last_part
                                },
                                dataType: 'json',
                                success: function(response) {
                                    console.log(response);
                                    $('.prodcttsdiv').html('');
                                    
                                    var len = response.length;
                                    for (var i = 0; i < len; i++) {
                                        var productsdiv = $('<div class="col-lg-3 col-sm-6 d-flex  ">' + 
                                                                '<div class="productset flex-fill" style="border: 1px solid #afbcc6;">' +
                                                                    '<div class="productsetimg" style="height:110px;">' +
                                                                        '<img src="'+ response[i].product_image +'" alt="img">' +
                                                                    '</div>' +
                                                                    '<div class="productsetcontent">' +
                                                                        '<h4>'+ response[i].productname +'</h4>' +
                                                                        '<div style="display: flex">' +
                                                                            '<h6 class="pos-price">₹ '+ response[i].productprice +'.00</h6>' +
                                                                            '<h6>'+ response[i].checkbutton +'</h6>' +
                                                                        '</div>' +
                                                                    '</div>' +
                                                                '</div>' +
                                                            '</div>');
                                        $('.prodcttsdiv').append(productsdiv);
                                    }
                                }
                            });


                            $(document).on('click', '.category_type', function() {
                                var catogry_id = $(this).data('cat_id');
                                var sessionid = $(this).data('session_id');
                                console.log(sessionid);

                                        $.ajax({
                                            url: '/getselectedcat_products/',
                                            type: 'get',
                                            data: {
                                                _token: "{{ csrf_token() }}",
                                                catogry_id: catogry_id,
                                                sessionid: sessionid,
                                                last_part: last_part
                                            },
                                            dataType: 'json',
                                            success: function(response) {
                                             console.log(response);
                                                $('.prodcttsdiv').html('');
                                                
                                                var len = response.length;
                                                for (var i = 0; i < len; i++) {
                                                    var productsdiv = $('<div class="col-lg-3 col-sm-6 d-flex  ">' + 
                                                                            '<div class="productset flex-fill" style="border: 1px solid #afbcc6;">' +
                                                                                '<div class="productsetimg" style="height:110px;">' +
                                                                                    '<img src="'+ response[i].product_image +'" alt="img">' +
                                                                                '</div>' +
                                                                                '<div class="productsetcontent">' +
                                                                                    '<h4>'+ response[i].productname +'</h4>' +
                                                                                    '<div style="display: flex">' +
                                                                                        '<h6 class="pos-price">₹ '+ response[i].productprice +'.00</h6>' +
                                                                                        '<h6>'+ response[i].checkbutton +'</h6>' +
                                                                                    '</div>' +
                                                                                '</div>' +
                                                                            '</div>' +
                                                                        '</div>');
                                                    $('.prodcttsdiv').append(productsdiv);
                                                }
                                            }
                                        });
                                });

    function sessiontype(sessionid) {
        //console.log(sessionid);
        $('#purchase' + sessionid).each(function(){
            $(this).find('.category_type').removeClass('active');
            $(this).find('.category_type').first().addClass('active');
            var catogry_id = $(this).find('.category_type').first().data('cat_id');
            var sessionid = $(this).find('.category_type').first().data('session_id');
            console.log(sessionid);

                            $.ajax({
                                url: '/getselectedcat_products/',
                                type: 'get',
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    catogry_id: catogry_id,
                                    sessionid: sessionid,
                                    last_part: last_part
                                },
                                dataType: 'json',
                                success: function(response) {
                                    //console.log(response);
                                    $('.prodcttsdiv').html('');
                                    
                                    var len = response.length;
                                    for (var i = 0; i < len; i++) {
                                        var productsdiv = $('<div class="col-lg-3 col-sm-6 d-flex  ">' + 
                                                                '<div class="productset flex-fill" style="border: 1px solid #afbcc6;">' +
                                                                    '<div class="productsetimg" style="height:110px;">' +
                                                                        '<img src="'+ response[i].product_image +'" alt="img">' +
                                                                    '</div>' +
                                                                    '<div class="productsetcontent">' +
                                                                        '<h4>'+ response[i].productname +'</h4>' +
                                                                        '<div style="display: flex">' +
                                                                            '<h6 class="pos-price">₹ '+ response[i].productprice +'.00</h6>' +
                                                                            '<h6>'+ response[i].checkbutton +'</h6>' +
                                                                        '</div>' +
                                                                    '</div>' +
                                                                '</div>' +
                                                            '</div>');
                                        $('.prodcttsdiv').append(productsdiv);
                                    }
                                }
                            });
        });

                $(document).on('click', '.category_type', function() {
				    var catogry_id = $(this).data('cat_id');
                    var sessionid = $(this).data('session_id');
                    console.log(sessionid);

                            $.ajax({
                                url: '/getselectedcat_products/',
                                type: 'get',
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    catogry_id: catogry_id,
                                    sessionid: sessionid,
                                    last_part: last_part
                                },
                                dataType: 'json',
                                success: function(response) {
                                   // console.log(response);
                                    $('.prodcttsdiv').html('');
                                    
                                    var len = response.length;
                                    for (var i = 0; i < len; i++) {
                                        var productsdiv = $('<div class="col-lg-3 col-sm-6 d-flex  ">' + 
                                                                '<div class="productset flex-fill" style="border: 1px solid #afbcc6;">' +
                                                                    '<div class="productsetimg" style="height:110px;">' +
                                                                        '<img src="'+ response[i].product_image +'" alt="img">' +
                                                                    '</div>' +
                                                                    '<div class="productsetcontent">' +
                                                                        '<h4>'+ response[i].productname +'</h4>' +
                                                                        '<div style="display: flex">' +
                                                                            '<h6 class="pos-price">₹ '+ response[i].productprice +'.00</h6>' +
                                                                            '<h6>'+ response[i].checkbutton +'</h6>' +
                                                                        '</div>' +
                                                                    '</div>' +
                                                                '</div>' +
                                                            '</div>');
                                        $('.prodcttsdiv').append(productsdiv);
                                    }
                                }
                            });
                });

          

                    $(document).ready(function() {
                        $.ajax({
                            type: 'get',
                            url: '/GetAutosearchProducts/',
                            data: {
                                    _token: "{{ csrf_token() }}",
                                    sessionid: sessionid,
                                    last_part: last_part
                                },
                            dataType: 'json',
                            success: function (response) {
                                //console.log(response);
                                $('.select2PS').html('');

                                var $select = $(".select2PS").append(
                                    $('<option>', {
                                        value: '0',
                                        text: 'Select Product...'
                                    }));
                                $(".select2PS").append($select);


                                var output = response.length;
                                for (var i = 0; i < output; i++) {

                                    //console.log(response[i].product_id);



                                    $(".select2PS").append($('<option>', {
                                        value: response[i].id,
                                        text:  response[i].product_name + ' - ₹ ' + response[i].product_price,
                                    }));
                                }
                            }
                        });

                    }); 


    }


    var h = 1;
    $(document).on('click', '.selectproduct', function() {

                

    var product_id = $(this).data('product_id');
    var productsession_id = $(this).data('productsession_id');


                $('.addedproduct' + productsession_id).attr('style', 'display:none');
                $('.clickquantity' + productsession_id).attr('style', 'display:block');
                var selectproductid = $(this).data('product_id');
                var session_id = $(this).data('session_id');

               

                $.ajax({
                    url: '/getselectedproducts/',
                    type: 'get',
                    data: {
                        _token: "{{ csrf_token() }}",
                        selectproductid: selectproductid,
                        session_id: session_id
                    },
                    dataType: 'json',
                    success: function(response) {
                        
                        var len = response.length;
                        occurs = {};

                        for (var i = 0; i < len; i++) {

                            var e = $('<ul class="product-lists" id="productlist">'+
                            '<li>' +
                            '<div class="productimg">' +
                            '<div class="productimgs"><img src=" ' + response[i].product_image +  ' "alt="img"></div>' +
                            '<div class="productcontet"><h4> ' + response[i].product_name +  ' <a href="javascript:void(0);" class="ms-2" data-bs-toggle="modal"data-bs-target="#edit"><img src="{{ asset('assets/backend/img/icons/edit-5.svg') }}"alt="img"></a></h4>' +
                            '<div class="productlinkset"><h5>'+ response[i].Category +'</h5></div><div class="increment-decrement">' +
                            '<div class="input-groups">' +
                            '<input type="hidden"  name="product_id[]"  value="' + response[i].product_id + '"/>' +
                            '<input type="hidden" class="li_productid" id="li_productid"  value="' + response[i].id + '"/>' +
                            '<input type="button" value="-" class="button-minus dec button"  onClick="decrement_quantity('+ response[i].id +')">' +
                            '<input type="text" name="product_quantity[]" value="1"class="quantity-field product_quanitity" id="product_quantity' + response[i].id + '">' +
                            '<input type="button" value="+" class="button-plus inc button " onClick="increment_quantity('+ response[i].id +')">' +
                            '</div>' +
                            '<input type="hidden" class="product_price" name="product_price[]" id="product_price' + response[i].id +  '"  value="' + response[i].product_price + '"/>' +
                            '</div></div></div>' +
                            '</li><li><div class="input-groups"><span class="totalprice' + response[i].id +  '">' + response[i].product_price +  '</span>' +
                            '<input type="hidden" name="total_price[]" class="total_price' + response[i].id +  '" value="' + response[i].product_price +  '"/>' +
                            '<input type="hidden" name="product_session_id[]" class="product_session_id" value="' + response[i].id +  '"/>' +
                            '<input type="hidden" name="saleproductsid[]" class="saleproductsid" id="saleproductsid" value=""/></div></li>' +
                            '<li><a class="confirm-text" href="javascript:void(0);"><a class="confirm-text remove-tr"><img src="{{ asset('assets/backend/img/icons/delete-2.svg') }}"alt="img"></a></li></ul>');

                            $('.product-table').prepend(e);
                            var product_div = '1';
                            $('#product_quantity' + response[i].product_id).val(product_div);


                            var product_price = $('#product_price' + response[i].id).val();
                                var totalprice = product_price * product_div;
                                $('.totalprice' + response[i].id).text(totalprice);
                                $('.total_price' + response[i].id).val(totalprice);



                                var tot_expense_amount = 0;
                                $("input[name='total_price[]']").each(
                                    function() {
                                        //alert($(this).val());
                                        tot_expense_amount = Number(tot_expense_amount) +
                                            Number($(this).val());
                                            $('.subtotalamount').text('₹ ' + tot_expense_amount);
                                            $('#subtotal').val(tot_expense_amount);
                                            $('#totalamount').val(tot_expense_amount);


                                            var sale_discount = $('#sale_discount').val();
                                            var payment = Number(tot_expense_amount) - Number(sale_discount);
                                            $('.grand_total').text(payment.toFixed(2));
                                            $('.grandtotal').val(payment.toFixed(2));
                                    });
                        }

                        $(".total_count").text($('.product-table').children('.product-lists').length);

                    }
                });

                var tot_expense_amount = 0;
                    $("input[name='total_price[]']").each(
                        function() {
                            //alert($(this).val());
                            tot_expense_amount = Number(tot_expense_amount) +
                                Number($(this).val());
                                $('.subtotalamount').text('₹ ' + tot_expense_amount);
                                $('#subtotal').val(tot_expense_amount);
                                $('#totalamount').val(tot_expense_amount);
                                $('.grand_total').text('₹ ' + tot_expense_amount);
                                $('.grandtotal').val(tot_expense_amount);
                        });
       
   

    //console.log(product_id);
       

});


function increment_quantity(productsessionid) {

        var inputQuantityElement = $('#product_quantity' + productsessionid);
        //console.log(inputQuantityElement);
        var newQuantity = parseInt($(inputQuantityElement).val())+1;
        var QuantityElement = $('#product_quantity' + productsessionid);
        $(inputQuantityElement).val(newQuantity);

        var product_price = $('#product_price' + productsessionid).val();
        var totalprice = product_price * newQuantity;
        $('.totalprice' + productsessionid).text(totalprice);
        $('.total_price' + productsessionid).val(totalprice);



        var tot_expense_amount = 0;
            $("input[name='total_price[]']").each(
            function() {
                //alert($(this).val());
                tot_expense_amount = Number(tot_expense_amount) +
                    Number($(this).val());
                    $('.subtotalamount').text('₹ ' + tot_expense_amount);
                    $('#subtotal').val(tot_expense_amount);
                    $('#totalamount').val(tot_expense_amount);

                    var sale_discount = $('#sale_discount').val();
                    var payment = Number(tot_expense_amount) - Number(sale_discount);
                    $('.grand_total').text(payment.toFixed(2));
                    $('.grandtotal').val(payment.toFixed(2));
            });
}


                            function decrement_quantity(productsessionid) {
                                var inputQuantityElement = $('#product_quantity' + productsessionid);
                                if($(inputQuantityElement).val() > 1)
                                {
                                var newQuantity = parseInt($(inputQuantityElement).val()) - 1;
                                $(inputQuantityElement).val(newQuantity);

                                var product_price = $('#product_price' + productsessionid).val();
                                var totalprice = product_price * newQuantity;
                                $('.totalprice' + productsessionid).text(totalprice);
                                $('.total_price' + productsessionid).val(totalprice);

                                var tot_expense_amount = 0;
                                $("input[name='total_price[]']").each(
                                    function() {
                                        //alert($(this).val());
                                        tot_expense_amount = Number(tot_expense_amount) +
                                            Number($(this).val());
                                            $('.subtotalamount').text('₹ ' + tot_expense_amount);
                                            $('#subtotal').val(tot_expense_amount);
                                            $('#totalamount').val(tot_expense_amount);

                                            var sale_discount = $('#sale_discount').val();
                                            var payment = Number(tot_expense_amount) - Number(sale_discount);
                                            $('.grand_total').text(payment.toFixed(2));
                                            $('.grandtotal').val(payment.toFixed(2));
                                    });
                                }
                            }




var dt = new Date();
var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
$(".current_time").html(time);
$(".currenttime").val(time);

var today = new Date();
var date = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();
$(".current_date").html(date);



$(document).on('click', '.remove-tr', function() {
    var liProductid = $(this).parents('ul').find("#li_productid").val();

    //console.log(liProductid);

    $('#addedproduct' + liProductid).attr('style', 'background-color:#7367f0;color: #fff;').val('Add to Cart').attr('disabled', false);
    $('.clickquantity' + liProductid).attr('style', 'display:none');
    $(this).parents('ul').remove();


    var tot_expense_amount = 0;
                                $("input[name='total_price[]']").each(
                                    function() {
                                        //alert($(this).val());
                                        tot_expense_amount = Number(tot_expense_amount) +
                                            Number($(this).val());
                                            $('.subtotalamount').text('₹ ' + tot_expense_amount);
                                            $('#subtotal').val(tot_expense_amount);
                                            $('#totalamount').val(tot_expense_amount);

                                            var sale_discount = $('#sale_discount').val();
                                            var payment = Number(tot_expense_amount) - Number(sale_discount);
                                            $('.grand_total').text(payment.toFixed(2));
                                            $('.grandtotal').val(payment.toFixed(2));
                                    });
});
$(document).on('click', '.remove-ultr', function() {
    $('.product-table').empty('');
    $('.selectproduct').attr('style', 'background-color:#7367f0;color: #fff;').val('Add to Cart').attr('disabled', false);
    $('.clickquantity').attr('style', 'display:none');
});



$(document).ready(function(){

    
$('#sales_store').submit(function(e){
    e.preventDefault();

    //console.log($(this).serialize());

    //var billno = $('#bill_no').val();
    var date = $('#date').val();
    var time = $('#time').val();
    var sales_type = $('input[name=sales_type]:checked').val();
    var customer_type = $('#customer_type').val();
    var customer_id = $('#customer_id').val();
    var subtotal = $('#subtotal').val();
    var taxamount = $('#taxamount').val();
    var paymentmethod = $('input[name=paymentmethod]:checked').val();
    var totalamount = $('#totalamount').val();
    var sale_discount = $('#sale_discount').val();
    var grandtotal = $('#grandtotal').val();
    var saleid = $('#saleid').val();

    var product_ids = $("input[name='product_id[]']")
            .map(function () {
                return $(this).val();
            }).get();

    var product_quantity = $("input[name='product_quantity[]']")
            .map(function () {
                return $(this).val();
            }).get();


    var product_price = $("input[name='product_price[]']")
            .map(function () {
                return $(this).val();
            }).get();

    var total_price = $("input[name='total_price[]']")
            .map(function () {
                return $(this).val();
            }).get();

    var product_session_id = $("input[name='product_session_id[]']")
            .map(function () {
                return $(this).val();
            }).get();

    var saleproductsid = $("input[name='saleproductsid[]']")
            .map(function () {
                return $(this).val();
            }).get();
    console.log(saleproductsid);


            $.ajax({
                url: "{{ route('sales.store.salesdata') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    date: date,
                    time: time,
                    sales_type: sales_type,
                    customer_type: customer_type,
                    customer_id: customer_id,
                    subtotal: subtotal,
                    taxamount: taxamount,
                    paymentmethod: paymentmethod,
                    totalamount: totalamount,
                    product_ids: product_ids,
                    product_quantity: product_quantity,
                    product_price: product_price,
                    total_price: total_price,
                    sale_discount: sale_discount,
                    grandtotal: grandtotal,
                    product_session_id: product_session_id,
                    saleid: saleid,
                    saleproductsid: saleproductsid,
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response.data);

                    if(response.alert){
                        alert('Please Enter the Data');
                    }else {
                        $('.alert-success').fadeIn().html(response.msg);
                        setTimeout(function() {
                            $('.alert-success').fadeOut("slow");
                        }, 2000 );

                        var last_salesid = response.last_id;
                        
                    
                       // window.location= "http://127.0.0.1:8000/zworktechnology/sales/print/" + last_salesid;
                        window.location= "https://annapooranifoods.com/zworktechnology/sales/print/" + last_salesid;


                        document.getElementById("sales_store").reset();
                        $('.product-table').empty('');
                        $('.selectproduct').attr('style', 'background-color:#7367f0;color: #fff;').val('Add to Cart').attr('disabled', false);
                        $('.rise_quantity').attr('style', 'display:none');
                        $('.total_count').text('');
                        $('.subtotalamount').text('');
                        $('#subtotal').val('');
                        $('#customer_type').val('walkincustomer');
                        $('#customer_type').select2().trigger('change');
                        $('#customer_id').val('');
                        $('#taxamount').val('');
                        $('input[name=paymentmethod]:checked').val('');
                        $('#totalamount').val('');
                        $('#sale_discount').val('');
                        $('.grand_total').text('');
                        $('.grandtotal').val('');
                        $('.cutomer_arr').hide();
                        $('.customertyp').show();
                        $('.selectproduct').show();
                        $('.setvaluecash').show();

                    }
                    //alert('Bill Added').attr('style', 'background-color:yellow;');

                       

                   
                }
            });
});


$('#sales_update').submit(function(e){
    e.preventDefault();

    //console.log($(this).serialize());

    //var billno = $('#bill_no').val();
    var date = $('#date').val();
    var time = $('#time').val();
    var sales_type = $('input[name=sales_type]:checked').val();
    var customer_type = $('#customer_type').val();
    var customer_id = $('#customer_id').val();
    var subtotal = $('#subtotal').val();
    var taxamount = $('#taxamount').val();
    var paymentmethod = $('input[name=paymentmethod]:checked').val();
    var totalamount = $('#totalamount').val();
    var sale_discount = $('#sale_discount').val();
    var grandtotal = $('#grandtotal').val();
    var saleid = $('#saleid').val();

    var product_ids = $("input[name='product_id[]']")
            .map(function () {
                return $(this).val();
            }).get();

    var product_quantity = $("input[name='product_quantity[]']")
            .map(function () {
                return $(this).val();
            }).get();


    var product_price = $("input[name='product_price[]']")
            .map(function () {
                return $(this).val();
            }).get();

    var total_price = $("input[name='total_price[]']")
            .map(function () {
                return $(this).val();
            }).get();

    var product_session_id = $("input[name='product_session_id[]']")
            .map(function () {
                return $(this).val();
            }).get();

    var saleproductsid = $("input[name='saleproductsid[]']")
            .map(function () {
                return $(this).val();
            }).get();
    console.log(saleproductsid);


            $.ajax({
                url: "{{ route('sales.update.salesdata') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    date: date,
                    time: time,
                    sales_type: sales_type,
                    customer_type: customer_type,
                    customer_id: customer_id,
                    subtotal: subtotal,
                    taxamount: taxamount,
                    paymentmethod: paymentmethod,
                    totalamount: totalamount,
                    product_ids: product_ids,
                    product_quantity: product_quantity,
                    product_price: product_price,
                    total_price: total_price,
                    sale_discount: sale_discount,
                    grandtotal: grandtotal,
                    product_session_id: product_session_id,
                    saleid: saleid,
                    saleproductsid: saleproductsid,
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response.msg);

                    if(response.alert){
                        alert('Please Enter the Data');
                    }else {
                        $('.alert-success').fadeIn().html(response.msg);
                        setTimeout(function() {
                            $('.alert-success').fadeOut("slow");
                        }, 2000 );

                        var last_salesid = response.last_id;
                        
                    
                       // window.location= "http://127.0.0.1:8000/zworktechnology/sales/";
                        window.location= "https://annapooranifoods.com/zworktechnology/sales";


                        document.getElementById("sales_update").reset();
                        $('.product-table').empty('');
                        $('.selectproduct').attr('style', 'background-color:#7367f0;color: #fff;').val('Add to Cart').attr('disabled', false);
                        $('.rise_quantity').attr('style', 'display:none');
                        $('.total_count').text('');
                        $('.subtotalamount').text('');
                        $('#subtotal').val('');
                        $('#saleid').val('');
                        $('#customer_type').val('walkincustomer');
                        $('#customer_type').select2().trigger('change');
                        $('#customer_id').val('');
                        $('#taxamount').val('');
                        $('input[name=paymentmethod]:checked').val('');
                        $('#totalamount').val('');
                        $('#sale_discount').val('');
                        $('.grand_total').text('');
                        $('.grandtotal').val('');
                        $('.cutomer_arr').hide();
                        $('.customertyp').show();
                        $('.selectproduct').show();
                        $('.setvaluecash').show();

                    }
                    //alert('Bill Added').attr('style', 'background-color:yellow;');

                       

                   
                }
            });
});



});



function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }



               
        $('.select2PS').on('change', function () {
               // $('.productlist').fadeOut();
               
                var productsessionid = $(this).find('option').filter(':selected').val()
                console.log(productsessionid);
                $('option:selected', this).remove();

                $('.addedproduct' + productsessionid).hide();
                var product_sessonid = productsessionid;
                        $.ajax({
                            url: '/getselectedboxproducts/',
                            type: 'get',
                            data: {
                                _token: "{{ csrf_token() }}",
                                product_sessonid: product_sessonid
                            },
                            dataType: 'json',
                            success: function(response) {
                                console.log(response);
                                var len = response.length;
                                occurs = {};

                                for (var i = 0; i < len; i++) {

                                    var e = $('<ul class="product-lists" id="productlist">'+
                                    '<li>' +
                                    '<div class="productimg">' +
                                    '<div class="productimgs"><img src=" ' + response[i].product_image +  ' "alt="img"></div>' +
                                    '<div class="productcontet"><h4> ' + response[i].product_name +  ' <a href="javascript:void(0);" class="ms-2" data-bs-toggle="modal"data-bs-target="#edit"><img src="{{ asset('assets/backend/img/icons/edit-5.svg') }}"alt="img"></a></h4>' +
                                    '<div class="productlinkset"><h5>'+ response[i].Category +'</h5></div><div class="increment-decrement">' +
                                    '<div class="input-groups">' +
                                    '<input type="hidden"  name="product_id[]"  value="' + response[i].product_id + '"/>' +
                                    '<input type="hidden" class="li_productid" id="li_productid"   value="' + response[i].id + '"/>' +
                                    '<input type="button" value="-" class="button-minus dec button"  onClick="decrement_quantity('+ response[i].id +')">' +
                                    '<input type="text" name="product_quantity[]" value="1"class="quantity-field product_quanitity" id="product_quantity' + response[i].id + '">' +
                                    '<input type="button" value="+" class="button-plus inc button " onClick="increment_quantity('+ response[i].id +')">' +
                                    '</div>' +
                                    '<input type="hidden" class="product_price" name="product_price[]" id="product_price' + response[i].id +  '"  value="' + response[i].product_price + '"/>' +
                                    '<input type="hidden" name="product_session_id[]" id="product_session_id"  value="' + response[i].id + '"/><input type="hidden" name="saleproductsid[]" class="saleproductsid" id="saleproductsid" value=""/>' +
                                    '</div></div></div>' +
                                    '</li><li><div class="input-groups"><span class="totalprice' + response[i].id +  '">' + response[i].product_price +  '</span>' +
                                    '<input type="hidden" name="total_price[]" class="total_price' + response[i].id +  '" value="' + response[i].product_price +  '"/></div></li>' +
                                    '<li><a class="confirm-text" href="javascript:void(0);"><a class="confirm-text remove-tr"><img src="{{ asset('assets/backend/img/icons/delete-2.svg') }}"alt="img"></a></li></ul>');

                                    $('.product-table').prepend(e);
                                    var product_div = '1';
                                    $('#product_quantity' + response[i].id).val(product_div);


                                    var product_price = $('#product_price' + response[i].id).val();
                                        var totalprice = product_price * product_div;
                                        $('.totalprice' + response[i].id).text(totalprice);
                                        $('.total_price' + response[i].id).val(totalprice);



                                        var tot_expense_amount = 0;
                                        $("input[name='total_price[]']").each(
                                            function() {
                                                //alert($(this).val());
                                                tot_expense_amount = Number(tot_expense_amount) +
                                                    Number($(this).val());
                                                    $('.subtotalamount').text('₹ ' + tot_expense_amount);
                                                    $('#subtotal').val(tot_expense_amount);
                                                    $('#totalamount').val(tot_expense_amount);


                                                    var sale_discount = $('#sale_discount').val();
                                                    var payment = Number(tot_expense_amount) - Number(sale_discount);
                                                    $('.grand_total').text(payment.toFixed(2));
                                                    $('.grandtotal').val(payment.toFixed(2));
                                            });
                                }

                                $(".total_count").text($('.product-table').children('.product-lists').length);

                            }
                        });




                                var tot_expense_amount = 0;
                                $("input[name='total_price[]']").each(
                                    function() {
                                        //alert($(this).val());
                                        tot_expense_amount = Number(tot_expense_amount) +
                                            Number($(this).val());
                                            $('.subtotalamount').text('₹ ' + tot_expense_amount);
                                            $('#subtotal').val(tot_expense_amount);
                                            $('#totalamount').val(tot_expense_amount);
                                            $('.grand_total').text('₹ ' + tot_expense_amount);
                                            $('.grandtotal').val(tot_expense_amount);
                                    });



                        
            });





       

        $(document).on("keyup", '.sale_discount', function() {
                var sale_discount = $(this).val();
                var totalamount = $("#totalamount").val();
                var payment = Number(totalamount) - Number(sale_discount);
                $('.grand_total').text(payment.toFixed(2));
                $('.grandtotal').val(payment.toFixed(2));
            });




            $(function(){

                $("input:radio[name='sales_type']").change(function(){
                    var _val = $(this).val();
                    //console.log(_val);
                    if(_val == 'Dine In'){

                        $('#customer_type').val('walkincustomer');
                        $('#customer_type').select2().trigger('change');
                        $('.customertyp').show();
                        $('.cutomer_arr').hide();
                        $('.setvaluecash').show();

                    }else if(_val == 'Take Away'){

                        $('#customer_type').val('walkoutcustomer');
                        $('#customer_type').select2().trigger('change');
                        $('.customertyp').show();
                        $('.cutomer_arr').hide();
                        $('.setvaluecash').show();

                    }else if(_val == 'Delivery'){
                        $('.customertyp').hide();
                        $('.cutomer_arr').show();
                        $('#customer_type').val('');
                        $('.setvaluecash').hide();
                    }
                });

            });




var j = 1;
var i = 1;


$(document).ready(function() {

    $(document).on('click', '.addproductfields', function() {
         ++i;
                $(".product_fields").append(
                    '<tr>' +
                    '<td style="background: #eee;"><input type="hidden"id="purchase_detail_id"name="purchase_detail_id[]" />' +
                    '<select class="form-control js-example-basic-single purchaseproduct_id select"name="purchaseproduct_id[]" id="purchaseproduct_id' + i + '"required>' +
                    '<option value="" selected hidden class="text-muted">Select Product</option></select>' +
                    '</td>' +
                    '<td style="background: #eee;"><input type="text" class="form-control purchase_quantity" id="quantity" name="purchase_quantity[]" placeholder="Quantity" value="" required /></td>' +
                    '<td style="background: #eee;"><input type="text" class="form-control purchase_price" id="price" name="purchase_price[]" placeholder="Price" value="" required /></td>' +
                    '<td style="background: #eee;"><input type="text" class="form-control total_price" id="total_price" name="total_price[]" placeholder="" value="" readonly /></td>' +
                    '<td style="background: #eee;"><button style="width: 35px;margin-right:5px;"class="py-1 text-white font-medium rounded-lg text-sm  text-center btn btn-primary addproductfields"type="button" id="" value="Add">+</button>' +
                    '<button style="width: 35px;" class="text-white py-1 font-medium rounded-lg text-sm  text-center btn btn-danger remove-purchasetr" type="button" >-</button></td>' +
                    '</tr>'
                );


                $.ajax({
                    url: '/getProducts/',
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        //console.log(response['data']);
                        var len = response['data'].length;

                        var selectedValues = new Array();

                        if (len > 0) {
                            for (var i = 0; i < len; i++) {

                                    var id = response['data'][i].id;
                                    var name = response['data'][i].name;
                                    var option = "<option value='" + id + "'>" + name +
                                        "</option>";
                                    selectedValues.push(option);
                            }
                        }
                        ++j;
                        $('#purchaseproduct_id' + j).append(selectedValues);
                        //add_count.push(Object.keys(selectedValues).length);
                    }
                });
        });


});





$(document).on('click', '.remove-purchasetr', function() {
    $(this).parents('tr').remove();

        var sum = 0;
        $(".total_price").each(function(){
            sum += +$(this).val();
        });

        $(".sub_total").val(sum);
        $('.subtotal').text('₹ ' + sum);

        $('.total').val(sum);
        $('.totalamount').text('₹ ' + sum);

        $('.purchase_grandtotal').val(sum);
        $('.purchasegrand_total').text('₹ ' + sum);


        var tax = $( "#tax option:selected" ).val();
        if(tax != '0'){
            var sub_total = $(".sub_total").val();
            var tax_amount = (tax / 100) * sub_total;
            $('.tax_amount').val(tax_amount.toFixed(2));
            $('.taxamount').text('₹ ' + tax_amount.toFixed(2));

            var totsl = Number(sub_total) + Number(tax_amount);
            $('.total').val(totsl.toFixed(2));
            $('.totalamount').text('₹ ' + totsl.toFixed(2));

            var discount_price = $('.discount_price').val();

            var grand_total = Number(totsl) - Number(discount_price);
            $('.purchase_grandtotal').val(grand_total.toFixed(2));
            $('.purchasegrand_total').text('₹ ' + grand_total.toFixed(2));
        }


        var discount_type = $("#discount_type").val();
        if(discount_type == 'fixed'){

            var discount = $('.discount').val();
            $('.discount_price').val(discount);
            $('.discountprice').text('₹ ' + discount);

            var total = $(".total").val();
            var total_amount = Number(total) - Number(discount);
            $('.purchase_grandtotal').val(total_amount.toFixed(2));
            $('.purchasegrand_total').text('₹ ' + total_amount.toFixed(2));

        }else if(discount_type == 'percentage'){

            var total = $(".total").val();
            var discount = $('.discount').val();
            var discountPercentageAmount = (discount / 100) * total;
            $('.discount_price').val(discountPercentageAmount.toFixed(2));
            $('.discountprice').text('₹ ' + discountPercentageAmount.toFixed(2));

            var totalamount = Number(total) - Number(discountPercentageAmount);
            $('.purchase_grandtotal').val(totalamount.toFixed(2));
            $('.purchasegrand_total').text('₹ ' + totalamount.toFixed(2));

        }else if(discount_type == 'none'){

            $('.discount').val(0);
            $('.discount_price').val(0);
            $('.discountprice').text('₹ ' + 0);
            var total = $(".total").val();
            $('.purchase_grandtotal').val(total);
            $('.purchasegrand_total').text('₹ ' + total);
        }


        var paidamount = $('.paidamount').val();
        if(paidamount != ''){
            var purchase_grandtotal = $('.purchase_grandtotal').val();
            var balance_amount = Number(purchase_grandtotal) - Number(paidamount);
            console.log(balance_amount);
            $('.balanceamount').val(balance_amount.toFixed(2));
        }
        

        


});




    $(document).on("blur", "input[name*=purchase_quantity]", function() {
        var quantity = $(this).val();
        var price = $(this).parents('tr').find('.purchase_price').val();
        var total = quantity * price;
        $(this).parents('tr').find('.total_price').val(total);

        var sum = 0;
        $(".total_price").each(function(){
            sum += +$(this).val();
        });

        $(".sub_total").val(sum);
        $('.subtotal').text('₹ ' + sum);

        $('.total').val(sum);
        $('.totalamount').text('₹ ' + sum);

        $('.purchase_grandtotal').val(sum);
        $('.purchasegrand_total').text('₹ ' + sum);



        var tax = $( "#tax option:selected" ).val();
        if(tax != '0'){
            var sub_total = $(".sub_total").val();
            var tax_amount = (tax / 100) * sub_total;
            $('.tax_amount').val(tax_amount.toFixed(2));
            $('.taxamount').text('₹ ' + tax_amount.toFixed(2));

            var totsl = Number(sub_total) + Number(tax_amount);
            $('.total').val(totsl.toFixed(2));
            $('.totalamount').text('₹ ' + totsl.toFixed(2));

            var discount_price = $('.discount_price').val();

            var grand_total = Number(totsl) - Number(discount_price);
            $('.purchase_grandtotal').val(grand_total.toFixed(2));
            $('.purchasegrand_total').text('₹ ' + grand_total.toFixed(2));
        }


        var discount_type = $("#discount_type").val();
        if(discount_type == 'fixed'){

            var discount = $('.discount').val();
            $('.discount_price').val(discount);
            $('.discountprice').text('₹ ' + discount);

            var total = $(".total").val();
            var total_amount = Number(total) - Number(discount);
            $('.purchase_grandtotal').val(total_amount.toFixed(2));
            $('.purchasegrand_total').text('₹ ' + total_amount.toFixed(2));

        }else if(discount_type == 'percentage'){

            var total = $(".total").val();
            var discount = $('.discount').val();
            var discountPercentageAmount = (discount / 100) * total;
            $('.discount_price').val(discountPercentageAmount.toFixed(2));
            $('.discountprice').text('₹ ' + discountPercentageAmount.toFixed(2));

            var totalamount = Number(total) - Number(discountPercentageAmount);
            $('.purchase_grandtotal').val(totalamount.toFixed(2));
            $('.purchasegrand_total').text('₹ ' + totalamount.toFixed(2));

        }else if(discount_type == 'none'){

            $('.discount').val(0);
            $('.discount_price').val(0);
            $('.discountprice').text('₹ ' + 0);
            var total = $(".total").val();
            $('.purchase_grandtotal').val(total.toFixed(2));
            $('.purchasegrand_total').text('₹ ' + total.toFixed(2));
        }


        var paidamount = $('.paidamount').val();
        var purchase_grandtotal = $('.purchase_grandtotal').val();

        var balance_amount = Number(purchase_grandtotal) - Number(paidamount);
        $('.balanceamount').val(balance_amount.toFixed(2));

    });





$(document).on("blur", "input[name*=purchase_price]", function() {
    var price = $(this).val();
    var quantity = $(this).parents('tr').find('.purchase_quantity').val();
    var total = quantity * price;
    $(this).parents('tr').find('.total_price').val(total);

        var sum = 0;
        $(".total_price").each(function(){
            sum += +$(this).val();
        });

        $(".sub_total").val(sum);
        $('.subtotal').text('₹ ' + sum);

        $('.total').val(sum);
        $('.totalamount').text('₹ ' + sum);

        $('.purchase_grandtotal').val(sum);
        $('.purchasegrand_total').text('₹ ' + sum);



        var tax = $( "#tax option:selected" ).val();
        if(tax != '0'){
            var sub_total = $(".sub_total").val();
            var tax_amount = (tax / 100) * sub_total;
            $('.tax_amount').val(tax_amount.toFixed(2));
            $('.taxamount').text('₹ ' + tax_amount.toFixed(2));

            var totsl = Number(sub_total) + Number(tax_amount);
            $('.total').val(totsl.toFixed(2));
            $('.totalamount').text('₹ ' + totsl.toFixed(2));

            var discount_price = $('.discount_price').val();

            var grand_total = Number(totsl) - Number(discount_price);
            $('.purchase_grandtotal').val(grand_total.toFixed(2));
            $('.purchasegrand_total').text('₹ ' + grand_total.toFixed(2));
        }


        var discount_type = $("#discount_type").val();
        if(discount_type == 'fixed'){

            var discount = $('.discount').val();
            $('.discount_price').val(discount);
            $('.discountprice').text('₹ ' + discount);

            var total = $(".total").val();
            var total_amount = Number(total) - Number(discount);
            $('.purchase_grandtotal').val(total_amount.toFixed(2));
            $('.purchasegrand_total').text('₹ ' + total_amount.toFixed(2));

        }else if(discount_type == 'percentage'){

            var total = $(".total").val();
            var discount = $('.discount').val();
            var discountPercentageAmount = (discount / 100) * total;
            $('.discount_price').val(discountPercentageAmount.toFixed(2));
            $('.discountprice').text('₹ ' + discountPercentageAmount.toFixed(2));

            var totalamount = Number(total) - Number(discountPercentageAmount);
            $('.purchase_grandtotal').val(totalamount.toFixed(2));
            $('.purchasegrand_total').text('₹ ' + totalamount.toFixed(2));

        }else if(discount_type == 'none'){

            $('.discount').val(0);
            $('.discount_price').val(0);
            $('.discountprice').text('₹ ' + 0);
            var total = $(".total").val();
            $('.purchase_grandtotal').val(total.toFixed(2));
            $('.purchasegrand_total').text('₹ ' + total.toFixed(2));
        }

        var paidamount = $('.paidamount').val();
        var purchase_grandtotal = $('.purchase_grandtotal').val();

        var balance_amount = Number(purchase_grandtotal) - Number(paidamount);
        $('.balanceamount').val(balance_amount.toFixed(2));


});




$("#tax").on('change', function() {
    var tax = $(this).val();
    var sub_total = $(".sub_total").val();
    var tax_amount = (tax / 100) * sub_total;
    $('.tax_amount').val(tax_amount.toFixed(2));
    $('.taxamount').text('₹ ' + tax_amount.toFixed(2));

    var totsl = Number(sub_total) + Number(tax_amount);
    $('.total').val(totsl.toFixed(2));
    $('.totalamount').text('₹ ' + totsl.toFixed(2));

    var discount_price = $('.discount_price').val();
    var grand_total = Number(totsl) - Number(discount_price);
    $('.purchase_grandtotal').val(grand_total.toFixed(2));
    $('.purchasegrand_total').text('₹ ' + grand_total.toFixed(2));

    var paidamount = $('.paidamount').val();
    var purchase_grandtotal = $('.purchase_grandtotal').val();

    var balance_amount = Number(purchase_grandtotal) - Number(paidamount);
    $('.balanceamount').val(balance_amount.toFixed(2));
});



$("#discount_type").on('change', function() {
        var discount_type = this.value;
        
        if(discount_type == 'fixed'){

            $('#discount').val('');
            $('.discount_price').val(0);
            $('.discountprice').text('₹ ' + 0);

        }else if(discount_type == 'percentage'){

            $('#discount').val('');
            $('.discount_price').val(0);
            $('.discountprice').text('₹ ' + 0);

        }else if(discount_type == 'none'){

            $('#discount').val('');
            $('.discount_price').val(0);
            $('.discountprice').text('₹ ' + 0);

            var total = $(".total").val();
            $('.purchase_grandtotal').val(total.toFixed(2));
            $('.purchasegrand_total').text('₹ ' + total.toFixed(2));

            var paidamount = $('.paidamount').val();
            var purchase_grandtotal = $('.purchase_grandtotal').val();
            var balance_amount = Number(purchase_grandtotal) - Number(paidamount);
            $('.balanceamount').val(balance_amount.toFixed(2));
        }
    });


    $(document).on("keyup", 'input.discount', function() {
        var discount = $(this).val();
        var discount_type = $("#discount_type").val();

        if(discount_type == 'fixed'){

            $('.discount_price').val(discount);
            $('.discountprice').text('₹ ' + discount);

            var total = $(".total").val();
            var total_amount = Number(total) - Number(discount);
            $('.purchase_grandtotal').val(total_amount.toFixed(2));
            $('.purchasegrand_total').text('₹ ' + total_amount.toFixed(2));

            var paidamount = $('.paidamount').val();
            var purchase_grandtotal = $('.purchase_grandtotal').val();
            var balance_amount = Number(purchase_grandtotal) - Number(paidamount);
            $('.balanceamount').val(balance_amount.toFixed(2));

        }else if(discount_type == 'percentage'){

            var total = $(".total").val();
            var discountPercentageAmount = (discount / 100) * total;
            $('.discount_price').val(discountPercentageAmount.toFixed(2));
            $('.discountprice').text('₹ ' + discountPercentageAmount.toFixed(2));

            var totalamount = Number(total) - Number(discountPercentageAmount);
            $('.purchase_grandtotal').val(totalamount.toFixed(2));
            $('.purchasegrand_total').text('₹ ' + totalamount.toFixed(2));

            var paidamount = $('.paidamount').val();
            var purchase_grandtotal = $('.purchase_grandtotal').val();
            var balance_amount = Number(purchase_grandtotal) - Number(paidamount);
            $('.balanceamount').val(balance_amount.toFixed(2));

        }else if(discount_type == 'none'){

            $('.discount').val(0);
            $('.discount_price').val(0);
            $('.discountprice').text('₹ ' + 0);
            var total = $(".total").val();
            $('.purchase_grandtotal').val(total.toFixed(2));
            $('.purchasegrand_total').text('₹ ' + total.toFixed(2));

            var paidamount = $('.paidamount').val();
            var purchase_grandtotal = $('.purchase_grandtotal').val();
            var balance_amount = Number(purchase_grandtotal) - Number(paidamount);
            $('.balanceamount').val(balance_amount.toFixed(2));
        }
    });


    $(document).on("keyup", 'input.paidamount', function() {
        var paidamount = $(this).val();
        var purchase_grandtotal = $(".purchase_grandtotal").val();
        //alert(bill_paid_amount);
        var purchase_balance_amount = Number(purchase_grandtotal) - Number(paidamount);
        $('.balanceamount').val(purchase_balance_amount.toFixed(2));
    });


    $(document).on("keyup", 'input.paidamount', function() {
            var payable_amount = $(this).val();
            var grand_total = $(".purchase_grandtotal").val();

            if (Number(payable_amount) > Number(grand_total)) {
                alert('!Paid Amount is More than of Total!');
                $(".paidamount").val('');
            }
    });


function purchasesubmitForm(btn) {
        // disable the button
        btn.disabled = true;
        // submit the form
        btn.form.submit();
    }

    $(document).ready(function() {
            $('.salespaymentcustomer_id').on('change', function() {
                var customerid = this.value;
                //alert(branch_id);
                $('.saleoldbalance').val('');
                    $.ajax({
                        url: '/getoldbalanceforPayment/',
                        type: 'get',
                        data: {
                                customerid: customerid
                            },
                        dataType: 'json',
                        success: function(response) {
                            //
                            console.log(response);
                            var len = response.length;
                            for (var i = 0; i < len; i++) {
                                $(".saleoldbalance").val(response[i].payment_pending);
                                var salepaymentpaidamt = 0;
                                var balance_amount = Number(response[i].payment_pending) - Number(salepaymentpaidamt);
                                $('.salepaymentbal').val(balance_amount.toFixed(2));
                            }
                        }
                    });
            });



            $('.salepaymentpaid_customerid').on('change', function() {
                var customerid = this.value;
                //alert(branch_id);
                $('.salepayment_paidamt').val('');
                    $.ajax({
                        url: '/getoldbalanceforPayment/',
                        type: 'get',
                        data: {
                                customerid: customerid
                            },
                        dataType: 'json',
                        success: function(response) {
                            //
                            console.log(response);
                            var len = response.length;
                            $('.alreadypaidamount').show();
                            for (var i = 0; i < len; i++) {
                                $(".salepayment_paidamt").val(response[i].payment_pending);

                                var sales_totamount = $('.sales_totamount').val();
                            }
                        }
                    });
            });
    });

    $(document).on("keyup", '.salepaymentpaidamt', function() {
        var salepaymentpaidamt = $(this).val();
        var saleoldbalance = $(".saleoldbalance").val();
        //alert(bill_paid_amount);
        var balance_amount = Number(saleoldbalance) - Number(salepaymentpaidamt);
        $('.salepaymentbal').val(balance_amount.toFixed(2));
    });




    $(document).ready(function() {
            $('.purchasepaymentsupplier').on('change', function() {
                var supplierid = this.value;
                //alert(branch_id);
                $('.purchaseoldbalance').val('');
                    $.ajax({
                        url: '/getbalanceforpurchasePayment/',
                        type: 'get',
                        data: {
                            supplierid: supplierid
                            },
                        dataType: 'json',
                        success: function(response) {
                            //
                            console.log(response);
                            var len = response.length;
                            for (var i = 0; i < len; i++) {
                                $(".purchaseoldbalance").val(response[i].payment_pending);
                                var purchasepaidamount = 0;
                                var balance_amount = Number(response[i].payment_pending) - Number(purchasepaidamount);
                                $('.purchasebal').val(balance_amount.toFixed(2));
                            }
                        }
                    });
            });
    });

    

    $(document).on("keyup", '.purchasepaidamount', function() {
        var purchasepaidamount = $(this).val();
        var purchaseoldbalance = $(".purchaseoldbalance").val();
        //alert(bill_paid_amount);
        var balance_amount = Number(purchaseoldbalance) - Number(purchasepaidamount);
        $('.purchasebal').val(balance_amount.toFixed(2));
    });


    function empattendsubmitForm(btn) {
        // disable the button
        btn.disabled = true;
        // submit the form
        btn.form.submit();
    }


    function deliveryattendsubmitForm(btn) {
        // disable the button
        btn.disabled = true;
        // submit the form
        btn.form.submit();
    }


    function expensesubmitForm(btn) {
        // disable the button
        btn.disabled = true;
        // submit the form
        btn.form.submit();
    }


    function outdoorsubmitForm(btn) {
        // disable the button
        btn.disabled = true;
        // submit the form
        btn.form.submit();
    }



$(document).ready(function() {

    $(document).on('click', '.addexpensefields', function() {
     ++i;
            $(".expense_fields").append(
                '<tr>' +
                '<td><input type="hidden"id="expenes_detail_id"name="expenes_detail_id[]" value=""/><input type="text" class="form-control note" id="note" name="note[]"placeholder="note" value="" required />' +
                '</td>' +
                '<td><input type="text" class="form-control expenseprice" id="expenseprice" name="expenseprice[]" placeholder="Price" value="" required /></td>' +
                '<td style="background: #eee;"><button style="width: 35px;margin-right:5px;"class="py-1 text-white font-medium rounded-lg text-sm  text-center btn btn-primary addexpensefields"type="button" id="" value="Add">+</button>' +
                '<button style="width: 35px;" class="text-white py-1 font-medium rounded-lg text-sm  text-center btn btn-danger remove-expensetr" type="button" >-</button></td>' +
                '</tr>'
            );
        
    });

});

$(document).on('click', '.remove-expensetr', function() {
    $(this).parents('tr').remove();

    var tota_expense = 0;
        $("input[name='expenseprice[]']").each(
                                    function() {
                                        //alert($(this).val());
                                        tota_expense = Number(tota_expense) +
                                            Number($(this).val());
                                        $('.expensetotal_price').val(tota_expense.toFixed(2));
                                    });
});
           
 

$(document).on("keyup", "input[name*=expenseprice]", function() {
        var tota_expense = 0;
        $("input[name='expenseprice[]']").each(
                                    function() {
                                        //alert($(this).val());
                                        tota_expense = Number(tota_expense) +
                                            Number($(this).val());
                                        $('.expensetotal_price').val(tota_expense.toFixed(2));
                                    });
    });



var o = 1;
var p = 1;
$(document).ready(function() {

    $(document).on('click', '.addoutdoorfields', function() {
    ++o;
            $(".outdoor_fields").append(
                '<tr>' +
                '<td><input type="hidden"id="outdoor_detail_id"name="outdoor_detail_id[]" value=""/>' +
                    '<select class="form-control js-example-basic-single outdoorproduct_id select"name="outdoorproduct_id[]" id="outdoorproduct_id' + o + '"required>' +
                    '<option value="" selected hidden class="text-muted">Select Product</option></select>' +
                    '</td>' +
                '<td><textarea type="text" name="outdoornote[]" class="form-control" placeholder="Enter note" ></textarea></td>' +
                '<td><input type="text" class="form-control outdoorquantity" id="outdoorquantity" name="outdoorquantity[]" placeholder="quantity" value="" required /></td>' +
                '<td><input type="text" class="form-control outdoorpriceperquantity" id="outdoorpriceperquantity" name="outdoorpriceperquantity[]" placeholder="note" value="" required /></td>' +
                '<td><input type="text" class="form-control outdoorprice" id="outdoorprice" name="outdoorprice[]" placeholder="Price" value="" required /></td>' +
                '<td style="background: #eee;"><button style="width: 35px;margin-right:5px;"class="py-1 text-white font-medium rounded-lg text-sm  text-center btn btn-primary addoutdoorfields"type="button" id="" value="Add">+</button>' +
                '<button style="width: 35px;" class="text-white py-1 font-medium rounded-lg text-sm  text-center btn btn-danger remove-outdoortr" type="button" >-</button></td>' +
                '</tr>'
            );

            $.ajax({
                    url: '/getoutdoorProducts/',
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {
                        //console.log(response['data']);
                        var len = response['data'].length;

                        var selectedValues = new Array();

                        if (len > 0) {
                            for (var i = 0; i < len; i++) {

                                    var id = response['data'][i].id;
                                    var name = response['data'][i].name;
                                    var option = "<option value='" + id + "'>" + name +
                                        "</option>";
                                    selectedValues.push(option);
                            }
                        }
                        ++p;
                        $('#outdoorproduct_id' + p).append(selectedValues);
                        //add_count.push(Object.keys(selectedValues).length);
                    }
                });
        
    });

});

$(document).on('click', '.remove-outdoortr', function() {
    $(this).parents('tr').remove();

        var sum = 0;
        $(".outdoorprice").each(function(){
            sum += +$(this).val();
        });

        $(".outdoorsub_total").val(sum);
        $('.outdoorsubtotal').text('₹ ' + sum);

        $('.outdoor_grandtotal').val(sum);
        $('.outdoorgrandtotal').text('₹ ' + sum);



        var tax = $( "#outdoortax option:selected" ).val();
        if(tax != '0'){
            var outdoorsub_total = $(".outdoorsub_total").val();
            var tax_amount = (tax / 100) * outdoorsub_total;
            $('.outdoortax_amount').val(tax_amount.toFixed(2));
            $('.outdoortaxamount').text('₹ ' + tax_amount.toFixed(2));

            var totsl = Number(outdoorsub_total) + Number(tax_amount);
            $('.outdoor_grandtotal').val(totsl.toFixed(2));
            $('.outdoorgrandtotal').text('₹ ' + totsl.toFixed(2));
        }
});




    $(document).on("blur", "input[name*=outdoorquantity]", function() {
        var quantity = $(this).val();
        var price = $(this).parents('tr').find('.outdoorpriceperquantity').val();
        var total = quantity * price;
        $(this).parents('tr').find('.outdoorprice').val(total);

        var sum = 0;
        $(".outdoorprice").each(function(){
            sum += +$(this).val();
        });

        $(".outdoorsub_total").val(sum);
        $('.outdoorsubtotal').text('₹ ' + sum);

        $('.outdoor_grandtotal').val(sum);
        $('.outdoorgrandtotal').text('₹ ' + sum);



        var tax = $( "#outdoortax option:selected" ).val();
        if(tax != '0'){
            var outdoorsub_total = $(".outdoorsub_total").val();
            var tax_amount = (tax / 100) * outdoorsub_total;
            $('.outdoortax_amount').val(tax_amount.toFixed(2));
            $('.outdoortaxamount').text('₹ ' + tax_amount.toFixed(2));

            var totsl = Number(outdoorsub_total) + Number(tax_amount);
            $('.outdoor_grandtotal').val(totsl.toFixed(2));
            $('.outdoorgrandtotal').text('₹ ' + totsl.toFixed(2));
        }

    });



    $(document).on("blur", "input[name*=outdoorpriceperquantity]", function() {
        var outdoorpriceperquantity = $(this).val();
        var outdoorquantity = $(this).parents('tr').find('.outdoorquantity').val();
        var total = outdoorpriceperquantity * outdoorquantity;
        $(this).parents('tr').find('.outdoorprice').val(total);

        var sum = 0;
        $(".outdoorprice").each(function(){
            sum += +$(this).val();
        });

        $(".outdoorsub_total").val(sum);
        $('.outdoorsubtotal').text('₹ ' + sum);

        $('.outdoor_grandtotal').val(sum);
        $('.outdoorgrandtotal').text('₹ ' + sum);



        var tax = $( "#outdoortax option:selected" ).val();
        if(tax != '0'){
            var outdoorsub_total = $(".outdoorsub_total").val();
            var tax_amount = (tax / 100) * outdoorsub_total;
            $('.outdoortax_amount').val(tax_amount.toFixed(2));
            $('.outdoortaxamount').text('₹ ' + tax_amount.toFixed(2));

            var totsl = Number(outdoorsub_total) + Number(tax_amount);
            $('.outdoor_grandtotal').val(totsl.toFixed(2));
            $('.outdoorgrandtotal').text('₹ ' + totsl.toFixed(2));
        }

    });


    $("#outdoortax").on('change', function() {
        var tax = $(this).val();
        var sub_total = $(".outdoorsub_total").val();
        var tax_amount = (tax / 100) * sub_total;
        $('.outdoortax_amount').val(tax_amount.toFixed(2));
        $('.outdoortaxamount').text('₹ ' + tax_amount.toFixed(2));

        var totsl = Number(sub_total) + Number(tax_amount);
        $('.outdoor_grandtotal').val(totsl.toFixed(2));
        $('.outdoorgrandtotal').text('₹ ' + totsl.toFixed(2));
       
    });



    $(document).on("keyup", '#count1', function() {
        var count1 = $(this).val();
        var rupee1 = $("#rupee1").val();
        //alert(bill_paid_amount);
        var total1 = count1 * rupee1;
        $('#amount1').val(total1);


        var sum = 0;
        $(".determinationamount").each(function(){
            sum += +$(this).val();
        });

        $(".determinationtotal_amount").val(sum);
    });

    $(document).on("keyup", '#count2', function() {
        var count2 = $(this).val();
        var rupee2 = $("#rupee2").val();
        //alert(bill_paid_amount);
        var total2 = count2 * rupee2;
        $('#amount2').val(total2);

        var sum = 0;
        $(".determinationamount").each(function(){
            sum += +$(this).val();
        });

        $(".determinationtotal_amount").val(sum);
    });


    $(document).on("keyup", '#count3', function() {
        var count3 = $(this).val();
        var rupee3 = $("#rupee3").val();
        //alert(bill_paid_amount);
        var total3 = count3 * rupee3;
        $('#amount3').val(total3);


        var sum = 0;
        $(".determinationamount").each(function(){
            sum += +$(this).val();
        });

        $(".determinationtotal_amount").val(sum);
    });


    $(document).on("keyup", '#count4', function() {
        var count4 = $(this).val();
        var rupee4 = $("#rupee4").val();
        //alert(bill_paid_amount);
        var total4 = count4 * rupee4;
        $('#amount4').val(total4);

        var sum = 0;
        $(".determinationamount").each(function(){
            sum += +$(this).val();
        });

        $(".determinationtotal_amount").val(sum);
    });


    $(document).on("keyup", '#count5', function() {
        var count5 = $(this).val();
        var rupee5 = $("#rupee5").val();
        //alert(bill_paid_amount);
        var total5 = count5 * rupee5;
        $('#amount5').val(total5);

        var sum = 0;
        $(".determinationamount").each(function(){
            sum += +$(this).val();
        });

        $(".determinationtotal_amount").val(sum);
    });


    $(document).on("keyup", '#count6', function() {
        var count6 = $(this).val();
        var rupee6 = $("#rupee6").val();
        //alert(bill_paid_amount);
        var total6 = count6 * rupee6;
        $('#amount6').val(total6);

        var sum = 0;
        $(".determinationamount").each(function(){
            sum += +$(this).val();
        });

        $(".determinationtotal_amount").val(sum);
    });


    $(document).on("keyup", '#count7', function() {
        var count7 = $(this).val();
        var rupee7 = $("#rupee7").val();
        //alert(bill_paid_amount);
        var total7 = count7 * rupee7;
        $('#amount7').val(total7);

        var sum = 0;
        $(".determinationamount").each(function(){
            sum += +$(this).val();
        });

        $(".determinationtotal_amount").val(sum);
    });

    $(document).on("keyup", '#count8', function() {
        var count8 = $(this).val();
        var rupee8 = $("#rupee8").val();
        //alert(bill_paid_amount);
        var total8 = count8 * rupee8;
        $('#amount8').val(total8);

        var sum = 0;
        $(".determinationamount").each(function(){
            sum += +$(this).val();
        });

        $(".determinationtotal_amount").val(sum);
    });


    $(document).on("keyup", '#count9', function() {
        var count9 = $(this).val();
        var rupee9 = $("#rupee9").val();
        //alert(bill_paid_amount);
        var total9 = count9 * rupee9;
        $('#amount9').val(total9);

        var sum = 0;
        $(".determinationamount").each(function(){
            sum += +$(this).val();
        });

        $(".determinationtotal_amount").val(sum);
    });

    $(document).on("keyup", '#count10', function() {
        var count10 = $(this).val();
        var rupee10 = $("#rupee10").val();
        //alert(bill_paid_amount);
        var total10 = count10 * rupee10;
        $('#amount10').val(total10);

        var sum = 0;
        $(".determinationamount").each(function(){
            sum += +$(this).val();
        });

        $(".determinationtotal_amount").val(sum);
    });


    
    $(document).on('click', '.remove-produtseesiondiv', function() {
        $(this).parents('div.produtseesiondiv').remove();
    });

    $(document).on("keyup", '.outdoor_payment_amount', function() {
        var outdoor_payment_amount = $(this).val();
        var outdoor_grandtotal = $(".outdoor_grandtotal").val();
        //alert(bill_paid_amount);
        var balance_amount = Number(outdoor_grandtotal) - Number(outdoor_payment_amount);
        $('.outdoorbalanceamount').val(balance_amount.toFixed(2));
    });



    $(document).on("keyup", 'input.outdoor_payment_amount', function() {
            var payable_amount = $(this).val();
            var grand_total = $(".outdoor_grandtotal").val();

            if (Number(payable_amount) > Number(grand_total)) {
                alert('!Paid Amount is More than of Total!');
                $(".outdoor_payment_amount").val('');
            }
    });

</script>
