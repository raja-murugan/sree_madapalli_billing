<?php

namespace App\Http\Controllers;

use App\Models\Deliveryarea;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class DeliveryareaController extends Controller
{
    public function index()
    {
        $data = Deliveryarea::where('soft_delete', '!=', 1)->get();

        return view('page.backend.deliveryarea.index', compact('data'));
    }

    public function store(Request $request)
    {
        $randomkey = Str::random(5);

        $data = new Deliveryarea();

        $data->user_key = Auth::user()->name;
        $data->name = $request->get('name');
        $data->note = $request->get('note');
        $data->unique_key = $randomkey;

        $data->save();

        return redirect()->route('delivery.area.index')->with('message', 'Added !');
    }

    public function edit(Request $request, $unique_key)
    {
        $areadata = Deliveryarea::where('unique_key', '=', $unique_key)->first();

        $areadata->name = $request->get('name');
        $areadata->note = $request->get('note');

        $areadata->update();

        return redirect()->route('delivery.area.index')->with('info', 'Updated !');
    }

    public function delete($unique_key)
    {
        $data = Deliveryarea::where('unique_key', '=', $unique_key)->first();

        $data->soft_delete = 1;

        $data->update();

        return redirect()->route('delivery.area.index')->with('warning', 'Deleted !');
    }
}
