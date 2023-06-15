@extends('layout.layout')

@section('title', '게시글 작성')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/board.css') }}">  
@endsection

@section('contents')
    <div class="boardCon">
        <div>
            @include('layout.boardNav')
        </div>
        <div>
            <div class="shadowYellow">
                <form action="">
                    <input type="text">
                </form>
            </div>
        </div>
    </div>
@endsection