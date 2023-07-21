@extends('layout.layout')
@section('contents')
    @forelse ($report_info as $item)
        <ul>
            <li>
                {{$item->reporter}}
                {{$item->suspect}}
                {{$item->report_num}}
                board_id{{$item->board_id}}
                reply_id{{$item->reply_id}}
                {{$item->rep_flg}}
                {{-- {{$item->rep_r_content}} --}}
                {{$item->complate_flg}}
                {{$item->created_at}}
                @if ($item->complate_flg == 0)
                    <span>대기</span>
                @else
                    <span>완료</span>   
                @endif
                <button type="button" onclick="detailReport('{{$item->rep_id}}', '{{$item->board_id}}')" data-bs-toggle="modal" data-bs-target="#detailreport">자세히 보기</button>
            </li>
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
                                </div>
                                <button type="submit" name="complate" value="0">철회</button>
                                <button type="submit" name="complate" value="1">확인</button>
                            </form>
                        </div>
                    </div>
                </div>                    
            </div>
        </ul>
    @empty
        <ul>
            <li>신고 없음</li>
        </ul>
    @endforelse
@endsection
@section('js')
<script type="text/javascript" src="{{asset('js/report.js')}}"></script>
@endsection