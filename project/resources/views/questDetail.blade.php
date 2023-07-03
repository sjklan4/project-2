@extends('layout.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/quest.css') }}">  
@endsection

@section('title', '퀘스트 관리')

@section('contents')
    <div id="wrap">
        @if ($flg === 3)
            <div class="fail">
                <span>
                퀘스트 완료
                <i class="fa-solid fa-face-smile"></i>
                </span>
                <form action="{{route('quest.destroy', ['id' => $id])}}" method="post">
                    @csrf
                    @method('delete')
                    <button id="greenBtn" type="submit">퀘스트 시작</button>
                </form> 
            </div>
        @elseif ($flg !== 1)
        <div class="container contents mt-5">
            <h2 class="fw-bold">퀘스트 관리</h2>
            <div class="row mt-4">
                <div class="col-sm-5 pt-4">
                    <div class="sub1">
                        <div>
                            <span class="fw-bold">퀘스트</span>
                            <span>{{$info->quest_name}}</span>
                        </div>
                        <div>
                            <span class="fw-bold">내용</span>
                            <span>{{$info->quest_content}}</span>
                        </div>
                        <div>
                            <span class="fw-bold">기간</span>
                            <span>{{$info->min_period}} 일</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7 pt-4">
                    <div class="sub2">
                        <div>
                            <span class="fw-bold">진행도</span>
                        </div>
                        <div class="progress">
                            <div data-percentage="0%" style="width: {{$ratio['ratio']}}%;" class="progress-bar progress-bar-danger" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div>
                            <div><span class="fw-bold">{{$ratio['complete']}} / {{$ratio['period']}} 일</span></div>
                            <div><span class="fw-bold">{{$ratio['ratio']}}%</span></div>
                        </div>
                        <div class="giveUp">
                            @if ($flg === 0)
                            <form action="{{route('quest.destroy', ['id' => $questStat->quest_status_id])}}" method="post">
                                @csrf
                                @method('delete')
                                <button id="greenBtn" type="submit">퀘스트 포기</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="container quest">
                <div class="sub3 row row-cols-2 row-cols-xl-5">
                    @if ($flg === 0)
                        @foreach ($logs as $item)
                            <div class="col">
                                <span class="fw-bold">
                                    {{substr($item->effective_date, 5)}}
                                </span>
                                @if ($item->complete_flg === '0')
                                    @if ($item->effective_date === Carbon\Carbon::now()->format("Y-m-d"))
                                        <div class="imgDiv">
                                            <form action="{{route('quest.update', ['id' => $item->quest_log_id])}}" method="post">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="statId" value="{{$item->quest_status_id}}">
                                                <button type="submit">
                                                    <img id="comBtn" src="{{asset('img/quest_uncom.png')}}" alt="수행">
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="imgDiv">
                                            <img class="black" src="{{asset('img/quest_com.png')}}" alt="완료예정">
                                        </div>
                                    @endif
                                @else
                                    <div class="imgDiv">
                                        <img src="{{asset('img/quest_uncom.png')}}" alt="완료">
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div>퀘스트 실패...</div>
                    @endif
                </div>
            </div>
        @else
            <div class="fail">
                <span>
                진행중인 퀘스트가 없습니다.
                <i class="fa-solid fa-face-sad-tear"></i>
                </span>
                <button id="greenBtn" onclick="location.href='{{route('quest.index')}}'">시작하기</button>
            </div>
        @endif
        </div>
    </div>

    {{-- ajax로 한 부분... --}}
    {{-- @if (isset($info))
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
    @endif --}}
@endsection

@section('js')
    <script src="{{asset('js/quest.js')}}"></script>
@endsection