@extends('layout.loginlayout')

@section('title', '비밀번호찾기')

@section('contents')
    <div>
        <h1>비밀번호 찾기</h1>
        <div class="findemail-insert">
            <form action="{{ route('findpw.post') }}" method="post">
                @csrf
                <div class="findEmail">
                    <div class="write-input">
                        <label for="user_email">이메일</label>
                        <br>
                        <input type="email" name="user_email" id="user_email">
                        @error('user_email') 
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="write-input">
                        <label for="user_name">회원이름</label>
                        <br>
                        <input type="text" name="user_name" id="user_name" value="{{ $errors->has('user_name') ? '' : old('user_name', isset($data) ? $data->user_email : '') }}">
                        @error('user_name') 
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="write-input">
                        <label for="user_phone_num">전화번호</label>
                        <br>
                        <input type="text" name="user_phone_num" id="user_phone_num"  value="{{ $errors->has('user_phone_num') ? '' : old('user_phone_num', isset($data) ? $data->user_phone_num : '') }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        @error('user_phone_num')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="regisBtn">
                        <button type="button" onclick="location.href='{{route('user.login')}}'" id="greenBtn">취소</button>
                        <button type="submit" id="greenBtn">확인</button>
                    </div>
                </div>
            </form>
        </div>
        @if(session('message'))
            {{session('message')}}
        @endif
    </div>




    {{-- <div>
        <h1>비밀번호 찾기</h1>
        <form action="{{ route('findpw.post') }}" method="post">
            @csrf
            <input type="email" name="user_email" id="user_email">
            <button type="submit">인증</button>
        </form>
        <a href="{{route('user.userfindE')}}">이메일찾기</a>
        <a href="{{route('user.login')}}">취소</a>
    </div>
    @if(session('message'))
        {{session('message')}}
    @endif --}}
@endsection