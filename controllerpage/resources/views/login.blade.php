@extends('layout.layout')

@section('title','로그인')

@section('css')
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection

@section('contents')
<div id="wrap">
    <form action="{{route('login.post')}}"  method="post">
        @csrf
        <div class="container">
            <div>
                <label for="email">Email</label>
                <br>
                <input type="text" name="email" id="email" value="{{ $errors->has('email') ? '' : old('email', isset($data) ? $data->user_email : '') }}" autocomplete="off">
            </div>
            {{-- @error('email') 
            <div class="err-mgs">{{ $message }}</div>
            @enderror --}}
            <div class="pwBox">
                <label for="password">Password</label>
                <br>
                <input type="password" name="password" id="password" autocomplete="off">
            </div>
            {{-- @error('password')
            <div class="err-mgs">{{ $message }}</div>
            @enderror --}}
            <div class="error_msg">
                @if(session('error'))
                    {{session('error')}}
                @endif
            </div>    
            <div class="loginBtn">
                <button type="submit" id="loginBtn">로그인</button>
            </div>
        </div>
    </form>
</div>

@endsection