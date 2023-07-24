@extends('layout.layout')
@section('title', '신고')
@section('css')
    <link rel="stylesheet" href="{{asset('css/report.css')}}">
@endsection
@section('contents')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">신고 내역</h4>
                    <h6 class="card-subtitle">신고 내역</h6>
                    <div class="table-responsive">
                        <table class="table user-table no-wrap">
                            <thead>
                                <tr>
                                    <th class="border-top-0">신고인 번호</th>
                                    <th class="border-top-0">피신고인 번호</th>
                                    <th class="border-top-0">게시글 번호</th>
                                    <th class="border-top-0">댓글 번호</th>
                                    <th class="border-top-0">신고 사유 카테고리</th>
                                    <th class="border-top-0">신고당한 횟수(피신고인)</th>
                                    <th class="border-top-0">신고일</th>
                                    <th class="border-top-0">신고현황</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($report_info as $item)
                                    <tr onclick="detailReport('{{$item->rep_id}}', '{{$item->board_id}}')" data-bs-toggle="modal" data-bs-target="#detailreport">
                                        <td>{{ $item->reporter }}</td>
                                        <td>{{ $item->suspect }}</td>
                                        @if ($item->board_id != null)
                                            <td>{{ $item->board_id }}</td>
                                        @else
                                            <td>X</td>
                                        @endif
                                        @if ($item->reply_id != null)
                                            <td>{{ $item->reply_id }}</td>
                                        @else
                                            <td>X</td>
                                        @endif
                                        <td>{{ $item->rep_flg }}</td>
                                        <td>{{ $item->report_num }}</td>
                                        <td>{{$item->created_at}}</td>
                                        @if ($item->complate_flg == 0)
                                            <td>대기</td>
                                        @else
                                            <td>완료</td>
                                        @endif
                                    </tr>
                                    <div class="modal fade" id="detailreport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">신고 상세내용</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>신고자 ID 및 이름</h5>
                                                    <span id="reporter"></span>
                                                    <h5>피신고자 ID 및 이름</h5>
                                                    <span id="suspect"></span>
                                                    <h5>신고 내용</h5>
                                                    <span id="report_con"></span>
                                                    <h5>신고 현황</h5>
                                                    <span id="report_com"></span>
                                                    <h5>신고일</h5>
                                                    <span id="report_date"></span>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{route('report.post')}}" method="post">
                                                        @csrf
                                                        <div id="reportBtn">
                                                            <input type="hidden" id="report" name="reportId">
                                                            <input type="hidden" id="board" name="boartId">
                                                            <input type="hidden" id="reply" name="replyId">
                                                            <input type="hidden" id="suspectId" name="userId">
                                                        </div>
                                                        <button type="submit" name="complate" value="0">철회</button>
                                                        <button type="submit" name="complate" value="1">확인</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>                    
                                    </div>
                                @empty
                                    <tr>
                                        <td>신고 없음</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{-- 페이지네이션 --}}
                    @if ($report_info->hasPages())
                        <ul class="pagination pagination">
                            @php
                                $block = 5;
                                $startPage = max(1, $report_info->currentPage() - floor($block / 2));
                                $endPage = min($startPage + $block - 1, $report_info->lastPage());
                            @endphp
        
                            {{-- 첫 페이지 버튼 --}}
                            @if ($report_info->onFirstPage())
                                <li><<</li>
                            @else
                                <li class="active">
                                    <a href="{{ $report_info->url(1) }}" rel="prev"><<</a>
                                </li>
                            @endif
        
                            {{-- 이전 페이지 버튼 --}}
                            @if ($report_info->onFirstPage())
                                <li><</li>
                            @else
                                <li class="active">
                                    <a href="{{ $report_info->previousPageUrl() }}" rel="prev"><</a>
                                </li>
                            @endif
        
                            {{-- 페이징 --}}
                            {{-- range() : 지정된 범위의 숫자를 생성하여 배열로 반환 --}}
                            @foreach(range($startPage, $endPage) as $i)
                                @if ($i == $report_info->currentPage())
                                    <li class="active"><span>{{ $i }}</span></li>
                                @else
                                    <li class="active">
                                        <a href="{{$report_info->url($i)}}">{{$i}}</a>
                                    </li>
                                @endif
                            @endforeach
        
                            {{-- 다음 페이지 버튼 --}}
                            @if ($report_info->hasMorePages())
                                <li class="active">
                                    <a href="{{$report_info->nextPageUrl()}}">></a>
                                </li>
                            @else
                                <li>></li> 
                            @endif
        
                            {{-- 마지막 페이지 --}}
                            @if ($report_info->hasMorePages())
                                <li class="active">
                                    <a href="{{ $report_info->url($report_info->lastPage()) }}" rel="next">>></a>
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
    @endsection
    @section('js')
    <script type="text/javascript" src="{{asset('js/report.js')}}"></script>
    @endsection