@extends('layout.layout')

@section('title', 'regist')

@section('contents')

<form action="{{route('user.registpost')}}" method="post">
    @csrf
<label for="user_email">이메일</label>
<input type="text" name="user_email" id="user_email"  value="{{ $errors->has('user_email') ? '' : old('user_email', isset($data) ? $data->user_email : '') }}">
<button type="button" id="chdeckEmail">중복확인</button>

<span id="emailRegexm"></span>
{{-- @error('user_email')
<div class="text-danger">{{ $message }}</div>
@enderror
@if (session('message'))
    <div class="text-success">{{ session('message') }}</div>
@endif --}}

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

<button type ="submit" id="signupButton" disabled>회원가입</button>
</form>


@endsection


@section('js')
    <script src="{{ asset('js/regist.js') }}"></script>
@endsection


{{-- @section('script')
<script src="{{asset('js/regist.js')}}"></script>
@endsection --}}



{{-- @error는 라라벨에서 제공하는 블레이드 지시어로 유효성 검사가 실패할시 특정 양식에 입력된 오류 메시지를 출력
    vaidato class와 같이 연결해서 사용하는 지시어로 text_danger클래에 message가 입력되서 출력 --}}


    {{-- 이 코드에서 @error('user_email')...@enderror 블록은 user_email 필드와 관련된 유효성 검사 오류를 표시합니다. @if (session('message'))...@endif 블록은 이메일이 고유하고 사용 가능한 경우 성공 메시지를 표시합니다. 두 메시지 모두 이메일 입력 필드 아래에 나타납니다.


session('message')은 with('message', $message)를 사용하여 컨트롤러에서 전달하는 성공 메시지입니다.


그리고 text-success 클래스는 성공 메시지를 녹색으로 만드는 데 사용됩니다(CSS 스타일에 따라 이를 조정해야 할 수도 있음). 부트스트랩 또는 text-success 클래스를 정의하는 유사한 CSS 프레임워크를 사용하지 않는 경우 CSS에서 직접 정의하거나 인라인 스타일을 사용하여 텍스트를 녹색으로 지정해야 할 수 있습니다. --}}

{{-- 
<button id="button1">Button 1</button>
<button id="button2" disabled>Button 2</button> --}}