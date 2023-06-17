@extends('layout.layout')

@section('title', 'FoodSearch')

@section('js')
    <script src="{{asset('js/search.js')}}"></script>
@endsection

@section('contents')
    <form action="{{route('search.list.get')}}" method="get" class="searchform">
    @csrf
        <input type="text" name="search_input">
        <button type="submit">검색</button>
    </form>

    <div class="btnDiv">
        <button type="button" class="favdiets">저장된 식단</button>
        <button type="button" class="userseleted">선택된 음식</button>
        <button type="button" class="userfoodinsert" onclick="location.href='{{route('food.create')}}'">음식 등록</button>
    </div>

    <div class="searchResult">
        @forelse ($foddd as $item)
        <form action="{{route('search.list.post')}}" method="post">
            @csrf
            <input type="hidden" name="selectedUser" value="{{$item->user_id}}">
            <input type="checkbox" name="usercheck" id="searchname" value="{{$item->food_id, $item->user_id}}">
            <span>{{$item->food_name}}</span>
        </form>
        @empty
            <p>검색어를 입력해주세요.</p>
        @endforelse
    </div>
@endsection