<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
  
         $api_response = Http::withHeaders([
            'Authorization' => 'Bearer '.session('token'),
        ])->get('https://candidate-testing.com/api/v2/authors?orderBy=id&direction=ASC&limit=5&page='.request()->input('page',1));

        if($api_response->successful()){
            return view('author.list',[
                'authors'=>$api_response['items'],
                'total_pages'=>$api_response['total_pages'],
                'current_page'=>$api_response['current_page']
            ]);
        }

        return redirect()->back()->with('main_error',"Error occured");

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $api_response =  Http::withHeaders([
            'Authorization' => 'Bearer '.session('token'),
        ])->get('https://candidate-testing.com/api/v2/authors/'.$id);
        
        if($api_response->successful()){
            return view('author.show',['author_details'=>$api_response]);
        }
        return redirect()->back()->with('main_error',"Error occured");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function remove()
    {
        $api_response =  Http::withHeaders([
            'Authorization' => 'Bearer '.session('token'),
        ])->get('https://candidate-testing.com/api/v2/authors/'.request('id'));
        
        if($api_response->successful()){
            if($api_response['books']){
                return back()->with('main_error',"Can't delete author {$api_response['first_name']} because he already has books");
            }else{
                $remove_author_api_response =  Http::withHeaders([
                    'Authorization' => 'Bearer '.session('token'),
                ])->delete('https://candidate-testing.com/api/v2/authors/'.request('id'));
                if($api_response->successful()){
                    return back()->with('main_success',"Author {$api_response['first_name']} deleted successfully");
                }
                return 'some error';
            }
            return redirect()->back()->with('main_error',"Error occured");
        }

    }

     /**
     * Remove the author book.
     */
    public function remove_book()
    {
        $api_response =  Http::withHeaders([
            'Authorization' => 'Bearer '.session('token'),
        ])->delete('https://candidate-testing.com/api/v2/books/'.request('id'));
        
        
        if($api_response->successful()){
            return back()->with('main_success',"Book deleted successfully");
        }
        return back()->with('main_error',"Error occured , book is not deleted");
        

    }
}
