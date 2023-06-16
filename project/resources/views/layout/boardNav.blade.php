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
                    <a class="nav-link" href="{{route('board.index', ['board' => 0])}}">전체</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">건강 관리</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">다이어트</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">10대</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">20대</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">30대</a>
                </li>
            </ul>
        </div>
        <div>
            @yield('boardContent')
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/board.js') }}"></script>
@endsection
