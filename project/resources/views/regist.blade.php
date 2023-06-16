@extends('layout.layout')

@section('title', 'List')

@section('contents')

<form action="{{route('user.registpost')}}" method="post">
    @csrf
<label for="user_email">이메일</label>
<input type="text" name="user_email" id="user_email"  value="{{ $errors->has('user_email') ? '' : old('user_email', isset($data) ? $data->user_email : '') }}">
@error('user_email')
<div class="text-danger">{{ $message }}</div>
@enderror
{{-- <button type="button" onclick="location.href = '{{route('user.registdup')}}'">중복확인</button> --}}
<br>

<label for="user_name">이름</label>
<input type="text" name="user_name" id="user_name"   value="{{ $errors->has('user_name') ? '' : old('user_name', isset($data) ? $data->user_name : '') }}">
    @error('user_name')
    <div class="text-danger">{{ $message }}</div>
    @enderror
<br>

<label for="password">비밀번호</label>
<input type="password" name="password" id="password"  value="{{ $errors->has('password') ? '' : old('password', isset($data) ? $data->password : '') }}">
    @error('password')
    <div class="text-danger">{{ $message }}</div>
    @enderror
<br>

<label for="passwordchk">비밀번호 확인</label>
<input type="password" name="passwordchk" id="passwordchk" value="{{ $errors->has('passwordchk') ? '' : old('passwordchk', isset($data) ? $data->passwordchk : '') }}">
    @error('passwordchk')
    <div class="text-danger">{{ $message }}</div>
    @enderror
<br>

<label for="nkname">닉네임</label>
<input type="text" name="nkname" id="nkname"  value="{{ $errors->has('nkname') ? '' : old('nkname', isset($data) ? $data->nkname : '') }}">
    @error('nkname')
    <div class="text-danger">{{ $message }}</div>
    @enderror
<br>

<label for="user_birth">생년월일</label>
<input type="date" name="user_birth" id="user_birth">
<br>

<label for="user_phone_num">전화번호</label>
<input type="text" name="user_phone_num" id="user_phone_num"  value="{{ $errors->has('user_phone_num') ? '' : old('user_phone_num', isset($data) ? $data->user_phone_num : '') }}">
    @error('user_phone_num')
    <div class="text-danger">{{ $message }}</div>
    @enderror
<br>

<label for="gender">성별</label>
<input type="radio" name="gender" id="gender" value="0">남자
<input type="radio" name="gender" id="gender" value="1">여자
<br>

<button type ="submit">회원가입</button>
</form>
@endsection



{{-- @error는 라라벨에서 제공하는 블레이드 지시어로 유효성 검사가 실패할시 특정 양식에 입력된 오류 메시지를 출력
    vaidato class와 같이 연결해서 사용하는 지시어로 text_danger클래에 message가 입력되서 출력 --}}