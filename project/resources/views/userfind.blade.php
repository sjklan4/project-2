@extends('layout.loginlayout')

@section('title', 'Finduser')
@section('css')
    <link rel="stylesheet" href="{{asset('css/finduser.css')}}">
@endsection

@section('contents')
<div class="finduser-info">
    <div class="intro_login  d-none d-xl-block">
        <img src="{{asset('img/logo.png')}}" alt="logo" class="mt-4 ms-4">
            <br>
        {{-- <div class="p-tag">
            <p class="first-line">Wishing You</p>
            <p class="first-line">Good Health!</p>
        </div> --}}
    </div>

    <div class="finduserpage">
        <div class="find-insert">
            <div class="insert-info">
                <button type="button" class="btn-stlye" id="findEmail">이메일찾기</button>
                {{-- <button type="button"  class="btn-stlye" id="findpassword">비밀번호변경</button> --}}
                <button type="button" onclick="location.href='{{route('user.login')}}'" id="greenBtn">로그인</button>
            </div> 

            <div class="info-list">
                <div class = "findemail">
                    <h1>Find Email</h1>
                    <div class="findemail-insert">
                        <form action="{{ route('user.userfindEPost') }}" method="post">
                            @csrf
                        <div class="write-input">
                            <label for="user_name">회원이름  </label>
                            <input type="text" name="user_name" id="user_name" value="{{ $errors->has('user_name') ? '' : old('user_name', isset($data) ? $data->user_email : '') }}">
                        {{-- validator에서 출력하는 오류 메시지를 출력하기 위해서 추가한 구문 --}}
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
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/changeblade.js') }}"></script>
<script src="{{ asset('js/password.js') }}"></script>
@endsection

