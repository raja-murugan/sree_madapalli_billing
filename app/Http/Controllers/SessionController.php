<?php

namespace App\Http\Controllers;
use App\Models\Session;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PDF;

class SessionController extends Controller
{
    public function index()
    {
        $data = Session::where('soft_delete', '!=', 1)->get();
        return view('page.backend.session.index', compact('data'));
    }


    public function store(Request $request)
    {
        $randomkey = Str::random(5);

        $data = new Session();

        $data->unique_key = $randomkey;
        $data->name = $request->get('name');

        $data->save();


        return redirect()->route('session.index')->with('message', 'Added !');
    }


    public function edit(Request $request, $unique_key)
    {
        $SessionData = Session::where('unique_key', '=', $unique_key)->first();

        $SessionData->name = $request->get('name');
        $SessionData->update();

        return redirect()->route('session.index')->with('info', 'Updated !');
    }



    public function delete($unique_key)
    {
        $data = Session::where('unique_key', '=', $unique_key)->first();

        $data->soft_delete = 1;

        $data->update();

        return redirect()->route('session.index')->with('warning', 'Deleted !');
    }


  
}
