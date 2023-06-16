@extends('layout.layout')

@section('title', 'FoodSearch')

@section('contents')
    @csrf
    <form action="{{route('search')}}" method="post">
        <input type="text" name="search_input">
        <button type="submit">검색</button>
    </form>

    @forelse ($foddd as $item)
        <input type="checkbox" name="searchname" id="searchname" value="{{ $item->food_name }}">
    @empty
        asdsa
    @endforelse
@endsection