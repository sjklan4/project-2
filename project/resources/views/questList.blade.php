@extends('layout.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/quest.css') }}">  
@endsection

@section('contents')
<div class="cards">
    <div class="options">
        @foreach ($data as $item)
            <div class="option" style="--optionBackground:url({{asset('img/quest_1.jpg')}});">
                <div class="shadow"></div>
                <div class="label">
                    <div class="icon">
                        <i class="fas fa-tint"></i>
                    </div>
                    <div class="info">
                        <div class="main">{{$item->quest_name}}</div>
                        <div class="sub">{{$item->quest_content}} {{$item->min_period}}일
                            @if (isset($flg))
                            <form action="{{route('quest.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$item->quest_cate_id}}">
                                <button type="submit">시작하기</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('js')
    <script src="{{asset('js/quest.js')}}"></script>
@endsection