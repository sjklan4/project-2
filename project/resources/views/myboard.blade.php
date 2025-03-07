@extends('layout.userinfoNav')

@section('title', '나의 작성글')

@section('myboard')
    <div class="col-md-8 offset-lg-1 pb-5 mt-n3 mb-2 mb-lg-4 mt-n3 mt-md-0">
        <div class="ps-md-3 ps-lg-0 mt-md-2 py-md-4">
                <h1 class="h2 pt-xl-1 pb-3">
                    <a href="{{route('user.board')}}" id="boardBtn" class="fc-green">나의 게시글({{$boardCnt}})</a> /
                    <a href="{{route('user.reply')}}" id="replyBtn">나의 댓글({{$replyCnt}})</a>
                </h1>
            <div class="row pb-2">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table user-table no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0" style="max-width: 20px;">no</th>
                                            <th class="border-top-0">게시글 제목</th>
                                            <th class="border-top-0">게시글 생성일</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($data as $item)
                                            <tr>
                                                <td style="max-width: 20px;">{{ $item->board_id }}</td>
                                                <td class="btitle">
                                                    <a href="{{route('board.show', ['board' => $item->board_id])}}">
                                                        @if(isset($item->btitle))
                                                            {{$item->btitle }}                                                 
                                                        @elseif(isset($item->rcontent))
                                                            {{$item->rcontent }}
                                                        @endif
                                                    </a>
                                                </td>
                                                <td>{{ $item->created_at }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td></td>
                                                <td>작성한 글이 없습니다.</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{-- 페이지네이션 --}}
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
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('subjs')
    <script src="{{ asset('js/myboard.js') }}"></script>
@endsection
