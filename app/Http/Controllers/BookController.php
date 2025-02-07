<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BookController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $api_response = Http::withHeaders([
            'Authorization' => 'Bearer '.session('token'),
        ])->get('https://candidate-testing.com/api/v2/authors?orderBy=id&direction=ASC&limit=12&page='.request()->input('page',1));

        if($api_response->successful()){
            return view('book.create',['authors'=>$api_response['items']]);
        }
        return redirect()->back()->with('main_error',"Error occured");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Formatting request before sending to API
        request()->request->add(['author'=>['id'=>request('author_id')]]);
        request()->request->add(['number_of_pages'=>(int) request('number_of_pages')]);
   
         $api_response =  Http::withHeaders([
            'Authorization' => 'Bearer '.session('token'),
        ])->post('https://candidate-testing.com/api/v2/books',request()->only(
                    "author",
                    "title",
                    "release_date",
                    "description",
                    "isbn",
                    "format",
                    "number_of_pages"
                    ));
            if($api_response->successful()){
                        return redirect()->back()->with('main_success','Book added successfully');
            }
            return redirect()->back()->with('main_error','Sorry due to some issue , Book not added');
            
    }

   
}
