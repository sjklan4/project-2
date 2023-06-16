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
                    <button
                        type="button"
                        onclick="location.href='{{route('board.like', ['board' => $data['id']])}}'"
                        >좋아요 {{$data['like']}}
                    </button>

                    {{-- todo @can 방법 : https://laracasts.com/series/laravel-6-from-scratch/episodes/50 --}}
                    @if (Auth::user()->user_id === $data['user_id'])
                        <form action="">
                            <button
                                type="button"
                                onclick="location.href='{{route('board.edit', ['board' => $data['id']])}}'"
                                >글 수정
                            </button>
                            <button
                                type="button"
                                onclick="location.href='{{route('board.destroy', ['board' => $data['id']])}}'"
                                >글 삭제
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection