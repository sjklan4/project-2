@extends('layout.layout')

@section('title', 'List')

@section('contents')

<form action=""></form>
<label for="email">이메일</label>
<input type="text" name="email" id="email">
<button type="button" onclick="location.href = '{{route('user.registdup')}}'">중복확인</button>
<br>
<label for="name">이름</label>
<input type="text" name="name" id="name">
<br>
<label for="password">비밀번호</label>
<input type="password" name="password" id="password">
<br>
<label for="passwordchk">비밀번호 확인</label>
<input type="password" name="passwordchk" id="passwordchk">
<br>
<label for="nkname">닉네임</label>
<input type="text" name="nkname" id="nkname">
<br>
<label for="birthdate">생년월일</label>
<input type="date" name="birthdate" id="birthdate">
<br>
<label for="callnum">전화번호</label>
<input type="text" name="callnum" id="callnum">
<br>
<label for="gender">성별</label>
<input type="radio" name="gender" id="gender" value= 0>남자
<input type="radio" name="gender" id="gender" value= 1>여자
<br>
<button type ="submit">회원가입</button>
@endsection

