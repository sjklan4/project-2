@extends('layout.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/board.css') }}">  
@endsection

@section('contents')
    <div class="boardCon">
        <div>
            <div>게시판</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('board.index')}}">전체</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('board.indexNum', ['board' => 1])}}">건강 관리</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('board.indexNum', ['board' => 2])}}">다이어트</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('board.indexNum', ['board' => 3])}}">10대</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('board.indexNum', ['board' => 4])}}">20대</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('board.indexNum', ['board' => 5])}}">30대</a>
                </li>
            </ul>
        </div>
        <div>
            @yield('boardContent')
        </div>
    </div>
@endsection

