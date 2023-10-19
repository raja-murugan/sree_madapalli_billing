<?php

namespace App\Http\Controllers;
use App\Models\Purchaseproduct;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use PDF;

class PurchaseproductController extends Controller
{
    public function index()
    {
        $data = Purchaseproduct::where('soft_delete', '!=', 1)->get();
        return view('page.backend.purchase_product.index', compact('data'));
    }


    public function store(Request $request)
    {
        $randomkey = Str::random(5);

        $data = new Purchaseproduct();

        $data->unique_key = $randomkey;
        $data->name = $request->get('name');
        $data->note = $request->get('note');

        $data->save();


        return redirect()->route('purchase_product.index')->with('message', 'Added !');
    }


    public function edit(Request $request, $unique_key)
    {
        $PurchaseproductData = Purchaseproduct::where('unique_key', '=', $unique_key)->first();

        $PurchaseproductData->name = $request->get('name');
        $PurchaseproductData->note = $request->get('note');

        $PurchaseproductData->update();

        return redirect()->route('purchase_product.index')->with('info', 'Updated !');
    }



    public function delete($unique_key)
    {
        $data = Purchaseproduct::where('unique_key', '=', $unique_key)->first();

        $data->soft_delete = 1;

        $data->update();

        return redirect()->route('purchase_product.index')->with('warning', 'Deleted !');
    }


    public function checkduplicate(Request $request)
    {
        if(request()->get('query'))
        {
            $query = request()->get('query');
            $PurchaseproductData = Purchaseproduct::where('name', '=', $query)->first();
            
            $userData['data'] = $PurchaseproductData;
            echo json_encode($userData);
        }
    }
}
