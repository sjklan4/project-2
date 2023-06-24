@extends('layout.boardNav')

@section('title', '게시글 상세')

@section('boardContent')
    <div class="shadow">
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
                <p>{{$data['content']}}</p>
                <div class="likeDiv">
                    <button
                        type="button"
                        onclick="location.href='{{route('board.like', ['board' => $data['id']])}}'"
                        >좋아요 {{$data['like']}}
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