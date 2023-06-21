@extends('layout.layout')

@section('title', 'FoodSearch')

@section('css')
    <link rel="stylesheet" href="{{asset('css/search.css')}}">
@endsection

@section('contents')
    <form action="{{route('search.list.get', ['id' => Auth::user()->user_id])}}" method="get" class="searchform">
        @csrf
        <input type="text" name="search_input">
        <button type="submit">검색</button>
    </form>

    <ul>
        <li class="tab1">
            저장된 식단
        </li>
        <li class="tab2">
            선택된 음식
        </li>
        <li class="tab3" onclick="location.href='{{route('food.create')}}'">
            음식등록
        </li>
    </ul>
{{-- todo : 사용자 등록/최근 먹은 음식 표시, 유효성 검사 --}}
{{-- todo : 저장된 식단 페이징 / 검색 결과 더보기 또는 페이징 --}}
{{-- todo : 선택된 음식 식단/음식 삭제 및 인분 수 조절 --}}
{{-- ? 검색/선택된 음식 인분 수 입력 및 설정 -> 첫 입력 값만 가져옴 : search.js --}}
{{-- todo : 드롭다운 메뉴 -> 영양성분 표시 --}}

{{-- !? 선택된 음식 새로고침 시 유지 --}}
    <div>
        @if (!empty($foods))
            <div class="user_search">
                @foreach ($foods as $item)
                    <input type="checkbox" name="usercheck" id="usercheck" value="{{$item->food_id}}" onclick='getFoodValue()'>
                    <span>{{$item->food_name}}</span>
                    <span>인분 수 : </span>
                    <input type="number" name="userving" id="userving" min="0.5" max="100">
                    <br>
                @endforeach
            </div>
        @else
            <p class="nosearch">검색어</p>
        @endif
        
        <div class="fav_diets">
        @if (!empty($dietname))
                <h2>자주먹는 식단</h2>
                @foreach ($dietname as $names)
                    <input type="checkbox" name="userdiet" id="userdiet" value="{{$names->fav_id}}" onclick='getDietValue()'>
                    <span> {{$names->fav_name}}</span>
                    <br>
                    @foreach ($dietfood as $foods)
                    @if($foods->fav_id === $names->fav_id)
                        <span> {{$foods->food_name}}</span>
                        <span> {{$foods->kcal}} </span>
                        <span> {{$foods->carbs}} </span>
                        <span> {{$foods->protein}} </span>
                        <span> {{$foods->fat}} </span>
                        <span> {{$foods->sugar}} </span>
                        <span> {{$foods->sodium}} </span>
                        <span> {{$foods->fav_f_intake}} </span>
                        <br>
                    @endif
                    @endforeach
                @endforeach
                @else
                <p>asdsdf</p>
                @endif
            </div>
            
        <div class="user_select">
            <form action="" method="post">
                <p>음식</p>
                <span id='resultfood'></span>
                <span id='resultserving'></span>
                <hr>
                <p>식단</p>
                <span id='resultdiet'></span>
                <button type="submit">입력</button>
            </form>
        </div>
        
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('js/search.js')}}"></script>
@endsection