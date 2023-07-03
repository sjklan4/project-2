@extends('layout.loginlayout')

@section('title', 'regist')


@section('css')
    <link rel="stylesheet" href="{{asset('css/regist.css')}}">
@endsection

@section('contents')

<div class="regist-body">
    <a href="{{route('user.login')}}">
        <div class="intro_login">
            <img src="{{asset('img/logo.png')}}" alt="logo" class="mt-4 ms-4">
                <br>
        </div>
    </a>
    <div class = "registpage">
        <form action="{{route('user.registpost')}}" method="post">
                    @csrf
        <div class = "margin"></div>
        <div class="registinfo">
            <h1>WELCOME!</h1>
            <h1>PLEASE REGIST!</h1>
            <table>
                <tr>
                    <td class="write_name">
                        <label for="user_email">이메일</label>
                    </td>
                    <td>        
                        <input type="text" name="user_email" id="user_email"  value="{{ $errors->has('user_email') ? '' : old('user_email', isset($data) ? $data->user_email : '') }}" placeholder="이메일을 입력해주세요" autocomplete="off">
                    </td>
                    <td>
                        <button type="button" id="chdeckEmail" class = "greenBtn" disabled>중복체크</button>
                    </td>
                </tr>
                <tr>
                    
                    <td colspan="3"><span id="emailRegexm"></span></td>
                    <td></td>
                    <td></td>
                </tr>    
                <tr>
                    <td class="write_name">    
                        <label for="user_name">이름</label>
                    </td>
                    <td>   
                        <input type="text" name="user_name" id="user_name"   value="{{ $errors->has('user_name') ? '' : old('user_name', isset($data) ? $data->user_name : '') }}">
                    </td>    
                </tr>
                <tr>
                  
                    <td colspan="3"> @error('user_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </td>
                    <td></td>
                    <td></td>
                </tr>           
                <tr>
            
                    <td class="write_name">   
                        <label for="password">비밀번호</label>
                    </td>
                    <td>   
                        <input type="password" name="password" id="password"  value="{{ $errors->has('password') ? '' : old('password', isset($data) ? $data->password : '') }}">
                    </td>
                </tr>
                <tr>
                 
                    <td colspan="3">   
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </td>
                    <td></td>
                    <td></td>
                </tr> 
                <tr> 
                
                    <td class="write_name">
                        <label for="passwordchk">비밀번호 확인</label>
                    </td>
                    <td>   
                        <input type="password" name="passwordchk" id="passwordchk" value="{{ $errors->has('passwordchk') ? '' : old('passwordchk', isset($data) ? $data->passwordchk : '') }}">
                    </td>
                </tr>
                <tr>
                    <td colspan="3">   
                        @error('passwordchk')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </td>
                    <td></td>
                    <td></td>
                </tr>   
                <tr>
                
                    <td class="write_name">
                        <label for="nkname">닉네임</label>
                    </td>
                    <td>   
                        <input type="text" name="nkname" id="nkname"  value="{{ $errors->has('nkname') ? '' : old('nkname', isset($data) ? $data->nkname : '') }}">

                    </td>    
                </tr>
                <tr>
                    <td colspan="3">   
                        @error('nkname')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </td> 
                    <td></td>
                    <td></td>
                </tr>     
                <tr>
                    <td class="write_name">        
                        <div class="user_birth_write">
                        <label for="user_birth">생년월일</label>
                    </td>
                    <td>   
                        <input type="date" name="user_birth" id="user_birth"  max="{{ now()->toDateString() }}">
                    </td>
                </tr>    
                <tr>
                    <td class="write_name">
                            <label for="user_phone_num">전화번호</label>
                    </td>
                    <td>   
                            <input type="text" name="user_phone_num" id="user_phone_num"  value="{{ $errors->has('user_phone_num') ? '' : old('user_phone_num', isset($data) ? $data->user_phone_num : '') }}">
                    </td>      
                </tr>
                <tr>
                    <td colspan="3">   
                        @error('user_phone_num')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </td> 
                    <td></td>
                    <td></td>
                </tr>     
                <tr>
                
                    <td class="write_name">    
                            <label for="gender">성별</label>
                    </td>
                    <td>   
                        <input type="radio" name="gender" id="gender" value="0" > 남자 <img src="{{ asset('img/manmark.png') }}" class="gen">
                        <input type="radio" name="gender" id="gender" value="1"> 여자 <img src="{{asset('img/womanmark.png')}}"  class="gen">
                    </td>
                </tr>
            
                </table>
                    <button type="button" onclick="location.href='{{route('user.login')}}'" id="exit">취소</button>
                    <button type ="submit" id="signupButton" class="greenBtn" disabled>회원가입</button>
            </div>
        </form>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('js/regist.js') }}"></script>
@endsection




