<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Monsterlite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Monster admin lite design, Monster admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Monster Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <meta name="csrf-token" content="xe1t9is6-Q1bcuuJ8G5rdTXWCRqzkSat7FUI">
    <title>Monster Lite Template by WrapPixel</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/monster-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('temple/assets/images/favicon.png')}}">
    <!-- Custom CSS -->
    <link href="{{asset('temple/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/food.css')}}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="{{asset('temple/assets/images/logo-icon.png')}}" alt="homepage" class="dark-logo" />

                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="{{asset('temple/assets/images/logo-text.png')}}" alt="homepage" class="dark-logo" />

                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav me-auto mt-md-0 ">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->

                        <li class="nav-item hidden-sm-down">
                            <form class="app-search ps-3">
                                <input type="text" class="form-control" placeholder="Search for..."> <a
                                    class="srh-btn"><i class="ti-search"></i></a>
                            </form>
                        </li>
                    </ul>

                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav">
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{asset('temple/assets/images/users/1.jpg')}}" alt="user" class="profile-pic me-2">{{Auth::user()->mng_name}}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{route('manager.logout')}}">로그아웃</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{route('user.food')}}" aria-expanded="false"><i class="me-3 far fa-clock fa-fw"
                                    aria-hidden="true"></i><span class="hide-menu">회원음식관리</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('member.memberlist')}}" aria-expanded="false">
                                <i class="me-3 fa fa-user" aria-hidden="true"></i><span
                                    class="hide-menu">회원관리</span></a>
                        </li>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{route('board.boardlist')}}" aria-expanded="false"><i class="me-3 fa fa-table"
                                    aria-hidden="true"></i><span class="hide-menu">게시글 관리</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('comment.commentlist') }}" aria-expanded="false"><i class="me-3 fa fa-font"
                                    aria-hidden="true"></i><span class="hide-menu">댓글 관리</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="map-google.html" aria-expanded="false"><i class="me-3 fa fa-globe"
                                    aria-hidden="true"></i><span class="hide-menu">Google Map</span></a></li>
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
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">Profile</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->

            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- column -->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">회원 등록 음식 관리</h4>
                                <h6 class="card-subtitle">음식정보 <code>.관리자용</code></h6>
                                <div class="table-responsive">
                                    <table class="table user-table no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">음식 번호</th>
                                                <th class="border-top-0">회원 번호</th>
                                                <th class="border-top-0">음식 이름</th>
                                                <th class="border-top-0">음식 등록일</th>
                                                <th class="border-top-0">음식 삭제일</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @foreach ($data as $item)
                                                    <form>
                                                        @csrf
                                                        <tr>
                                                            <td>{{ $item->food_id }}</td>
                                                            <td>{{ $item->user_id }}</td>
                                                            {{-- <td><a href="{{route('userfood.detail', ['food_id' => $item->food_id])}}">{{ $item->food_name }}</a></td> --}}
                                                            <td><a data-bs-toggle="modal" data-bs-target="#postModal{{ $item->food_id }}">{{ $item->food_name }}</a></td>
                                                            <td>{{ $item->created_at }}</td>
                                                            @if(isset($item->deleted_at))
                                                                <td>{{$item->deleted_at}}</td>
                                                            @else
                                                                <td class="delDate"><button type="button" onclick="foodDel({{$item->food_id}})" class="delBtn">삭제</button></td>
                                                            @endif
                                                        </tr>
                                                    </form>                                                    
                                                    {{-- 모달 --}}
                                                    <div class="modal" tabindex="-1" id="postModal{{ $item->food_id }}" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="false">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title">음식번호 {{$item->food_id}}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <ul>
                                                                        <li><span>음식이름</span> : {{$item->food_name}}</li>
                                                                        <li><span>칼로리</span> : {{$item->kcal}}KCAL</li>
                                                                        <li><span>탄수화물</span> : {{$item->carbs}}g</li>
                                                                        <li><span>단백질</span> : {{$item->protein}}g</li>
                                                                        <li><span>지방</span> : {{$item->fat}}g</li>
                                                                        <li><span>당</span> : {{$item->sugar}}g</li>
                                                                        <li><span>나트륨</span> : {{$item->sodium}}g</li>
                                                                    </ul>
                                                                </div>
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>




            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                © 2021 Monster Admin by <a href="https://www.wrappixel.com/">wrappixel.com</a>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('temple/assets/plugins/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('temple/assets/plugins/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('temple/js/app-style-switcher.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('temple/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('temple/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('temple/js/custom.js')}}"></script>
    <script src="{{asset('js/food.js')}}"></script>
</body>

</html>