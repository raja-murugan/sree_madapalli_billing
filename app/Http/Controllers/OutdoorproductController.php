<?php

namespace App\Http\Controllers;
use App\Models\Outdoorproduct;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PDF;


class OutdoorproductController extends Controller
{
    public function index()
    {
        $data = Outdoorproduct::where('soft_delete', '!=', 1)->get();
        return view('page.backend.outdoor_product.index', compact('data'));
    }


    public function store(Request $request)
    {
        $randomkey = Str::random(5);

        $data = new Outdoorproduct();

        $data->unique_key = $randomkey;
        $data->name = $request->get('name');

        $data->save();


        return redirect()->route('outdoor_product.index')->with('message', 'Added !');
    }


    public function edit(Request $request, $unique_key)
    {
        $Outdoorproductdata = Outdoorproduct::where('unique_key', '=', $unique_key)->first();

        $Outdoorproductdata->name = $request->get('name');
        $Outdoorproductdata->update();

        return redirect()->route('outdoor_product.index')->with('info', 'Updated !');
    }



    public function delete($unique_key)
    {
        $data = Outdoorproduct::where('unique_key', '=', $unique_key)->first();

        $data->soft_delete = 1;

        $data->update();

        return redirect()->route('outdoor_product.index')->with('warning', 'Deleted !');
    }

    public function getoutdoorProducts()
    {
        $GetProduct = Outdoorproduct::orderBy('name', 'ASC')->where('soft_delete', '!=', 1)->get();
        $userData['data'] = $GetProduct;
        echo json_encode($userData);
    }
}
