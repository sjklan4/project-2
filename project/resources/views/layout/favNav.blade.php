@extends('layout.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/favdiet.css') }}">  
@endsection

@section('contents')
    <span class="mNav">
        <a href="{{route('board.index')}}">전체</a>
        <a href="{{route('board.indexNum', ['board' => 1])}}">나의 정보</a>
        <a href="{{route('board.indexNum', ['board' => 2])}}">비밀번호 변경</a>
        <a href="{{route('board.indexNum', ['board' => 3])}}">식단 설정 변경</a>
    </span>
    <div class="boardCon">
        <div class="dis-left"></div>
        <div class="boardNavDiv">
            <div>회원 정보</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('board.index')}}">전체</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('board.indexNum', ['board' => 1])}}">나의 정보</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('board.indexNum', ['board' => 2])}}">비밀번호 변경</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('board.indexNum', ['board' => 3])}}">식단 설정 변경</a>
                </li>
            </ul>
        </div>
        <div class="favConDiv">
            @yield('favdietcontents')
        </div>
        <div class="dis-right"></div>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/board.js')}}"></script>
@endsection