<?php

namespace App\Http\Controllers;
use App\Models\Employee;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PDF;

class EmployeeController extends Controller
{
    public function index()
    {
        $data = Employee::where('soft_delete', '!=', 1)->get();
        return view('page.backend.employee.index', compact('data'));
    }


    public function store(Request $request)
    {
        $randomkey = Str::random(5);

        $data = new Employee();

        $data->unique_key = $randomkey;
        $data->name = $request->get('name');
        $data->phone_number = $request->get('phone_number');
        $data->address = $request->get('address');
        $data->perdaysalary = $request->get('perdaysalary');

        $data->save();


        return redirect()->route('employee.index')->with('message', 'Added !');
    }


    public function edit(Request $request, $unique_key)
    {
        $EmployeeData = Employee::where('unique_key', '=', $unique_key)->first();

        $EmployeeData->name = $request->get('name');
        $EmployeeData->phone_number = $request->get('phone_number');
        $EmployeeData->address = $request->get('address');
        $EmployeeData->perdaysalary = $request->get('perdaysalary');

        $EmployeeData->update();

        return redirect()->route('employee.index')->with('info', 'Updated !');
    }



    public function delete($unique_key)
    {
        $data = Employee::where('unique_key', '=', $unique_key)->first();

        $data->soft_delete = 1;

        $data->update();

        return redirect()->route('employee.index')->with('warning', 'Deleted !');
    }


    public function checkduplicate(Request $request)
    {
        if(request()->get('query'))
        {
            $query = request()->get('query');
            $EmployeeData = Employee::where('phone_number', '=', $query)->first();
            
            $userData['data'] = $EmployeeData;
            echo json_encode($userData);
        }
    }
}
