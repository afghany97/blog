@extends('layouts.master')
@section('content')
    <ul>
        @foreach($users as $user)
            <li class="form-control"> {{$user}} </li>
        @endforeach
    </ul>
@endsection