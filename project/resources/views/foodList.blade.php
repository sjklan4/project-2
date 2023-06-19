@extends('layout.layout')

@section('title', 'FoodSearch')

@section('js')
    <script type="text/javascript" src="{{asset('js/search.js')}}"></script>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('css/search.css')}}">
@endsection

@section('contents')
    <form action="{{route('search.list.get')}}" method="get" class="searchform">
    @csrf
        <input type="text" name="search_input">
        <button type="submit">검색</button>
    </form>

    <button type="button" class="tab1">
        <a href="{{route('fav.diets', ['id' => Auth::user()->user_id])}}">저장된 식단</a></button>
    <button type="button" class="tab2">선택된 음식</button>
    <button type="button" class="tab3" onclick="location.href='{{route('food.create')}}'">음식등록</button>
    <div class="user_search">
        @forelse ($foods as $item)
        <form action="{{route('search.list.post')}}" method="post">
            @csrf
            <input type="hidden" name="selectedUser" value="{{$item->user_id}}">
            <input type="checkbox" name="usercheck" id="searchname" value="{{$item->food_id}}" onclick='getCheckboxValue()'>
            <span>{{$item->food_name}}</span>
        </form>
        @empty
        <p>검색어를 입력해주세요.</p>
        @endforelse
    </div>
    <div id='result'></div>
    <div class="fav_diets">
        <h2>fav-diets</h2>
        @forelse ($fav_diets as $diet)
        <input type="checkbox" name="usercheck" id="searchname" value="{{$diet->fav_id}}" onclick='getCheckboxValue()'>
        <span> {{$diet->fav_name}}</span>
        @empty
            없음
        @endforelse
    </div>
    <div class="user_select">
        <h2>user-select</h2>
    </div>
@endsection