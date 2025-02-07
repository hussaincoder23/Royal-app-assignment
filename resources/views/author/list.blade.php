@extends('layouts.app')
@section('content')
    <div>

    <h2>Authors list</h2>
    @if($authors)
    <table border="1" style="margin-top: 20px;">
        <th>First name</th>
        <th>Last name</th>
        <th>Gender</th>
        <th>Birth Place</th>
        <th>Birth date</th>
        <th>Action</th>
        @forelse($authors as $author)
        <tr>
            <td>{{$author['first_name']??'-'}}</td>
        
            <td>{{$author['last_name']??'-'}}</td>
        
            <td>{{$author['gender']??'-'}}</td>
            <td>{{$author['birthday']??'-'}}</td>
            <td>{{$author['place_of_birth']??'-'}}</td>
            <td>
                <a href="{{route('authors.show',['author'=>$author['id']])}}">View</a>
                <a href="{{route('authors.remove',['id'=>$author['id']])}}">Delete</a>
            </td>
        </tr>
        @empty
    </table>
        @if($current_page <= 1)
            <p>Sorry there is no authors</p>
        @endif
    @endforelse
    @endif


    <!-- Pagination Section -->
    @if($total_pages > 1)
        <div class="pagination_div">
            <b>Go to Page :  &nbsp;</b>
            @if($current_page > 1)
                <a href="{{ route('authors.index', ['page' => $current_page - 1]) }}">Previous</a>
            @endif

            @for($i = 1; $i <= $total_pages; $i++)
                <a href="{{ route('authors.index', ['page' => $i]) }}" 
                    @if($i == $current_page) style="font-weight: bold;" @endif>
                    {{ $i }}
                </a>
            @endfor

            @if($current_page < $total_pages)
                <a href="{{ route('authors.index', ['page' => $current_page + 1]) }}">Next</a>
            @endif
        </div>
    @endif
    </div>

@endsection
