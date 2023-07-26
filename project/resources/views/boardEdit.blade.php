@extends('layout.boardNav')

@section('title', '게시글 수정')

@section('boardContent')
    <form action="{{ route('board.update', ['board' => $data->board_id]) }}" method="post" enctype="multipart/form-data" name="boardForm">
        <div class="shadowYellow">
            <div id="boardInserDiv">
                @csrf
                @method('put')
                <div>
                    <div class="errorMsg">{{count($errors) > 0 ? $errors->first('cate', ':message') : ''}}</div>
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
                </div>
                {{-- v002 add start --}}
                <div>
                    <label for="favdiet">저장된 식단</label>
                    <select name="favdiet" id="favdiet" onchange="DietShare()">
                        <option value="0">선택안함</option>
                        @foreach ($favDiet as $diet)
                        @if($diet->fav_id == $data->fav_id)
                            <option value="{{$diet->fav_id}}" selected>{{$diet->fav_name}}</option>
                        @else
                            <option value="{{$diet->fav_id}}">{{$diet->fav_name}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                {{-- v002 add end --}}
                <div>
                    <div class="errorMsg">{{count($errors) > 0 ? $errors->first('title', ':message') : ''}}</div>
                    <label for="title">제목</label>
                    <input type="text" name="title" id="title" value="{{count($errors) > 0 ? old('title') : $data->btitle}}">
                </div>
                <div>
                    <div class="errorMsg">{{count($errors) > 0 ? $errors->first('content', ':message') : ''}}</div>
                    <label for="content">내용</label>
                    <textarea name="content" id="content" cols="40" rows="8">{{count($errors) > 0 ? old('content') : $data->bcontent}}</textarea>
                </div>
                {{-- v002 add start --}}
                <div> {{-- 저장된 식단 출력 부분 --}}
                    <br>
                    <label for="Diet">식단</label>
                    <div id="Diet">
                        @foreach ($beforeDiet as $foods)
                            <input type="text" value={{$foods->food_name}}>
                            <input type="text" value={{$foods->fav_f_intake}}>
                            <br>
                        @endforeach
                    </div>
                </div>
                {{-- v002 add end --}}
                <div>
                    <label for="picture">사진</label>
                    <span class="errorMsg">{{count($errors) > 0 ? $errors->first('picture', ':message') : ''}}</span>
                    <br>
                    <br>
                    <span id="pictureSpan">
                        <input type="file" id="picture" name="picture" accept="image/*">
                        <div>
                            <button type="button" onclick="resetImg();" id="greenBtn">사진 초기화</button>
                        </div>
                    </span>
                </div>
            </div>
        </div>
        <div class="rigtTwoBtnDiv">
            <button type="button" onclick="location.href='{{ route('board.shows', ['board' => $data->board_id, 'flg' => '1']) }}'">취소</button>
            <button type="button" id="greenBtn" onclick="boardFormChk()">수정</button>
        </div>
    </form>
@endsection