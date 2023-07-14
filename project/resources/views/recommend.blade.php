@extends('layout.layout')

@section('title', 'FoodSearch')

@section('css')
    <link rel="stylesheet" href="{{asset('css/search.css')}}">
@endsection

@section('contents')
    <div>
        <h1>식단 추천</h1>
        {{-- @if (!$userkcal) --}}
            <form action="{{route('recom.post')}}" method="post">
                @csrf
                <span>식단 유형 > </span>
                <input type="radio" name="dietcate" id="loseweight" value="0">
                <label for="loseweight">감량</label>
                <input type="radio" name="dietcate" id="increase" value="1">
                <label for="increase">증량</label>
                <input type="radio" name="dietcate" id="health" value="2">
                <label for="health">일반</label>
                <br>
                {{-- <span>성별</span>
                <input type="radio" name="gender" id="male" value="0">
                <label for="male">남자</label>
                <input type="radio" name="gender" id="female" value="1">
                <label for="female">여자</label>
                <br>
                <span>키</span>
                <input type="text" name="height" id="height">
                <br>
                <span>몸무게</span>
                <input type="text" name="weight" id="weight">
                <br>
                <span>나이</span>
                <input type="text" name="age" id="age">
                <br>
                <span>활동량</span>
                <input type="radio" name="activity" id="lessact" value="0">
                <label for="lessact">적음</label>
                <input type="radio" name="activity" id="nomalact" value="1">
                <label for="nomalact">보통</label>
                <input type="radio" name="activity" id="moeract" value="2">
                <label for="moeract">많음</label></label>
                <br> --}}
                <button type="submit">추천받기</button>
            </form>
        {{-- @else
        <form action="{{route('recom.post')}}" method="post">
            @csrf
            <span>식단 유형 > </span>
            <input type="radio" name="dietcate" id="loseweight" value="0">
            <label for="loseweight">감량</label>
            <input type="radio" name="dietcate" id="increase" value="1">
            <label for="increase">증량</label>
            <input type="radio" name="dietcate" id="health" value="2">
            <label for="health">일반</label>
            <br>
            <button type="submit">추천받기</button>
        </form>
        @endif --}}
        
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