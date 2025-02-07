@extends('layouts.app')
@section('content')

<h2>Add new Book</h2>
    <Form method="post" action="{{route('books.store')}}">
        @csrf
        <table border="1">
        <tr><td>Title</td><td><input type="text" name="title"></td></tr>
            <tr><td>Release date</td><td><input type="date" name="release_date"></td></tr>
            <tr><td>Description</td><td><input type="text" name="description"></td></tr>
            <tr><td>isbn</td><td><input type="text" name="isbn"></td></tr>
            <tr><td>Format</td><td><input type="text" name="format"></td></tr>
            <tr><td>Number of pages</td><td><input type="number" name="number_of_pages"></td></tr>
            <tr><td>Author</td><td><select name="author_id">
                @foreach($authors as $author)
                <option value="{{$author['id']}}">{{$author['first_name'].' '.$author['last_name']}}</option>    
                @endforeach
            </select>
            </td></tr>
        </table> 
                <button type="submit">Add book</button>
            </Form>
                @endsection
