@extends('layout.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/prevateinfo.css') }}">
@endsection


@section('contents')
    <span class="mNav">
        <a href="{{route('user.userinfoedit')}}">나의 정보</a>
        <a href="{{route('user.userpsedit')}}">비밀번호 변경</a>
        <a href="{{route('user.prevateinfo')}}">식단 설정 변경</a>
    </span>
    <div class="boardCon">
        <div class="dis-left"></div>
        <div class="boardNavDiv">
            <div>회원 정보</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('user.userinfoedit')}}">나의 정보</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('user.userpsedit')}}">비밀번호 변경</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('user.prevateinfo')}}">식단 설정 변경</a>
                </li>
            </ul>
        </div>
        <div class="prevateConDiv">
            @yield('prevateinfocontents')
            @yield('userinfocontents')
            @yield('passwordcontents')
        </div>
        <div class="dis-right"></div>
    </div>
@endsection