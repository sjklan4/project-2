@extends('layout.layout')

@section('title', '식단추천')

@section('css')
    <link rel="stylesheet" href="{{asset('css/recom.css')}}">
@endsection

@section('contents')
    <div class="RecommentDiv"> {{-- 전체를 감싸는 div--}}
        <h2 class="recomTitle">식단 추천</h2>
        <div class="contentDiv"> {{-- 내용을 감싸는 div --}}
            @if ($recomFood)
            <div class="recomFoodDiv">
                <div>
                    <h3 class="recomFoodTitle">추천 음식</h3>
                    <button type="button" class="reload" onclick="location.reload()"><i class="fa-solid fa-rotate-right"></i></button>
                </div>
                @foreach ($recomFood as $food)
                    <div class="recomcontent">
                        <span>{{$food->food_name}}</span>
                        <span>{{$food->recom_intake}} 인분</span>
                        <div class="nutcontent">
                            <span class="nut">칼로리 : {{round($food->kcal * $food->recom_intake)}}</span>
                            <span class="nut">탄수화물 : {{round($food->carbs * $food->recom_intake)}}</span>
                            <span class="nut">단백질 : {{round($food->protein * $food->recom_intake)}}</span>
                            <span class="nut">지방 : {{round($food->fat * $food->recom_intake)}}</span>
                        </div>
                    </div>
                    @endforeach
                    <hr>
                    <h3 class="recomFoodTitle">총 영양성분</h3>
                    @foreach ($totalnut as $nut)
                    <div class="nutcontent">
                        <span class="nutspan">{{$nut}}</span>
                    </div>
                    @endforeach
                    <br>
                    <div class="btnDiv">
                        <button type="button" onclick="location.href='{{route('recom.get')}}'">취소</button>
                        <button type="button" class="greenBtn" data-bs-toggle="modal" data-bs-target="#plusdiet">식단 추가</button>
                    </div>
                    {{-- 식단 명 입력 alert --}}
                    <div class="modal fade" id="plusdiet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">식단 즐겨찾기에 추가하기</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="fw-bold">식단명을 입력해주세요</p>                                     
                                    <form action="{{route('recom.setdiet')}}" method="post">
                                        @csrf
                                        @foreach($recomFood as $food)
                                            <input type="hidden" name="recomfood" value="{{$recomFood}}">
                                        @endforeach
                                        <input type="text" name="fav_name" required placeholder="식단명을 입력해주세요." autocomplete="off" maxlength="10">
                                        <button type="submit" class="greenBtn">등록하기</button>
                                    </form>
                                </div>
                            </div>
                        </div>                    
                    </div>
                </div>
            @else
                <form action="{{route('recom.post')}}" method="post">
                    @csrf
                    <div class="dietCateDiv">
                        <h3 class="recomFoodTitle">식단 유형을 선택해주세요.</h3>
                        <div class="inputRadioDiv">
                            <input type="radio" name="dietcate" id="loseweight" value="0" required>
                            <label for="loseweight">감 량</label>
                            <input type="radio" name="dietcate" id="increase" value="1" required>
                            <label for="increase">증 량</label>
                            <input type="radio" name="dietcate" id="health" value="2" required>
                            <label for="health">일 반</label>
                        </div>
                        <br>
                        <div class="btnDiv">
                            <button type="button" onclick="location.href='{{route('fav.favdiet')}}'">취소</button>
                            @if ($goalKcal)
                                <button type="submit" class="greenBtn">추천받기</button>
                            @else
                                <button type="button" class="greenBtn" data-bs-toggle="modal" data-bs-target="#nokcal">추천받기</button>
                                {{-- 식단 설정 경고 모달 --}}
                                <div class="modal fade" id="nokcal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                    <i class="fa-solid fa-circle-exclamation" style="color: #538e04;"></i>
                                                    설정된 목표 칼로리가 없습니다.
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <span class="fw-bold">목표갈로리 설정 페이지로 이동하시겠습니까?</span>  
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" data-bs-dismiss="modal" aria-label="Close">취소</button>                                   
                                                <button type="button" class="greenBtn" onclick="location.href='{{route('user.prevateinfo')}}'">확인</button>
                                            </div>
                                        </div>
                                    </div>                    
                                </div>
                            @endif
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('js/recom.js')}}"></script>
@endsection