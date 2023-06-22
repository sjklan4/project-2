@extends('layout.layout')

@section('title', 'Login')

@section('contents')


<button type="button" onclick="location.href='{{route('user.userinfoedit')}}'">회원정보수정</button>




@if(!empty($error))
    <span>{{$error}}</span>
@endif
<form action="{{route('user.loginpost')}}"  method="post">
    @csrf
    <label for="email">email : </label>
    <input type="text" name="email" id="email" value="{{ $errors->has('email') ? '' : old('email', isset($data) ? $data->user_email : '') }}">
    {{-- validator에서 출력하는 오류 메시지를 출력하기 위해서 추가한 구문 --}}
    @error('email') 
    <div class="text-danger">{{ $message }}</div>
    @enderror
    <br>


    <label for="password">password : </label>
    <input type="password" name="password" id="password"  value="{{ $errors->has('password') ? '' : old('password', isset($data) ? $data->password : '') }}">
    @error('password')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    <br>

    <button type="submti">로그인</button>
</form>
<br>
<button type="button" onclick="location.href = '{{route('user.regist')}}'">회원가입</button>


@endsection