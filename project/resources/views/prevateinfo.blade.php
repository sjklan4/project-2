@extends('layout.userinfoNav')

@section('title', 'prevateinfo')

@section('prevateinfocontents')
<div>

</div>
<div class="prvateinfo">
    <h2>Account Details</h2>
    <form action="{{route('user.userKcaledit')}}" method="post">
        @csrf
    <div class="table-diet">
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
                                <button type="button" id="suggest" class="question">추천받기</button>
                            </div>
                        </span>
                        <p class="arrow_box">추천이 필요 하시면 아래 정보를 입력해주세요</p>
                    </div> 
                </td>
            </tr>

        </table>
    </div>
    <div class="line"></div>
        <div class="table-prevate">
            <li class="info-list">
                <label for="gender">성별 : </label>
                <input type="radio" name="gender" id="gender" value="0" class="genman"  readonly>남자</td><img src="{{ asset('img/manmark.png') }}">
                <input type="radio" name="gender" id="gender" value="1" class="genwoman" readonly>여자</td><img src="{{asset('img/womanmark.png')}}">
            </li>
            <li class="info-list">
                <label for="user_birth">나이 : </label>
                <input type="date" name="user_birth" id="user_birth">
            </li>  
            <li class="info-list">
                <label for="tall">키(cm) : </label>
                <input type="number" name="tall" id="tall">
            </li>   
            <li class="info-list">   
                <label for="weight">몸무게(Kg) : </label>
                <input type="number" name="weight" id="weight">
            </li>
            <li class="info-list">
                <div class="form_radio_btn">
                    <label for="acctivaty">활동량 : </label>
                    <input type="radio" name="acctivaty" id="acctivaty0" value="0">적음
                    <input type="radio" name="acctivaty" id="acctivaty1" value="1">보통
                    <input type="radio" name="acctivaty" id="acctivaty2" value="2">많음
                </div>
            </li>   
        </div>
        <div class="button btn-stlye">
            <button type ="submit" id="insert">입  력</button>
            <span id="exit"><a href="{{route('home')}}">취소</a></span>
        </div>
    </form>
</div>

@section('js')
    <script src="{{ asset('js/suggestkcal.js') }}"></script>
@endsection


@endsection
