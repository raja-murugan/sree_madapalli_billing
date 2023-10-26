<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Product;
use App\Models\Session;
use App\Models\Category;
use App\Models\Bank;
use App\Models\Sale;
use App\Models\SaleProduct;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Productsession;
use App\Models\Deliveryboy;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use PDF;


class SaleController extends Controller
{
    public function index()
    {
        
        $today = Carbon::now()->format('Y-m-d');
        $dineindata = Sale::where('date', '=', $today)->where('sales_type', '=', 'Dine In')->where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();
        $saledinein_data = [];
        $terms = [];
        foreach ($dineindata as $key => $datas) {
            
            if($datas->customer_id != ""){
                $customer = Customer::findOrFail($datas->customer_id);
                $customername = $customer->name;
            }else {
                $customername = '';
            }


            $SaleProducts = SaleProduct::where('sales_id', '=', $datas->id)->get();
            foreach ($SaleProducts as $key => $SaleProducts_arr) {

                $productid = Product::findOrFail($SaleProducts_arr->product_id);
                $terms[] = array(
                    'product_name' => $productid->name,
                    'quantity' => $SaleProducts_arr->quantity,
                    'price' => $SaleProducts_arr->price,
                    'total_price' => $SaleProducts_arr->total_price,
                    'sales_id' => $SaleProducts_arr->sales_id,
                );
            }



            $saledinein_data[] = array(
                'date' => date('d-m-Y', strtotime($datas->date)),
                'bill_no' => $datas->bill_no,
                'time' => $datas->time,
                'sales_type' => $datas->sales_type,
                'customer_type' => $datas->customer_type,
                'customer' => $customername,
                'sub_total' => $datas->sub_total,
                'tax' => $datas->tax,
                'total' => $datas->total,
                'sale_discount' => $datas->sale_discount,
                'grandtotal' => $datas->grandtotal,
                'payment_method' => $datas->payment_method,
                'id' => $datas->id,
                'unique_key' => $datas->unique_key,
                'terms' => $terms,
            );
        }




        $takeawaydata = Sale::where('date', '=', $today)->where('sales_type', '=', 'Take Away')->where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();
        $saletakeway_data = [];
        $terms = [];
        foreach ($takeawaydata as $key => $datas) {
            
            if($datas->customer_id != ""){
                $customer = Customer::findOrFail($datas->customer_id);
                $customername = $customer->name;
            }else {
                $customername = '';
            }


            $SaleProducts = SaleProduct::where('sales_id', '=', $datas->id)->get();
            foreach ($SaleProducts as $key => $SaleProducts_arr) {

                $productid = Product::findOrFail($SaleProducts_arr->product_id);
                $terms[] = array(
                    'product_name' => $productid->name,
                    'quantity' => $SaleProducts_arr->quantity,
                    'price' => $SaleProducts_arr->price,
                    'total_price' => $SaleProducts_arr->total_price,
                    'sales_id' => $SaleProducts_arr->sales_id,
                );
            }



            $saletakeway_data[] = array(
                'date' => date('d-m-Y', strtotime($datas->date)),
                'bill_no' => $datas->bill_no,
                'time' => $datas->time,
                'sales_type' => $datas->sales_type,
                'customer_type' => $datas->customer_type,
                'customer' => $customername,
                'sub_total' => $datas->sub_total,
                'tax' => $datas->tax,
                'total' => $datas->total,
                'sale_discount' => $datas->sale_discount,
                'grandtotal' => $datas->grandtotal,
                'payment_method' => $datas->payment_method,
                'id' => $datas->id,
                'unique_key' => $datas->unique_key,
                'terms' => $terms,
            );
        }





        $deliverydata = Sale::where('date', '=', $today)->where('sales_type', '=', 'Delivery')->where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();
        $saledelivery_data = [];
        $terms = [];
        foreach ($deliverydata as $key => $datas) {
            
            if($datas->customer_id != ""){
                $customer = Customer::findOrFail($datas->customer_id);
                $customername = $customer->name;
            }else {
                $customername = '';
            }


            $SaleProducts = SaleProduct::where('sales_id', '=', $datas->id)->get();
            foreach ($SaleProducts as $key => $SaleProducts_arr) {

                $productid = Product::findOrFail($SaleProducts_arr->product_id);
                $terms[] = array(
                    'product_name' => $productid->name,
                    'quantity' => $SaleProducts_arr->quantity,
                    'price' => $SaleProducts_arr->price,
                    'total_price' => $SaleProducts_arr->total_price,
                    'sales_id' => $SaleProducts_arr->sales_id,
                );
            }

            if($datas->deliveryboy_id != ""){
                $Delivery_boy = Deliveryboy::findOrFail($datas->deliveryboy_id);
                $Delivery_boyname = $Delivery_boy->name;
            }else {
                $Delivery_boyname = '';
            }


            $saledelivery_data[] = array(
                'date' => date('d-m-Y', strtotime($datas->date)),
                'bill_no' => $datas->bill_no,
                'time' => $datas->time,
                'sales_type' => $datas->sales_type,
                'customer_type' => $datas->customer_type,
                'customer' => $customername,
                'Delivery_boyname' => $Delivery_boyname,
                'sub_total' => $datas->sub_total,
                'tax' => $datas->tax,
                'total' => $datas->total,
                'sale_discount' => $datas->sale_discount,
                'grandtotal' => $datas->grandtotal,
                'payment_method' => $datas->payment_method,
                'id' => $datas->id,
                'unique_key' => $datas->unique_key,
                'terms' => $terms,
            );
        }







        
        $session = Session::where('soft_delete', '!=', 1)->get();
        $category = Category::where('soft_delete', '!=', 1)->get();
        $Bank = Bank::where('soft_delete', '!=', 1)->get();
        $Deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
        $todaydate = Carbon::now()->format('d-m-Y');


        $total_sale_amount = Sale::where('date', '=', $today)->where('soft_delete', '!=', 1)->sum('grandtotal');
            if($total_sale_amount != ""){
                $totsaleAmount = $total_sale_amount;
            }else {
                $totsaleAmount = '0';
            }

        $total_dinein = Sale::where('date', '=', $today)->where('sales_type', '=', 'Dine In')->where('soft_delete', '!=', 1)->sum('grandtotal');
            if($total_dinein != ""){
                $total_dine_in = $total_dinein;
            }else {
                $total_dine_in = '0';
            }


        $total_takeaway = Sale::where('date', '=', $today)->where('sales_type', '=', 'Take Away')->where('soft_delete', '!=', 1)->sum('grandtotal');
            if($total_takeaway != ""){
                $total_take_away = $total_takeaway;
            }else {
                $total_take_away = '0';
            }


        $total_delivery = Sale::where('date', '=', $today)->where('sales_type', '=', 'Delivery')->where('soft_delete', '!=', 1)->sum('grandtotal');
            if($total_delivery != ""){
                $totaldelivery = $total_delivery;
            }else {
                $totaldelivery = '0';
            }

        return view('page.backend.sales.index', compact('saledinein_data', 'saletakeway_data', 'saledelivery_data',  'session', 'category', 'today', 'todaydate', 'totsaleAmount', 'total_dine_in', 'total_take_away', 'totaldelivery', 'Bank', 'Deliveryboy'));
    }




    public function datefilter(Request $request) {

        $today = $request->get('from_date');

        
        $dineindata = Sale::where('date', '=', $today)->where('sales_type', '=', 'Dine In')->where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();
        $saledinein_data = [];
        $terms = [];
        foreach ($dineindata as $key => $datas) {
            
            if($datas->customer_id != ""){
                $customer = Customer::findOrFail($datas->customer_id);
                $customername = $customer->name;
            }else {
                $customername = '';
            }


            $SaleProducts = SaleProduct::where('sales_id', '=', $datas->id)->get();
            foreach ($SaleProducts as $key => $SaleProducts_arr) {

                $productid = Product::findOrFail($SaleProducts_arr->product_id);
                $terms[] = array(
                    'product_name' => $productid->name,
                    'quantity' => $SaleProducts_arr->quantity,
                    'price' => $SaleProducts_arr->price,
                    'total_price' => $SaleProducts_arr->total_price,
                    'sales_id' => $SaleProducts_arr->sales_id,
                );
            }



            $saledinein_data[] = array(
                'date' => date('d-m-Y', strtotime($datas->date)),
                'bill_no' => $datas->bill_no,
                'time' => $datas->time,
                'sales_type' => $datas->sales_type,
                'customer_type' => $datas->customer_type,
                'customer' => $customername,
                'sub_total' => $datas->sub_total,
                'tax' => $datas->tax,
                'total' => $datas->total,
                'sale_discount' => $datas->sale_discount,
                'grandtotal' => $datas->grandtotal,
                'payment_method' => $datas->payment_method,
                'id' => $datas->id,
                'unique_key' => $datas->unique_key,
                'terms' => $terms,
            );
        }




        $takeawaydata = Sale::where('date', '=', $today)->where('sales_type', '=', 'Take Away')->where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();
        $saletakeway_data = [];
        $terms = [];
        foreach ($takeawaydata as $key => $datas) {
            
            if($datas->customer_id != ""){
                $customer = Customer::findOrFail($datas->customer_id);
                $customername = $customer->name;
            }else {
                $customername = '';
            }


            $SaleProducts = SaleProduct::where('sales_id', '=', $datas->id)->get();
            foreach ($SaleProducts as $key => $SaleProducts_arr) {

                $productid = Product::findOrFail($SaleProducts_arr->product_id);
                $terms[] = array(
                    'product_name' => $productid->name,
                    'quantity' => $SaleProducts_arr->quantity,
                    'price' => $SaleProducts_arr->price,
                    'total_price' => $SaleProducts_arr->total_price,
                    'sales_id' => $SaleProducts_arr->sales_id,
                );
            }



            $saletakeway_data[] = array(
                'date' => date('d-m-Y', strtotime($datas->date)),
                'bill_no' => $datas->bill_no,
                'time' => $datas->time,
                'sales_type' => $datas->sales_type,
                'customer_type' => $datas->customer_type,
                'customer' => $customername,
                'sub_total' => $datas->sub_total,
                'tax' => $datas->tax,
                'total' => $datas->total,
                'sale_discount' => $datas->sale_discount,
                'grandtotal' => $datas->grandtotal,
                'payment_method' => $datas->payment_method,
                'id' => $datas->id,
                'unique_key' => $datas->unique_key,
                'terms' => $terms,
            );
        }





        $deliverydata = Sale::where('date', '=', $today)->where('sales_type', '=', 'Delivery')->where('soft_delete', '!=', 1)->orderBy('id', 'desc')->get();
        $saledelivery_data = [];
        $terms = [];
        foreach ($deliverydata as $key => $datas) {
            
            if($datas->customer_id != ""){
                $customer = Customer::findOrFail($datas->customer_id);
                $customername = $customer->name;
            }else {
                $customername = '';
            }


            $SaleProducts = SaleProduct::where('sales_id', '=', $datas->id)->get();
            foreach ($SaleProducts as $key => $SaleProducts_arr) {

                $productid = Product::findOrFail($SaleProducts_arr->product_id);
                $terms[] = array(
                    'product_name' => $productid->name,
                    'quantity' => $SaleProducts_arr->quantity,
                    'price' => $SaleProducts_arr->price,
                    'total_price' => $SaleProducts_arr->total_price,
                    'sales_id' => $SaleProducts_arr->sales_id,
                );
            }

            if($datas->deliveryboy_id != ""){
                $Delivery_boy = Deliveryboy::findOrFail($datas->deliveryboy_id);
                $Delivery_boyname = $Delivery_boy->name;
            }else {
                $Delivery_boyname = '';
            }



            $saledelivery_data[] = array(
                'date' => date('d-m-Y', strtotime($datas->date)),
                'bill_no' => $datas->bill_no,
                'time' => $datas->time,
                'sales_type' => $datas->sales_type,
                'customer_type' => $datas->customer_type,
                'customer' => $customername,
                'Delivery_boyname' => $Delivery_boyname,
                'sub_total' => $datas->sub_total,
                'tax' => $datas->tax,
                'total' => $datas->total,
                'sale_discount' => $datas->sale_discount,
                'grandtotal' => $datas->grandtotal,
                'payment_method' => $datas->payment_method,
                'id' => $datas->id,
                'unique_key' => $datas->unique_key,
                'terms' => $terms,
            );
        }




            $total_sale_amount = Sale::where('date', '=', $today)->where('soft_delete', '!=', 1)->sum('grandtotal');
            if($total_sale_amount != ""){
                $totsaleAmount = $total_sale_amount;
            }else {
                $totsaleAmount = '0';
            }

            $total_dinein = Sale::where('date', '=', $today)->where('sales_type', '=', 'Dine In')->where('soft_delete', '!=', 1)->sum('grandtotal');
            if($total_dinein != ""){
                $total_dine_in = $total_dinein;
            }else {
                $total_dine_in = '0';
            }


            $total_takeaway = Sale::where('date', '=', $today)->where('sales_type', '=', 'Take Away')->where('soft_delete', '!=', 1)->sum('grandtotal');
            if($total_takeaway != ""){
                $total_take_away = $total_takeaway;
            }else {
                $total_take_away = '0';
            }


            $total_delivery = Sale::where('date', '=', $today)->where('sales_type', '=', 'Delivery')->where('soft_delete', '!=', 1)->sum('grandtotal');
            if($total_delivery != ""){
                $totaldelivery = $total_delivery;
            }else {
                $totaldelivery = '0';
            }

        

        
        $session = Session::where('soft_delete', '!=', 1)->get();
        $category = Category::where('soft_delete', '!=', 1)->get();
        $Bank = Bank::where('soft_delete', '!=', 1)->get();
        $Deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
        $todaydate = Carbon::now()->format('d-m-Y');
        return view('page.backend.sales.index', compact('saledinein_data', 'saletakeway_data', 'saledelivery_data',  'session', 'category', 'today', 'todaydate', 'totsaleAmount', 'total_dine_in', 'total_take_away', 'totaldelivery', 'Bank', 'Deliveryboy'));
    }


    public function create()
    {
        $session = Session::where('soft_delete', '!=', 1)->get();
        $category = Category::where('soft_delete', '!=', 1)->get();
        $product_array = Product::where('soft_delete', '!=', 1)->get();
        $Bank = Bank::where('soft_delete', '!=', 1)->get();
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');
        $customer_rray = Customer::where('soft_delete', '!=', 1)->get();

        $catProductsession = Productsession::select('session_id','category_id','category_name')->distinct('category_id')->where('soft_delete', '!=', 1)->get();
        $cat_Productsession = [];
        foreach ($catProductsession as $key => $catProductsessions) {

            $cat_session = Session::findOrFail($catProductsessions->session_id);
            $cat_order = Category::findOrFail($catProductsessions->category_id);

            $cat_Productsession[] = array(
                'session_id' => $cat_session->id,
                'category_id' => $cat_order->id,
                'category_name' => $cat_order->name
            );
        }

        $Productsession = Productsession::select('category_id','productname','productimage', 'productprice', 'product_id', 'id', 'session_id')->distinct('product_id')->where('session_id', '=', 1)->where('soft_delete', '!=', 1)->get();
        $produc_session_arr = [];
        foreach ($Productsession as $key => $Productsession_arr) {

            $cat_orderid = Category::findOrFail($Productsession_arr->category_id);
            $product_orderid = Product::findOrFail($Productsession_arr->product_id);

            $produc_session_arr[] = array(
                'category_id' => $cat_orderid->id,
                'product_id' => $product_orderid->id,
                'productname' => $product_orderid->name,
                'productimage' => $product_orderid->image,
                'productprice' => $product_orderid->price,
                'id' => $Productsession_arr->id,
                'session_id' => $Productsession_arr->session_id
            );
        }

        $Latest_Sale = Sale::where('soft_delete', '!=', 1)->latest('id')->first();
        if($Latest_Sale != ''){
            $latestbillno = $Latest_Sale->bill_no + 1;
        }else {
            $latestbillno = 1;
        }

        $DineIn = Sale::where('sales_type', '=', 'Dine In')->where('soft_delete', '!=', 1)->latest()->take(10)->get();
        $DineInoutput = [];
        foreach ($DineIn as $key => $DineIn_arr) {

            $DineInoutput[] = array(
                'date' => date('d-m-Y', strtotime($DineIn_arr->date)),
                'bill_no' => $DineIn_arr->bill_no,
                'grandtotal' => $DineIn_arr->grandtotal,
                'unique_key' => $DineIn_arr->unique_key
            );
        }

        $TakeAway = Sale::where('sales_type', '=', 'Take Away')->where('soft_delete', '!=', 1)->latest()->take(10)->get();
        $TakeAwayInoutput = [];
        foreach ($TakeAway as $key => $TakeAway_arr) {

            $TakeAwayInoutput[] = array(
                'date' => date('d-m-Y', strtotime($TakeAway_arr->date)),
                'bill_no' => $TakeAway_arr->bill_no,
                'grandtotal' => $TakeAway_arr->grandtotal,
                'unique_key' => $TakeAway_arr->unique_key
            );
        }



        $Delivery = Sale::where('sales_type', '=', 'Delivery')->where('soft_delete', '!=', 1)->latest()->take(10)->get();
        $DeliveryInoutput = [];
        foreach ($Delivery as $key => $Delivery_arr) {

            $customer = Customer::findOrFail($Delivery_arr->customer_id);

            $DeliveryInoutput[] = array(
                'date' => date('d-m-Y', strtotime($Delivery_arr->date)),
                'bill_no' => $Delivery_arr->bill_no,
                'grandtotal' => $Delivery_arr->grandtotal,
                'customer' => $customer->name,
                'unique_key' => $Delivery_arr->unique_key
            );
        }


        
        return view('page.backend.sales.create', compact('session', 'category', 'product_array', 'today', 'timenow', 'Bank', 'latestbillno', 'customer_rray', 'DineInoutput', 'TakeAwayInoutput', 'DeliveryInoutput', 'cat_Productsession', 'produc_session_arr'));
    }


    public function getselectedproducts()
    {
        $product_id = request()->get('selectproductid');
        $sessionid = request()->get('session_id');
        $output = [];


            $Productsessions = Productsession::where('soft_delete', '!=', 1)->where('product_id', '=', $product_id)->where('session_id', '=', $sessionid)->first();
                $output[] = [
                    "quantity" => 1,
                    'product_id' => $Productsessions->product_id,
                    'product_name' => $Productsessions->productname,
                    'product_price' => $Productsessions->productprice,
                    'product_image' => asset('assets/product/'.$Productsessions->productimage),
                    'Category' => $Productsessions->category_name,
                    'id' => $Productsessions->id,
                ];
            
        
            echo json_encode($output);
    }


    public function getselectedboxproducts()
    {
        $product_sessonid = request()->get('product_sessonid');
        $output = [];


            $Productsessions = Productsession::findOrFail($product_sessonid);
                $output[] = [
                    "quantity" => 1,
                    'product_id' => $Productsessions->product_id,
                    'product_name' => $Productsessions->productname,
                    'product_price' => $Productsessions->productprice,
                    'product_image' => asset('assets/product/'.$Productsessions->productimage),
                    'Category' => $Productsessions->category_name,
                    'id' => $Productsessions->id,
                ];
            
        
            echo json_encode($output);
    }

    public function storeSalesData(Request $request)
    {

       
       

            $grqndtotal = $request->totalamount;
            if($grqndtotal != ""){
                $randomkey = Str::random(5);
    
    
                $Latest_Sale = Sale::where('soft_delete', '!=', 1)->latest('id')->first();
                if($Latest_Sale != ''){
                    $latestbillno = $Latest_Sale->bill_no + 1;
                }else {
                    $latestbillno = 1;
                }
        
                $data = new Sale;
                $data->unique_key = $randomkey;
                $data->bill_no = $latestbillno;
                $data->date = $request->date;
                $data->time = $request->time;
                $data->sales_type = $request->sales_type;
                $data->customer_type = $request->customer_type;
                $data->customer_id = $request->customer_id;
                $data->sub_total = $request->subtotal;
                $data->tax = $request->taxamount;
                $data->total = $request->totalamount;
                $data->sale_discount = $request->sale_discount;
                $data->grandtotal = $request->grandtotal;
                $data->payment_method = $request->paymentmethod;
                $data->deliveryboy_id = $request->deliveryboy_id;
                $data->session_id = $request->session_ids;
                $data->save();
        
        
                $sales_id = $data->id;
                $next_billno = $request->billno + 1;
        
                foreach (($request->product_ids) as $key => $product_id) {
                    $SaleProduct = new SaleProduct;
                    $SaleProduct->sales_id = $sales_id;
                    $SaleProduct->product_id = $product_id;
                    $SaleProduct->quantity = $request->product_quantity[$key];
                    $SaleProduct->price = $request->product_price[$key];
                    $SaleProduct->total_price = $request->total_price[$key];
                    $SaleProduct->product_session_id = $request->product_session_id[$key];
                    $SaleProduct->save();
                }
        
        
                $customerid = $request->customer_id;
                if($customerid != ""){
        
                    
        
                    $saleamountData = Payment::where('customer_id', '=', $customerid)->first();
                    if($saleamountData != ""){
        
                        $old_grossamount = $saleamountData->saleamount;
                        $old_paid = $saleamountData->salepaid;
        
                        $gross_amount = $request->grandtotal;
        
                        $new_grossamount = $old_grossamount + $gross_amount;
                        $new_paid = $old_paid;
                        $new_balance = $new_grossamount - $new_paid;
        
                        DB::table('payments')->where('customer_id', $customerid)->update([
                            'saleamount' => $new_grossamount,  'salepaid' => $new_paid, 'salebalance' => $new_balance
                        ]);
        
                    }else {
                        if($customerid != ""){
                            $gross_amount = $request->grandtotal;
        
                            $Paymentata = new Payment();
            
                            $Paymentata->customer_id = $customerid;
                            $Paymentata->saleamount = $request->grandtotal;
                            $Paymentata->salepaid = 0;
                            $Paymentata->salebalance = $request->grandtotal;
                            $Paymentata->save();
                        }
                        
                    }
                    //dd($customerid);
        
                }
    
                return response()->json(['next_billno' => $next_billno, 'msg' => 'Bill Added', 'last_id' => $sales_id]);
            }else {
                return response()->json(['alert' => 'Please Enter the data']);
            }

      
        
        
        
            
            
        //$SaleData->save();

        //return redirect('form')->with('status', 'Ajax Form Data Has Been validated and store into database');

    }






    public function updateSaleData(Request $request)
    {
            $saleid = $request->saleid;
            $customer_id = $request->customer_id;

            $OldSaleData = Sale::findOrFail($saleid);


            if($customer_id != ""){
                $status = 'delivery';


                $saleamountData = Payment::where('customer_id', '=', $customer_id)->first();
                if($saleamountData != ""){

                    $old_grossamount = $saleamountData->saleamount;
                    $old_paid = $saleamountData->salepaid;
        
                    $oldentry_grossamount = $OldSaleData->grandtotal;
        
                    $gross_amount = $request->grandtotal;



                    $edited_grossamount = $old_grossamount - $oldentry_grossamount;
                    $new_gross_amount = $edited_grossamount + $gross_amount;

                    $new_balance = $new_gross_amount - $old_paid;


                    DB::table('payments')->where('customer_id', $customer_id)->update([
                        'saleamount' => $new_gross_amount,  'salepaid' => $old_paid, 'salebalance' => $new_balance
                    ]);
        
                }

            }else {
                $status = '';
            }


           
            

            
            $OldSaleData->date = $request->date;
            $OldSaleData->time = $request->time;
            $OldSaleData->sales_type = $request->sales_type;
            $OldSaleData->customer_type = $request->customer_type;
            $OldSaleData->customer_id = $request->customer_id;
            $OldSaleData->sub_total = $request->subtotal;
            $OldSaleData->tax = $request->taxamount;
            $OldSaleData->total = $request->totalamount;
            $OldSaleData->sale_discount = $request->sale_discount;
            $OldSaleData->grandtotal = $request->grandtotal;
            $OldSaleData->payment_method = $request->paymentmethod;
            $OldSaleData->deliveryboy_id = $request->deliveryboy_id;
            $OldSaleData->session_id = $request->session_ids;
            $OldSaleData->update(); 
            
            
            $getinsertedP_Products = SaleProduct::where('sales_id', '=', $saleid)->get();
            $Purchaseproducts = array();
            foreach ($getinsertedP_Products as $key => $getinserted_P_Products) {
                $Purchaseproducts[] = $getinserted_P_Products->id;
            }

            $updatedpurchaseproduct_id = $request->saleproductsid;
            $updated_PurchaseProduct_id = array_filter($updatedpurchaseproduct_id);
            $different_ids = array_merge(array_diff($Purchaseproducts, $updated_PurchaseProduct_id), array_diff($updated_PurchaseProduct_id, $Purchaseproducts));

            if (!empty($different_ids)) {
                foreach ($different_ids as $key => $different_id) {
                    SaleProduct::where('id', $different_id)->delete();
                }
            }
            //dd($request->saleproductsid);

            foreach (($request->saleproductsid) as $key => $saleproductsid) {

                if($saleproductsid > 0) {

                    $ids = $saleproductsid;
                    $product_id = $request->product_ids[$key];
                    $product_quantity = $request->product_quantity[$key];
                    $product_price = $request->product_price[$key];
                    $total_price = $request->total_price[$key];
                    $product_session_id = $request->product_session_id[$key];

                    DB::table('sale_products')->where('id', $ids)->update([
                        'sales_id' => $saleid,  'product_id' => $product_id,  'quantity' => $product_quantity,  'price' => $product_price,  'total_price' => $total_price,  'product_session_id' => $product_session_id
                    ]);


                }elseif($saleproductsid == '') {

                    $SaleProduct = new SaleProduct;
                    $SaleProduct->sales_id = $saleid;
                    $SaleProduct->product_id = $request->product_ids[$key];
                    $SaleProduct->quantity = $request->product_quantity[$key];
                    $SaleProduct->price = $request->product_price[$key];
                    $SaleProduct->total_price = $request->total_price[$key];
                    $SaleProduct->product_session_id = $request->product_session_id[$key];
                    $SaleProduct->save();
                }

                
            }


            return response()->json(['next_billno' => $OldSaleData->bill_no, 'msg' => 'Bill Updated', 'last_id' => $saleid, 'status' => $status]);
    }



    public function edit($unique_key)
    {
        $SaleData = Sale::where('unique_key', '=', $unique_key)->first();

        $SaleProducts = SaleProduct::where('sales_id', '=', $SaleData->id)->get();
        $SaleProducts_arrdata = [];

        foreach (($SaleProducts) as $key => $SaleProducts_arr) {

            $product = Product::findOrFail($SaleProducts_arr->product_id);
            $category = Category::findOrFail($product->category_id);

            $SaleProducts_arrdata[] = [
                'sales_id' => $SaleProducts_arr->sales_id,
                'product_id' => $SaleProducts_arr->product_id,
                'quantity' => $SaleProducts_arr->quantity,
                'price' => $SaleProducts_arr->price,
                'total_price' => $SaleProducts_arr->total_price,
                'product' => $product->name,
                'image' => $product->image,
                'category' => $category->name,
                'id' => $SaleProducts_arr->id,
                'product_session_id' => $SaleProducts_arr->product_session_id,
            ];
        }


        

        $session = Session::where('soft_delete', '!=', 1)->get();
        $category = Category::where('soft_delete', '!=', 1)->get();
        $product_array = Product::where('soft_delete', '!=', 1)->get();
        $Bank = Bank::where('soft_delete', '!=', 1)->get();
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');
        $customer_rray = Customer::where('soft_delete', '!=', 1)->get();

        $catProductsession = Productsession::select('session_id','category_id','category_name')->distinct('category_id')->where('soft_delete', '!=', 1)->get();
        $cat_Productsession = [];
        foreach ($catProductsession as $key => $catProductsessions) {

            $cat_session = Session::findOrFail($catProductsessions->session_id);
            $cat_order = Category::findOrFail($catProductsessions->category_id);

            $cat_Productsession[] = array(
                'session_id' => $cat_session->id,
                'category_id' => $cat_order->id,
                'category_name' => $cat_order->name
            );
        }

        $Productsession = Productsession::select('category_id','productname','productimage', 'productprice', 'product_id', 'id', 'session_id')->distinct('product_id')->where('session_id', '=', 1)->where('soft_delete', '!=', 1)->get();
        $produc_session_arr = [];
        foreach ($Productsession as $key => $Productsession_arr) {

            $cat_orderid = Category::findOrFail($Productsession_arr->category_id);
            $product_orderid = Product::findOrFail($Productsession_arr->product_id);

            // $SaleProducts_productsession = SaleProduct::where('product_session_id', '=', $Productsession_arr->id)->where('sales_id', '=', $SaleData->id)->first();
            // if($SaleProducts_productsession != ""){
            //     $prodctsessionid = $SaleProducts_productsession->product_session_id;
            // }else {
            //     $prodctsessionid = '';
            // }

            $produc_session_arr[] = array(
                'category_id' => $cat_orderid->id,
                'product_id' => $product_orderid->id,
                'productname' => $product_orderid->name,
                'productimage' => $product_orderid->image,
                'productprice' => $product_orderid->price,
                'id' => $Productsession_arr->id,
                'session_id' => $Productsession_arr->session_id,
                // 'product_session_id' => $prodctsessionid
                
            );
        }

        
            $latestbillno = $SaleData->bill_no;
       

        $DineIn = Sale::where('sales_type', '=', 'Dine In')->where('soft_delete', '!=', 1)->latest()->take(10)->get();
        $DineInoutput = [];
        foreach ($DineIn as $key => $DineIn_arr) {

            $DineInoutput[] = array(
                'date' => date('d-m-Y', strtotime($DineIn_arr->date)),
                'bill_no' => $DineIn_arr->bill_no,
                'grandtotal' => $DineIn_arr->grandtotal,
                'unique_key' => $DineIn_arr->unique_key
            );
        }

        $TakeAway = Sale::where('sales_type', '=', 'Take Away')->where('soft_delete', '!=', 1)->latest()->take(10)->get();
        $TakeAwayInoutput = [];
        foreach ($TakeAway as $key => $TakeAway_arr) {

            $TakeAwayInoutput[] = array(
                'date' => date('d-m-Y', strtotime($TakeAway_arr->date)),
                'bill_no' => $TakeAway_arr->bill_no,
                'grandtotal' => $TakeAway_arr->grandtotal,
                'unique_key' => $TakeAway_arr->unique_key
            );
        }



        $Delivery = Sale::where('sales_type', '=', 'Delivery')->where('soft_delete', '!=', 1)->latest()->take(10)->get();
        $DeliveryInoutput = [];
        foreach ($Delivery as $key => $Delivery_arr) {

            $customer = Customer::findOrFail($Delivery_arr->customer_id);

            $DeliveryInoutput[] = array(
                'date' => date('d-m-Y', strtotime($Delivery_arr->date)),
                'bill_no' => $Delivery_arr->bill_no,
                'grandtotal' => $Delivery_arr->grandtotal,
                'customer' => $customer->name,
                'unique_key' => $Delivery_arr->unique_key
            );
        }
        return view('page.backend.sales.edit', compact('session', 'category', 'product_array', 'today', 'timenow', 'Bank', 'latestbillno', 'customer_rray', 'DineInoutput', 'TakeAwayInoutput', 'DeliveryInoutput', 'cat_Productsession', 'produc_session_arr', 'SaleData', 'SaleProducts_arrdata'));
    }



    public function delete($unique_key)
    {
        $data = Sale::where('unique_key', '=', $unique_key)->first();

        if($data->customer_id != ""){

            $getinsertedP_Products = SaleProduct::where('sales_id', '=', $data->id)->get();
            $SaleProducts = array();
            foreach ($getinsertedP_Products as $key => $getinserted_P_Products) {
                $SaleProducts[] = $getinserted_P_Products->id;
            }


            if (!empty($SaleProducts)) {
                foreach ($SaleProducts as $key => $SaleProducts_arr) {
                    SaleProduct::where('id', $SaleProducts_arr)->delete();
                }
            }

            $salecustomer_id = $data->customer_id;

            $PaymentsData = Payment::where('customer_id', '=', $salecustomer_id)->first();
            if($PaymentsData != ""){


                $old_grossamount = $PaymentsData->saleamount;
                $old_paid = $PaymentsData->salepaid;

                $oldentry_paid = $data->grandtotal;


                $updated_gross = $old_grossamount - $oldentry_paid;

                $new_balance = $updated_gross - $old_paid;

                DB::table('payments')->where('customer_id', $salecustomer_id)->update([
                    'saleamount' => $updated_gross,  'salepaid' => $old_paid, 'salebalance' => $new_balance
                ]);

            }

            $data->delete();
    
        }else {
            $data->soft_delete = 1;

            $data->update();
        }

        
        

        return redirect()->route('sales.index')->with('warning', 'Deleted !');
    }



    public function deliveryupdate(Request $request, $unique_key)
    {

        $updateSaledata = Sale::where('unique_key', '=', $unique_key)->first();

        $payment_method = $request->get('payment_method');
        $deliveryboy_id = $request->get('deliveryboy_id');

        $updateSaledata->payment_method = $payment_method;
        $updateSaledata->deliveryboy_id = $deliveryboy_id;
        $updateSaledata->update();

        return redirect()->route('sales.index')->with('info', 'Updated !');
    }


    public function getLastId($last_salesid)
    {
        $GetSale = Sale::findOrFail($last_salesid);
        $output = [];
        $SaleProducts = SaleProduct::where('sales_id', '=', $GetSale->id)->get();
        foreach ($SaleProducts as $key => $SaleProducts_arr) {

            $Getproducts = Product::findOrFail($SaleProducts_arr->product_id);

            $output[] = array(
                'payment_method' => $GetSale->payment_method,
                'productname' => $Getproducts->name,
                'quantity' => $SaleProducts_arr->quantity,
                'price' => $SaleProducts_arr->price,
                'total_price' => $SaleProducts_arr->total_price,

            );
        }

        $billno = $GetSale->bill_no;
        $sales_type = $GetSale->sales_type;
        $date = $GetSale->date;
        $total = $GetSale->grandtotal;

        return view('page.backend.sales.print', compact('output', 'billno', 'sales_type', 'date', 'total'));

    }



    
    public function autocomplete(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $product_catid = $request->get('product_catid');
            $data = Product::select ("id", "name", "category_id", "session_id")
                    ->where('name', 'LIKE', "%{$query}%")->where('category_id', '=', $product_catid)->distinct()->get();
            $output = '<ul class="form-control" style="display:block; position:relative;background: #9ddbdb2e;">';
            foreach(($data) as $row)
            {
                $session = session::findOrFail($row->session_id);
                $Category = Category::findOrFail($row->category_id);
                $output .= '<li class="autosearchli"><a class="" style="color:black;background: #f8f9fa;">'.$row->name.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }



    public function GetAutosearchProducts()
    {
        $sessionid = request()->get('sessionid');
        $last_part = request()->get('last_part');
        $productoutput = [];
        //$productids = [];
        //$prdoct_array = [];
        
            $Getproducts = Productsession::where('soft_delete', '!=', 1)->where('session_id', '=', $sessionid)->distinct('product_id')->get();
            foreach ($Getproducts as $key => $Getproducts_arr) {

                // if($last_part != ""){
                //     $saledata = Sale::where('unique_key', '=', $last_part)->first();
                //     $SaleProducts_productsession = SaleProduct::where('product_session_id', '=', $Getproducts_arr->id)->where('sales_id', '=', $saledata->id)->first();
                //     if($SaleProducts_productsession->product_session_id != ""){
                //         $productsession_id = $Getproducts_arr->id;
                //     }else {
                //         $productsession_id = $Getproducts_arr->id;
                //     }
                // }else {
                //     $productsession_id = '';
                // }

                $productoutput[] = [
                    'product_id' => $Getproducts_arr->product_id,
                    'product_name' => $Getproducts_arr->productname,
                    'product_price' => $Getproducts_arr->productprice,
                    'product_image' => asset('assets/product/'.$Getproducts_arr->productimage),
                    'Category' => $Getproducts_arr->category_name,
                    'session_id' => $Getproducts_arr->session_id,
                    'id' => $Getproducts_arr->id,
                ];
            
            }

            
            //$prdoct_array =  array_replace_recursive($productids, $productoutput);
            echo json_encode($productoutput);
    }


    public function getoldbalanceforPayment()
    {

        $customerid = request()->get('customerid');



        $last_idrow = Payment::where('customer_id', '=', $customerid)->first();
        if($last_idrow != ""){

            if($last_idrow->salebalance != NULL){

                $output[] = array(
                    'payment_pending' => $last_idrow->salebalance,
                );
            }else {
                $output[] = array(
                    'payment_pending' => 0,
                );

            }
        }else {
            $output[] = array(
                'payment_pending' => 0,
            );
        }
        echo json_encode($output);
    }


    public function getselectedsessioncat()
    {
        $sessionid = request()->get('sessionid');
        $output = [];

        $GetCatgory = Productsession::where('session_id', '=', $sessionid)->where('soft_delete', '!=', 1)->select('category_id', 'session_id', 'category_name')->distinct()->get();
            foreach ($GetCatgory as $key => $GetCatgorys) {
                if($key == 0){
                    $active = 'active';
                }else {
                    $active = '';
                }
                $output[] = [
                    'category_id' => $GetCatgorys->category_id,
                    'session_id' => $GetCatgorys->session_id,
                    'category_name' => $GetCatgorys->category_name,
                    'active' => $active,
                ];
            }
        
            echo json_encode($output);
    }



    public function getsalelatest()
    {
        $Getsale = Sale::where('soft_delete', '!=', 1)->latest('id')->first();
        $userData['data'] = $Getsale->bill_no;
        echo json_encode($userData);
    }








    public function delivery_index()
    {
        
        $today = Carbon::now()->format('Y-m-d');


        $time = strtotime($today);
        $curent_month = date("F",$time);

        $month = date("m",strtotime($today));
        $year = date("Y",strtotime($today));

        $list=array();
        $monthdates = [];
        for($d=1; $d<=31; $d++)
        {
            $times = mktime(12, 0, 0, $month, $d, $year);
            if (date('m', $times) == $month)
                $list[] = date('d', $times);
                $monthdates[] = date('Y-m-d', $times);
        }
        $Sale_Delivery_Data = [];
        $terms = [];

        foreach (($monthdates) as $key => $monthdate_arr) {

            $customer_arr = Customer::where('soft_delete', '!=', 1)->get();

            foreach ($customer_arr as $key => $customer_array) {

                $sesionarr = Session::where('soft_delete', '!=', 1)->get();
                foreach ($sesionarr as $key => $sesionarry) {

                    $status = '';

                    $SaleDeliverydata = Sale::where('customer_id', '=', $customer_array->id)
                                                            ->where('date', '=', $monthdate_arr)
                                                            ->where('session_id', '=', $sesionarry->id)
                                                            ->where('soft_delete', '!=', 1)
                                                            ->first();

                    if($SaleDeliverydata != ""){
                        $status = 'Yes';
                        $deliverysale_id = $SaleDeliverydata->id;
                        $unique_key = $SaleDeliverydata->unique_key;


                        $bill_no = $SaleDeliverydata->bill_no;
                        $time = $SaleDeliverydata->time;
                        $sales_type = $SaleDeliverydata->sales_type;
                        $customer_type = $SaleDeliverydata->customer_type;
                        $sub_total = $SaleDeliverydata->sub_total;
                        $tax = $SaleDeliverydata->tax;
                        $total = $SaleDeliverydata->total;
                        $sale_discount = $SaleDeliverydata->sale_discount;
                        $grandtotal = $SaleDeliverydata->grandtotal;
                        $payment_method = $SaleDeliverydata->payment_method;
                        $saledate = $SaleDeliverydata->date;


                        $SaleProducts = SaleProduct::where('sales_id', '=', $SaleDeliverydata->id)->get();
                        foreach ($SaleProducts as $key => $SaleProducts_arr) {

                            $productid = Product::findOrFail($SaleProducts_arr->product_id);
                            $terms[] = array(
                                'product_name' => $productid->name,
                                'quantity' => $SaleProducts_arr->quantity,
                                'price' => $SaleProducts_arr->price,
                                'total_price' => $SaleProducts_arr->total_price,
                                'sales_id' => $SaleProducts_arr->sales_id,
                            );
                        }


                    }else {

                        $status = '';
                        $deliverysale_id = '';
                        $unique_key = '';
                        $bill_no = '';
                        $time = '';
                        $sales_type = '';
                        $customer_type = '';
                        $sub_total = '';
                        $tax = '';
                        $total = '';
                        $sale_discount = '';
                        $grandtotal = '';
                        $payment_method = '';
                        $saledate = '';
                        $terms[] = array(
                            'product_name' => '',
                            'quantity' => '',
                            'price' => '',
                            'total_price' => '',
                            'sales_id' => '',
                        );
                    }



                    


                    $Sale_Delivery_Data[] = array(
                        'date' => date("d",strtotime($monthdate_arr)),
                        'bill_no' => $bill_no,
                        'time' => $time,
                        'sales_type' => $sales_type,
                        'customer_type' => $customer_type,
                        'customer' => $customer_array->name,
                        'customer_id' => $customer_array->id,
                        'sub_total' => $sub_total,
                        'tax' => $tax,
                        'total' => $total,
                        'sale_discount' => $sale_discount,
                        'grandtotal' => $grandtotal,
                        'payment_method' => $payment_method,
                        'status' => $status,
                        'deliverysale_id' => $deliverysale_id,
                        'unique_key' => $unique_key,
                        'terms' => $terms,
                        'saledate' => $saledate,
                    );
                }
            }

        }


        $session = Session::where('soft_delete', '!=', 1)->get();
        $session_terms = [];
        foreach ($session as $key => $session_arr) {

            if($session_arr->id == 1){
                $session = 'BF';
            }else if($session_arr->id == 2){
                $session = 'L';
            }else if($session_arr->id == 3){
                $session = 'D';
            }

            $session_terms[] = array(
                'id' => $session_arr->id,
                'session' => $session
            );
        }


        $customer_arrdata = Customer::where('soft_delete', '!=', 1)->get();
        return view('page.backend.deliverysales.delivery_index', compact('Sale_Delivery_Data', 'session_terms', 'customer_arrdata', 'today', 'curent_month', 'year', 'list', 'month'));
    }



    public function delivery_datefilter(Request $request) {

        $today = $request->get('from_date');

        $time = strtotime($today);
        $curent_month = date("F",$time);

        $month = date("m",strtotime($today));
        $year = date("Y",strtotime($today));

        $list=array();
        $monthdates = [];
        for($d=1; $d<=31; $d++)
        {
            $times = mktime(12, 0, 0, $month, $d, $year);
            if (date('m', $times) == $month)
                $list[] = date('d', $times);
                $monthdates[] = date('Y-m-d', $times);
        }
        $Sale_Delivery_Data = [];
        $terms = [];

        foreach (($monthdates) as $key => $monthdate_arr) {

            $customer_arr = Customer::where('soft_delete', '!=', 1)->get();

            foreach ($customer_arr as $key => $customer_array) {

                $sesionarr = Session::where('soft_delete', '!=', 1)->get();
                foreach ($sesionarr as $key => $sesionarry) {

                    $status = '';

                    $SaleDeliverydata = Sale::where('customer_id', '=', $customer_array->id)
                                                            ->where('date', '=', $monthdate_arr)
                                                            ->where('session_id', '=', $sesionarry->id)
                                                            ->where('soft_delete', '!=', 1)
                                                            ->first();

                    if($SaleDeliverydata != ""){
                        $status = 'Yes';
                        $deliverysale_id = $SaleDeliverydata->id;
                        $unique_key = $SaleDeliverydata->unique_key;


                        $bill_no = $SaleDeliverydata->bill_no;
                        $time = $SaleDeliverydata->time;
                        $sales_type = $SaleDeliverydata->sales_type;
                        $customer_type = $SaleDeliverydata->customer_type;
                        $sub_total = $SaleDeliverydata->sub_total;
                        $tax = $SaleDeliverydata->tax;
                        $total = $SaleDeliverydata->total;
                        $sale_discount = $SaleDeliverydata->sale_discount;
                        $grandtotal = $SaleDeliverydata->grandtotal;
                        $payment_method = $SaleDeliverydata->payment_method;
                        $saledate = $SaleDeliverydata->date;


                        $SaleProducts = SaleProduct::where('sales_id', '=', $SaleDeliverydata->id)->get();
                        foreach ($SaleProducts as $key => $SaleProducts_arr) {

                            $productid = Product::findOrFail($SaleProducts_arr->product_id);
                            $terms[] = array(
                                'product_name' => $productid->name,
                                'quantity' => $SaleProducts_arr->quantity,
                                'price' => $SaleProducts_arr->price,
                                'total_price' => $SaleProducts_arr->total_price,
                                'sales_id' => $SaleProducts_arr->sales_id,
                            );
                        }


                    }else {

                        $status = '';
                        $deliverysale_id = '';
                        $unique_key = '';
                        $bill_no = '';
                        $time = '';
                        $sales_type = '';
                        $customer_type = '';
                        $sub_total = '';
                        $tax = '';
                        $total = '';
                        $sale_discount = '';
                        $grandtotal = '';
                        $payment_method = '';
                        $saledate = '';
                        $terms[] = array(
                            'product_name' => '',
                            'quantity' => '',
                            'price' => '',
                            'total_price' => '',
                            'sales_id' => '',
                        );
                    }



                    


                    $Sale_Delivery_Data[] = array(
                        'date' => date("d",strtotime($monthdate_arr)),
                        'bill_no' => $bill_no,
                        'time' => $time,
                        'sales_type' => $sales_type,
                        'customer_type' => $customer_type,
                        'customer' => $customer_array->name,
                        'customer_id' => $customer_array->id,
                        'sub_total' => $sub_total,
                        'tax' => $tax,
                        'total' => $total,
                        'sale_discount' => $sale_discount,
                        'grandtotal' => $grandtotal,
                        'payment_method' => $payment_method,
                        'status' => $status,
                        'deliverysale_id' => $deliverysale_id,
                        'unique_key' => $unique_key,
                        'terms' => $terms,
                        'saledate' => $saledate,
                    );
                }
            }

        }


        $session = Session::where('soft_delete', '!=', 1)->get();
        $session_terms = [];
        foreach ($session as $key => $session_arr) {

            if($session_arr->id == 1){
                $session = 'BF';
            }else if($session_arr->id == 2){
                $session = 'L';
            }else if($session_arr->id == 3){
                $session = 'D';
            }

            $session_terms[] = array(
                'id' => $session_arr->id,
                'session' => $session
            );
        }


        $customer_arrdata = Customer::where('soft_delete', '!=', 1)->get();
        return view('page.backend.deliverysales.delivery_index', compact('Sale_Delivery_Data', 'session_terms', 'customer_arrdata', 'today', 'curent_month', 'year', 'list', 'month'));
    }
        



    public function delivery_create()
    {
        $session = Session::where('soft_delete', '!=', 1)->get();
        $category = Category::where('soft_delete', '!=', 1)->get();
        $product_array = Product::where('soft_delete', '!=', 1)->get();
        $Bank = Bank::where('soft_delete', '!=', 1)->get();
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');
        $customer_rray = Customer::where('soft_delete', '!=', 1)->get();
        $Deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();

        $catProductsession = Productsession::select('session_id','category_id','category_name')->distinct('category_id')->where('soft_delete', '!=', 1)->get();
        $cat_Productsession = [];
        foreach ($catProductsession as $key => $catProductsessions) {

            $cat_session = Session::findOrFail($catProductsessions->session_id);
            $cat_order = Category::findOrFail($catProductsessions->category_id);

            $cat_Productsession[] = array(
                'session_id' => $cat_session->id,
                'category_id' => $cat_order->id,
                'category_name' => $cat_order->name
            );
        }

        $Productsession = Productsession::select('category_id','productname','productimage', 'productprice', 'product_id', 'id', 'session_id')->distinct('product_id')->where('session_id', '=', 1)->where('soft_delete', '!=', 1)->get();
        $produc_session_arr = [];
        foreach ($Productsession as $key => $Productsession_arr) {

            $cat_orderid = Category::findOrFail($Productsession_arr->category_id);
            $product_orderid = Product::findOrFail($Productsession_arr->product_id);

            $produc_session_arr[] = array(
                'category_id' => $cat_orderid->id,
                'product_id' => $product_orderid->id,
                'productname' => $product_orderid->name,
                'productimage' => $product_orderid->image,
                'productprice' => $product_orderid->price,
                'id' => $Productsession_arr->id,
                'session_id' => $Productsession_arr->session_id
            );
        }

        $Latest_Sale = Sale::where('soft_delete', '!=', 1)->latest('id')->first();
        if($Latest_Sale != ''){
            $latestbillno = $Latest_Sale->bill_no + 1;
        }else {
            $latestbillno = 1;
        }

        $DineIn = Sale::where('sales_type', '=', 'Dine In')->where('soft_delete', '!=', 1)->latest()->take(10)->get();
        $DineInoutput = [];
        foreach ($DineIn as $key => $DineIn_arr) {

            $DineInoutput[] = array(
                'date' => date('d-m-Y', strtotime($DineIn_arr->date)),
                'bill_no' => $DineIn_arr->bill_no,
                'grandtotal' => $DineIn_arr->grandtotal,
                'unique_key' => $DineIn_arr->unique_key
            );
        }

        $TakeAway = Sale::where('sales_type', '=', 'Take Away')->where('soft_delete', '!=', 1)->latest()->take(10)->get();
        $TakeAwayInoutput = [];
        foreach ($TakeAway as $key => $TakeAway_arr) {

            $TakeAwayInoutput[] = array(
                'date' => date('d-m-Y', strtotime($TakeAway_arr->date)),
                'bill_no' => $TakeAway_arr->bill_no,
                'grandtotal' => $TakeAway_arr->grandtotal,
                'unique_key' => $TakeAway_arr->unique_key
            );
        }



        $Delivery = Sale::where('sales_type', '=', 'Delivery')->where('soft_delete', '!=', 1)->latest()->take(10)->get();
        $DeliveryInoutput = [];
        foreach ($Delivery as $key => $Delivery_arr) {

            $customer = Customer::findOrFail($Delivery_arr->customer_id);

            $DeliveryInoutput[] = array(
                'date' => date('d-m-Y', strtotime($Delivery_arr->date)),
                'bill_no' => $Delivery_arr->bill_no,
                'grandtotal' => $Delivery_arr->grandtotal,
                'customer' => $customer->name,
                'unique_key' => $Delivery_arr->unique_key
            );
        }


        
        return view('page.backend.deliverysales.delivery_create', compact('session', 'category', 'product_array', 'today', 'timenow', 'Bank', 'latestbillno', 'customer_rray', 'DineInoutput', 'TakeAwayInoutput', 'DeliveryInoutput', 'cat_Productsession', 'produc_session_arr', 'Deliveryboy'));
    }



    public function delivery_edit($unique_key)
    {
        $SaleData = Sale::where('unique_key', '=', $unique_key)->first();

        $SaleProducts = SaleProduct::where('sales_id', '=', $SaleData->id)->get();
        $SaleProducts_arrdata = [];

        foreach (($SaleProducts) as $key => $SaleProducts_arr) {

            $product = Product::findOrFail($SaleProducts_arr->product_id);
            $category = Category::findOrFail($product->category_id);

            $SaleProducts_arrdata[] = [
                'sales_id' => $SaleProducts_arr->sales_id,
                'product_id' => $SaleProducts_arr->product_id,
                'quantity' => $SaleProducts_arr->quantity,
                'price' => $SaleProducts_arr->price,
                'total_price' => $SaleProducts_arr->total_price,
                'product' => $product->name,
                'image' => $product->image,
                'category' => $category->name,
                'id' => $SaleProducts_arr->id,
                'product_session_id' => $SaleProducts_arr->product_session_id,
            ];
        }


        

        $session = Session::where('soft_delete', '!=', 1)->get();
        $category = Category::where('soft_delete', '!=', 1)->get();
        $product_array = Product::where('soft_delete', '!=', 1)->get();
        $Bank = Bank::where('soft_delete', '!=', 1)->get();
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');
        $customer_rray = Customer::where('soft_delete', '!=', 1)->get();
        $Deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();

        $catProductsession = Productsession::select('session_id','category_id','category_name')->distinct('category_id')->where('soft_delete', '!=', 1)->get();
        $cat_Productsession = [];
        foreach ($catProductsession as $key => $catProductsessions) {

            $cat_session = Session::findOrFail($catProductsessions->session_id);
            $cat_order = Category::findOrFail($catProductsessions->category_id);

            $cat_Productsession[] = array(
                'session_id' => $cat_session->id,
                'category_id' => $cat_order->id,
                'category_name' => $cat_order->name
            );
        }

        $Productsession = Productsession::select('category_id','productname','productimage', 'productprice', 'product_id', 'id', 'session_id')->distinct('product_id')->where('session_id', '=', 1)->where('soft_delete', '!=', 1)->get();
        $produc_session_arr = [];
        foreach ($Productsession as $key => $Productsession_arr) {

            $cat_orderid = Category::findOrFail($Productsession_arr->category_id);
            $product_orderid = Product::findOrFail($Productsession_arr->product_id);

            // $SaleProducts_productsession = SaleProduct::where('product_session_id', '=', $Productsession_arr->id)->where('sales_id', '=', $SaleData->id)->first();
            // if($SaleProducts_productsession != ""){
            //     $prodctsessionid = $SaleProducts_productsession->product_session_id;
            // }else {
            //     $prodctsessionid = '';
            // }

            $produc_session_arr[] = array(
                'category_id' => $cat_orderid->id,
                'product_id' => $product_orderid->id,
                'productname' => $product_orderid->name,
                'productimage' => $product_orderid->image,
                'productprice' => $product_orderid->price,
                'id' => $Productsession_arr->id,
                'session_id' => $Productsession_arr->session_id,
                // 'product_session_id' => $prodctsessionid
                
            );
        }

        
            $latestbillno = $SaleData->bill_no;
       

        $DineIn = Sale::where('sales_type', '=', 'Dine In')->where('soft_delete', '!=', 1)->latest()->take(10)->get();
        $DineInoutput = [];
        foreach ($DineIn as $key => $DineIn_arr) {

            $DineInoutput[] = array(
                'date' => date('d-m-Y', strtotime($DineIn_arr->date)),
                'bill_no' => $DineIn_arr->bill_no,
                'grandtotal' => $DineIn_arr->grandtotal,
                'unique_key' => $DineIn_arr->unique_key
            );
        }

        $TakeAway = Sale::where('sales_type', '=', 'Take Away')->where('soft_delete', '!=', 1)->latest()->take(10)->get();
        $TakeAwayInoutput = [];
        foreach ($TakeAway as $key => $TakeAway_arr) {

            $TakeAwayInoutput[] = array(
                'date' => date('d-m-Y', strtotime($TakeAway_arr->date)),
                'bill_no' => $TakeAway_arr->bill_no,
                'grandtotal' => $TakeAway_arr->grandtotal,
                'unique_key' => $TakeAway_arr->unique_key
            );
        }



        $Delivery = Sale::where('sales_type', '=', 'Delivery')->where('soft_delete', '!=', 1)->latest()->take(10)->get();
        $DeliveryInoutput = [];
        foreach ($Delivery as $key => $Delivery_arr) {

            $customer = Customer::findOrFail($Delivery_arr->customer_id);

            $DeliveryInoutput[] = array(
                'date' => date('d-m-Y', strtotime($Delivery_arr->date)),
                'bill_no' => $Delivery_arr->bill_no,
                'grandtotal' => $Delivery_arr->grandtotal,
                'customer' => $customer->name,
                'unique_key' => $Delivery_arr->unique_key
            );
        }
        return view('page.backend.deliverysales.delivery_edit', compact('session', 'category', 'product_array', 'today', 'timenow', 'Bank', 'latestbillno', 'customer_rray', 'DineInoutput', 'TakeAwayInoutput', 'DeliveryInoutput', 'cat_Productsession', 'produc_session_arr', 'SaleData', 'SaleProducts_arrdata', 'Deliveryboy'));
    }


    public function delivery_delete($unique_key)
    {
        $data = Sale::where('unique_key', '=', $unique_key)->first();

        if($data->customer_id != ""){

            $getinsertedP_Products = SaleProduct::where('sales_id', '=', $data->id)->get();
            $SaleProducts = array();
            foreach ($getinsertedP_Products as $key => $getinserted_P_Products) {
                $SaleProducts[] = $getinserted_P_Products->id;
            }


            if (!empty($SaleProducts)) {
                foreach ($SaleProducts as $key => $SaleProducts_arr) {
                    SaleProduct::where('id', $SaleProducts_arr)->delete();
                }
            }

            $salecustomer_id = $data->customer_id;

            $PaymentsData = Payment::where('customer_id', '=', $salecustomer_id)->first();
            if($PaymentsData != ""){


                $old_grossamount = $PaymentsData->saleamount;
                $old_paid = $PaymentsData->salepaid;

                $oldentry_paid = $data->grandtotal;


                $updated_gross = $old_grossamount - $oldentry_paid;

                $new_balance = $updated_gross - $old_paid;

                DB::table('payments')->where('customer_id', $salecustomer_id)->update([
                    'saleamount' => $updated_gross,  'salepaid' => $old_paid, 'salebalance' => $new_balance
                ]);

            }

            $data->delete();
    
        }else {
            $data->soft_delete = 1;

            $data->update();
        }

        
        

        return redirect()->route('deliverysales.delivery_index')->with('warning', 'Deleted !');
    }

    
}
