@extends('layout.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/board.css') }}">  
@endsection

@section('title', '사용자 음식 등록')
    
@section('contents')
    <div class="shadowYellow">
    <div>사용자 음식 등록</div>
        <form action="{{route('food.store')}}" method="post">
            @csrf
            <div class="foodInsertGrid">
                <div>
                    <div>음식명 입력</div>
                    <input type="text" id="foodName" name="foodName">
                    <br>
                    <div>1회 제공량</div>
                    <input type="text" name="serving">
                    <input type="radio" name="ser_unit" value="0">g
                    <input type="radio" name="ser_unit" value="1">ml
                    <br>
                </div>
                <div>
                    <div>영양 성분</div>
                    <label for="kcal">칼로리(Kcal)</label>
                    <input type="text" id="kcal" name="kcal">
                    <br>
                    <label for="kcal">탄수화물(Carbs)</label>
                    <input type="text" id="carbs" name="carbs">
                    <br>
                    <label for="kcal">단백질(Protein)</label>
                    <input type="text" id="protein" name="protein">
                    <br>
                    <label for="kcal">지방(Fat)</label>
                    <input type="text" id="fat" name="fat">
                    <br>
                    <label for="kcal">당(Sugar)</label>
                    <input type="text" id="sugar" name="sugar">
                    <br>
                    <label for="kcal">나트륨(Sodium)</label>
                    <input type="text" id="sodium" name="sodium">
                    <br>
                </div>
            </div>
            <button>취소</button>
            <button type="submit" href="">입력</button>
        </form>
    </div>
@endsection