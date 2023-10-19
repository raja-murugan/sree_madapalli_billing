<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Denomination;
use App\Models\Determinationdata;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use PDF;

class DenominationController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');
        $data = Denomination::where('soft_delete', '!=', 1)->orderBy('id', 'DESC')->get();
        $determination_Data = [];
        $terms = [];
        foreach ($data as $key => $datas) {


            $Determinationdatas = Determinationdata::where('determination_id', '=', $datas->id)->get();
            foreach ($Determinationdatas as $key => $Determinationdatas_arr) {
                
                $terms[] = array(
                    'rupee' => $Determinationdatas_arr->rupee,
                    'count' => $Determinationdatas_arr->count,
                    'amount' => $Determinationdatas_arr->amount,
                    'determination_id' => $Determinationdatas_arr->determination_id,
                    'id' => $Determinationdatas_arr->id,
                );
            }

            $determination_Data[] = array(
                'id' => $datas->id,
                'unique_key' => $datas->unique_key,
                'date' => $datas->date,
                'time' => $datas->time,
                'total_amount' => $datas->total_amount,
                'terms' => $terms,
            );
        }
        return view('page.backend.dinomination.index', compact('determination_Data', 'today', 'timenow'));
    }


    public function store(Request $request)
    {
       

            $randomkey = Str::random(5);

            $data = new Denomination();
    
            $data->unique_key = $randomkey;
            $data->date = $request->get('date');
            $data->time = $request->get('time');
            $data->total_amount = $request->get('total_amount');
    
            $data->save();

            $insertedId = $data->id;


            foreach ($request->get('count') as $key => $count) {
    
                    $Determinationdata = new Determinationdata;
                    $Determinationdata->determination_id = $insertedId;
                    $Determinationdata->rupee = $request->rupee[$key];
                    $Determinationdata->count = $count;
                    $Determinationdata->amount = $request->amount[$key];
                    $Determinationdata->save();
    
            }
    
    
            return redirect()->route('dinomination.index')->with('message', 'Added !');

        
    }


    public function edit(Request $request, $unique_key)
    {
        $Denominationdarta = Denomination::where('unique_key', '=', $unique_key)->first();

        $Denominationdarta->date = $request->get('date');
        $Denominationdarta->time = $request->get('time');
        $Denominationdarta->total_amount = $request->get('total_amount');

        $Denominationdarta->update();

        $determinationid = $Denominationdarta->id;


        foreach ($request->get('rupee') as $key => $rupee) {
                
            $determination_id = $determinationid;
            $count = $request->count[$key];
            $amount = $request->amount[$key];

            DB::table('determinationdatas')->where('determination_id', $determination_id)->where('rupee', $rupee)->update([
                'count' => $count, 'amount' => $amount
            ]);
        }


        return redirect()->route('dinomination.index')->with('info', 'Updated !');
    }



    public function delete($unique_key)
    {
        $data = Denomination::where('unique_key', '=', $unique_key)->first();

        $data->soft_delete = 1;

        $data->update();

        return redirect()->route('dinomination.index')->with('warning', 'Deleted !');
    }

}
