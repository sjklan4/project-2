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
    <hr>
    <br>
    <form action=""></form>
<div>
    <form action="{{ route('user.userKcalup') }}" method="post">
        @csrf
    <label for="user_birth">나이(생년월일) : </label><span id="userage"></span>
    <input type="date" name="user_birth" id="user_birth" value= "{{old('user_birth') !== null ? old('user_birth') : $data->user_birth}}">
    <br>
    <label for="user_tall">키 : </label>
    <input type="text" name="user_tall" id="user_tall" value= "{{old('user_tall') !== null ? old('user_tall') : $data->user_tall}}">
    <br>
    <label for="user_weight">몸무게 : </label>
    <input type="text" name="user_weight" id="user_weight" value= "{{old('user_weight') !== null ? old('user_weight') : $data->user_weight}}">
    <br>
    <label for="user_activity">활동량 : </label>
    <input type="radio" name="user_activity" id="user_activity" value="0">적음(1.2)
    <input type="radio" name="user_activity" id="user_activity" value="1">보통(1.55)
    <input type="radio" name="user_activity" id="user_activity" value="2">많음(1.9)
    <br>
    <br>
    <button type = "submit">기본자료수정</button>
</div>

@endsection

@section('js')
    <script src="{{ asset('js/userinfo.js') }}"></script>
@endsection

