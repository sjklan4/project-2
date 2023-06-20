<h2>Header</h2>

{{-- 로그인 상태 --}}
@auth
    <button type="button" onclick="location.href='{{route('user.logout')}}'">로그아웃</button>
    <button type="button" onclick="location.href='{{route('user.userinfoedit')}}'">회원정보수정</button>
@endauth

{{-- 로그아웃 상태 --}}
@guest
<button type="button" onclick="location.href='{{route('user.login')}}'">로그인</button>
@endguest

<hr> 