<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Openaccount;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use PDF;

class OpenaccountController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $data = Openaccount::where('soft_delete', '!=', 1)->get();
        return view('page.backend.openaccount.index', compact('data', 'today'));
    }


    public function store(Request $request)
    {
        $olddata = Openaccount::where('date', '=', $request->get('date'))->where('soft_delete', '!=', 1)->first();

        if($olddata == ''){

            $randomkey = Str::random(5);

            $data = new Openaccount();
    
            $data->unique_key = $randomkey;
            $data->date = $request->get('date');
            $data->amount = $request->get('amount');
            $data->note = $request->get('note');
    
            $data->save();
    
    
            return redirect()->route('openaccount.index')->with('message', 'Added !');
        }else {
            return redirect()->route('openaccount.index')->with('info', 'Already Existed !');
        }
        
    }


    public function edit(Request $request, $unique_key)
    {
        $OpenaccountData = Openaccount::where('unique_key', '=', $unique_key)->first();

        $OpenaccountData->date = $request->get('date');
        $OpenaccountData->amount = $request->get('amount');
        $OpenaccountData->note = $request->get('note');

        $OpenaccountData->update();

        return redirect()->route('openaccount.index')->with('info', 'Updated !');
    }



    public function delete($unique_key)
    {
        $data = Openaccount::where('unique_key', '=', $unique_key)->first();

        $data->soft_delete = 1;

        $data->update();

        return redirect()->route('openaccount.index')->with('warning', 'Deleted !');
    }


    
}
