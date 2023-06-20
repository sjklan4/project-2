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