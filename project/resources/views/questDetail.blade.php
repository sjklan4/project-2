@extends('layout.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/quest.css') }}">  
@endsection

@section('contents')
    <div>
        <div>{{$info->quest_name}}</div>
        <div>{{$info->quest_content}}</div>
        <div>{{$info->min_period}} 일</div>
    </div>
    <div>
        @foreach ($logs as $item)
            <div>
                <span>
                    {{$item->effective_date}}
                </span>
                @if ($item->complete_flg === '0')
                <span>미완</span>
                @else
                <span>완료</span>
                @endif
            </div>
        @endforeach
    </div>
    <br>
    <div>
        {{-- @if ()
            
        @endif --}}
        <span id="errorMsg"></span>
        <span>{{$todayLog->effective_date}} 오늘 퀘스트 완료하기</span>
        <input id="log_id" type="hidden" value="{{$todayLog->quest_log_id}}">
        <input id="stat_id" type="hidden" value="{{$questStat->quest_status_id}}">
        <button type="button" class="questUdt">완료</button>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/quest.js')}}"></script>
@endsection