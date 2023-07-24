@extends('layout.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/quest.css') }}">  
@endsection

@section('title', '퀘스트 수락')

@section('contents')
<div class="con">
    <h1>퀘스트 수락</h1>
    <h6 id="questSet">
        @if (!isset($flg))
            이미 진행중인 퀘스트가 있습니다.
        @endif
    </h6>
    
    <section class="articles">
        @foreach ($data as $item)
        <article>
            <div class="article-wrapper">
                <figure>
                    <img src="{{asset('img/quest_'.$item->quest_cate_id.'.jpg')}}" alt="" />
                </figure>
                <div class="article-body">
                    <h2>
                        {{$item->quest_name}}</h2>
                    <p>
                        {{$item->quest_content}} ｜ {{$item->min_period}}일
                    </p>
                    @if (isset($flg))
                    <form action="{{route('quest.store')}}" method="post">
                        @csrf
                        <label for="time">알림 설정</label>
                        <select name="time">
                            <option value="">시간 선택</option>
                            @for ($i = 1; $i < 24; $i++)
                                <option value="{{$i}}">{{sprintf('%02d',$i)}}시</option>
                            @endfor
                        </select>
                        <input type="hidden" name="id" value="{{$item->quest_cate_id}}">
                        <button id="greenBtn" type="submit">시작하기</button>
                    </form>
                    @endif
                </div>
            </div>
        </article>
        @endforeach
    </section>
</div>


{{-- <div class="cards">
    <div class="options">
        @foreach ($data as $item)
            <div class="option" style="--optionBackground:url({{asset('img/quest_'.$item->quest_cate_id.'.jpg')}});">
                <div class="shadow"></div>
                <div class="label">
                    <div class="icon">
                        @if ($item->quest_cate_id === 1)
                            <i class="fas fa-tint"></i>
                        @elseif ($item->quest_cate_id === 2)
                            <i class="fa-solid fa-hand"></i>
                        @elseif ($item->quest_cate_id === 3)
                            <i class="fa-solid fa-person-walking"></i>
                        @elseif ($item->quest_cate_id === 4)
                            <i class="fa-solid fa-stairs"></i>
                        @else
                            <i class="fa-solid fa-bed"></i>
                        @endif
                    </div>
                    <div class="info">
                        <div class="main">{{$item->quest_name}}</div>
                        <div class="sub">{{$item->quest_content}} ｜ {{$item->min_period}}일</div>
                    </div>
                    <div class="button">
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
        @endforeach
    </div>
    <h6 id="questSet">
        @if (!isset($flg))
            이미 진행중인 퀘스트가 있습니다.
        @endif
    </h6>
</div> --}}
@endsection

@section('js')
    <script src="{{asset('js/quest.js')}}"></script>
@endsection