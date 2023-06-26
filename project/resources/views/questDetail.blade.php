@extends('layout.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/board.css') }}">  
@endsection

@section('contents')
    <h1>퀘스트 관리</h1>
    <div>
        <div>
            <div>
                <h5>진행 정보</h5>
                <progress value="20" max="200"></progress>
                <div>3</div>
            </div>
        </div>
        <br><br>
        <div>
            <h5>오늘 퀘스트 완료</h5>
            <div>퀘스트 내용</div>
            <div>2023-06-26</div>
            <button>완료</button>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/board.js')}}"></script>
@endsection