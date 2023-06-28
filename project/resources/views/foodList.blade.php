{{-- todo : 최근 먹음 표시, 유효성 검사 --}}
{{-- todo : 선택된 음식 인분 수 조절 --}}
{{-- todo : 드롭다운 메뉴 --}}
{{-- todo : 10개 이상 > 홈 --}}
@extends('layout.layout')

@section('title', 'FoodSearch')

@section('css')
    <link rel="stylesheet" href="{{asset('css/search.css')}}">
@endsection

@section('contents')
<div class="searchContainer">
    <div class="search_div">
        <form action="{{route('search.list.get', ['id' => Auth::user()->user_id])}}" method="post" class="searchform">
            @csrf
            <div class="searchdiv">
                <input type="hidden" name="date" value="{{$data['date']}}">
                <input type="hidden" name="time" value="{{$data['time']}}">
                <input type="text" name="search_input" class="searchip" placeholder="검색할 단어를 입력하세요.">
                <button type="reset" class="resetbtn">X</button>
                <button type="submit" class="searchbtn"><i class="fa-solid fa-magnifying-glass" style="color: #000000;"></i></button>
            </div>
        </form>

        <ul class="searchtab">
            <li class="tab1">
                <i class="fa-solid fa-utensils" style="color: #ee6666;"></i>
                저장된 식단
            </li>
            <li class="tab2">
                <i class="fa-solid fa-cart-shopping" style="color: #538e04;"></i>
                선택된 음식
            </li>
            <li class="tab3" onclick="location.href='{{route('food.create')}}'">
                <i class="fa-solid fa-mortar-pestle" style="color: #6799e4;"></i>
                음식등록
            </li>
        </ul>
    </div>
    <div class="searchTabContainer">
        <hr>
        @if (!empty($foods))
        <div class="user_search">
            @foreach ($foods as $item)
                <div class="search_result">
                    <span id="food_name">{{$item->food_name}}</span>
                    @if (!empty($item->user_id))
                    <span class="usercreate">사용자 등록</span>
                    @endif
                    <br>
                    <span>인분 수 : </span>
                    <input type="number" name="userving" id="userving" min="0.5" step="0.5" max="100">
                    <input type="checkbox" name="usercheck" id="usercheck" value="{{$item->food_id}}" onclick='getFoodValue({{Auth::user()->user_id}})'>
                    <br>
                    <strong>영양성분</strong>
                    <span> > </span>
                    <span>칼로리 : {{$item->kcal}}, </span>
                    <span>탄수화물 : {{$item->carbs}}, </span>
                    <span>단백질 : {{$item->protein}}, </span>
                    <span>지방 : {{$item->fat}}, </span>
                    <span>당 : {{$item->sugar}}, </span>
                    <span>나트륨 : {{$item->sodium}}</span>
                    @if (!empty($recent))
                    {{-- <span>최근 먹은 음식</span> --}}
                    @endif
                </div>
                <hr class="search_hr">
            @endforeach
        </div>
        @else
            <p class="nosearch">검색 결과가 없습니다.</p>
        @endif
        
        <div class="fav_diets">
        @if (!empty($dietname))
            <h2>자주먹는 식단</h2>
            @foreach ($dietname as $names)
                <input type="checkbox" name="userdiet" id="userdiet" value="{{$names->fav_id}}" onclick='getDietValue({{Auth::user()->user_id}})'>
                <span class="favname"> {{$names->fav_name}}</span>
                <br>
                <div class="diet_div">
                @foreach ($dietfood as $foods)
                {{-- {{$d = 0;}}
                @foreach ($total[$d] as $item) --}}
                @if($foods->fav_id === $names->fav_id)
                {{-- @foreach ($total as $item)
                    <span>1회 총 제공량 : </span>
                    <span>Kcal, {{$item->total->kcal}}</span>
                    <span>Carbs, {{$item->carbs}}</span>
                    <span>Protein, {{$item->protein}}</span>
                    <span>Fat, {{$item->fat}}</span>
                    <span>Sugar, {{$item->sugar}}</span>
                    <span>Sodium, {{$item->sodium}}</span>
                @endforeach --}}
                    <div class="dietinfo">
                        <span> {{$foods->food_name}}</span>
                        <br
                        <strong>영양성분</strong>
                        <span> > </span>
                            
                        {{-- <span>칼로리 : {{$total[$d]['kcal']}}, </span>
                        <span>탄수화물 : {{$total[$d]['carbs']}}, </span>
                        <span>단백질 : {{$total[$d]['protein']}}, </span>
                        <span>지방 : {{$total[$d]['fat']}}, </span>
                        <span>당 : {{$total[$d]['sugar']}}, </span>
                        <span>나트륨 : {{$total[$d]['sodium']}}</span>
                        <br>
                        {{$d++;}} --}}
                            
                        <span>칼로리 : {{$foods->kcal}}, </span>
                        <span>탄수화물 : {{$foods->carbs}}, </span>
                        <span>단백질 : {{$foods->protein}}, </span>
                        <span>지방 : {{$foods->fat}}, </span>
                        <span>당 : {{$foods->sugar}}, </span>
                        <span>나트륨 : {{$foods->sodium}}</span>
                        <span> > {{$foods->fav_f_intake}} 인분</span>
                    </div>
                    <br>
                @endif
                {{-- @endforeach --}}
                @endforeach
                </div>
            @endforeach
        @else
            <p>asdsdf</p>
        @endif
        </div>
            
        <div class="user_select">
            @if (!empty($seleted))
            <h3>선택한 음식 / 식단</h3>
            <br>
            <h4>음식</h4>
            <hr class="select_food">
            @foreach ($seleted as $food)
                <form action="{{route('food.delete', ['f_id' => $food->food_id])}}" method="get">
                    <div class="fav_food">
                        <span>{{$food->food_name}}</span>
                        <span>{{$food->amount}}</span>
                        <input type="hidden" name="date" value="{{$data['date']}}">
                        <input type="hidden" name="time" value="{{$data['time']}}">
                        <button type="submit" class="delete_btn">X</button>
                    </div>
                    <br>
                </form>
            @endforeach
            <br>
            <h4>식단</h4>
            <hr class="select_diet">
            @foreach ($seleted_diet as $diet)
            <form action="{{route('diet.delete', ['d_id' => $diet->fav_id])}}" method="get">
                <div class="fav_diet">
                    <span>{{$diet->fav_name}}</span>
                    <input type="hidden" name="date" value="{{$data['date']}}">
                    <input type="hidden" name="time" value="{{$data['time']}}">
                    <button type="submit" class="delete_btn">X</button>
                </div>
                <br>
            </form>
            @endforeach
            <br>
            @else
                <span>선택된 음식 또는 식단이 없습니다.</span>
            @endif
            <br>
            <button type="button" onclick="location.href='{{route('search.delete')}}'">취소</button>
            <button type="button" id="greenBtn" onclick="location.href='{{route('search.insert', 
            ['date' => $data['date'], 'time' => $data['time']])}}'">입력</button>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="https://kit.fontawesome.com/8c69259d3d.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('js/search.js')}}"></script>
@endsection