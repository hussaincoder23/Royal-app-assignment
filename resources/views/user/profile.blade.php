@extends('layouts.app')
@section('content')
    <h2>User Details</h2>
    <table border="1">
        <tr>
            <td>First name</td>
            <td>{{$user['first_name']}}</td>
        </tr>
        <tr>
            <td>Last name</td>
            <td>{{$user['last_name']}}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{$user['email']}}</td>
        </tr>
        <tr>
            <td>Gender</td>
            <td>{{$user['gender']}}</td>
        </tr>
        
    </table>
@endsection
