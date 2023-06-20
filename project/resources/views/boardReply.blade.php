<div class="shadowYellow">
    @forelse ($reply as $item)
        <div>{{$item->rcontent}}</div>
        <div>{{$item->nkname}}</div>
        <div>{{substr($item->created_at, 0, 10)}}</div>
        <hr>
    @empty
        <div>댓글이 없습니다</div>
    @endforelse
    <form action="{{route('board.replyPost')}}" method="post">
        @csrf
        <input type="hidden" name="board_id" value="{{$data['id']}}">
        <textarea textarea name="reply" id="reply" cols="30" rows="10" placeholder="댓글을 작성하세요."></textarea>
        <button type="sumbit">작성</button>
    </form>
</div>