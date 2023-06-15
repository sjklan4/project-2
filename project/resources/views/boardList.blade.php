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
            <div class="shadowYellow">
                <a href="{{route('board.create')}}">작성하기</a>
                <div class="listCon">
                    <table>
                        @forelse ($data as $item)
                            <tr>
                                <td>{{$item->bcate_name}}</td>
                                <td><a href="{{route('board.show', ['board' => $item->board_id])}}">{{$item->btitle}}</a></td>
                                <td>{{$item->board_hits}}</td>
                                <td>{{$item->likes}}</td>
                                <td>3</td>
                            </tr>
                        @empty
                        <tr>
                            <td></td>
                            <td>게시글 없음</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection