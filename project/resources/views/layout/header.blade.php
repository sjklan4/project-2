<div class="nav-top"></div>
<section class="navigation">
    <div class="nav-container">
        <div class="brand ps-3 ps-sm-none">
            <a href="{{route('home')}}">
                <img src="{{asset('img/logo.png')}}" alt="logo">
            </a>
        </div>
        <nav>
            <div class="nav-mobile"><a id="navbar-toggle" href="#!"><span></span></a></div>
            <ul class="nav-list">
                <li>
                    <a id="cursorPointer">My Food</a>
                    <ul class="navbar-dropdown">
                        <li>
                            <a href="{{route('home')}}">기록</a>
                        </li>
                        <li>
                            <a href="{{route('fav.favdiet')}}">자주먹는 식단</a>
                        </li>
                        <li>
                            <a href="{{route('food.index')}}">등록한 음식</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a id="cursorPointer">Challenge</a>
                    <ul class="navbar-dropdown">
                        <li>
                            <a href="{{route('quest.index')}}">퀘스트 수락</a>
                        </li>
                        <li>
                            <a href="{{route('quest.show')}}">퀘스트 관리</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a id="cursorPointer">Board</a>
                    <ul class="navbar-dropdown">
                        <li>
                            <a href="{{route('board.index')}}">전체</a>
                        </li>
                        <li>
                            <a href="{{route('board.indexNum', ['board' => 1])}}">건강관리</a>
                        </li>
                        <li>
                            <a href="{{route('board.indexNum', ['board' => 2])}}">다이어트</a>
                        </li>
                        <li>
                            <a href="{{route('board.indexNum', ['board' => 3])}}">10대</a>
                        </li>
                        <li>
                            <a href="{{route('board.indexNum', ['board' => 4])}}">20대</a>
                        </li>
                        <li>
                            <a href="{{route('board.indexNum', ['board' => 5])}}">30대</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a id="cursorPointer">My Page</a>
                    <ul class="navbar-dropdown">
                        <li>
                            <a href="{{route('user.userinfoedit')}}">나의정보</a>
                        </li>
                        <li>
                            <a href="{{route('user.userpsedit')}}">비밀번호 변경</a>
                        </li>
                        <li>
                            <a href="{{route('user.prevateinfo')}}">식단 설정 변경</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a id="cursorPointer">
                        알림
                    </a>
                    <ul class="navbar-dropdown">
                        @if(isset($alarmData))
                            @foreach ($alarmData as $item)
                            <li>
                                <a href="{{route('board.show', ['board' => $item->board_id])}}"> 새 댓글 </a>
                            </li>
                            @endforeach
                        @else
                            <li>
                                <a>알림 없음</a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li>
                    {{-- 로그인 상태 --}}
                    @auth
                    <a href='{{route('user.logout')}}' id="logoutBtn" title="로그아웃">
                        <img src="{{asset('img/logoutBtn.png')}}">
                    </a>
                    @endauth
        
                    {{-- 로그아웃 상태 --}}
                    @guest
                    <a href='{{route('user.login')}}' id="logoutBtn">
                        <img src="{{asset('img/loginBtn.png')}}">
                    </a>
                    @endguest
                </li>
            </ul>
        </nav>
    </div>
</section>