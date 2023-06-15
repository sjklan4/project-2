@extends('layout.layout')

@section('title', '게시글 상세')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/board.css') }}">  
@endsection

@section('contents')
    <div class="boardCon">
        <div>
            @include('layout.boardNav')
        </div>
        <div>
            <div class="shadow">
                <div class="boardDetailTitle">
                    <div>{{$data['cate']}}</div>
                    <div>{{$data['title']}}</div>
                    <div>생성일</div>
                    <div>{{$data['hits']}}</div>
                </div>
                <div class="boardDetailContet">
                    <p>{{$data['content']}}</p>
                    <button type="button" onclick="location.href='{{route('board.like', ['board' => $data['id']])}}'">좋아요 {{$data['like']}}</button>
                    <button type="button" onclick="location.href='{{route('board.edit', ['board' => $data['id']])}}'">글 수정</button>
                    <button>글 삭제</button>
                </div>
            </div>
        </div>
    </div>
@endsection