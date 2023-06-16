@extends('layout.layout')

@section('title', '음식 입력')

@section('contents')
    @csrf
    {{-- <form action="{{route('foods.search')}}" method="get"> --}}
    <input type="text" name="search_input">
    <button type="button" onclick="location.href='{{route('foods.search')}}'">검색</button>
</form>
@endsection