@extends('layout.userinfoNav')

@section('title', 'passwordchange')

@section('passwordcontents')
    <form action="{{ route('user.userpseditpost') }}" method="post">
        @csrf
        <label for="password">기존비밀번호 : </label>
        <input type="password" name="password" id="password" placeholder="비밀번호를 입력해 주세요">
        <button type="button" id="passwordchk" disabled>확인</button>
        <br>
        <span id="writeerror"></span>
        <br>
        <label for="newpassword">새 비밀번호 : </label>
        <input type="text" name="newpassword" id="newpassword">
        <br>
        <label for="newpasswordchk">새 비밀번호 확인: </label>
        <input type="text" name="newpasswordchk" id="newpasswordchk">
        <br>
        <button type = "submit" id="passwordchg" disabled>변경</button>
    </form>
@endsection

@section('js')
    <script src="{{ asset('js/password.js') }}"></script>
@endsection
