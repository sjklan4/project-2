@extends('layout.layout')

@section('title')
    {{-- {{$data->user_id}}'s HOME --}}
    {{Auth::user()->user_id}}
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('contents')
{{-- {{var_dump(session());}} --}}
    <div id="wrap">
        {{-- <h1>{{$data->user_name}}'s HOME</h1> --}}
        <h1>{{Auth::user()->user_name}}'s HOME</h1>
        <div id="dateArea">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="20" fill="#538E04" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                </svg>
            </div>
            <div class="dateBox">
                <form action="{{route('home.post')}}" method="post">
                        @csrf
                        <input name="getDate" id="calendar" type="date" data-placeholder="" required value="{{$data['date']}}">
                        <button type="submit">이동</button>
                </form>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="30" fill="#538E04" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                </svg>
            </div>
        </div>
        {{-- 테스트존 --}}
        테스트 : {{$data['brfSum']['brfKcalSum']}} 
        테스트 : {{$data['dietFood']['dietLunch']}} 
        <hr class="bc-green">
        <div id="myDiet">
            <div class="box1">
                <div class="sub1">
                    현재 먹은 kcal : 
                </div>
                <div class="sub2">
                    탄수화물 % <br>
                    단백질 %   <br>
                    지방 %
                </div>
            </div>
            <div class="box2">
                <div class="sub3">
                    @if(($data['userKcal']->nutrition_ratio)==1)
                        탄수화물 : 0/{{($kcal->goal_kcal)*0.4}}<br>
                        단백질 : 0/{{($kcal->goal_kcal)*0.4}}<br>
                        지방 : 0/{{($kcal->goal_kcal)*0.2}}
                    @endif
                    내용없음
                </div>
                <div class="sub4">
                    @@ kcal 더먹을수 있어요<br>
                    {{-- 나의 목표 칼로리 : {{$kcal->goal_kcal}}<br> --}}
                    나의 목표 칼로리 : {{$data['userKcal']->goal_kcal}}<br>
                    나의 식단 : 탄40 : 단40 : 지20
                </div>
            </div>
        </div>
        <hr class="bc-green">
        <div class="foodBox">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        아침
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse">
                        <div class="accordion-body">
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        점심
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        저녁
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseThree">
                        간식
                        </button>
                    </h2>
                    <div id="flush-collapseFour" class="accordion-collapse collapse">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/home.js')}}"></script>
@endsection