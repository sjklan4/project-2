@extends('layout.layout')

@section('title', 'FoodSearch')

@section('css')
    <link rel="stylesheet" href="{{asset('css/search.css')}}">
@endsection

@section('contents')
    <form action="{{route('search.list.get')}}" method="get" class="searchform">
        @csrf
        <input type="text" name="search_input">
        <button type="submit">검색</button>
    </form>

    <ul>
        <li class="tab1">
            <a href="{{route('fav.diets', ['id' => Auth::user()->user_id])}}">저장된 식단</a>
        </li>
        <li class="tab2">
            선택된 음식
        </li>
        <li class="tab3" onclick="location.href='{{route('food.create')}}'">
            음식등록
        </li>
    </ul>

    <div>
        @if (!empty($foods))
            <div class="user_search">
                @foreach ($foods as $item)
                    <input type="hidden" name="selectedUser" value="{{$item->user_id}}">
                    <input type="checkbox" name="usercheck" id="searchname" value="{{$item->food_id}}" onclick='getCheckboxValue()'>
                    <span>{{$item->food_name}}</span>
                    <br>
                @endforeach
            </div>
        @endif
        <div id='result'></div>
        @if (!empty($fav_diets))
            <div class="fav_diets">
                <h2>자주먹는 식단</h2>
                @foreach ($fav_diets as $diet)
                    <input type="checkbox" name="usercheck" id="searchname" value="{{$diet->fav_id}}" onclick='getCheckboxValue()'>
                    <span> {{$diet->fav_name}}</span>
                    <br>
                @endforeach
            </div>
        @endif

        <div class="user_select">
            <h2>user-select</h2>
        </div>
    </div>
    {{-- @forelse ($foods as $item)
        <form action="{{route('search.list.post')}}" method="post">
            @csrf
            <input type="hidden" name="selectedUser" value="{{$item->user_id}}">
            <input type="checkbox" name="usercheck" id="searchname" value="{{$item->food_id}}" onclick='getCheckboxValue()'>
            <span>{{$item->food_name}}</span>
        </form>
        @empty
        <p>검색어를 입력해주세요.</p>
        @endforelse --}}
    {{-- <div id='result'></div> --}}
    {{-- <div class="fav_diets"> --}}
        {{-- <h2>fav-diets</h2> --}}
        {{-- <div id='result'></div> --}}
        {{-- @forelse ($fav_diets as $diet)
            <input type="checkbox" name="usercheck" id="searchname" value="{{$diet->fav_id}}" onclick='getCheckboxValue()'>
            <span> {{$diet->fav_name}}</span>
        @empty
            없음
        @endforelse --}}
    </div>
    {{-- <div class="user_select">
        <h2>user-select</h2>
    </div> --}}
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('js/search.js')}}"></script>
@endsection