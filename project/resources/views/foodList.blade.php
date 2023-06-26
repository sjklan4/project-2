@extends('layout.layout')

@section('title', 'FoodSearch')

@section('css')
    <link rel="stylesheet" href="{{asset('css/search.css')}}">
@endsection

@section('contents')
    <form action="{{route('search.list.get', ['id' => Auth::user()->user_id])}}" method="get" class="searchform">
        @csrf
        <div class="searchform">
        <input type="text" name="search_input" class="searchip" placeholder="검색할 단어를 입력하세요.">
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
{{-- todo : 사용자 등록/최근 먹은 음식 표시, 유효성 검사 --}}
{{-- todo : 저장된 식단 페이징 / 검색 결과 더보기 또는 페이징 --}}
{{-- todo : 선택된 음식 식단/음식 삭제 및 인분 수 조절 --}}
{{-- todo : 드롭다운 메뉴 -> 영양성분 표시 --}}
    <div class="searchContainer">
        <hr>
        @if (!empty($foods))
            <div class="user_search">
                @foreach ($foods as $item)
                    <div class="searchhhh">
                        <input type="checkbox" name="usercheck" id="usercheck" value="{{$item->food_id}}" onclick='getFoodValue({{Auth::user()->user_id}})'>
                        <label for="usercheck" id="food_name">{{$item->food_name}}</label>
                        <strong>영양성분</strong>
                        <span> > </span>
                        <span>kcal : {{$item->kcal}}, </span>
                        <span>carbs : {{$item->carbs}}, </span>
                        <span>protein : {{$item->protein}}, </span>
                        <span>fat : {{$item->fat}}, </span>
                        <span>sugar : {{$item->sugar}}, </span>
                        <span>sodium : {{$item->sodium}}</span>
                        <span>인분 수 : </span>
                        <input type="number" name="userving" id="userving" min="0.5" max="100">
                        @if (!empty($item->user_id))
                            <span class="usercreate">사용자 등록</span>
                        @endif
                        @if (!empty($recent))
                            
                            {{-- <span>최근 먹은 음식</span> --}}
                        @endif
                        <hr class="div_hr">
                    </div>
                    <br>
                @endforeach
                @if ($foods->hasPages())
                <ul class="pagination pagination">
                @if ($foods->currentPage() > 1)
                    <a href="{{ $foods->previousPageUrl() }}"><span class="fa fa-chevron-left" aria-hidden="true">이전</span></a>
                @else
                    <span>이전</span>
                @endif

                @for($i = 1; $i <= $foods->lastPage(); $i++)
                    @if ($i == $foods->currentPage())
                        <li class="active"><span>{{ $i }}</span></li>
                    @else
                        <li><a href="{{ $foods->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endfor
                
                @if ($foods->currentPage() < $foods->lastPage() )
                    <a href="{{$foods->nextPageUrl()}}"><span class="fa fa-chevron-right" aria-hidden="true">이후</span></a>
                @else
                    <span>이후</span>
                @endif
                </ul>
                @endif
                    </div>
                @else
                    <p class="nosearch">검색 결과가 없습니다.</p>
                @endif
        
        <div class="fav_diets">
        @if (!empty($dietname))
                <h2>
                    자주먹는 식단
                </h2>
                @foreach ($dietname as $names)
                    <div class="fav_div">
                        <input type="checkbox" name="userdiet" id="userdiet" value="{{$names->fav_id}}" onclick='getDietValue()'>
                        <span> {{$names->fav_name}}</span>
                    </div>
                    @foreach ($dietfood as $foods)
                    @if($foods->fav_id === $names->fav_id)
                        <span> {{$foods->food_name}}</span>
                        <br>
                        <strong>영양성분</strong>
                        <span> > </span>
                        <span>kcal : {{$foods->kcal}}, </span>
                        <span>carbs : {{$foods->carbs}}, </span>
                        <span>protein : {{$foods->protein}}, </span>
                        <span>fat : {{$foods->fat}}, </span>
                        <span>sugar : {{$foods->sugar}}, </span>
                        <span>sodium : {{$foods->sodium}}</span>
                        <span>{{$foods->fav_f_intake}}</span>
                        <br>
                    @endif
                    @endforeach
                @endforeach
                @else
                <p>asdsdf</p>
                @endif
            
                @if ($dietname->hasPages())
                <ul class="pagination pagination">
                    @if ($dietname->currentPage() > 1)
                        <a href="{{ $dietname->previousPageUrl() }}"><span class="fa fa-chevron-left" aria-hidden="true">이전</span></a>
                    @else
                        <span>이전</span>
                    @endif

                    @for($i = 1; $i <= $dietname->lastPage(); $i++)
                        @if ($i == $dietname->currentPage())
                            <li class="active"><span>{{ $i }}</span></li>
                        @else
                            <li><a href="{{ $dietname->url($i) }}">{{ $i }}</a></li>
                        @endif
                    @endfor
                
                    @if ($dietname->currentPage() < $dietname->lastPage() )
                        <a href="{{$dietname->nextPageUrl()}}"><span class="fa fa-chevron-right" aria-hidden="true">이후</span></a>
                    @else
                        <span>이후</span>
                    @endif
                </ul>
                @endif
            </div>
            
        <div class="user_select">
            @if (!empty($seleted))
                <h3>선택한 음식</h3>
                @foreach ($seleted as $food)
                    <span>{{$food->food_name}}</span>
                    <button type="button">X</button>
                    <br>
                @endforeach
                <hr>
                <h3>선택한 식단</h3>
                <input type="text" id="resultdiet" name="resultdiet" value="" readonly>
                <br>
            @endif
                <button type="button">취소</button>
                <button type="button" onclick="location.href='{{route('search.insert', 
                ['id' => Auth::user()->user_id, 'date' => '2023-06-22', 'time' => '0'])}}'">입력</button>
        </div>
        
    </div>
@endsection

@section('js')
    <script src="https://kit.fontawesome.com/8c69259d3d.js" crossorigin="anonymous"></script>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/search.js')}}"></script>
@endsection