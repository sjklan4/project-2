@extends('layout.loginlayout')

@section('title', 'Mail')

@section('contents')
    <div class="access_email">
        <form action="{{route('users.verify')}}" method="POST">
            @csrf
            <div class="mailAddress">
                <label for="mailAddress">email : </label>
                <input type="text" id="mailAddress" name="mailAddress" onblur="duplicationEmail()"
                value="{{ session()->has('data') ? session('data') : '' }}" autocomplete="off" required>

                @if (!session()->has('data'))
                    <button type="submit" id="signupButton" class="accessBtn"  disabled>인증요청</button>
                @endif
                    <div class="insermsg">
                        <span id="insertmsg"></span>
                    </div>
            </div>
         
         
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </form>
    </div>    
    
    @if (!session()->has('data'))
        <div class="loginBtn">
            <button type="button" onclick="location.href='{{route('user.login')}}'" id="greenBtn">취소</button>
        </div>
    @endif

    @if(session()->has('data'))
        <div>
            <h2>입력하신 이메일에서 인증번호를 확인해주세요.</h2>
        </div>
        <form action="{{route('users.accessok')}}" method="POST">
            @csrf
            <div id="accessnumber">
                <label for="accessnum">인증번호 :  </label>
                <input type="text" id="accessnum" name="accessnum">
            </div>
            <div>
                @error('numerror')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <button type="submit" id="registbtn">인증</button> 
            </div>
        </form>
    @endif
@endsection

@section('js')
    <script src="{{ asset('js/regist.js') }}"></script>
@endsection