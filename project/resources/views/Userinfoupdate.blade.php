@extends('layout.layout')

@section('title', 'List')

@section('contents')
    <form action="{{ route('user.userinfoeditPost') }}" method="post">
        @csrf
    <label for="user_email">Email : </label>
    <input type="text" name="user_email" id="user_email" value= "{{old('user_email') !== null ? old('user_email') : $data->user_email}}" readonly>
    <br>
    <label for="user_name">이름 : </label>
    <input type="text" name="user_name" id="user_name" value= "{{old('user_name') !== null ? old('user_name') : $data->user_name}}">
    <br>
    <label for="nkname">닉네임 : </label>
    <input type="text" name="nkname" id="nkname" value= "{{old('nkname') !== null ? old('nkname') : $data->nkname}}">
    <br>
    <label for="user_phone_num">전화번호 : </label>
    <input type="text" name="user_phone_num" id="user_phone_num" value= "{{old('user_phone_num') !== null ? old('user_phone_num') : $data->user_phone_num}}">
    <br>
    <button type = "submit">정보수정</button>


    </form>
@endsection