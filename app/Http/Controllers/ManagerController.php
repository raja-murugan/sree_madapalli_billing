<?php

namespace App\Http\Controllers;

use App\Mail\ManagerMail;
use App\Models\Manager;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function index()
    {
        $data = Manager::all();
        $role = Role::all();

        return view('page.backend.manager.index', compact('data', 'role'));
    }

    public function store(Request $request)
    {
        do
        {
            $token = Str::random();
        }
        while (Manager::where('token', $token)->first());

        $randompasswordValue = Str::random(8, 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()');

        $randomkey = Str::random(5);

        $data = new Manager();

        $data->user_key = Auth::user()->name;
        $data->role_id = $request->get('role_id');
        $data->name = $request->get('name');
        $data->contact_number = $request->get('contact_number');
        $data->email = $request->get('email');
        $data->password = $randompasswordValue;
        $data->token = $token;
        $data->unique_key = $randomkey;

        $data->save();

        Mail::to($request->get('email'))->send(new ManagerMail($data));

        return redirect()->route('manager.invite.index')->with('add', 'Successful invite mail send to user !');
    }

    public function accept($token)
    {
        if (!$invite = Manager::where('token', $token)->first())
        {
            abort(404);
        }

        $user = new User();

        $user->email = $invite->email;
        $user->name = $invite->name;
        $user->password = $invite->password;

        $user->save();

        Manager::where('email', $invite->email)
            ->where('token', $token)
            ->update(['invite_accepted_at' => Carbon::now()]);

        $role = Role::find($invite->role_id);

        $user->assignRole($role->name);

        return redirect('login');
    }
}
