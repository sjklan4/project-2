@extends('layout.loginlayout')

@section('title', '비밀번호찾기')

@section('contents')
    <div>
        <h1>Find Password</h1>
        <form action="{{ route('findpw.post') }}" method="post">
            @csrf
            <input type="email" name="user_email" id="user_email">
            <button type="submit">인증</button>
        </form>
    </div>
@endsection