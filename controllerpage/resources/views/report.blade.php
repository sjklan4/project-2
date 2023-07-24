@extends('layout.layout')
@section('css')
    <link rel="stylesheet" href="{{asset('css/report.css')}}">
@endsection
@section('contents')
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                {{-- 로고 --}}
                <div class="navbar-header" data-logobg="skin6">
                    <a class="navbar-brand" href="index.html">
                        <b class="logo-icon">
                            {{-- <img src="{{asset('img/logo.png')}}" alt="logo" class="dark-logo"> --}}
                            <img src="temple/assets/images/logo-icon.png" alt="homepage" class  ="dark-logo" />

                        </b>
                        <span class="logo-text">
                            <img src="temple/assets/images/logo-text.png" alt="homepage" class="dark-logo" />

                        </span>
                    </a>
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- 검색창 -->
                    <ul class="navbar-nav me-auto mt-md-0 ">
                        <li class="nav-item hidden-sm-down">
                            <form class="app-search ps-3">
                                <input type="text" class="form-control" placeholder="Search for..."> <a
                                    class="srh-btn"><i class="ti-search"></i></a>
                            </form>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="temple/assets/images/users/1.jpg" alt="user" class="profile-pic me-2">Markarn Doe
                            </a>
                            <ul class="dropdown-menu show" aria-labelledby="navbarDropdown"></ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- 네비게이션 사이드 바 -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="index.html" aria-expanded="false"><i class="me-3 far fa-clock fa-fw"
                                    aria-hidden="true"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('member.memberlist')}}" aria-expanded="false">
                                <i class="me-3 fa fa-user" aria-hidden="true"></i><span
                                    class="hide-menu">회원관리</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{route('board.boardlist')}}" aria-expanded="false"><i class="me-3 fa fa-table"
                                    aria-hidden="true"></i><span class="hide-menu">게시글 관리</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('comment.commentlist') }}" aria-expanded="false"><i class="me-3 fa fa-font"
                                    aria-hidden="true"></i><span class="hide-menu">댓글 관리</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('report.get') }}" aria-expanded="false"><i class="me-3 fa fa-globe"
                                    aria-hidden="true"></i><span class="hide-menu">신고 관리</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="pages-blank.html" aria-expanded="false"><i class="me-3 fa fa-columns"
                                    aria-hidden="true"></i><span class="hide-menu">Blank</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="pages-error-404.html" aria-expanded="false"><i class="me-3 fa fa-info-circle"
                                    aria-hidden="true"></i><span class="hide-menu">Error 404</span></a></li>
                        <li class="text-center p-20 upgrade-btn">
                            <a href="https://www.wrappixel.com/templates/monsteradmin/"
                                class="btn btn-danger text-white mt-4" target="_blank">Upgrade to
                                Pro</a>
                        </li>
                    </ul>

                </nav>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">Table</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Table</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-md-6 col-4 align-self-center">
                        <div class="text-end upgrade-btn">
                            <a href="https://www.wrappixel.com/templates/monsteradmin/"
                                class="btn btn-success d-none d-md-inline-block text-white" target="_blank">Upgrade to
                                Pro</a>
                        </div>
                    </div>
                </div>
            </div>
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
                                        <tfoot>
                                        </tfoot>
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
            <footer class="footer text-center">
                © 2021 Monster Admin by <a href="https://www.wrappixel.com/">wrappixel.com</a>
            </footer>
        </div>
    </div>
    @endsection
    @section('js')
    <script type="text/javascript" src="{{asset('js/report.js')}}"></script>
    @endsection