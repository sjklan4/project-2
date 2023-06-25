@extends('layout.boardNav')

@section('title', '게시글 작성')

@section('boardContent')
    <div class="shadow">
        <form action="{{route('board.store')}}" method="post">
            @csrf
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
            <input type="text" name="title" id="title" placeholder="제목을 입력해주세요.">
            <br>
            <label for="content">내용</label>
            <textarea name="content" id="content" placeholder="내용을 입력해주세요." cols="40" rows="8"></textarea>
            <br>
            <label for="pic">사진</label>
            <input type="file" name="pic" id="pic">
            <button type="button" onclick="location.href='{{ url()->previous() }}'">취소</button>
            <button type="submit">작성</button>
        </form>
    </div>
@endsection