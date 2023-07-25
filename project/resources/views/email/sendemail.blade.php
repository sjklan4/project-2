<!DOCTYPE html>
<html>
    <script></script>
<head>
    <title>이메일 인증</title>
</head>
<body>
<div style="border: 2px solid #195F1C; background= #538e04; border-radius: 5px; width:350px">
        <h1 style="text-align: center">이메일 인증</h1>
    <div>
        <h3 style="color:#195F1C; text-align: center">안녕하세요, {{ $email }}님</h2>
    </div>
    <div style="text-align: center">
        아래 인증코드를 입력해주세요
    </div>
    <br>
    <div style="color:blue; text-align: center ">
        {{ $verification_code }}
    </div>
    {{-- <div><a href="{{ route('user.emailverifypage')}}">이메일 인증 링크</a></div> --}}
    <br>
    <div style="color: red; text-align: center">이 인증번호는 {{ $validityPeriod }}까지 유효합니다.</div>
</div>
</body>
</html>