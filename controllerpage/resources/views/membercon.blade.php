@extends('layout.layout')
@section('title', '회원관리')
@section('css')
    <link href="{{asset('css/food.css')}}" rel="stylesheet">
@endsection
@section('contents')
<div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">회원 관리</h4>
                                <h6 class="card-subtitle">회원정보 <code>.관리자용</code></h6>
                                <div class="table-responsive">
                                    <table class="table user-table no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">회원 번호</th>
                                                <th class="border-top-0">회원 이름</th>
                                                <th class="border-top-0">닉네임</th>
                                                <th class="border-top-0">연락처</th>
                                                <th class="border-top-0">가입일</th>
                                                <th class="border-top-0">유저상태 번호</th>
                                                <th class="border-top-0">유저전환여부</th>
                                                {{-- <th class="border-top-0">신고받은 횟수</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                            <form action="{{ route('member.memberstop', ['id' => $item->user_id])}}" method="post">
                                                @csrf

                                                <tr>
                                                    <td class="user_id">{{ $item->user_id }}</td>
                                                    <td>{{ $item->user_email }}</td>
                                                    <td>{{ $item->user_name }}</td>
                                                    <td>{{ $item->user_phone_num }}</td>
                                                    <td>{{ $item->created_at }}</td>
                                                    <td>{{$item->user_status}}</td>
                                                    <td>
                                                        @if($item->user_status === '3')
                                                            정지된 회원입니다.
                                                                <button type="button" class="releasebtn" onclick="release({{ $item->user_id }})">
                                                                    복구
                                                                </button>
                                                            @elseif($item->user_status !== '3')
                                                        <button type="submit" class = "delBtn">정지</button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </form>   
                                        @endforeach
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
@endsection

@section('js')
    <script src="/js/member.js"></script>
@endsection