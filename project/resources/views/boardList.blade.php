@extends('layout.layout')

@section('title', '게시판')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/board.css') }}">  
@endsection

@section('contents')
    <div class="boardCon">
        <div>
            @include('layout.boardNav')
        </div>
        <div>
            @section('boardContents')
            <a href="{{route('board.create')}}">작성하기</a>
            <table>
                <tr>
                    <th>글제목</th>
                    <th>조회수</th>
                    <th>좋아요수</th>
                    <th>댓글수</th>
                </tr>
                <tr>
                    <td>게시글 없음</td>
                    <td>30</td>
                    <td>3</td>
                    <td>2</td>
                </tr>
            </table>
            @show
        </div>
    </div>
@endsection