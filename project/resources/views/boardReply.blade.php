<div class="shadowYellow">
    @forelse ($reply as $item)
        <div>{{$item->rcontent}}</div>
        <div>{{$item->nkname}}</div>
        <div>{{substr($item->created_at, 0, 10)}}</div>
        @if (Auth::user()->user_id === $item->user_id)
            <form action="{{route('board.replyDelete', ['board' => $data['id'], 'id' => $item->reply_id])}}" method="post">
                @csrf
                @method('delete')
                <button type="submit">삭제</button>
            </form>
        @endif
        <hr>
    @empty
        <div>댓글이 없습니다</div>
    @endforelse
            @if ($reply->hasPages())
                <ul class="pagination pagination">
                @if ($reply->currentPage() > 1)
                    <a href="{{ $reply->previousPageUrl() }}"><span class="fa fa-chevron-left" aria-hidden="true">이전</span></a>
                @else
                    <span>이전</span>
                @endif

                @for($i = 1; $i <= $reply->lastPage(); $i++)
                    @if ($i == $reply->currentPage())
                        <li class="active"><span>{{ $i }}</span></li>
                    @else
                        <li><a href="{{ $reply->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endfor
                
                @if ($reply->currentPage() < $reply->lastPage() )
                    <a href="{{$reply->nextPageUrl()}}"><span class="fa fa-chevron-right" aria-hidden="true">이후</span></a>
                @else
                    <span>이후</span>
                @endif
                </ul>
            @endif
    <form action="{{route('board.replyPost')}}" method="post">
        @csrf
        <div>{{count($errors) > 0 ? $errors->first('reply', ':message') : ''}}</div>
        <input type="hidden" name="board_id" value="{{$data['id']}}">
        <textarea textarea name="reply" id="reply" cols="30" rows="10" placeholder="댓글을 작성하세요.">{{count($errors) > 0 ? old('reply') : ''}}</textarea>
        <button type="sumbit">작성</button>
    </form>
</div>