<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Payment;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PDF;

class CustomerController extends Controller
{
    public function index()
    {
        $data = Customer::where('soft_delete', '!=', 1)->get();

        $customerdata = [];
        foreach ($data as $key => $datas) {

            $PaymentsData = Payment::where('customer_id', '=', $datas->id)->first();
            if($PaymentsData != ""){
                if($PaymentsData->salepaid > $PaymentsData->saleamount){
                    $account_balance = $PaymentsData->salepaid - $PaymentsData->saleamount;
                    $pending_amount = '';
                }else if($PaymentsData->saleamount > $PaymentsData->salepaid){
                    $pending_amount = $PaymentsData->saleamount - $PaymentsData->salepaid;
                    $account_balance = '';
                }
            }else {
                $pending_amount = '';
                $account_balance = '';
            }

            $customerdata[] = array(
                'id' => $datas->id,
                'unique_key' => $datas->unique_key,
                'name' => $datas->name,
                'phone_number' => $datas->phone_number,
                'address' => $datas->address,
                'account_balance' => $account_balance,
                'pending_amount' => $pending_amount,
            );
        }

        return view('page.backend.customer.index', compact('customerdata'));
    }


    public function store(Request $request)
    {
        $randomkey = Str::random(5);

        $data = new Customer();

        $data->unique_key = $randomkey;
        $data->name = $request->get('name');
        $data->phone_number = $request->get('phone_number');
        $data->address = $request->get('address');
        $data->old_balance = $request->get('old_balance');

        $data->save();


        if($request->get('old_balance') != ""){
            
            $customerid = $data->id;
            $PaymentBalanceDAta = Payment::where('customer_id', '=', $customerid)->first();
            if($PaymentBalanceDAta == ""){
                $balance_amount = $request->get('old_balance');
                $paymentbalacedata = new Payment();
    
                $paymentbalacedata->customer_id = $customerid;
                $paymentbalacedata->saleamount = $balance_amount;
                $paymentbalacedata->salepaid = 0;
                $paymentbalacedata->salebalance = $balance_amount;
                $paymentbalacedata->save();
            }
        }



        return redirect()->route('customer.index')->with('message', 'Added !');
    }


    public function edit(Request $request, $unique_key)
    {
        $CustomerData = Customer::where('unique_key', '=', $unique_key)->first();

        $CustomerData->name = $request->get('name');
        $CustomerData->phone_number = $request->get('phone_number');
        $CustomerData->address = $request->get('address');

        $CustomerData->update();

        return redirect()->route('customer.index')->with('info', 'Updated !');
    }



    public function delete($unique_key)
    {
        $data = Customer::where('unique_key', '=', $unique_key)->first();

        $data->soft_delete = 1;

        $data->update();

        return redirect()->route('customer.index')->with('warning', 'Deleted !');
    }


    public function checkduplicate(Request $request)
    {
        if(request()->get('query'))
        {
            $query = request()->get('query');
            $customerData = Customer::where('phone_number', '=', $query)->first();
            
            $userData['data'] = $customerData;
            echo json_encode($userData);
        }
    }
}
