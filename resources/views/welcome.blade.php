@extends('layouts.app')
                    @section('content')
                    <h2>Login here</h2>
                        <Form method="post" action="{{route('login')}}">
                            @csrf
                            @if(session('error'))
                            <p>{{session('error')}}</p>
                            @endif
                            <input type="email" required name="email" id="email">
                            <input type="password" required name="password" id="password">
                            <button type="submit">login</button>
                        </Form>
                   @endsection