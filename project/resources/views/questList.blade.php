@extends('layout.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/board.css') }}">  
@endsection

@section('contents')
    <h1>퀘스트 수락</h1>
    <div>
        <div>퀘스트 목록</div>
        @foreach ($data as $item)
            <div>
                <span>{{$item->quest_name}}</span>
                <span>{{$item->quest_content}}</span>
                <span>{{$item->min_period}}일</span>
                {{-- todo 이미 수락된 퀘스트가 있으면 수락 버튼 안뜨게 하기 --}}
                <span>
                    <form action="{{route('quest.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$item->quest_cate_id}}">
                        <button id="greenBtn">수락</button>
                    </form>
                </span>
            </div>
        @endforeach
    </div>
@endsection

@section('js')
    <script src="{{asset('js/board.js')}}"></script>
@endsection