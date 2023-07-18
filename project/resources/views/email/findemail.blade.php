<!DOCTYPE html>
<html>
<head>
    <title>비밀번호 찾기</title>
</head>
<body>
    <h1>비밀번호 찾기</h1>
    <div>안녕하세요, {{ $user }}님</div>

    <br>
    {{-- <div>{{ $verification_code }}</div> --}}
    {{-- <div><a href="{{ route('user.emailverifypage')}}">이메일 인증 링크</a></div> --}}
    <br>
    {{-- <div>이 인증 링크는 {{ $validityPeriod }}까지 유효합니다.</div> --}}
</body>
</html>