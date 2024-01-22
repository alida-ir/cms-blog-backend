<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{
    public function login()
    {
        return view("login");
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string' ,
            'password' => 'required|string' ,
        ]);
        $user = User::find(1);

        if (auth()->guard('web')->attempt($data)){
//            Session::put("userAdmin" , true);
//            dd(auth()->guard('web')->user());
            return redirect()->route('panel-admin');
        }else{
            return back();
        }
    }

    public function logout()
    {
        Session::forget("userAdmin");
        Session::remove("userAdmin");
        return redirect()->route("login-admin");
    }
}
