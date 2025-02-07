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
        
// "total_results"
// :
// 10,
// "total_pages"
// :
// 1,
// "current_page"
// :
// 1,
// "limit"
// :
// 12,
// "offset"
// :
// 0,
// "order_by"
// :
// "id",
// "direction"
// :
// "ASC",
// "items": [
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

        // return view('authors.list',['authors'=>session('user')]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function remove()
    {
        $api_response =  Http::withHeaders([
            'Authorization' => 'Bearer '.session('token'),
        ])->get('https://candidate-testing.com/api/v2/authors/'.request('id'));
        
    //    return $api_response =  Http::withHeaders([
    //         'Authorization' => 'Bearer '.session('token'),
    //     ])->post('https://candidate-testing.com/api/v2/authors',[
    //             "first_name"=> "hussain 5",
    //             "last_name"=> "webdev 5",
    //             "birthday"=> "2025-02-07T03:38:43.585Z",
    //             "biography"=> "test bio hussain 5",
    //             "gender"=> "male",
    //             "place_of_birth"=> "india"
    //     ]);
        
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
            // return view('author.show',['author_details'=>$api_response]);
        }

    }

     /**
     * Remove the author book.
     */
    public function remove_book()
    {
    //    return $api_response =  Http::withHeaders([
    //         'Authorization' => 'Bearer '.session('token'),
    //     ])->get('https://candidate-testing.com/api/v2/books/'.request('id'));

        $api_response =  Http::withHeaders([
            'Authorization' => 'Bearer '.session('token'),
        ])->delete('https://candidate-testing.com/api/v2/books/'.request('id'));
        
    //    return $api_response =  Http::withHeaders([
    //         'Authorization' => 'Bearer '.session('token'),
    //     ])->post('https://candidate-testing.com/api/v2/authors',[
    //             "first_name"=> "hussain 5",
    //             "last_name"=> "webdev 5",
    //             "birthday"=> "2025-02-07T03:38:43.585Z",
    //             "biography"=> "test bio hussain 5",
    //             "gender"=> "male",
    //             "place_of_birth"=> "india"
    //     ]);
        
        if($api_response->successful()){
            return back()->with('main_success',"Book deleted successfully");
        }
        return back()->with('main_error',"Error occured , book is not deleted");

    }
}
