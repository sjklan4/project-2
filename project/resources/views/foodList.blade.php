@extends('layout.layout')

@section('title', '음식 입력')

@section('contents')
    <form action="{{route('foods.search')}}" method="post">
        <input type="text" name="search_input">
        <button type="button">검색</button>

        <ul>
            <li></li>
        </ul>
    </form>
@endsection