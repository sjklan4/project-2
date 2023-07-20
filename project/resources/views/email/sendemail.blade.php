<!DOCTYPE html>
<html>
<head>
    <title>이메일 인증</title>
</head>
<body>
    <h1>이메일 인증</h1>
    <div>안녕하세요, {{ $email }}님</div>
    <div>아래 인증코드를 입력해주세요</div>
    <br>
    <div>{{ $verification_code }}</div>
    {{-- <div><a href="{{ route('user.emailverifypage')}}">이메일 인증 링크</a></div> --}}
    <br>
    <div>이 인증번호는 {{ $validityPeriod }}까지 유효합니다.</div>
</body>
</html>