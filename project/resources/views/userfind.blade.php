@extends('layout.layout')

@section('title', 'List')

@section('contents')
    <form action="{{ route('user.userpseditpost') }}" method="post">
        @csrf
        <label for="user_name">회원이름 : </label>
    <input type="text" name="user_name" id="user_name" value="{{ $errors->has('user_name') ? '' : old('user_name', isset($data) ? $data->user_email : '') }}">
    {{-- validator에서 출력하는 오류 메시지를 출력하기 위해서 추가한 구문 --}}
    @error('user_name') 
    <div class="text-danger">{{ $message }}</div>
    @enderror
    <br>

    <label for="user_phone_num">전화번호 : </label>
    <input type="text" name="user_phone_num" id="user_phone_num"  value="{{ $errors->has('user_phone_num') ? '' : old('user_phone_num', isset($data) ? $data->user_phone_num : '') }}">
    @error('user_phone_num')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    <br>
    
    <div>Email : {{ $findemail }} </div>
    
    </form>
@endsection
