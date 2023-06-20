@extends('layout.layout')

@section('title', 'List')

@section('contents')
    <form action="{{ route('user.userpseditpost') }}" method="post">
        @csrf
    <label for="password">기존비밀번호 : </label>
    <input type="password" name="password" id="password">
    <button type="button" id="passwordchk">확인</button>
    <br>
    <span id="writeerror"></span>
    <br>
    <label for="newpassword">새 비밀번호 : </label>
    <input type="text" name="newpassword" id="newpassword">
    <br>
    <label for="newpasswordchk">새 비밀번호 확인: </label>
    <input type="text" name="newpasswordchk" id="newpasswordchk">
    <br>
    <button type = "submit" id="passwordchg">변경</button>
    </form>
@endsection

@section('js')
    <script src="{{ asset('js/password.js') }}"></script>
@endsection