<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Purchase;
use App\Models\PurchaseProductdata;
use App\Models\Supplier;
use App\Models\Purchaseproduct;
use App\Models\Bank;
use App\Models\Payment;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use PDF;

class PurchaseController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $data = Purchase::where('date', '=', $today)->where('soft_delete', '!=', 1)->get();
        $purchase_data = [];
        $terms = [];
        foreach ($data as $key => $datas) {
            $supplier_name = Supplier::findOrFail($datas->supplier_id);


            $PurchaseProducts = PurchaseProductdata::where('purchase_id', '=', $datas->id)->get();
            foreach ($PurchaseProducts as $key => $PurchaseProducts_arrdata) {

                $purchaseproduct_id = Purchaseproduct::findOrFail($PurchaseProducts_arrdata->purchaseproduct_id);
                $terms[] = array(
                    'product_name' => $purchaseproduct_id->name,
                    'quantity' => $PurchaseProducts_arrdata->quantity,
                    'price' => $PurchaseProducts_arrdata->price,
                    'total_price' => $PurchaseProducts_arrdata->total_price,
                    'purchase_id' => $PurchaseProducts_arrdata->purchase_id,

                );
            }


            $payment_method = Bank::findOrFail($datas->payment_method);
            $purchase_data[] = array(
                'unique_key' => $datas->unique_key,
                'bill_no' => $datas->bill_no,
                'voucher_no' => $datas->voucher_no,
                'date' => $datas->date,
                'time' => $datas->time,
                'supplier_id' => $datas->supplier_id,
                'supplier_name' => $supplier_name->name,
                'supplier_phone_number' => $supplier_name->phone_number,
                'supplier_address' => $supplier_name->address,
                'sub_total' => $datas->sub_total,
                'id' => $datas->id,
                'tax' => $datas->tax,
                'tax_amount' => $datas->tax_amount,
                'discount_price' => $datas->discount_price,
                'total' => $datas->total,
                'discount_type' => $datas->discount_type,
                'discount' => $datas->discount,
                'grandtotal' => $datas->grandtotal,
                'paidamount' => $datas->paidamount,
                'balanceamount' => $datas->balanceamount,
                'payment_method' => $payment_method->name,
                'terms' => $terms,
            );

        }


        $Purchaseproduct = Purchaseproduct::where('soft_delete', '!=', 1)->get();
        $Supplier = Supplier::where('soft_delete', '!=', 1)->get();
        $bank = Bank::where('soft_delete', '!=', 1)->get();
        $timenow = Carbon::now()->format('H:i');

        return view('page.backend.purchase.index', compact('purchase_data', 'today', 'timenow', 'Purchaseproduct', 'Supplier', 'bank'));
    }

    public function datefilter(Request $request) {
        $today = $request->get('from_date');

        $data = Purchase::where('date', '=', $today)->where('soft_delete', '!=', 1)->get();
        $purchase_data = [];
        $terms = [];
        foreach ($data as $key => $datas) {
            $supplier_name = Supplier::findOrFail($datas->supplier_id);


            $PurchaseProducts = PurchaseProductdata::where('purchase_id', '=', $datas->id)->get();
            foreach ($PurchaseProducts as $key => $PurchaseProducts_arrdata) {

                $purchaseproduct_id = Purchaseproduct::findOrFail($PurchaseProducts_arrdata->purchaseproduct_id);
                $terms[] = array(
                    'product_name' => $purchaseproduct_id->name,
                    'quantity' => $PurchaseProducts_arrdata->quantity,
                    'price' => $PurchaseProducts_arrdata->price,
                    'total_price' => $PurchaseProducts_arrdata->total_price,
                    'purchase_id' => $PurchaseProducts_arrdata->purchase_id,

                );
            }


            $payment_method = Bank::findOrFail($datas->payment_method);
            $purchase_data[] = array(
                'unique_key' => $datas->unique_key,
                'bill_no' => $datas->bill_no,
                'voucher_no' => $datas->voucher_no,
                'date' => $datas->date,
                'time' => $datas->time,
                'supplier_id' => $datas->supplier_id,
                'supplier_name' => $supplier_name->name,
                'supplier_phone_number' => $supplier_name->phone_number,
                'supplier_address' => $supplier_name->address,
                'sub_total' => $datas->sub_total,
                'id' => $datas->id,
                'tax' => $datas->tax,
                'tax_amount' => $datas->tax_amount,
                'discount_price' => $datas->discount_price,
                'total' => $datas->total,
                'discount_type' => $datas->discount_type,
                'discount' => $datas->discount,
                'grandtotal' => $datas->grandtotal,
                'paidamount' => $datas->paidamount,
                'balanceamount' => $datas->balanceamount,
                'payment_method' => $payment_method->name,
                'terms' => $terms,
            );

        }


        $Purchaseproduct = Purchaseproduct::where('soft_delete', '!=', 1)->get();
        $Supplier = Supplier::where('soft_delete', '!=', 1)->get();
        $bank = Bank::where('soft_delete', '!=', 1)->get();
        $timenow = Carbon::now()->format('H:i');

        return view('page.backend.purchase.index', compact('purchase_data', 'today', 'timenow', 'Purchaseproduct', 'Supplier', 'bank'));
    }



    public function create()
    {
        $purchaseproduct = Purchaseproduct::where('soft_delete', '!=', 1)->get();
        $Supplier = Supplier::where('soft_delete', '!=', 1)->get();
        $bank = Bank::where('soft_delete', '!=', 1)->get();
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');

        $Latest_Bill = Purchase::latest('id')->first();
        if($Latest_Bill != ''){
            $billno = $Latest_Bill->bill_no + 1;
        }else {
            $billno = 1;
        }

        return view('page.backend.purchase.create', compact('purchaseproduct', 'Supplier', 'bank', 'today', 'timenow', 'billno'));
    }


    public function store(Request $request)
    {
        $randomkey = Str::random(5);



        $bill_date = $request->get('date');
        $s_bill_no = 1;

        $billreport_date = date('dmY', strtotime($bill_date));

        $lastreport = Purchase::where('date', '=', $bill_date)->latest('id')->first();
            if($lastreport != '')
            {
                $added_billno = substr ($lastreport->bill_no, -2);
                $billno = $billreport_date . 'P0' . ($added_billno) + 1;
            } else {
                $billno = $billreport_date . 'P0' . $s_bill_no;
            }




        $data = new Purchase();
        $data->unique_key = $randomkey;
        $data->bill_no = $request->get('bill_no');
        $data->voucher_no = $request->get('voucher_no');
        $data->date = $request->get('date');
        $data->time = $request->get('time');
        $data->supplier_id = $request->get('supplier_id');
        $data->sub_total = $request->get('sub_total');
        $data->tax = $request->get('tax');
        $data->total = $request->get('total');
        $data->tax_amount = $request->get('tax_amount');
        $data->discount_price = $request->get('discount_price');
        $data->discount_type = $request->get('discount_type');
        $data->discount = $request->get('discount');
        $data->grandtotal = $request->get('purchase_grandtotal');
        $data->paidamount = $request->get('paidamount');
        $data->balanceamount = $request->get('balanceamount');
        $data->payment_method = $request->get('payment_method');
        $data->save();

        $insertedId = $data->id;
        $supplierid = $data->supplier_id;


        foreach ($request->get('purchaseproduct_id') as $key => $purchaseproduct_id) {
            $pprandomkey = Str::random(5);

                $PurchaseProductdata = new PurchaseProductdata;
                $PurchaseProductdata->unique_key = $pprandomkey;
                $PurchaseProductdata->purchase_id = $insertedId;
                $PurchaseProductdata->purchaseproduct_id = $purchaseproduct_id;
                $PurchaseProductdata->quantity = $request->purchase_quantity[$key];
                $PurchaseProductdata->price = $request->purchase_price[$key];
                $PurchaseProductdata->total_price = $request->total_price[$key];
                $PurchaseProductdata->save();

        }

        $PurchseData = Payment::where('supplier_id', '=', $supplierid)->first();
        if($PurchseData != ""){

            $old_grossamount = $PurchseData->purchase_amount;
            $old_paid = $PurchseData->purchase_paid;

            $gross_amount = $request->get('purchase_grandtotal');
            $payable_amount = $request->get('paidamount');

            $new_grossamount = $old_grossamount + $gross_amount;
            $new_paid = $old_paid + $payable_amount;
            $new_balance = $new_grossamount - $new_paid;

            DB::table('payments')->where('supplier_id', $supplierid)->update([
                'purchase_amount' => $new_grossamount,  'purchase_paid' => $new_paid, 'purchase_balance' => $new_balance
            ]);

        }else {
            $gross_amount = $request->get('purchase_grandtotal');
            $payable_amount = $request->get('paidamount');
            $balance_amount = $gross_amount - $payable_amount;

            $data = new Payment();

            $data->supplier_id = $supplierid;
            $data->purchase_amount = $request->get('purchase_grandtotal');
            $data->purchase_paid = $request->get('paidamount');
            $data->purchase_balance = $balance_amount;
            $data->save();
        }


        return redirect()->route('purchase.index')->with('message', 'Purchase Data added successfully!');
    }



    public function edit($unique_key)
    {
        $PurchaseData = Purchase::where('unique_key', '=', $unique_key)->first();
        $purchaseproduct = Purchaseproduct::orderBy('name', 'ASC')->where('soft_delete', '!=', 1)->get();
        $Supplier = Supplier::where('soft_delete', '!=', 1)->get();
        $bank = Bank::where('soft_delete', '!=', 1)->get();
        $PurchaseProductdata = PurchaseProductdata::where('purchase_id', '=', $PurchaseData->id)->get();

        return view('page.backend.purchase.edit', compact('PurchaseData', 'purchaseproduct', 'Supplier', 'bank', 'PurchaseProductdata'));
    }


    public function update(Request $request, $unique_key)
    {
        $Purchase_Data = Purchase::where('unique_key', '=', $unique_key)->first();

        $purchase_supplier_id = $request->get('supplier_id');


        $PurchasebranchwiseData = Payment::where('supplier_id', '=', $purchase_supplier_id)->first();
        if($PurchasebranchwiseData != ""){


            $old_grossamount = $PurchasebranchwiseData->purchase_amount;
            $old_paid = $PurchasebranchwiseData->purchase_paid;

            $oldentry_grossamount = $Purchase_Data->grandtotal;
            $oldentry_paid = $Purchase_Data->paidamount;

            $gross_amount = $request->get('purchase_grandtotal');
            $payable_amount = $request->get('paidamount');



            if($oldentry_grossamount > $gross_amount){
                $newgross = $oldentry_grossamount - $gross_amount;
                $updated_gross = $old_grossamount - $newgross;
            }else if($oldentry_grossamount < $gross_amount){
                $newgross = $gross_amount - $oldentry_grossamount;
                $updated_gross = $old_grossamount + $newgross;
            }else if($oldentry_grossamount == $gross_amount){
                $updated_gross = $old_grossamount;
            }


            if($oldentry_paid > $payable_amount){
                $newPaidAmt = $oldentry_paid - $payable_amount;
                $updated_paid = $old_paid - $newPaidAmt;
            }else if($oldentry_paid < $payable_amount){
                $newPaidAmt = $payable_amount - $oldentry_paid;
                $updated_paid = $old_paid + $newPaidAmt;
            }else if($oldentry_paid == $payable_amount){
                $updated_paid = $old_paid;
            }

            $new_balance = $updated_gross - $updated_paid;

            DB::table('payments')->where('supplier_id', $purchase_supplier_id)->update([
                'purchase_amount' => $updated_gross,  'purchase_paid' => $updated_paid, 'purchase_balance' => $new_balance
            ]);

        }


        
        $Purchase_Data->voucher_no = $request->get('voucher_no');
        $Purchase_Data->date = $request->get('date');
        $Purchase_Data->time = $request->get('time');
        $Purchase_Data->supplier_id = $request->get('supplier_id');
        $Purchase_Data->sub_total = $request->get('sub_total');
        $Purchase_Data->tax = $request->get('tax');
        $Purchase_Data->total = $request->get('total');
        $Purchase_Data->tax_amount = $request->get('tax_amount');
        $Purchase_Data->discount_price = $request->get('discount_price');
        $Purchase_Data->discount_type = $request->get('discount_type');
        $Purchase_Data->discount = $request->get('discount');
        $Purchase_Data->grandtotal = $request->get('purchase_grandtotal');
        $Purchase_Data->paidamount = $request->get('paidamount');
        $Purchase_Data->balanceamount = $request->get('balanceamount');
        $Purchase_Data->payment_method = $request->get('payment_method');
        $Purchase_Data->update();

        $PurchaseId = $Purchase_Data->id;


        $getinsertedP_Products = PurchaseProductdata::where('purchase_id', '=', $PurchaseId)->get();
        $Purchaseproducts = array();
        foreach ($getinsertedP_Products as $key => $getinserted_P_Products) {
            $Purchaseproducts[] = $getinserted_P_Products->id;
        }

        $updatedpurchaseproduct_id = $request->purchase_detail_id;
        $updated_PurchaseProduct_id = array_filter($updatedpurchaseproduct_id);
        $different_ids = array_merge(array_diff($Purchaseproducts, $updated_PurchaseProduct_id), array_diff($updated_PurchaseProduct_id, $Purchaseproducts));

        if (!empty($different_ids)) {
            foreach ($different_ids as $key => $different_id) {
                PurchaseProductdata::where('id', $different_id)->delete();
            }
        }


        foreach ($request->get('purchase_detail_id') as $key => $purchase_detail_id) {
            if ($purchase_detail_id > 0) {

                $ids = $purchase_detail_id;
                $purchaseID = $PurchaseId;
                $purchaseproduct_id = $request->purchaseproduct_id[$key];
                $quantity = $request->purchase_quantity[$key];
                $price = $request->purchase_price[$key];
                $total_price = $request->total_price[$key];

                DB::table('purchase_productdatas')->where('id', $ids)->update([
                    'purchase_id' => $purchaseID,  'purchaseproduct_id' => $purchaseproduct_id,  'quantity' => $quantity,  'price' => $price,  'total_price' => $total_price
                ]);

            } else if ($purchase_detail_id == '') {
                if ($request->purchaseproduct_id[$key] > 0) {

                    $prandomkey = Str::random(5);

                    $PurchaseProductdata = new PurchaseProductdata;
                    $PurchaseProductdata->unique_key = $prandomkey;
                    $PurchaseProductdata->purchase_id = $purchaseID;
                    $PurchaseProductdata->purchaseproduct_id = $request->purchaseproduct_id[$key];
                    $PurchaseProductdata->quantity = $request->purchase_quantity[$key];
                    $PurchaseProductdata->price = $request->purchase_price[$key];
                    $PurchaseProductdata->total_price = $request->total_price[$key];
                    $PurchaseProductdata->save();
                }
            }
        }


        return redirect()->route('purchase.index')->with('info', 'Updated !');


    }


    public function delete($unique_key)
    {
        $data = Purchase::where('unique_key', '=', $unique_key)->first();


        $getinsertedP_Products = PurchaseProductdata::where('purchase_id', '=', $data->id)->get();
        $Purchaseproducts = array();
        foreach ($getinsertedP_Products as $key => $getinserted_P_Products) {
            $Purchaseproducts[] = $getinserted_P_Products->id;
        }

        if (!empty($Purchaseproducts)) {
            foreach ($Purchaseproducts as $key => $Purchaseproducts_arr) {
                PurchaseProductdata::where('id', $Purchaseproducts_arr)->delete();
            }
        }


        $purchase_supplier_id = $data->supplier_id;


        $PurchasebranchwiseData = Payment::where('supplier_id', '=', $purchase_supplier_id)->first();
        if($PurchasebranchwiseData != ""){


            $old_grossamount = $PurchasebranchwiseData->purchase_amount;
            $old_paid = $PurchasebranchwiseData->purchase_paid;

            $oldentry_grossamount = $data->grandtotal;
            $oldentry_paid = $data->paidamount;

         
                $updated_gross = $old_grossamount - $oldentry_grossamount;
                $updated_paid = $old_paid - $oldentry_paid;

                $new_balance = $updated_gross - $updated_paid;

            DB::table('payments')->where('supplier_id', $purchase_supplier_id)->update([
                'purchase_amount' => $updated_gross,  'purchase_paid' => $updated_paid, 'purchase_balance' => $new_balance
            ]);

        }



        $data->delete();

        return redirect()->route('purchase.index')->with('warning', 'Deleted !');
    }


    public function getProducts()
    {
        $GetProduct = Purchaseproduct::orderBy('name', 'ASC')->where('soft_delete', '!=', 1)->get();
        $userData['data'] = $GetProduct;
        echo json_encode($userData);
    }


    public function getbalanceforpurchasePayment()
    {

        $supplierid = request()->get('supplierid');



        $last_idrow = Payment::where('supplier_id', '=', $supplierid)->first();
        if($last_idrow != ""){

            if($last_idrow->purchase_balance != NULL){

                $output[] = array(
                    'payment_pending' => $last_idrow->purchase_balance,
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
}
