@extends('layout.boardNav')

@section('title', '게시글 상세')

@section('boardContent')
    <div class="shadowWhite">
        <div class="divUnderShadow">
            <div class="boardDetailTitle">
                <div>{{$data['title']}}</div>
                <div>{{$data['cate']}}</div>
                <div>{{$data['nkname']}}</div>
                <div>{{substr($data['created_at'], 0, 16)}}</div>
                <div><i class="bi bi-bar-chart-fill"></i> {{number_format($data['hits'])}}</div>
            </div>
            <div class="boardDetailContet">
                @if (isset($data['img']))
                <div class="imgDiv">
                    <img src="{{asset('storage/images/board/'.$data['img'])}}" class="img-fluid" alt="1">
                </div>
                @endif
                <span>{!! $data['content']!!}</span>
                <div> {{-- 게시글에 입력한 식단 출력 div --}}
                    @foreach ($diet as $foods)
                        <span>{{$foods->food_name}}</span>
                        <span>{{$foods->fav_f_intake}}</span>
                        <br>
                    @endforeach
                    {{-- todo : 식단 내려받기 함수 구현 --}}
                    @if ($data['fav_id'] != 0)
                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal0">식단 내려받기</button>
                        {{-- 식단 명 입력 alert --}}
                        <div class="modal fade" id="exampleModal0" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">식단 즐겨찾기에 추가하기</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="fw-bold">식단명을 입력해주세요</p>                                     
                                        <form action="{{route('board.dietdownload', ['favid' => $data['fav_id']])}}" method="post">
                                            @csrf
                                            <input type="text" name="fav_name" required placeholder="식단명을 입력해주세요." autocomplete="off" maxlength="10">
                                            <button type="submit" class="greenBtn">등록하기</button>
                                        </form>
                                    </div>
                                </div>
                            </div> 
                        </div>         
                    @endif
                </div>
                <div class="likeDiv">
                    <input type="hidden" id="value1" value="{{session('user_id')}}">
                    <input type="hidden" id="value2" value="{{$data['id']}}">
                    <button
                        class="likeUpDown"
                    @if ($data['like_flg'] === 1)
                        id="greenBtn"
                    @endif
                        type="button"
                        onclick="likeUpDown()"
                        >좋아요 <span id="likes">{{$data['like']}}</span>
                    </button>
                </div>
    
                {{-- todo @can 방법 : https://laracasts.com/series/laravel-6-from-scratch/episodes/50 --}}
                @if (Auth::user()->user_id === $data['user_id'] || Auth::user()->user_id === 0)
                <div class="rigtTwoBtnDiv">
                    @if (Auth::user()->user_id !== 0)
                        <button
                            type="button"
                            onclick="location.href='{{route('board.edit', ['board' => $data['id']])}}'"
                            id="greenBtn"
                            >글 수정
                        </button>
                    @endif
                    <button type="button" id="greenBtn" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                        글 삭제
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">게시글 삭제</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                정말 삭제하시겠습니까?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" data-bs-dismiss="modal">취소</button>
                                    <form action="{{route('board.destroy', ['board' => $data['id']])}}" method='post'>
                                        @csrf
                                        @method('delete')
                                        <button type="submit" id="greenBtn">삭제</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @include('boardReply')
    </div>
@endsection