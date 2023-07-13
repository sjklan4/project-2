@extends('layout.layout')

@section('title', 'FoodSearch')

@section('css')
    <link rel="stylesheet" href="{{asset('css/search.css')}}">
@endsection

@section('contents')
    <div>
        <h1>식단 추천</h1>
        <div>
            {{-- <h2>어떤 유형</h2> --}}
            <button>감량</button>
            <button>증량</button>
            <button>건강식</button>
        </div>
        {{-- <hr>
        <div>
            <h2>추천 음식</h2>

        </div>
        <hr>
        <div>
            <h2>총 영양성분</h2>
        </div>
        <button></button>
        <button></button> --}}
    </div>
@endsection

@section('js')

@endsection