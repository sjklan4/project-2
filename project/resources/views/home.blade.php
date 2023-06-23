@extends('layout.layout')

@section('title')
{{Auth::user()->user_name}}'s HOME
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('contents')
<div id="wrap">
    <div id="dateArea">
        <div>
            <a href="">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="20" fill="#538E04"
                    class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                    <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
                </svg>
            </a>
        </div>
        <div class="dateBox">
            <form action="{{route('home.post')}}" method="post">
                @csrf
                <input name="getDate" id="calendar" type="date" data-placeholder="" required value="{{$data['date'] ?? $data['today']}}">
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
    <hr class="bg-green">
    <div id="myDiet">
        <div class="diet1">
            <div class="box1">
                <canvas id="doughnut-chart" width="60%" height="40"></canvas>
                <div class="todayKcal">
                    {{$data['total']['kcalTotal']}}Kcal
                </div>
            </div>
            {{-- 먹은거 없을 때 오류 방지 --}}
            <div class="box2">
                @if($data['total']['tdgTotal'] === 0)
                <div class="percent">
                    <span class="fc-red">■</span> 0 % <br>
                    <span class="fc-yel">■</span> 0 % <br>
                    <span class="fc-blue">■</span> 0 % <br>
                </div>
                @else
                {{-- 탄, 단, 지 비율 계산 --}}
                <div class="percent">
                    <span class="fc-pink">■</span>
                    {{(round(($data['total']['carbTotal']*100)/($data['total']['tdgTotal'])))}} % <br>
                    <span class="fc-yel">■</span>
                    {{round(($data['total']['proteinTotal']*100)/($data['total']['tdgTotal']))}} % <br>
                    <span class="fc-blue">■</span>
                    {{round(($data['total']['fatTotal']*100)/($data['total']['tdgTotal']))}} %
                </div>
                @endif
            </div>
        </div>
        <div class="diet2">
            <div class="box3">
                @if(($data['userKcal']->nutrition_ratio)==1)
                순탄수<br>
                <progress id="kcalPro" value="{{$data['total']['carbTotal']}}" min="0" max="{{round((($data['userKcal']->goal_kcal)*0.4)/4)}}"></progress><br>
                {{$data['total']['carbTotal']}} / {{round((($data['userKcal']->goal_kcal)*0.4)/4)}}g<br>
                단백질<br>
                <progress id="proteinPro" value="{{$data['total']['proteinTotal']}}" min="0" max="{{round((($data['userKcal']->goal_kcal)*0.4)/4)}}"></progress><br>
                    @if($data['total']['proteinTotal'] > ((($data['userKcal']->goal_kcal)*0.4)/4))
                        <span class="fc-red">{{$data['total']['proteinTotal']}}</span> / 
                        {{round((($data['userKcal']->goal_kcal)*0.4)/4)}}g<br>
                    @else
                        {{$data['total']['proteinTotal']}} / {{round((($data['userKcal']->goal_kcal)*0.4)/4)}}g<br>
                    @endif
                    
                지방<br>
                <progress id="fatPro" value="{{$data['total']['fatTotal']}}" min="0" max="{{round((($data['userKcal']->goal_kcal)*0.2)/9)}}"></progress><br>
                {{$data['total']['fatTotal']}} / {{round((($data['userKcal']->goal_kcal)*0.2)/9)}}g
                @endif
            </div>
            <div class="box4">
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
    <hr class="bg-green">
    <main>
        <aside></aside>
        <div class="contents">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <div class="accordion-header" id="flush-headingOne">
                        <img src="https://cdn.pixabay.com/photo/2023/06/14/06/22/cat-8062388_640.jpg" alt="test" class="img-fluid" width="200px">
                    </div>
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne" style="width: 10px ">
                    </button>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne">
                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                </div>
                </div>
                <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Accordion Item #2
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo">
                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
                </div>
                </div>
                <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    Accordion Item #3
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree">
                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                </div>
                </div>
            </div>
        </div>
    </main>
    <div class="foodBox">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">아침
                    </button>
                    <div class="imgbox">
                        <div class="img">이미지</div>
                        칼로리 총합 : {{$data['brfSum']['brfKcalSum']}} | 탄수화물 총합 : {{$data['brfSum']['brfCarbSum']}} | 단백질
                        총합 : {{$data['brfSum']['brfProteinSum']}} | 지방 총합 : {{$data['brfSum']['brfFatSum']}}
                    </div>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse">
                    <div class="accordion-body">
                            @forelse($data['dietFood']['dietBrf'] as $val)
                                <form action="{{route('home.update', ['df_id' => $val->df_id])}}" method="POST" style="display:inline-block">
                                    @csrf
                                    {{($val->kcal)*($val->df_intake)}}KCAL | 상세정보 ->{{$val->df_id}}
                                    음식명 : {{$val->food_name}} | 칼로리 : {{$val->kcal}} | 탄수화물 : {{$val->carbs}} | 단백질 :
                                    {{$val->protein}} | 지방 : {{$val->fat}} |당 : {{$val->sugar}} | 나트륨 : {{$val->sodium}} | 섭취량 : <input name="df_intake" value="{{$val->df_intake}}">
                                    <button type="submit">수정하기</button>
                                </form>
                                <form action="{{route('home.delete', ['df_id' => $val->df_id])}}" method="post" style="display:inline-block">
                                    @csrf
                                    @method('delete')
                                    <button type="submit">삭제</button>
                                </form>
                            @empty
                                정보가 없어요 ㅠㅠ
                            @endforelse
                            <button type="button" onclick="location.href='{{route('search.insert',[
                                        'date' => $data['date'] ?? $data['today'],
                                        'time' => '0'
                                    ])}}'">음식추가
                            </button>
                            @if(isset($data['dietFood']['dietBrf'][0]))
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal0">
                                    즐겨찾기 등록
                                </button>
                                <!-- 즐겨찾기 등록 Modal -->
                                <div class="modal fade" id="exampleModal0" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">식단 즐겨찾기에 추가하기</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                음식 목록<br>                                       
                                                @foreach($data['dietFood']['dietBrf'] as $val)
                                                    {{$val->food_name}}<br>
                                                @endforeach
                                                <form action="{{route('fav.insert')}}">
                                                    <input type="hidden" name="date" value="{{$data['date'] ?? $data['today']}}" >
                                                    <input type="hidden" name="d_flg" value="0">
                                                    <input type="text" name="fav_name" required>
                                                    <button type="submit">등록하기</button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">닫기</button>
                                            </div>
                                        </div>
                                    </div>                    
                                </div>
                            @endif
                    </div>
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
                            // labels: ["탄수화물", "단백질", "지방"],
                            datasets: [
                                {
                                label: "Population (millions)",
                                backgroundColor: ["#F2F2F2"],
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