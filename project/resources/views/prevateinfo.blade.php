@extends('layout.userinfoNav')

@section('title', 'prevateinfo')

@section('prevateinfocontents')
<div class="prvateinfo">
    <form action="{{route('user.userKcaledit')}}" method="post">
        @csrf
        <div class="shadowYellow">
            <div><h1>식단 설정</h1>
            <table>
                <tr><td class="diechk-td" rowspan="5"><label for="nutrition_ratio">식단 설정 :</label></td></tr>
                <tr><td colspan="2"><input type="radio" name="nutrition_ratio" id="nutrition_ratio" value="0">일반식단(탄수화물 50, 단백질 30, 지방 20)</td></tr>
                <tr><td colspan="2"><input type="radio" name="nutrition_ratio" id="nutrition_ratio" value="1">운동식단(탄수화물 40, 단백질 40, 지방 20)</td></tr>
                <tr><td colspan="2"><input type="radio" name="nutrition_ratio" id="nutrition_ratio" value="2">키토식단(탄수화물 8, 단백질 22, 지방 70)</td></tr>
                <tr><td colspan="2"><input type="radio" name="nutrition_ratio" id="nutrition_ratio" value="3">비건식단(탄수화물 50, 단백질 30, 지방 20)</td></tr>
                    <td class="diechk-td">
                        <label for="goal_kcal">목표칼로리 : </label>
                    </td>
                    <td colspan="2" class="goal_kcal_input">
                        <input type="number" name="goal_kcal" id="goal_kcal" placeholder="목표칼로리를 입력해 주세요">Kcal
                    </td>
                    <td>
                        <div class="hover-btn">
                            <span> 
                                <div class="button btn-stlye">   
                                    <button type="button" id="suggest"  class="greenBtn">추천받기</button>
                                </div>
                            </span>
                            <p class="arrow_box">추천이 필요 하시면 아래 정보를 입력해주세요</p>
                        </div> 
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="btn"><button type ="submit" id="modal" class="greenBtn">입  력</button></div>  
</div>
<div class="modal_wrap">
    <div class="shadowYellow">
        <table>
            <tr>
                <td><label for="gender">성별 : </label></td>
                <td>
                    <input type="radio" name="gender" id="gender" value="0" class="genman"  readonly>남자<img src="{{ asset('img/manmark.png') }}">
                    <input type="radio" name="gender" id="gender" value="1" class="genwoman" readonly>여자<img src="   {{asset('img/womanmark.png')}}">
                </td>
            </tr>
            <tr>
                <td><label for="user_birth">나이 : </label></td>
                <td><input type="date" name="user_birth" id="user_birth"></td>
            </tr>
            <tr>
                <td><label for="tall">키(cm) : </label></td>
                <td><input type="number" name="tall" id="tall"></td>
            </tr>
            <tr>
                <td><label for="weight">몸무게(Kg) : </label></td>
                <td><input type="number" name="weight" id="weight"></td>
            </tr>
            <tr>
                <div class="form_radio_btn">
                    
                    <td><label for="acctivaty">활동량 : </label></td>
                    <td>    
                        <input type="radio" name="acctivaty" id="acctivaty0" value="0">적음
                        <input type="radio" name="acctivaty" id="acctivaty1" value="1">보통
                        <input type="radio" name="acctivaty" id="acctivaty2" value="2">많음
                    </td>
                </div>
            </tr>
            <tr>
                <td><label for="calcul-kcal">추천칼로리 : </label></td>
                <td><input type="text" name="calcul-kcal" id="calcul-kcal" placeholder="추천 칼로리">Kcal</td>
            </tr>
            <tr>        
                <td><div><button type="button" id="suggest-cal" class="greenBtn">계산</button></div></td>
                <td><div><button type="button" id="suggest-insert" class="greenBtn">입력</button></div></td>
            </tr>    
        </table>
        <div class="exit">X</div>
    </div>
</form>
</div>

@endsection

@section('js')
    <script src="{{ asset('js/suggestkcal.js') }}"></script>
@endsection


