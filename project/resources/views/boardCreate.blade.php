@extends('layout.boardNav')

@section('title', '게시글 작성')

@section('boardContent')
    <form action="{{route('board.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="shadowYellow">
            <div id="boardInserDiv">
                <div>
                    <div class="errorMsg">{{count($errors) > 0 ? $errors->first('cate', ':message') : ''}}</div>
                    <label for="cate">카테고리</label>
                    <select name="cate" id="cate">
                        <option value="1" {{ old('cate') == 1 ? 'selected' : '' }}>건강 관리</option>
                        <option value="2" {{ old('cate') == 2 ? 'selected' : '' }}>다이어트</option>
                        <option value="3" {{ old('cate') == 3 ? 'selected' : '' }}>10대</option>
                        <option value="4" {{ old('cate') == 4 ? 'selected' : '' }}>20대</option>
                        <option value="5" {{ old('cate') == 5 ? 'selected' : '' }}>30대</option>
                    </select>
                </div>
                <div>
                    <div class="errorMsg"></div>
                    <label for="title">제목</label>
                    <span class="errorMsg">{{count($errors) > 0 ? $errors->first('title', ':message') : ''}}</span>
                    <br>
                    <input type="text" name="title" id="title"
                        placeholder='제목을 입력해주세요.'
                        value="{{count($errors) > 0 ? old('title') : ''}}"
                    >
                </div>
                <div>
                    <div class="errorMsg"></div>
                    <label for="content">내용</label>
                    <span class="errorMsg">{{count($errors) > 0 ? $errors->first('content', ':message') : ''}}</span>
                    <br>
                    <div>
                        <textarea name="content" id="content"
                            placeholder='내용을 입력해주세요.'
                            >{{count($errors) > 0 ? old('content') : ''}}</textarea>
                    </div>
                </div>
                <div>
                    <label for="picture">사진</label>
                    <span class="errorMsg">{{count($errors) > 0 ? $errors->first('picture', ':message') : ''}}</span>
                    <br>
                    <span id="pictureSpan">
                        <input type="file" id="picture" name="picture">
                        <div>
                            <button type="button" onclick="resetImg();" id="greenBtn">사진 초기화</button>
                        </div>
                    </span>
                </div>
            </div>
        </div>
        <div class="rigtTwoBtnDiv">
            <button type="button" onclick="location.href='{{ route('board.index') }}'">취소</button>
            <button type="submit" id="greenBtn">작성</button>
        </div>
    </form>
@endsection