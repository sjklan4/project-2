<!DOCTYPE html>
<html>
<head>
    <title>임시 비밀번호 발급안내</title>
</head>
<body>
    <h1>임시 비밀번호 발급안내</h1>
    <div>안녕하세요 {{ $email }} 님</div>

    <p>임시비밀번호는 {{$onepw}}입니다 . </p>

    <a href="{{route('user.login')}}">로그인하러가기</a>

    <p>임시비밀번호로 로그인하신 후 비밀번호를 꼭 변경해주세요.</p>
</body>
</html>