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
    <hr class="fc-green">
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
    <hr class="fc-green">

    <div class="dietArea">
        {{-- 아침 식단 --}}
        <div class="flgBox text-center">
            아침
            <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                ^
            </button>
        </div>
        <div class="diet">
            <div class="food container">
                <div class="row row-cols-2 row-cols-md-3 row-cols-xl-6 mx-auto">
                    <div class="col"><span class="fc-green">■</span>칼로리 {{$data['brfSum']['brfKcalSum']}} Kcal</div>
                    <div class="col"><span class="fc-pink">■</span>탄수화물 {{$data['brfSum']['brfCarbSum']}} g</div>
                    <div class="col"><span class="fc-yel">■</span>단백질 {{$data['brfSum']['brfProteinSum']}} g</div>
                    <div class="col"><span class="fc-blue">■</span>지방 {{$data['brfSum']['brfFatSum']}} g</div>
                    <div class="col">
                        <button class="btn btn-success" type="button" onclick="location.href='{{route('search.insert',[
                            'date' => $data['date'] ?? $data['today'],
                            'time' => '0'
                        ])}}'">음식추가
                        </button>
                    </div>
                    <div class="col">
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
        </div>
        <div class="dietDetail">
            <div class="collapse" id="collapseExample">
                <div class="card mb-3" style="width:95vw; border:none; background:#fffff0">
                    <div class="row g-0">
                        <div class="col-md-3 mx-auto mx-md-0 p-1 pb-md-5" style="max-width:350px;">
                            <img src="https://cdn.pixabay.com/photo/2016/05/03/12/19/credit-card-1369111__340.png" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-9 mx-auto">
                            <div class="card-body">
                                <div class="table-responsive text-center">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2">음식명</th>
                                                <th>칼로리</th>
                                                <th>탄수화물</th>
                                                <th>단백질</th>
                                                <th>지방</th>
                                                <th>당</th>
                                                <th>나트륨</th>
                                                <th>섭취량</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>                                          
                                            @forelse($data['dietFood']['dietBrf'] as $val)
                                                <tr>
                                                    <form action="{{route('home.update', ['df_id' => $val->df_id])}}" method="POST" style="display:inline-block">
                                                        @csrf
                                                        <td colspan="2">{{$val->food_name}}</td>
                                                        <td>{{$val->kcal}}</td>
                                                        <td>{{$val->carbs}}</td>
                                                        <td>{{$val->protein}}</td>
                                                        <td>{{$val->fat}}</td>
                                                        <td>{{$val->sugar}}</td>
                                                        <td>{{$val->sodium}}</td>
                                                        <td><input name="df_intake" value="{{$val->df_intake}}" type="number" min="0.5" max="100" step="0.5"></td>
                                                        <td><button type="submit">수정하기</button></td>
                                                    </form>
                                                    <td>
                                                        <form action="{{route('home.delete', ['df_id' => $val->df_id])}}" method="post" style="display:inline-block">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit">삭제</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>정보가없어요</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                <tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 점심 식단 --}}
        <div class="flgBox text-center">
            점심
            <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseExampleTwo" aria-expanded="false" aria-controls="collapseExampleTwo">
                ^
            </button>
        </div>
        <div class="diet">
            <div class="food container">
                <div class="row row-cols-2 row-cols-md-3 row-cols-xl-6 mx-auto">
                    <div class="col"><span class="fc-green">■</span>칼로리 {{$data['lunchSum']['lunchKcalSum']}} Kcal</div>
                    <div class="col"><span class="fc-pink">■</span>탄수화물 {{$data['lunchSum']['lunchCarbSum']}} g</div>
                    <div class="col"><span class="fc-yel">■</span>단백질 {{$data['lunchSum']['lunchProteinSum']}} g</div>
                    <div class="col"><span class="fc-blue">■</span>지방 {{$data['lunchSum']['lunchFatSum']}} g</div>
                    <div class="col">
                        <button class="btn btn-success" type="button" onclick="location.href='{{route('search.insert',[
                            'date' => $data['date'] ?? $data['today'],
                            'time' => '1'
                        ])}}'">음식추가
                        </button>
                    </div>
                    <div class="col">
                        @if(isset($data['dietFood']['dietLunch'][0]))
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                즐겨찾기 등록
                            </button>
                            <!-- 즐겨찾기 등록 Modal -->
                            <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                            @foreach($data['dietFood']['dietLunch'] as $val)
                                                {{$val->food_name}}<br>
                                            @endforeach
                                            <form action="{{route('fav.insert')}}">
                                                <input type="hidden" name="date" value="{{$data['date'] ?? $data['today']}}" >
                                                <input type="hidden" name="d_flg" value="1">
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
        </div>
        <div class="dietDetail">
            <div class="collapse" id="collapseExampleTwo">
                <div class="card mb-3" style="width:95vw; border:none; background:#fffff0">
                    <div class="row g-0">
                        <div class="col-md-3 mx-auto mx-md-0 p-1 pb-md-5" style="max-width:350px;">
                            <img src="https://cdn.pixabay.com/photo/2016/05/03/12/19/credit-card-1369111__340.png" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-9 mx-auto">
                            <div class="card-body">
                                <div class="table-responsive text-center">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2">음식명</th>
                                                <th>칼로리</th>
                                                <th>탄수화물</th>
                                                <th>단백질</th>
                                                <th>지방</th>
                                                <th>당</th>
                                                <th>나트륨</th>
                                                <th>섭취량</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>                                           
                                            @forelse($data['dietFood']['dietLunch'] as $val)
                                                <tr>
                                                    <form action="{{route('home.update', ['df_id' => $val->df_id])}}" method="POST" style="display:inline-block">
                                                        @csrf
                                                        <td colspan="2">{{$val->food_name}}</td>
                                                        <td>{{$val->kcal}}</td>
                                                        <td>{{$val->carbs}}</td>
                                                        <td>{{$val->protein}}</td>
                                                        <td>{{$val->fat}}</td>
                                                        <td>{{$val->sugar}}</td>
                                                        <td>{{$val->sodium}}</td>
                                                        <td><input name="df_intake" value="{{$val->df_intake}}" type="number" min="0.5" max="100" step="0.5"></td>
                                                        <td><button type="submit">수정하기</button></td>
                                                    </form>
                                                    <td>
                                                        <form action="{{route('home.delete', ['df_id' => $val->df_id])}}" method="post" style="display:inline-block">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit">삭제</button>
                                                        </form>
                                                    </td>
                                                <tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>정보가없어요</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                <tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 저녁 식단 --}}
        <div class="flgBox text-center">
            저녁
            <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseExampleThree" aria-expanded="false" aria-controls="collapseExampleThree">
                ^
            </button>
        </div>
        <div class="diet">
            <div class="food container">
                <div class="row row-cols-2 row-cols-md-3 row-cols-xl-6 mx-auto">
                    <div class="col"><span class="fc-green">■</span>칼로리 {{$data['dinnerSum']['dinnerKcalSum']}} Kcal</div>
                    <div class="col"><span class="fc-pink">■</span>탄수화물 {{$data['dinnerSum']['dinnerCarbSum']}} g</div>
                    <div class="col"><span class="fc-yel">■</span>단백질 {{$data['dinnerSum']['dinnerProteinSum']}} g</div>
                    <div class="col"><span class="fc-blue">■</span>지방 {{$data['dinnerSum']['dinnerFatSum']}} g</div>
                    <div class="col">
                        <button class="btn btn-success" type="button" onclick="location.href='{{route('search.insert',[
                            'date' => $data['date'] ?? $data['today'],
                            'time' => '2'
                        ])}}'">음식추가
                        </button>
                    </div>
                    <div class="col">
                        @if(isset($data['dietFood']['dietDinner'][0]))
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                즐겨찾기 등록
                            </button>
                            <!-- 즐겨찾기 등록 Modal -->
                            <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                            @foreach($data['dietFood']['dietDinner'] as $val)
                                                {{$val->food_name}}<br>
                                            @endforeach
                                            <form action="{{route('fav.insert')}}">
                                                <input type="hidden" name="date" value="{{$data['date'] ?? $data['today']}}" >
                                                <input type="hidden" name="d_flg" value="2">
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
        </div>
        <div class="dietDetail">
            <div class="collapse" id="collapseExampleThree">
                <div class="card mb-3" style="width:95vw; border:none; background:#fffff0">
                    <div class="row g-0">
                        <div class="col-md-3 mx-auto mx-md-0 p-1 pb-md-5" style="max-width:350px;">
                            <img src="https://cdn.pixabay.com/photo/2016/05/03/12/19/credit-card-1369111__340.png" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-9 mx-auto">
                            <div class="card-body">
                                <div class="table-responsive text-center">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2">음식명</th>
                                                <th>칼로리</th>
                                                <th>탄수화물</th>
                                                <th>단백질</th>
                                                <th>지방</th>
                                                <th>당</th>
                                                <th>나트륨</th>
                                                <th>섭취량</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>                                           
                                            @forelse($data['dietFood']['dietDinner'] as $val)
                                                <tr>
                                                    <form action="{{route('home.update', ['df_id' => $val->df_id])}}" method="POST" style="display:inline-block">
                                                        @csrf
                                                        <td colspan="2">{{$val->food_name}}</td>
                                                        <td>{{$val->kcal}}</td>
                                                        <td>{{$val->carbs}}</td>
                                                        <td>{{$val->protein}}</td>
                                                        <td>{{$val->fat}}</td>
                                                        <td>{{$val->sugar}}</td>
                                                        <td>{{$val->sodium}}</td>
                                                        <td><input name="df_intake" value="{{$val->df_intake}}" type="number" min="0.5" max="100" step="0.5"></td>
                                                        <td><button type="submit">수정하기</button></td>
                                                    </form>
                                                    <td>
                                                        <form action="{{route('home.delete', ['df_id' => $val->df_id])}}" method="post" style="display:inline-block">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit">삭제</button>
                                                        </form>
                                                    </td>
                                                <tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>정보가없어요</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                <tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 간식 식단 --}}
        <div class="flgBox text-center">
            저녁
            <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseExampleFour" aria-expanded="false" aria-controls="collapseExampleFour">
                ^
            </button>
        </div>
        <div class="diet">
            <div class="food container">
                <div class="row row-cols-2 row-cols-md-3 row-cols-xl-6 mx-auto">
                    <div class="col"><span class="fc-green">■</span>칼로리 {{$data['snackSum']['snackKcalSum']}} Kcal</div>
                    <div class="col"><span class="fc-pink">■</span>탄수화물 {{$data['snackSum']['snackCarbSum']}} g</div>
                    <div class="col"><span class="fc-yel">■</span>단백질 {{$data['snackSum']['snackProteinSum']}} g</div>
                    <div class="col"><span class="fc-blue">■</span>지방 {{$data['snackSum']['snackFatSum']}} g</div>
                    <div class="col">
                        <button class="btn btn-success" type="button" onclick="location.href='{{route('search.insert',[
                            'date' => $data['date'] ?? $data['today'],
                            'time' => '3'
                        ])}}'">음식추가
                        </button>
                    </div>
                    <div class="col">
                        @if(isset($data['dietFood']['dietSnack'][0]))
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal3">
                                즐겨찾기 등록
                            </button>
                            <!-- 즐겨찾기 등록 Modal -->
                            <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                            @foreach($data['dietFood']['dietSnack'] as $val)
                                                {{$val->food_name}}<br>
                                            @endforeach
                                            <form action="{{route('fav.insert')}}">
                                                <input type="hidden" name="date" value="{{$data['date'] ?? $data['today']}}" >
                                                <input type="hidden" name="d_flg" value="3">
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
        </div>
        <div class="dietDetail">
            <div class="collapse" id="collapseExampleFour">
                <div class="card mb-3" style="width:95vw; border:none; background:#fffff0">
                    <div class="row g-0">
                        <div class="col-md-3 mx-auto mx-md-0 p-1 pb-md-5" style="max-width:350px;">
                            <img src="https://cdn.pixabay.com/photo/2016/05/03/12/19/credit-card-1369111__340.png" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-9 mx-auto">
                            <div class="card-body">
                                <div class="table-responsive text-center">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2">음식명</th>
                                                <th>칼로리</th>
                                                <th>탄수화물</th>
                                                <th>단백질</th>
                                                <th>지방</th>
                                                <th>당</th>
                                                <th>나트륨</th>
                                                <th>섭취량</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>                                           
                                            @forelse($data['dietFood']['dietSnack'] as $val)
                                                <tr>
                                                    <form action="{{route('home.update', ['df_id' => $val->df_id])}}" method="POST" style="display:inline-block">
                                                        @csrf
                                                        <td colspan="2">{{$val->food_name}}</td>
                                                        <td>{{$val->kcal}}</td>
                                                        <td>{{$val->carbs}}</td>
                                                        <td>{{$val->protein}}</td>
                                                        <td>{{$val->fat}}</td>
                                                        <td>{{$val->sugar}}</td>
                                                        <td>{{$val->sodium}}</td>
                                                        <td><input name="df_intake" value="{{$val->df_intake}}" type="number" min="0.5" max="100" step="0.5"></td>
                                                        <td><button type="submit">수정하기</button></td>
                                                    </form>
                                                    <td>
                                                        <form action="{{route('home.delete', ['df_id' => $val->df_id])}}" method="post" style="display:inline-block">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit">삭제</button>
                                                        </form>
                                                    </td>
                                                <tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>정보가없어요</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                <tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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