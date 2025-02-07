@extends('layouts.app')
                    @section('content')
                    <h2>Login here</h2>
                        <Form method="post" action="{{route('login')}}">
                            @csrf
                            @if(session('error'))
                            <p>{{session('error')}}</p>
                            @endif
                            <table border="1">
                            <tr><td>Email : </td><td><input type="email" required name="email" id="email"></td>
                            <tr><td>Password : </td><td><input type="password" required name="password" id="password"></td>
                            </table>
                            <button type="submit">login</button>
                        </Form>
                   @endsection