@extends('layout.boardNav')

@section('title', '게시글 수정')

@section('boardContent')
    <form action="{{ route('board.update', ['board' => $data->board_id]) }}" method="post" enctype="multipart/form-data">
        <div class="shadowYellow">
            @csrf
            @method('put')
            <div>{{count($errors) > 0 ? $errors->first('cate', ':message') : ''}}</div>
            <label for="cate">카테고리</label>
            <select name="cate" id="cate">
                @foreach ($cate as $item)
                    <option
                        value="{{ $item->bcate_id }}" 
                        @if ($item->bcate_id === $data->bcate_id || old('cate') == $item->bcate_id)
                            selected
                        @endif
                        >{{ $item->bcate_name }}
                    </option>
                @endforeach
            </select>
            <br>
            <div>{{count($errors) > 0 ? $errors->first('title', ':message') : ''}}</div>
            <label for="title">제목</label>
            <input type="text" name="title" id="title" value="{{count($errors) > 0 ? old('title') : $data->btitle}}">
            <br>
            <div>{{count($errors) > 0 ? $errors->first('content', ':message') : ''}}</div>
            <label for="content">내용</label>
            <textarea name="content" id="content" cols="40" rows="8">{{count($errors) > 0 ? old('content') : $data->bcontent}}</textarea>
            <br>
            <div>{{count($errors) > 0 ? $errors->first('picture', ':message') : ''}}</div>
            <label for="picture">사진</label>
            <input type="file" id="picture" name="picture">
            <button type="button" onclick="resetImg();">사진 초기화</button>
        </div>
            <button type="button" onclick="location.href='{{ url()->previous() }}'">취소</button>
            <button type="submit">수정</button>
    </form>
@endsection