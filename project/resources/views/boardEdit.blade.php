@extends('layout.layout')

@section('title', '게시글 수정')

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
                <form action="{{route('board.update', ['board' => $data['id']])}}" method="post">
                    @csrf
                    @method('put')
                    <label for="cate">카테고리</label>
                    <select name="cate" id="cate">
                        <option value="0">건강 관리</option>
                        <option value="1">다이어트</option>
                        <option value="2">10대</option>
                        <option value="3">20대</option>
                        <option value="4">30대</option>
                    </select>
                    <br>
                    <label for="title">제목</label>
                    <input type="text" name="title" id="title" value="{{$data['title']}}">
                    <br>
                    <label for="content">내용</label>
                    <textarea name="content" id="content" cols="40" rows="8">{{$data['content']}}</textarea>
                    <br>
                    <label for="pic">사진</label>
                    <input type="file" name="pic" id="pic">
                    <button type="button" onclick="location.href='{{ url()->previous() }}'">취소</button>
                    <button type="submit">작성</button>
                </form>
            </div>
        </div>
    </div>
@endsection