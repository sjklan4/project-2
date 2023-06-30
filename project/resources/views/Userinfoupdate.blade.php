@extends('layout.userinfoNav')

@section('title', 'inforupdate')

@section('userinfocontents')
<div class="shadowYellow">
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
                    <td class="info-table"><input type="text" name="nkname" id="nkname" value= "{{old('nkname') !== null ? old('nkname') : $data->nkname}}"></td>
                </tr>
                <tr>
                    <th class="info-table"><label for="user_phone_num">전화번호  </label></th>
                    <td class="info-table"><input type="text" name="user_phone_num" id="user_phone_num" value= "{{old('user_phone_num') !== null ? old('user_phone_num') : $data->user_phone_num}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"></td>
                </tr>
                    <caption><button type = "submit" id="greenBtn">정보수정</button></caption>
                </form>
            </table>
        </div>    
    </div>
</div>

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