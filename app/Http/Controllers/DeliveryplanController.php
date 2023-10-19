<?php

namespace App\Http\Controllers;

use App\Models\Deliveryplan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class DeliveryplanController extends Controller
{
    public function index()
    {
        $data = Deliveryplan::where('soft_delete', '!=', 1)->get();

        return view('page.backend.deliveryplan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $randomkey = Str::random(5);

        $data = new Deliveryplan();

        $data->user_key = Auth::user()->name;
        $data->name = $request->get('name');
        $data->price = $request->get('price');
        $data->note = $request->get('note');
        $data->unique_key = $randomkey;

        $data->save();

        return redirect()->route('delivery.plan.index')->with('message', 'Added !');
    }

    public function edit(Request $request, $unique_key)
    {
        $plandata = Deliveryplan::where('unique_key', '=', $unique_key)->first();

        $plandata->name = $request->get('name');
        $plandata->price = $request->get('price');
        $plandata->note = $request->get('note');

        $plandata->update();

        return redirect()->route('delivery.plan.index')->with('info', 'Updated !');
    }

    public function delete($unique_key)
    {
        $data = Deliveryplan::where('unique_key', '=', $unique_key)->first();

        $data->soft_delete = 1;

        $data->update();

        return redirect()->route('delivery.plan.index')->with('warning', 'Deleted !');
    }
}
