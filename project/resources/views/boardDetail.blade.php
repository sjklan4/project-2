@extends('layout.boardNav')

@section('title', '게시글 상세')

@section('boardContent')
    <div class="shadow">
        <div class="boardDetailTitle">
            <div>{{$data['cate']}}</div>
            <div>{{$data['title']}}</div>
            <div>{{$data['nkname']}}</div>
            <div>{{$data['created_at']}}</div>
            <div>{{$data['hits']}}</div>
        </div>
        <div class="boardDetailContet">
            @if (isset($data['img']))
            <div class="imgDiv">
                <img src="{{asset('storage/images/board/'.$data['img'])}}" class="img-fluid" alt="1">
            </div>
            @endif
            <p>{{$data['content']}}</p>
            <button
                type="button"
                onclick="location.href='{{route('board.like', ['board' => $data['id']])}}'"
                >좋아요 {{$data['like']}}
            </button>

            {{-- todo @can 방법 : https://laracasts.com/series/laravel-6-from-scratch/episodes/50 --}}
            @if (Auth::user()->user_id === $data['user_id'] || Auth::user()->user_id === 0)
                <form action="{{route('board.destroy', ['board' => $data['id']])}}" method='post'>
                    @if (Auth::user()->user_id !== 0)
                        <button
                            type="button"
                            onclick="location.href='{{route('board.edit', ['board' => $data['id']])}}'"
                            >글 수정
                        </button>
                    @endif
                    @csrf
                    @method('delete')
                    <button type="submit">글 삭제</button>
                </form>
            @endif
        </div>
    </div>
    @include('boardReply')
@endsection