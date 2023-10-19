<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Outdoor;
use App\Models\Outdoordata;
use App\Models\Outdoorpayment;
use App\Models\Bank;
use App\Models\Outdoorproduct;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use PDF;

class OutdoorController extends Controller
{
    

    public function index()
    {

        $today = Carbon::now()->format('Y-m-d');

        $data = Outdoor::where('booking_date', '=', $today)->where('soft_delete', '!=', 1)->get();

        $outdoor_data = [];
        $terms = [];
        $payments_terms = [];
        foreach ($data as $key => $datas) {
            $bank = Bank::findOrFail($datas->bank_id);


            $Outdoordata = Outdoordata::where('outdoor_id', '=', $datas->id)->get();
            foreach ($Outdoordata as $key => $Outdoordata_arr) {
                $Outdoorproduct = Outdoorproduct::findOrFail($Outdoordata_arr->product);
                $terms[] = array(
                    'product' => $Outdoorproduct->name,
                    'quantity' => $Outdoordata_arr->quantity,
                    'price_per_quantity' => $Outdoordata_arr->price_per_quantity,
                    'price' => $Outdoordata_arr->price,
                    'outdoor_id' => $Outdoordata_arr->outdoor_id,
                );
            }


            $Outdoorpaymentsa = Outdoorpayment::where('outdoor_id', '=', $datas->id)->get();
            foreach ($Outdoorpaymentsa as $key => $Outdoorpaymentsa_arr) {

                $payments_terms[] = array(
                    'payment_term' => $Outdoorpaymentsa_arr->payment_term,
                    'payment_amount' => $Outdoorpaymentsa_arr->payment_amount,
                    'payment_date' => $Outdoorpaymentsa_arr->payment_date,
                    'outdoor_id' => $Outdoorpaymentsa_arr->outdoor_id,
                );
            }


            $outdoor_data[] = array(
                'unique_key' => $datas->unique_key,
                'bill_no' => $datas->bill_no,
                'booking_date' => $datas->booking_date,
                'delivery_date' => $datas->delivery_date,
                'delivery_time' => $datas->delivery_time,
                'name' => $datas->name,
                'address' => $datas->address,
                'phone_number' => $datas->phone_number,
                'note' => $datas->note,
                'sub_total' => $datas->sub_total,
                'outdoortax' => $datas->outdoortax,
                'outdoortax_amount' => $datas->outdoortax_amount,
                'total' => $datas->total,
                'payment_amount' => $datas->payment_amount,
                'balanceamount' => $datas->balanceamount,
                'delivery_status' => $datas->delivery_status,
                'bank_id' => $datas->bank_id,
                'bank' => $bank->name,
                'id' => $datas->id,
                'terms' => $terms,
                'payments_terms' => $payments_terms,
            );

        }

        $currentdate = Carbon::now()->format('Y-m-d');
        $Bank = Bank::where('soft_delete', '!=', 1)->get();
        return view('page.backend.outdoor.index', compact('outdoor_data', 'today', 'currentdate', 'Bank'));
    }


    public function datefilter(Request $request) {
        $today = $request->get('from_date');

        $data = Outdoor::where('booking_date', '=', $today)->where('soft_delete', '!=', 1)->get();

        $outdoor_data = [];
        $terms = [];
        foreach ($data as $key => $datas) {
            $bank = Bank::findOrFail($datas->bank_id);


            $Outdoordata = Outdoordata::where('outdoor_id', '=', $datas->id)->get();
            foreach ($Outdoordata as $key => $Outdoordata_arr) {
                $Outdoorproduct = Outdoorproduct::findOrFail($Outdoordata_arr->product);
                $terms[] = array(
                    'product' => $Outdoorproduct->name,
                    'quantity' => $Outdoordata_arr->quantity,
                    'price_per_quantity' => $Outdoordata_arr->price_per_quantity,
                    'price' => $Outdoordata_arr->price,
                    'outdoor_id' => $Outdoordata_arr->outdoor_id,
                );
            }

            $Outdoorpaymentsa = Outdoorpayment::where('outdoor_id', '=', $datas->id)->get();
            foreach ($Outdoorpaymentsa as $key => $Outdoorpaymentsa_arr) {

                $payments_terms[] = array(
                    'payment_term' => $Outdoorpaymentsa_arr->payment_term,
                    'payment_amount' => $Outdoorpaymentsa_arr->payment_amount,
                    'payment_date' => $Outdoorpaymentsa_arr->payment_date,
                    'outdoor_id' => $Outdoorpaymentsa_arr->outdoor_id,
                );
            }


            $outdoor_data[] = array(
                'unique_key' => $datas->unique_key,
                'bill_no' => $datas->bill_no,
                'booking_date' => $datas->booking_date,
                'delivery_date' => $datas->delivery_date,
                'delivery_time' => $datas->delivery_time,
                'name' => $datas->name,
                'address' => $datas->address,
                'phone_number' => $datas->phone_number,
                'note' => $datas->note,
                'sub_total' => $datas->sub_total,
                'outdoortax' => $datas->outdoortax,
                'outdoortax_amount' => $datas->outdoortax_amount,
                'total' => $datas->total,
                'payment_amount' => $datas->payment_amount,
                'balanceamount' => $datas->balanceamount,
                'delivery_status' => $datas->delivery_status,
                'bank_id' => $datas->bank_id,
                'bank' => $bank->name,
                'id' => $datas->id,
                'terms' => $terms,
                'payments_terms' => $payments_terms,
            );

        }

        $currentdate = Carbon::now()->format('Y-m-d');
        $Bank = Bank::where('soft_delete', '!=', 1)->get();
        return view('page.backend.outdoor.index', compact('outdoor_data', 'today', 'currentdate', 'Bank'));
    }


    public function create()
    {
        $Bank = Bank::where('soft_delete', '!=', 1)->get();
        $outdoorproduct = Outdoorproduct::where('soft_delete', '!=', 1)->get();
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');

        $Latest_Bill = Outdoor::latest('id')->first();
        if($Latest_Bill != ''){
            $billno = $Latest_Bill->bill_no + 1;
        }else {
            $billno = 1;
        }

        return view('page.backend.outdoor.create', compact('today', 'timenow', 'Bank', 'billno', 'outdoorproduct'));
    }


    public function store(Request $request)
    {
        
            $randomkey = Str::random(5);

            $data = new Outdoor();
            $data->unique_key = $randomkey;
            $data->bill_no = $request->get('bill_no');
            $data->booking_date = $request->get('booking_date');
            $data->delivery_date = $request->get('delivery_date');
            $data->delivery_time = $request->get('delivery_time');
            $data->name = $request->get('name');
            $data->address = $request->get('address');
            $data->phone_number = $request->get('phone_number');
            $data->note = $request->get('note');
            $data->sub_total = $request->get('outdoorsub_total');
            $data->outdoortax = $request->get('outdoortax');
            $data->outdoortax_amount = $request->get('outdoortax_amount');
            $data->total = $request->get('outdoor_grandtotal');

            if($request->get('payment_amount') != ""){
                $data->payment_amount = $request->get('payment_amount');
                $balanceamt = $request->get('outdoor_grandtotal') - $request->get('payment_amount');
                $data->balanceamount = $balanceamt;
                if($balanceamt == 0){
                    $data->delivery_status = 1;
                }else {
                    $data->delivery_status = 0;
                }
            }else {
                $data->payment_amount = 0;
                $data->balanceamount = $request->get('outdoor_grandtotal');
                $data->delivery_status = 0;
            }
            
           
            
            $data->bank_id = $request->get('bank_id');
            $data->save();
    
            $insertedId = $data->id;
    
    
            foreach ($request->get('outdoorproduct_id') as $key => $outdoorproduct_id) {
    
                    $Outdoordata = new Outdoordata;
                    $Outdoordata->outdoor_id = $insertedId;
                    $Outdoordata->product = $outdoorproduct_id;
                    $Outdoordata->quantity = $request->outdoorquantity[$key];
                    $Outdoordata->price_per_quantity = $request->outdoorpriceperquantity[$key];
                    $Outdoordata->price = $request->outdoorprice[$key];
                    $Outdoordata->outdoornote = $request->outdoornote[$key];
                    $Outdoordata->save();
    
            }


            $Outdoorpayment = new Outdoorpayment;
            $Outdoorpayment->outdoor_id = $insertedId;
            $Outdoorpayment->payment_term = $request->get('payment_term');
            $Outdoorpayment->payment_amount = $request->get('payment_amount');
            $Outdoorpayment->payment_date = $request->get('booking_date');
            $Outdoorpayment->payment_method = $request->get('bank_id');
            $Outdoorpayment->save();
    
    
            return redirect()->route('outdoor.index')->with('message', 'outdoor Data added successfully!');
    }


    public function edit($unique_key)
    {
        $Outdoor = Outdoor::where('unique_key', '=', $unique_key)->first();
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');
        $Outdoordata = Outdoordata::where('outdoor_id', '=', $Outdoor->id)->get();
        $OutdoorPayments = Outdoorpayment::where('outdoor_id', '=', $Outdoor->id)->get();
        $Bank = Bank::where('soft_delete', '!=', 1)->get();
        $outdoorproduct = Outdoorproduct::where('soft_delete', '!=', 1)->get();

        return view('page.backend.outdoor.edit', compact('Outdoor', 'today', 'timenow', 'Outdoordata', 'Bank', 'OutdoorPayments', 'outdoorproduct'));
    }



    public function update(Request $request, $unique_key)
    {
        $Outdoor = Outdoor::where('unique_key', '=', $unique_key)->first();
       
        
        
        $Outdoor->booking_date = $request->get('booking_date');
        $Outdoor->delivery_date = $request->get('delivery_date');
        $Outdoor->delivery_time = $request->get('delivery_time');
        $Outdoor->name = $request->get('name');
        $Outdoor->address = $request->get('address');
        $Outdoor->phone_number = $request->get('phone_number');
        $Outdoor->note = $request->get('note');
        $Outdoor->sub_total = $request->get('outdoorsub_total');
        $Outdoor->outdoortax = $request->get('outdoortax');
        $Outdoor->outdoortax_amount = $request->get('outdoortax_amount');
        $Outdoor->total = $request->get('outdoor_grandtotal');
        $Outdoor->payment_amount = $request->get('outdoor_totalpaid');


        $outdoor_grandtotal = $request->get('outdoor_grandtotal');
        $payment_amount = $Outdoor->payment_amount;
        $balance = $outdoor_grandtotal - $payment_amount;
        $Outdoor->balanceamount = $balance;
        if($Outdoor->balanceamount == 0){
            $Outdoor->delivery_status = 1;
        }

        $Outdoor->update();

        $Outdoor_id = $Outdoor->id;



        foreach ($request->get('outdoor_payment_id') as $key => $outdoor_payment_id) {

            if ($outdoor_payment_id > 0) {


                $ids = $outdoor_payment_id;
                $payment_term = $request->payment_term[$key];
                $payment_amount = $request->outdooreditpayment_amount[$key];
                $payment_method = $request->bank_id[$key];
                $payment_date = $request->payment_date[$key];

                DB::table('outdoorpayments')->where('id', $ids)->update([
                    'outdoor_id' => $Outdoor_id,  'payment_term' => $payment_term,  'payment_amount' => $payment_amount,  'payment_date' => $payment_date,  'payment_method' => $payment_method
                ]);

            }
        }



        $getinsertedP_Products = Outdoordata::where('outdoor_id', '=', $Outdoor_id)->get();
        $Purchaseproducts = array();
        foreach ($getinsertedP_Products as $key => $getinserted_P_Products) {
            $Purchaseproducts[] = $getinserted_P_Products->id;
        }

        $updatedpurchaseproduct_id = $request->outdoor_detail_id;
        $updated_PurchaseProduct_id = array_filter($updatedpurchaseproduct_id);
        $different_ids = array_merge(array_diff($Purchaseproducts, $updated_PurchaseProduct_id), array_diff($updated_PurchaseProduct_id, $Purchaseproducts));

        if (!empty($different_ids)) {
            foreach ($different_ids as $key => $different_id) {
                Outdoordata::where('id', $different_id)->delete();
            }
        }



        foreach ($request->get('outdoor_detail_id') as $key => $outdoor_detail_id) {

            if ($outdoor_detail_id > 0) {

                $ids = $outdoor_detail_id;
                $Outdoorid = $Outdoor_id;
                $product = $request->outdoorproduct_id[$key];
                $quantity = $request->outdoorquantity[$key];
                $price_per_quantity = $request->outdoorpriceperquantity[$key];
                $price = $request->outdoorprice[$key];
                $outdoornote = $request->outdoornote[$key];

                DB::table('outdoordatas')->where('id', $ids)->update([
                    'outdoor_id' => $Outdoorid,  'product' => $product,  'quantity' => $quantity,  'price_per_quantity' => $price_per_quantity,  'price' => $price,  'outdoornote' => $outdoornote
                ]);

            } else if ($outdoor_detail_id == '') {
                if ($request->product[$key] > 0) {

                    $Outdoordata = new Outdoordata;
                    $Outdoordata->outdoor_id = $Outdoor_id;
                    $Outdoordata->product = $request->outdoorproduct_id[$key];
                    $Outdoordata->quantity = $request->outdoorquantity[$key];
                    $Outdoordata->price_per_quantity = $request->outdoorpriceperquantity[$key];
                    $Outdoordata->price = $request->outdoorprice[$key];
                    $Outdoordata->outdoornote = $request->outdoornote[$key];
                    $Outdoordata->save();
                }
            }

                
        }


        
        

        return redirect()->route('outdoor.index')->with('info', 'Updated !');


    }


    public function delete($unique_key)
    {
        $data = Outdoor::where('unique_key', '=', $unique_key)->first();

        $data->soft_delete = 1;

        $data->update();

        return redirect()->route('outdoor.index')->with('warning', 'Deleted !');
    }


    public function pay_balance(Request $request, $unique_key)
    {

        $Outdoordata = Outdoor::where('unique_key', '=', $unique_key)->first();

        $Outdoorpayment = new Outdoorpayment;
        $Outdoorpayment->outdoor_id = $Outdoordata->id;
        $Outdoorpayment->payment_term = $request->get('payment_term');
        $Outdoorpayment->payment_amount = $request->get('payment_amount');
        $Outdoorpayment->payment_date = $request->get('payment_date');
        $Outdoorpayment->payment_method = $request->get('bank_id');
        $Outdoorpayment->save();

        $payableAmount = $request->get('payment_amount');

        $total_paid_amount = $Outdoordata->payment_amount + $payableAmount;
        $balance = $Outdoordata->total - $total_paid_amount;

        $Outdoordata->payment_amount = $total_paid_amount;
        $Outdoordata->balanceamount = $balance;


        if($Outdoordata->balanceamount == 0){
            $Outdoordata->delivery_status = 1;
        }
        $Outdoordata->update();

        return redirect()->route('outdoor.index')->with('info', 'Updated !');
    }


}
