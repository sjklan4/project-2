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

                    @php
                        $block = 5;
                        $startPage = max(1, $data->currentPage() - floor($block / 2));
                        $endPage = min($startPage + $block - 1, $data->lastPage());
                    @endphp

                    {{-- 첫 페이지 버튼 --}}
                    @if ($data->onFirstPage())
                        <li><<</li>
                    @else
                        <li class="active">
                            <a href="{{ $data->url(1) }}" rel="prev"><<</a>
                        </li>
                    @endif

                    {{-- 이전 페이지 버튼 --}}
                    @if ($data->onFirstPage())
                        <li><</li>
                    @else
                        <li class="active">
                            <a href="{{ $data->previousPageUrl() }}" rel="prev"><</a>
                        </li>
                    @endif

                    {{-- 페이징 --}}
                    {{-- range() : 지정된 범위의 숫자를 생성하여 배열로 반환 --}}
                    @foreach(range($startPage, $endPage) as $i)
                        @if ($i == $data->currentPage())
                            <li class="active"><span>{{ $i }}</span></li>
                        @else
                            <li class="active">
                                <a href="{{$data->url($i)}}">{{$i}}</a>
                            </li>
                        @endif
                    @endforeach

                    {{-- 다음 페이지 버튼 --}}
                    @if ($data->hasMorePages())
                        <li class="active">
                            <a href="{{$data->nextPageUrl()}}">></a>
                        </li>
                    @else
                        <li>></li> 
                    @endif

                    {{-- 마지막 페이지 --}}
                    @if ($data->hasMorePages())
                        <li class="active">
                            <a href="{{ $data->url($data->lastPage()) }}" rel="next">>></a>
                        </li>
                    @else
                        <li>>></li> 
                    @endif


                    {{-- @if ($data->currentPage() > 1)
                    <li class="active">
                        <a href="{{ $data->previousPageUrl() }}"><</a>
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
                            <a href="{{$data->nextPageUrl()}}">></a>
                        </li>
                    @else
                        <li>></li>
                    @endif --}}
                </ul>
            @endif
        </div>
    </div>
@endsection