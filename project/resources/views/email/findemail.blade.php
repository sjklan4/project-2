<!DOCTYPE html>
<html>
<head>
    <title>비밀번호 찾기</title>
</head>
<body>
    <h1>비밀번호 찾기</h1>
    <div>안녕하세요 {{ $email }} 님</div>

    <p>임시비밀번호는 {{$onepw}}입니다 . </p>

    <a href="{{route('user.login')}}">로그인하러가기</a>
</body>
</html>