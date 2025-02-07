@extends('layouts.app')
@section('content')
    <h2>Author {{$author_details['first_name']}}'s Book list</h2>
    <table border="1">
        <th>Title</th>
        <th>Release date</th>
        <th>Description</th>
        <th>Isbn</th>
        <th>Format</th>
        <th>Total pages</th>
        <th>Action</th>
        @forelse($author_details['books'] as $book)
        <tr>
            <td>{{$book['title']??'-'}}</td>
        
            <td>{{$book['release_date']??'-'}}</td>
            <td>{{$book['description']??'-'}}</td>
        
            <td>{{$book['isbn']??'-'}}</td>
            <td>{{$book['format']??'-'}}</td>
            <td>{{$book['number_of_pages']??'-'}}</td>
            <td>
                <a href="{{route('authors.remove-book',['id'=>$book['id']])}}">Delete</a>
            </td>
            
        </tr>
        @empty
    </table>
    <p>Sorry there is no authors</p>
    @endforelse
@endsection
