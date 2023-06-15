@extends('layout.layout')

@section('title', 'List')

@section('contents')


<form action="{{route()}}"></form>
<label for="email">email : </label>
<input type="text" name="email" id="email">
<br>
<label for="password">password : </label>
<input type="password" name="password" id="password">
<br>
<button type="submti">로그인</button>

@endsection