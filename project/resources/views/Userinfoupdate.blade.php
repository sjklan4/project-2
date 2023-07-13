@extends('layout.userinfoNav')

@section('title', 'inforupdate')

@section('userinfocontents')
<!-- 상세 정보 영역 (오른쪽) 영역 -->
<div class="col-md-8 offset-lg-1 pb-5 mt-n3 mb-2 mb-lg-4 pt-md-5 mt-n3 mt-md-0">
    <div class="ps-md-3 ps-lg-0 mt-md-2 py-md-4">
        <h1 class="h2 pt-xl-1 pb-3">Account Details</h1>
        <h2 class="h5 text-primary mb-4">기본정보</h2>
        <form class="needs-validation border-bottom pb-3 pb-lg-4" novalidate>
            <div class="row pb-2">
                <div class="col-sm-6 mb-4">
                    <label for="fn" class="form-label fs-base">First Name</label>
                    <input type="text" id="fn" class="form-control form-control-lg" value="봉정" required readonly>
                    <div class="invalid-feedback">Please enter your first name</div>
                </div>
                <div class="col-sm-6 mb-4">
                    <label for="sn" class="form-label fs-base">Last Name</label>
                    <input type="text" id="sn" class="form-control form-control-lg" value="권" required readonly>
                    <div class="invalid-feedback">Please enter your Last name</div>
                </div>
                <div class="col-sm-6 mb-4">
                    <label for="email" class="form-label fs-base">Email Address</label>
                    <input type="email" id="email" class="form-control form-control-lg" value="qhdwjd4302@naver.com" required readonly>
                    <div class="invalid-feedback">Please enter your emailAddress</div>
                </div>
                <div class="col-sm-6 mb-4">
                    <label for="tel" class="form-label fs-base">Phone</label>
                    <input type="tel" class="form-control form-control-lg" data-format='{"numbericOnly":true,"delimiters":["+82"," "," "],"blocks":[0,3,4,4]}' placeholder="+82 ___ ___ ____" id="tel">
                </div>
            </div>
        </form>
    </div>
</div>




{{-- <div class="shadowYellow">
    <div>
        <h2>나의 정보</h2>
        <div class="listCon">
            <table>
                <form action="{{ route('user.userinfoeditPost') }}" method="post">
                    @csrf
                <tr class="trBasic">    
                    <th class="info-table"><label for="user_email">Email  </label></th>
                    <td class="info-table"><input type="text" name="user_email" id="user_email" value= "{{old('user_email') !== null ? old('user_email') : $data->user_email}}" readonly></td>
                </tr>
                <tr>
                    <th class="info-table"><label for="user_name">이름  </label></th>
                    <td class="info-table"><input type="text" name="user_name" id="user_name" value= "{{old('user_name') !== null ? old('user_name') : $data->user_name}}"></td>
                </tr>
                <tr>
                    <th class="info-table"><label for="nkname">닉네임  </label></th>
                    <td class="info-table"><input type="text" name="nkname" id="nkname" value= "{{old('nkname') !== null ? old('nkname') : $data->nkname}}">
                        <span id="nkRegexm"></span>
                    </td>
                </tr>
                <tr>
                    <th class="info-table"><label for="user_phone_num">전화번호  </label></th>
                    <td class="info-table"><input type="text" name="user_phone_num" id="user_phone_num" value= "{{old('user_phone_num') !== null ? old('user_phone_num') : $data->user_phone_num}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"></td>
                </tr>
                    <caption><button type = "submit" id="greenBtn">정보수정</button></caption>
                    @if(session('changemsg'))
                        {{session('changemsg')}}
                    @endif
                </form>
            </table>
        </div>    
    </div>
</div> --}}

@endsection

@section('js')
    <script src="{{ asset('js/userinfo.js') }}"></script>
@endsection


























{{------------------ 제외 코드 최초수정 : 230627------------------------------------------}}
{{-- //----------------------------------------------------------------------------------- --}}
 {{-- <div class="Physical-table">
        <div class="info-boxt">
            <table class="info-t">
                <form action="{{ route('user.userKcalup') }}" method="post">
                    @csrf
                <tr>    
                    <th class="info-table"><label for="user_birth">나이(생년월일) : </label><span id="userage"></span></th>
                    <td  class="info-table" colspan="3"><input type="date" name="user_birth" id="user_birth" value= "{{old('user_birth') !== null ? old('user_birth') : $data->user_birth}}"></td>
                </tr>
                <tr>
                    <th class="info-table"><label for="user_tall">키 : </label></th>
                    <td class="info-table" colspan="3"><input type="text" name="user_tall" id="user_tall" value= "{{old('user_tall') !== null ? old('user_tall') : $data->user_tall}}"></td>
            </tr>
            <tr>
                <th class="info-table"><label for="user_weight">몸무게 : </label></th>
                <td class="info-table" colspan="3"><input type="text" name="user_weight" id="user_weight" value= "{{old('user_weight') !== null ? old  ('user_weight') : $data->user_weight}}"></td>
            </tr>
            <tr>
                <th class="info-table"><label for="user_activity">활동량 : </label></th>
                <td class="info-table"><input type="radio" name="user_activity" id="user_activity" value="0">적음(1.2)</td>
                <td class="info-table"><input type="radio" name="user_activity" id="user_activity" value="1">보통(1.55)</td>
                <td class="info-table"><input type="radio" name="user_activity" id="user_activity" value="2">많음(1.9)</td>
            </tr>
                <br>
                <caption><button type = "submit" id="userinfosubmit">기본자료수정</button></caption>
            </table>
        </div>    
    </div>
</div> --}}