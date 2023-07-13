@extends('layout.layout')

@section('title', 'FoodSearch')

@section('css')
    <link rel="stylesheet" href="{{asset('css/search.css')}}">
@endsection

@section('contents')
    <div>
        <h1>식단 추천</h1>
        @if (!userinfo)
            <form action="{{route('recommend')}}" method="get">
                <span>식단 유형 > </span>
                <input type="checkbox" name="dietcate" id="loseweight" value="0">
                <label for="loseweight">감량</label>
                <input type="checkbox" name="dietcate" id="increase" value="1">female
                <label for="increase">증량</label>
                <input type="checkbox" name="dietcate" id="health" value="2">
                <label for="health">일반</label>
                <br>
                <p>성별</p>
                <label for="male">남자</label>
                <input type="radio" name="gender" id="male" value="0">
                <label for="female">여자</label>
                <input type="radio" name="gender" id="female" value="1">
                <p>키</p>
                <input type="text" name="height" id="height">
                <p>몸무게</p>
                <input type="text" name="weight" id="weight">
                <p>나이</p>
                <input type="text" name="age" id="age">
                <br>
                <p>활동량</p>
                <input type="checkbox" name="activity" id="lessact" value="0">
                <label for="lessact">적음</label>
                <input type="checkbox" name="activity" id="nomalact" value="1">female
                <label for="nomalact">보통</label>
                <input type="checkbox" name="activity" id="moeract" value="2">
                <label for="moeract">많음</label></label>
                <br>
                <button type="submit">추천받기</button>
            </form>
        @else
        <form action="{{route('recommend')}}" method="get">
            <span>식단 유형 > </span>
            <input type="checkbox" name="dietcate" id="loseweight" value="0">
            <label for="loseweight">감량</label>
            <input type="checkbox" name="dietcate" id="increase" value="1">female
            <label for="increase">증량</label>
            <input type="checkbox" name="dietcate" id="health" value="2">
            <label for="health">일반</label>
            <br>
            <button type="submit">추천받기</button>
        </form>
        @endif
        
        {{-- <hr>
        <div>
            <h2>추천 음식</h2>

        </div>
        <hr>
        <div>
            <h2>총 영양성분</h2>
        </div> --}}
    </div>
@endsection

@section('js')

@endsection