@extends('layout.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/quest.css') }}">  
@endsection

@section('title', '퀘스트 관리')

@section('contents')
    @if (isset($info))
        <div>
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
                @if ($todayLog->complete_flg !== '1')
                    <span>{{$todayLog->effective_date}} 오늘 퀘스트 완료하기</span>
                    <span id="errorMsg"></span>
                    <input id="log_id" type="hidden" value="{{$todayLog->quest_log_id}}">
                    <input id="stat_id" type="hidden" value="{{$questStat->quest_status_id}}">
                    <button type="button" class="questUdt">완료</button>
                @else
                    <div>오늘 퀘스트 완료!</div>
                @endif
            </div>
        </div>
    @else
        <div>진행중인 퀘스트가 없습니다.</div>
    @endif
@endsection

@section('js')
    <script src="{{asset('js/quest.js')}}"></script>
@endsection