@extends('layout.loginlayout')

@section('title', 'Finduser')
@section('css')
    <link rel="stylesheet" href="{{asset('css/finduser.css')}}">
@endsection

@section('contents')
    <div class="findemail">
        <div class="intro_login">
            <h1>Logo??</h1>
            <br>
            <br>
                <div class="p-tag">
                    <p class="first-line">Wishing You</p>
                    <p class="first-line">Good Health!</p>
                </div>
        </div>

    <div class="finduserpage">
        <div class="insert-info">
            <button type="button" id="findEmail">이메일찾기</button>
            <button type="button" id="findpassword">비밀번호찾기</button>
            <button type="button" onclick="location.href='{{route('user.login')}}'">로그인</button>
        </div>    
            <div class = "findemail">
                <form action="{{ route('user.userfindEPost') }}" method="post">
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
                <button type="submit">확인</button>
                </form>
                <div>Email : {{session('data')}} </div>
            </div>    
        
        <div class = "findpsw">
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
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="{{ asset('js/findemailpass.js') }}"></script>
<script src="{{ asset('js/password.js') }}"></script>
@endsection

