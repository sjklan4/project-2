@extends('layout.layout')

@section('title', 'favdiet')

@section('contents')


        @forelse($favfood as $val)
        <form action="{{route('fav.favfoodinfo')}}" method="post">
            @csrf
            {{ $val->fav_name }}|{{ $val->food_name }}
                <br>
        </form>
        @empty
            <p>즐겨 찾는 식단을 추가해주세요</p>
        @endforelse


@endsection

{{-- @section('js')
    <script src="{{ asset('js/password.js') }}"></script>
@endsection --}}