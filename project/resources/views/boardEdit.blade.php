@extends('layout.boardNav')

@section('title', '게시글 수정')

@section('boardContent')
    <form action="{{route('board.update', ['board' => $data->board_id])}}" method="post" enctype="multipart/form-data">
        <div class="shadowYellow">
            @csrf
            @method('put')
            <label for="cate">카테고리</label>
            <select name="cate" id="cate">
                <option value="1">건강 관리</option>
                <option value="2">다이어트</option>
                <option value="3">10대</option>
                <option value="4">20대</option>
                <option value="5">30대</option>
            </select>
            <br>
            <label for="title">제목</label>
            <input type="text" name="title" id="title" value="{{$data->btitle}}">
            <br>
            <label for="content">내용</label>
            <textarea name="content" id="content" cols="40" rows="8">{{$data->bcontent}}</textarea>
            <br>
            <label for="picture">사진</label>
            <input type="file" id="picture" name="picture">
            <button type="button" onclick="resetImg();">사진 초기화</button>
        </div>
            <button type="button" onclick="location.href='{{ url()->previous() }}'">취소</button>
            <button type="submit">수정</button>
    </form>
@endsection