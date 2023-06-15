@extends('layout.layout')

@section('title', 'List')

@section('contents')


@csrf
<label for="email">email : </label>
<input type="text" name="email" id="email">
<br>
<label for="password">password : </label>
<input type="password" name="password" id="password">
<br>
<button type="submti">로그인</button>
<br>
<button type="button"onclick="location.href = '{{route('user.regist')}}'">회원가입</button>

@endsection