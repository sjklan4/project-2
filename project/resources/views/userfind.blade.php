@extends('layout.loginlayout')

@section('title', '찾기')

@section('contents')
<div class="finduser-info">
    <div class = "findemail">
        <h1>Find Email</h1>
        <div class="findemail-insert">
            <form action="{{ route('user.userfindEPost') }}" method="post">
                @csrf
            <div class="write-input">
                <label for="user_name">회원이름  </label>
                <input type="text" name="user_name" id="user_name" value="{{ $errors->has('user_name') ? '' : old('user_name', isset($data) ? $data->user_email : '') }}">
            </div>
                @error('user_name') 
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            <br>
            <div class="write-input">
                <label for="user_phone_num">전화번호  </label>
                <input type="text" name="user_phone_num" id="user_phone_num"  value="{{ $errors->has('user_phone_num') ? '' : old('user_phone_num', isset($data) ? $data->user_phone_num : '') }}">
            </div>
                @error('user_phone_num')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            <div class="chk-btn">
                <button type="button" onclick="location.href='{{route('user.login')}}'" id="greenBtn">취소</button>
                <button type="submit" id="greenBtn">확인</button>
            </div>
            </form>
            <div class="chk-email">Email  {{session('data')}} </div>
        </div>
    </div>    
    <div class = "findpsw">
        <h1>Password Change</h1>
        <div class="changpassword-insert">
            <form action="{{ route('user.userpseditpost') }}" method="post">
                @csrf
                <div class="write-input">
                    <label for="password">기존비밀번호  </label>
                    <input type="password" name="password" id="password" placeholder="비밀번호를 입력해 주세요">
                    
                </div>
                <button type="button" id="passwordchk" disabled>비밀번호확인</button>
                <br>
                <span id="writeerror"></span>
                <br>
                <div class="write-input">
                    <label for="newpassword">새 비밀번호  </label>
                    <input type="text" name="newpassword" id="newpassword">
                </div>
                    <br>
                <div class="write-input">    
                    <label for="newpasswordchk">새 비밀번호 확인 </label>
                    <input type="text" name="newpasswordchk" id="newpasswordchk">
                </div>
                    <br>
                <button type = "submit" id="passwordchg" disabled>변경</button>
            </form>
        </div>
    </div>
</div>
@endsection

