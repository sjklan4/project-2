@extends('layout.boardNav')

@section('title', '게시판')

@section('boardContent')
    <div class="shadowYellow">
        <button type="button" onclick="location.href='{{route('board.create')}}'">작성하기</button>
        <div class="listCon">
            <table>
                @forelse ($data as $item)
                    <tr>
                        <td>{{$item->bcate_name}}</td>
                        <td><a href="{{route('board.show', ['board' => $item->board_id])}}">{{$item->btitle}}</a></td>
                        <td>{{$item->board_hits}}</td>
                        <td>{{$item->likes}}</td>
                        <td>3</td>
                    </tr>
                @empty
                <tr>
                    <td></td>
                    <td>게시글 없음</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforelse
            </table>
            @if ($data->hasPages())
                <ul class="pagination pagination">
                @if ($data->currentPage() > 1)
                    <a href="{{ $data->previousPageUrl() }}"><span class="fa fa-chevron-left" aria-hidden="true">이전</span></a>
                @else
                    <span>이전</span>
                @endif

                @for($i = 1; $i <= $data->lastPage(); $i++)
                    @if ($i == $data->currentPage())
                        <li class="active"><span>{{ $i }}</span></li>
                    @else
                        <li><a href="{{ $data->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endfor
                
                @if ($data->currentPage() < $data->lastPage() )
                    <a href="{{$data->nextPageUrl()}}"><span class="fa fa-chevron-right" aria-hidden="true">이후</span></a>
                @else
                    <span>이후</span>
                @endif
                </ul>
            @endif
        </div>
    </div>
@endsection