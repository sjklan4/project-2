<section class="navigation">
    <div class="nav-container">
        <div class="brand">
            <a href="{{route('home')}}">Home</a>
        </div>
        <nav>
            <div class="nav-mobile"><a id="navbar-toggle" href="#!"><span></span></a></div>
            <ul class="nav-list">
                <li>
                    <a href="#">My Food</a>
                    <ul class="navbar-dropdown">
                        <li>
                            <a href="#!">기록</a>
                        </li>
                        <li>
                            <a href="#!">자주먹는 식단</a>
                        </li>
                        <li>
                            <a href="{{route('food.index')}}">등록한 음식</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#!">Board</a>
                    <ul class="navbar-dropdown">
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
                    <a href="#!">My Page</a>
                    <ul class="navbar-dropdown">
                        <li>
                            <a href="#!">나의정보</a>
                        </li>
                        <li>
                            <a href="#!">비밀번호 변경</a>
                        </li>
                        <li>
                            <a href="#!">식단 설정 변경</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#!">Challenge</a>
                    <ul class="navbar-dropdown">
                        <li>
                            <a href="#!">퀘스트 수락</a>
                        </li>
                        <li>
                            <a href="#!">퀘스트 관리</a>
                        </li>
                    </ul>
                </li>
                <li>
                    {{-- 로그인 상태 --}}
                    @auth
                    <button type="button" onclick="location.href='{{route('user.logout')}}'">로그아웃</button>
                    @endauth
        
                    {{-- 로그아웃 상태 --}}
                    @guest
                    <button type="button" onclick="location.href='{{route('user.login')}}'">로그인</button>
                    @endguest
                </li>
            </ul>
        </nav>
    </div>
</section>
<h2>Header</h2>

{{-- 로그인 상태 --}}
@auth
    <button type="button" onclick="location.href='{{route('user.logout')}}'">로그아웃</button>
    <button type="button" onclick="location.href='{{route('user.userinfoedit')}}'">회원정보수정</button>
    <button type="button" onclick="location.href='{{route('user.userpsedit')}}'">비밀번호 수정</button>
    <button type="button" onclick="location.href='{{route('user.prevateinfo')}}'">개인설정 & 목표 칼로리 수정</button>


@endauth

{{-- 로그아웃 상태 --}}
@guest
<button type="button" onclick="location.href='{{route('user.login')}}'">로그인</button>
@endguest




<hr> 