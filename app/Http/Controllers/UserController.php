<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function profile(){
        if (session('user')) {
            return view('user.profile',['user'=>session('user')]);
        }
        return redirect()->back()->with('main_error','Some error occured');
    }

    public function logout(){
        session()->forget(['token','user','is_logged_in']);
        
        return redirect()->route('home');
    }
}
