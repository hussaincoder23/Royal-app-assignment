<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserAuthController extends Controller
{
    public function login(){

         $api_response = Http::post('https://candidate-testing.com/api/v2/token',request()->only('email','password'));

        if($api_response->successful()){
            session(['is_logged_in'=>true,'user'=>$api_response['user'],'token'=>$api_response['token_key']]);
            return redirect('dashboard');
        }

        return redirect()->route('home')->with('error','Enter valid email or password');
    }
}
