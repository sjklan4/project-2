@extends('layout.boardNav')

@section('title', '게시판')

@section('boardContent')
    <div class="shadowYellow">
        <div>
            <div class="rightBtn">
                <button type="button" id="greenBtn" onclick="location.href='{{route('board.create')}}'">작성하기</button>
            </div>
            <div class="listCon">
                <table>
                    @forelse ($data as $item)
                    <tr class="trBasic">
                        <td>{{$item->bcate_name}}</td>
                        <td><a href="{{route('board.show', ['board' => $item->board_id])}}">{{$item->btitle}}</a></td>
                        <td><i class="bi bi-bar-chart-fill"></i> {{number_format($item->hits)}}</td>
                        <td><i class="bi bi-heart-fill"></i> {{number_format($item->likes)}}</td>
                        <td><i class="bi bi-chat-dots-fill"></i> {{number_format($item->replies)}}</td>
                        <td>{{substr($item->created_at, 0, 10)}}</td>
                    </tr>
                    <tr class="trMobile">
                        <td><a href="{{route('board.show', ['board' => $item->board_id])}}">{{$item->btitle}}</a></td>
                    </tr>
                    <tr class="trMobileMargin">
                        <td><i class="bi bi-bar-chart-fill"></i> {{number_format($item->hits)}}</td>
                        <td><i class="bi bi-heart-fill"></i> {{number_format($item->likes)}}</td>
                        <td><i class="bi bi-chat-dots-fill"></i> {{number_format($item->replies)}}</td>
                        <td>{{substr($item->created_at, 0, 10)}}</td>
                    </tr>
                    @empty
                    <tr>
                        <td></td>
                        <td>게시글 없음</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforelse
                </table>
            </div>
            @if ($data->hasPages())
                <ul class="pagination pagination">
                @if ($data->currentPage() > 1)
                <li class="active">
                    <a href="{{ $data->previousPageUrl() }}">
                        <span class="fa fa-chevron-left" aria-hidden="true"><</span>
                    </a>
                </li>
                @else
                    <li><</li>
                @endif

                @for($i = 1; $i <= $data->lastPage(); $i++)
                    @if ($i == $data->currentPage())
                        <li class="active"><span>{{ $i }}</span></li>
                    @else
                        <li><a href="{{ $data->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endfor
                
                @if ($data->currentPage() < $data->lastPage() )
                    <li class="active">
                        <a href="{{$data->nextPageUrl()}}">
                            <span class="fa fa-chevron-right" aria-hidden="true">></span>
                        </a>
                    </li>
                @else
                    <li>></li>
                @endif
                </ul>
            @endif
        </div>
    </div>
@endsection