@extends('layouts.main_layout')
@section('content') 
        <h1>Welcome to the main page and blade</h1>
        <hr>
        <h2>Value: {{ $value }}</h2>
        <h2>Name: {{ $name }}</h2>
        <hr>    
@endsection
