@extends('layout.layout')

@section('title', 'FoodSearch')

@section('contents')
    <form action="{{route('search.list.get')}}" method="get">
    @csrf
        <input type="text" name="search_input">
        <button type="submit">검색</button>
    </form>
    @forelse ($foddd as $item)
    <form action="{{route('search.list.post')}}" method="post">
        <div>
            <input type="hidden" name="selectedUser" value="{{$item->user_id}}">
            <input type="checkbox" name="searchname" id="searchname" value="{{$item->food_id, $item->user_id}}">
            <span>{{$item->food_name}}</span>
        </div>
    </form>
        <br>
    @empty
        <p>검색어를 입력해주세요.</p>
    @endforelse
@endsection