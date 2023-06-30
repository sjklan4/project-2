@extends('layout.loginlayout')

@section('title','Login')

@section('css')
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection


@section('contents')
<div class="page-body">
    <div class="intro_login d-none d-xl-block">
        <img src="{{asset('img/logo.png')}}" alt="logo" class="mt-4 ms-4">
        <br>
    </div>
    <div class="loginpage">
        <div class="write">
                {{-- @if(!empty($error))
                    <span>{{$error}}</span>
                @endif --}}
        
                <form action="{{route('user.loginpost')}}"  method="post">
                    @csrf
                <div class="writein">
                    <div class="email_write">
                            <label for="email">email</label>
                            <input type="text" name="email" id="email" value="{{ $errors->has('email') ? '' : old('email', isset($data) ? $data->user_email : '') }}">
                    </div>
                            @error('email') 
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <br>
                    <div class="password_write">
                            <label for="password">password</label>
                            <input type="password" name="password" id="password"  value="{{ $errors->has('password') ? '' : old('password', isset($data) ? $data->password : '') }}">
                    </div>
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            <div>{{$error}}</div>
                            @enderror
                            


                            <br>
                </div>
                <div class="linkbutton">
                    <button type="submti" id="greenBtn">로그인</button>
                </form>
                <div class="registlink">
                    <a href="{{route('user.userfindE')}}">이메일찾기 | </a>
                    <a href="{{route('user.regist')}}">회원가입</a>
                </div>
        </div>
    </div>
</div>
@endsection