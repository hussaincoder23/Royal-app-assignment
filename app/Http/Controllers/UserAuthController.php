<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserAuthController extends Controller
{
    public function login(){
        // return Http::withHeaders([
        //     'Authorization' => 'Bearer dfda8263d928a9702adff42bb9cb651d0e8922c0ff2134a0ae14295319deb7c4fdb3eee6ed2e4707',
        // ])->get('https://candidate-testing.com/api/v2/authors/279?orderBy=id&direction=ASC&limit=12&page=1');

        // Http::withHeaders([
        //     'Authorization' => 'Bearer dfda8263d928a9702adff42bb9cb651d0e8922c0ff2134a0ae14295319deb7c4fdb3eee6ed2e4707',
        // ])->get('/authors/279?orderBy=id&direction=ASC&limit=12&page=1');

         $api_response = Http::post('https://candidate-testing.com/api/v2/token',request()->only('email','password'));
        //  $api_response['token_key'];

        if($api_response->successful()){
            session(['is_logged_in'=>true,'user'=>$api_response['user'],'token'=>$api_response['token_key']]);
            return redirect('dashboard');
        }

        return redirect()->route('home')->with('error','Enter valid email or password');
    }
}
