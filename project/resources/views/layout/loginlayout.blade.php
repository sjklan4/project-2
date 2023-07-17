<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
    
    @section('css')
        <link rel="stylesheet" href="{{asset('css/login.css')}}">
    @show
</head>
<body>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <div class="con">
        <div class="background">
            <div id="movingMsg">Make Yourself Healthy!</div>
            <div class="intro">
                <div>꾸준하게 기록하는 것만으로도 체중 관리에 큰 효과를 준다는 사실, 아시나요? <br>
                    매일 식단을 기록한 사람들 중 78%는 체중 관리에 성공했다고 해요. 오늘부터 리본과 함께 꾸준하게 기록하고, 건강하게 체중 관리 시작하세요!</div>
                <img src="{{ asset('img/login1.png') }}" class="img-fluid" alt="1">
            </div>
            <div class="information">
                <div>매일의 식단 기록,<br>
                    RE:bron과 함께하세요!
                </div>
                <div class="info-box">
                    <div class="info">
                        <div class="icon icon-blue">
                            <i class="fa-solid fa-calculator"></i>
                        </div>
                        <h5>식단에 따른 칼로리 계산</h5>
                        <p>칼로리, 탄단지부터 영양 정보까지 한눈에 파악할 수 있어요.</p>
                    </div>
                    <div class="info">
                        <div class="icon icon-yellow">
                            <i class="fa-solid fa-comments"></i>
                        </div>
                        <h5>즐거운 커뮤니티</h5>
                        <p>식단 공유부터 익명 수다까지 여러분의 일상을 공유해 보세요.</p>
                    </div>
                    <div class="info">
                        <div class="icon icon-pink">
                            <i class="fa-solid fa-circle-question"></i>
                        </div>
                        <h5>퀘스트와 건강 습관 관리</h5>
                        <p>여러 퀘스트를 통해 건강한 습관을 형성할 수 있어요.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="write">
            @yield('contents')
        </div>
    </div>

    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://themes.getbootstrap.com/wp-content/themes/bootstrap-marketplace/assets/javascript/scripts.js?ver=1670173476"></script>
    <script src="{{asset('js/common.js')}}"></script>
    <script src="https://kit.fontawesome.com/e3754443e1.js" crossorigin="anonymous"></script>
    @yield('js')
</body>
</html>