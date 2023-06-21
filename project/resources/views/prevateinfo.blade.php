@extends('layout.layout')

@section('title', 'regist')

@section('contents')

<form action="{{route('user.userKcaledit')}}" method="post">
    @csrf
<label for="nutrition_ratio">식단 설정 :</label>
<input type="radio" name="nutrition_ratio" id="nutrition_ratio" value="0">일반식단(탄수화물 50, 단백질 30, 지방 20)<br>
<input type="radio" name="nutrition_ratio" id="nutrition_ratio" value="1">운동식단(탄수화물 40, 단백질 40, 지방 20)<br>
<input type="radio" name="nutrition_ratio" id="nutrition_ratio" value="2">키토식단(탄수화물 8, 단백질 22, 지방 70)<br>
<input type="radio" name="nutrition_ratio" id="nutrition_ratio" value="3">비건식단(탄수화물 50, 단백질 30, 지방 20)<br>
<br>

<label for="goal_kcal">목표칼로리 : </label>
<input type="number" name="goal_kcal" id="goal_kcal" placeholder="목표칼로리를 입력해 주세요">
<button type="button" id="suggest">추천받기</button>
<br>
<br>
<br>
<label for="gender">성별</label>
<input type="radio" name="gender" id="gender" value="0" readonly>남자
<input type="radio" name="gender" id="gender" value="1" readonly>여자
<br>
<label for="age">나이 :</label>
<input type="number" name="age" id="age">
<br>
<label for="tall">키(cm) :</label>
<input type="number" name="tall" id="tall">
<br>
<label for="weight">몸무게(Kg) :</label>
<input type="number" name="weight" id="weight">
<br>
<label for="acctivaty">활동량 :</label>
<input type="radio" name="acctivaty" id="acctivaty" value="0">적음<br>
<input type="radio" name="acctivaty" id="acctivaty" value="1">보통<br>
<input type="radio" name="acctivaty" id="acctivaty" value="2">많음<br>
<br>
<br>
<button type ="submit">입력</button>
<button type ="button" onclick="location.href='{{route('home')}}'">취소</button>
</form>


@section('js')
    <script src="{{ asset('js/kcal.js') }}"></script>
@endsection


@endsection
