<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Hello {{ $email_data['name'] }}
<br><br>
Welcome to GameMatching!
<br>
Please click the below link to verify your email end activate your account!
<br><br>
<a href="http://127.0.0.1:8000/verify?code={{ $email_data['verification_code'] }}">Click Here!</a>

<br><br>
Thank you!
<br>
 GameMatching
</body>
</html>