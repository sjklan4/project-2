<!DOCTYPE html>
<html>
<head>
    <title>임시 비밀번호 발급안내</title>
</head>
<body>
    <h1>리본 비밀번호 확인 메일</h1>
    <p>안녕하세요, {{ $name }}님</p>
    <p>이 메일은 {{$email}}계정의 비밀번호 확인을 위한 메일입니다.</p>
    <p>아래 임시 비밀번호로 로그인하신 후 비밀번호를 수정하시기 바랍니다.</p>
    <p style="color: green">{{$onepw}}</p>
    <a href="{{route('user.login')}}" style="color: #333333">로그인하러가기</a>
    <p style="color: red">임시비밀번호로 로그인하신 후 비밀번호를 꼭 변경해주세요.</p>
</body>
</html>