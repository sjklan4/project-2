@extends('layout.layout')

@section('title')
{{-- {{$data->user_id}}'s HOME --}}
{{Auth::user()->user_id}}
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('contents')
<div id="wrap">
    <h1>{{Auth::user()->user_name}}'s HOME</h1>
    <div id="dateArea">
        <div>
            <a href="">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="20" fill="#538E04"
                    class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                    <path
                        d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
                </svg>
            </a>
        </div>
        <div class="dateBox">
            <form action="{{route('home.post')}}" method="post">
                @csrf
                <input name="getDate" id="calendar" type="date" data-placeholder="" required
                    value="{{$data['date'] ?? $data['today']}}">
                <button type="submit">이동</button>
            </form>
        </div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="30" fill="#538E04" class="bi bi-caret-right-fill"
                viewBox="0 0 16 16">
                <path
                    d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
            </svg>
        </div>
    </div>
    {{-- 테스트존 --}}
    <hr class="bc-green">
    <div id="myDiet">
        <div class="box1">
            <div class="sub1">
                <canvas id="doughnut-chart" width="60%" height="40"></canvas>
            </div>
            <div class="sub2">
                @if($data['total']['tdgTotal'] === 0)
                {{$data['total']['kcalTotal']}}
                탄수화물 : 0 %
                단백질 : 0 %
                지방 : 0 %
                @else
                {{$data['total']['kcalTotal']}}
                탄수화물 : {{(round(($data['total']['carbTotal']*100)/($data['total']['tdgTotal'])))}} % <br>
                단백질 : {{round(($data['total']['proteinTotal']*100)/($data['total']['tdgTotal']))}} % <br>
                지방 : {{round(($data['total']['fatTotal']*100)/($data['total']['tdgTotal']))}} %
                @endif
            </div>
        </div>
        <div class="box2">
            <div class="sub3">
                @if(($data['userKcal']->nutrition_ratio)==0)
                탄수화물 : {{$data['total']['carbTotal']}} / {{($data['userKcal']->goal_kcal)*0.4}}<br>
                단백질 : {{$data['total']['proteinTotal']}} / {{($data['userKcal']->goal_kcal)*0.4}}<br>
                지방 : {{$data['total']['fatTotal']}} / {{($data['userKcal']->goal_kcal)*0.2}}
                @endif
            </div>
            <div class="sub4">
                @if ($data['userKcal']->goal_kcal < $data['total']['kcalTotal']) {{($data['total']['kcalTotal']) -
                    ($data['userKcal']->goal_kcal)}} KCAL 만큼 초과했습니다 ㅠㅠ<br>
                    @else
                    {{($data['userKcal']->goal_kcal) - ($data['total']['kcalTotal'])}}
                    KCAL 더 먹을 수 있어요!<br>
                    @endif
                    나의 목표 칼로리 : {{$data['userKcal']->goal_kcal}}<br>
                    @if(($data['userKcal']->nutrition_ratio)==0)
                    나의 식단 : 탄40 : 단40 : 지20
                    @endif
            </div>
        </div>
    </div>
    <hr class="bc-green">
    <div class="foodBox">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        <div class="imgbox">
                            <div class="img">d</div>
                            아침<br>
                            칼로리 총합 : {{$data['brfSum']['brfKcalSum']}} | 탄수화물 총합 : {{$data['brfSum']['brfCarbSum']}} | 단백질
                            총합 : {{$data['brfSum']['brfProteinSum']}} | 지방 총합 : {{$data['brfSum']['brfFatSum']}}
                        </div>
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        @forelse($data['dietFood']['dietBrf'] as $val)
                        {{($val->kcal)*($val->df_intake)}}KCAL | 상세정보 ->
                        음식명 : {{$val->food_name}} | 칼로리 : {{$val->kcal}} | 탄수화물 : {{$val->carbs}} | 단백질 :
                        {{$val->protein}} | 지방 : {{$val->fat}} |당 : {{$val->sugar}} | 나트륨 : {{$val->sodium}} | 섭취량 :
                        {{$val->df_intake}}
                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">삭제
                        </button><br>
                        @empty
                        정보가 없어요 ㅠㅠ
                        @endforelse
                        <button type="button" onclick="location.href='{{route('search.insert',[
                                    'date' => $data['date'] ?? $data['today'],
                                    'time' => '0'
                                ])}}'">음식추가
                        </button>
                        <button type="button" onclick="location.href=''">수정하기
                        </button>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <form action="/user/out" method="get">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <input type="hidden" name="no" value="">
                                <div class="modal-body">
                                    정말 삭제하시겠습니까?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">닫기</button>
                                    <button type="submit" class="btn btn-success">삭제하기</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        점심<br>
                        칼로리 총합 : {{$data['lunchSum']['lunchKcalSum']}} | 탄수화물 총합 : {{$data['lunchSum']['lunchCarbSum']}}
                        | 단백질 총합 : {{$data['lunchSum']['lunchProteinSum']}} | 지방 총합 :
                        {{$data['lunchSum']['lunchFatSum']}}
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        @forelse($data['dietFood']['dietLunch'] as $val)
                        {{($val->kcal)*($val->df_intake)}}KCAL | 상세정보 ->
                        음식명 : {{$val->food_name}} | 칼로리 : {{$val->kcal}} | 탄수화물 : {{$val->carbs}} | 단백질 :
                        {{$val->protein}} | 지방 : {{$val->fat}} |당 : {{$val->sugar}} | 나트륨 : {{$val->sodium}} | 섭취량 :
                        {{$val->df_intake}} <br>
                        @empty
                        정보가 없어요 ㅠㅠ
                        @endforelse
                        <button type="button" onclick="location.href='{{route('search.insert',[
                                    'date' => $data['date'] ?? $data['today'],
                                    'time' => '1'
                                ])}}'">음식추가
                        </button>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        저녁<br>
                        칼로리 총합 : {{$data['dinnerSum']['dinnerKcalSum']}} | 탄수화물 총합 :
                        {{$data['dinnerSum']['dinnerCarbSum']}} | 단백질 총합 : {{$data['dinnerSum']['dinnerProteinSum']}} |
                        지방 총합 : {{$data['dinnerSum']['dinnerFatSum']}}
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        @forelse($data['dietFood']['dietDinner'] as $val)
                        {{($val->kcal)*($val->df_intake)}}KCAL | 상세정보 ->
                        음식명 : {{$val->food_name}} | 칼로리 : {{$val->kcal}} | 탄수화물 : {{$val->carbs}} | 단백질 :
                        {{$val->protein}} | 지방 : {{$val->fat}} |당 : {{$val->sugar}} | 나트륨 : {{$val->sodium}} | 섭취량 :
                        {{$val->df_intake}} <br>
                        @empty
                        정보가 없어요 ㅠㅠ
                        @endforelse
                        <button type="button" onclick="location.href='{{route('search.insert',[
                                    'date' => $data['date'] ?? $data['today'],
                                    'time' => '0'
                                ])}}'">음식추가
                        </button>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                        간식<br>
                        칼로리 총합 : {{$data['snackSum']['snackKcalSum']}} | 탄수화물 총합 : {{$data['snackSum']['snackCarbSum']}}
                        | 단백질 총합 : {{$data['snackSum']['snackProteinSum']}} | 지방 총합 :
                        {{$data['snackSum']['snackFatSum']}}
                    </button>
                </h2>
                <div id="flush-collapseFour" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        @forelse($data['dietFood']['dietSnack'] as $val)
                        {{($val->kcal)*($val->df_intake)}}KCAL | 상세정보 ->
                        음식명 : {{$val->food_name}} | 칼로리 : {{$val->kcal}} | 탄수화물 : {{$val->carbs}} | 단백질 :
                        {{$val->protein}} | 지방 : {{$val->fat}} |당 : {{$val->sugar}} | 나트륨 : {{$val->sodium}} | 섭취량 :
                        {{$val->df_intake}} <br>
                        @empty
                        정보가 없어요 ㅠㅠ
                        @endforelse
                        <button type="button" onclick="location.href='{{route('search.insert',[
                                    'date' => $data['date'] ?? $data['today'],
                                    'time' => '0'
                                ])}}'">음식추가
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="{{asset('js/home.js')}}"></script>
<script>
    if({{$data['total']['tdgTotal']}} === 0)
        {
            new Chart(document.getElementById("doughnut-chart"),
                {
                    type: 'doughnut',
                        data:
                        {
                            // labels: ["0"],
                            datasets: [
                                {
                                label: "Population (millions)",
                                backgroundColor: ["#cccccc"],
                                data: [100]
                                }
                            ]
                        },
                        options:
                        {
                            title: {
                                display: true,
                                text: '오늘 식단'
                            }
                        }
                });
        }
        else
        {
                        new Chart(document.getElementById("doughnut-chart"), {
                type: 'doughnut',
                data: {
                labels: ["탄수화물", "단백질", "지방"],
                datasets: [
                    {
                    label: "Population (millions)",
                    backgroundColor: ["#EE6666", "#FFD029","#6799E4"],
                    data: [{{$data['total']['carbTotal']}},{{$data['total']['proteinTotal']}},{{$data['total']['fatTotal']}}]
                    }
                ]
                },
                options: {
                title: {
                    display: true,
                    text: '오늘 식단'
                }
                }
            });
        }
</script>
@endsection