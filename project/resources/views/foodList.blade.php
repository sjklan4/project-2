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
{{-- todo : insert 기능 수행 --}}
{{-- ? 검색/선택된 음식 인분 수 입력 및 설정 -> 첫 입력 값만 가져옴 : search.js --}}
{{-- todo : 드롭다운 메뉴 -> 영양성분 표시 --}}

{{-- !? 선택된 음식 새로고침 시 유지 --}}
    <div>
        @if (!empty($foods))
            <div class="user_search">
                @foreach ($foods as $item)
                    <input type="checkbox" name="usercheck" id="usercheck" value="{{$item->food_id}}" onclick='getFoodValue({{Auth::user()->user_id}})'>
                    <label for="usercheck" id="food_name">{{$item->food_name}}</label>
                    <span>인분 수 : </span>
                    <input type="number" name="userving" id="userving" min="0.5" max="100">
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
                    <p class="nosearch">검색어</p>
                @endif
        
        <div class="fav_diets">
        @if (!empty($dietname))
                <h2>
                    자주먹는 식단
                </h2>
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
            
                {{-- @if ($dietname->hasPages())
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
                @endif --}}
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
                <button type="button" onclick="location.href='{{route('search.insert', ['id' => Auth::user()->user_id, 'date' => '2023-06-22', 'time' => '1'])}}'">입력</button>
        </div>
        
    </div>
@endsection

@section('js')
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/search.js')}}"></script>
@endsection