@extends('layout.loginlayout')

@section('title','Login')

@section('css')
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection


@section('contents')
    <div class="login">
        <div class="intro_login">
            <h1>Logo??</h1>
            <br>
            <br>
                <div class="p-tag">
                    <p class="first-line">Achiev rewards</p>
                    <p>through healthy</p>
                    <p>missions</p>
                </div>
                    <div class="img1"></div>
        </div>
    </div>
        <div class="loginpage">
                @if(!empty($error))
                    <span>{{$error}}</span>
                @endif
            <div class="write">
                <form action="{{route('user.loginpost')}}"  method="post">
                    @csrf
                <div class="writein">
                    <div class="email_write">
                            <label for="email">email</label>
                            <input type="text" name="email" id="email" value="{{ $errors->has('email') ? '' : old('email', isset($data) ? $data->user_email : '') }}">
                    {{-- validator에서 출력하는 오류 메시지를 출력하기 위해서 추가한 구문 --}}
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
                            @enderror
                            <br>
                </div>
            </div>

                    <button type="submti" class="login_button btn-stlye">로그인</button>
                </form>
            <div class="registlink">
                <a href="{{route('user.regist')}}">회원가입</a>
            </div>
    </div>
@endsection