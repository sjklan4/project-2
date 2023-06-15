@extends('layout.layout')

@section('title')
    {{$id}}'s HOME
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('contents')
    <div id="wrap">
        <h1>{{$id}}'s HOME</h1>
        <div id="dateArea">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="20" fill="#538E04" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                </svg>
            </div>
            <div class="dateBox">오늘</div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="30" fill="#538E04" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                </svg>
            </div>
        </div>
        <hr class="bc-green">
        <div id="myDiet">
            <div class="box1">
                <div class="kcal"></div>
                <div class="tdg1"></div>
            </div>
            <div class="box2">
                <div class="box3"></div>
                <div class="box4"></div>
            </div>
        </div>
        <hr class="bc-green">
    </div>
@endsection