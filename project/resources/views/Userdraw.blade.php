@extends('layout.userinfoNav')

@section('title','회원탈퇴')

@section('userdrawcontents')
        <div class="col-md-8 offset-lg-1 pb-5 mb-lg-2 mb-lg-4 pt-md-5 mt-n3 mt-md-0">
            <div class="ps-md-3 ps-lg-0 mt-md-2 pt-md-4 pb-md-2">
                <div class="drawinfo">
                    <h2>
                        확인해 주세요!
                    </h2>
                    <div class="memo">
                        <p>
                            1. 탈퇴 후 계정 정보가 삭제되며, 복원할 수 없습니다.
                        </p>
                        <p>
                            2. 탈퇴 후 서비스 내 정보 및 서비스 이용기록은 사용이 불가합니다.
                        </p>
                        <p>
                            3. 삭제나 백업을 원하는 데이터가 있다면 반드시 탈퇴 전에 확인하시기 바랍니다.
                        </p>
                    </div>
                </div>
                <h1 class="h2 pt-xl-1 pb-3">password check</h1>
                <!-- Password -->
                {{-- <h2 class="h5 text-primary mb-4">Password</h2> --}}
                        <div class="col-sm-6 mb-4">
                            <label for="bpassword" class="form-label fs-base">Current password</label>
                            <div class="password-toggle">
                            <input type="password" class="form-control form-control-lg" name="bpassword" id="bpassword" required>
                            <input type="hidden" id="id" value={{session('user_id')}}>
                            {{-- <label class="password-toggle-btn" aria-label="Show/hide password">
                                <input class="password-toggle-check" type="checkbox">
                                <span class="password-toggle-indicator"></span>
                            </label> --}}

                            <div class="invalid-tooltip position-absolute top-100 start-0"></div>
                            </div>
                        </div>
            <div class="d-flex mb-3">
                <button type="button" id="passwordchg" class="btn btn-success me-3" onclick="chkpass();">비밀번호확인</button>
                <button type="button" id="drawbutton" class="btn btn-success" onclick="userdraw();" disabled>회원탈퇴하기</button>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/userdraw.js') }}"></script>
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