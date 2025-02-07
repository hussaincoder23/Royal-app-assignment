@extends('layouts.app')
@section('content')
Hello welcome , {{session('user')['first_name'].' '.session('user')['last_name']}}
@endsection
