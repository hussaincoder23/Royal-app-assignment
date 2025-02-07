<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function profile(){
        // return Http::withHeaders([
        //     'Authorization' => 'Bearer dfda8263d928a9702adff42bb9cb651d0e8922c0ff2134a0ae14295319deb7c4fdb3eee6ed2e4707',
        // ])->get('https://candidate-testing.com/api/v2/authors/279?orderBy=id&direction=ASC&limit=12&page=1');

        // Http::withHeaders([
        //     'Authorization' => 'Bearer dfda8263d928a9702adff42bb9cb651d0e8922c0ff2134a0ae14295319deb7c4fdb3eee6ed2e4707',
        // ])->get('/authors/279?orderBy=id&direction=ASC&limit=12&page=1');

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
