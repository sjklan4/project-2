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
                        <input name="getDate" id="calendar" type="date" data-placeholder="" required value="{{$data['date'] ?? $data['today']}}">
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
        <hr class="bc-green">
        <div id="myDiet">
            <div class="box1">
                <div class="sub1">
                    오늘 먹은 kcal 총합 : {{($data['brfSum']['brfKcalSum'])+($data['lunchSum']['lunchKcalSum'])+(($data['dinnerSum']['dinnerKcalSum']))+(($data['snackSum']['snackKcalSum']))}}
                </div>
                <div class="sub2">
                    탄수화물 % <br>
                    단백질 %   <br>
                    지방 %
                </div>
            </div>
            <div class="box2">
                <div class="sub3">
                    @if(($data['userKcal']->nutrition_ratio)==0)
                        탄수화물 : {{($data['brfSum']['brfCarbSum'])+($data['lunchSum']['lunchCarbSum'])+($data['dinnerSum']['dinnerCarbSum'])+($data['snackSum']['snackCarbSum'])}} / {{($data['userKcal']->goal_kcal)*0.4}}<br>
                        단백질 : 0/{{($data['userKcal']->goal_kcal)*0.4}}<br>
                        지방 : 0/{{($data['userKcal']->goal_kcal)*0.2}}
                    @endif
                </div>
                <div class="sub4">
                    @@ kcal 더먹을수 있어요<br>
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
                        아침<br>
                        칼로리 총합 : {{$data['brfSum']['brfKcalSum']}} | 탄수화물 총합 : {{$data['brfSum']['brfCarbSum']}} | 단백질 총합 : {{$data['brfSum']['brfProteinSum']}} | 지방 총합 : {{$data['brfSum']['brfFatSum']}}
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            @forelse($data['dietFood']['dietBrf'] as $val)
                                {{($val->kcal)*($val->df_intake)}}KCAL | 상세정보 ->
                                음식명 : {{$val->food_name}} | 칼로리 : {{$val->kcal}} | 탄수화물 : {{$val->carbs}} | 단백질 : {{$val->protein}} | 지방 : {{$val->fat}} |당 : {{$val->sugar}} | 나트륨 : {{$val->sodium}} | 섭취량 : {{$val->df_intake}} <br>
                            @empty
                                정보가 없어요 ㅠㅠ
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        점심<br>
                        칼로리 총합 : {{$data['lunchSum']['lunchKcalSum']}} | 탄수화물 총합 : {{$data['lunchSum']['lunchCarbSum']}} | 단백질 총합 : {{$data['lunchSum']['lunchProteinSum']}} | 지방 총합 : {{$data['lunchSum']['lunchFatSum']}}
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            @forelse($data['dietFood']['dietLunch'] as $val)
                                {{($val->kcal)*($val->df_intake)}}KCAL | 상세정보 ->
                                음식명 : {{$val->food_name}} | 칼로리 : {{$val->kcal}} | 탄수화물 : {{$val->carbs}} | 단백질 : {{$val->protein}} | 지방 : {{$val->fat}} |당 : {{$val->sugar}} | 나트륨 : {{$val->sodium}} | 섭취량 : {{$val->df_intake}} <br>
                            @empty
                                정보가 없어요 ㅠㅠ
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        저녁<br>
                        칼로리 총합 : {{$data['dinnerSum']['dinnerKcalSum']}} | 탄수화물 총합 : {{$data['dinnerSum']['dinnerCarbSum']}} | 단백질 총합 : {{$data['dinnerSum']['dinnerProteinSum']}} | 지방 총합 : {{$data['dinnerSum']['dinnerFatSum']}}
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            @forelse($data['dietFood']['dietDinner'] as $val)
                            {{($val->kcal)*($val->df_intake)}}KCAL | 상세정보 ->
                            음식명 : {{$val->food_name}} | 칼로리 : {{$val->kcal}} | 탄수화물 : {{$val->carbs}} | 단백질 : {{$val->protein}} | 지방 : {{$val->fat}} |당 : {{$val->sugar}} | 나트륨 : {{$val->sodium}} | 섭취량 : {{$val->df_intake}} <br>
                            @empty
                                정보가 없어요 ㅠㅠ
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                        간식<br>
                        칼로리 총합 : {{$data['snackSum']['snackKcalSum']}} | 탄수화물 총합 : {{$data['snackSum']['snackProteinSum']}} | 단백질 총합 : {{$data['snackSum']['snackProteinSum']}} | 지방 총합 : {{$data['snackSum']['snackFatSum']}}
                        </button>
                    </h2>
                    <div id="flush-collapseFour" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            @forelse($data['dietFood']['dietSnack'] as $val)
                            {{($val->kcal)*($val->df_intake)}}KCAL | 상세정보 ->
                            음식명 : {{$val->food_name}} | 칼로리 : {{$val->kcal}} | 탄수화물 : {{$val->carbs}} | 단백질 : {{$val->protein}} | 지방 : {{$val->fat}} |당 : {{$val->sugar}} | 나트륨 : {{$val->sodium}} | 섭취량 : {{$val->df_intake}} <br>
                            @empty
                                정보가 없어요 ㅠㅠ
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/home.js')}}"></script>
@endsection