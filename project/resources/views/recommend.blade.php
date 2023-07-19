@extends('layout.layout')

@section('title', 'FoodSearch')

@section('css')
    <link rel="stylesheet" href="{{asset('css/recom.css')}}">
@endsection

@section('contents')
    <div class="RecommentDiv"> {{-- 전체를 감싸는 div--}}
        <h2 class="recomTitle">식단 추천</h2>
        <div class="contentDiv"> {{-- 내용을 감싸는 div --}}
            @if ($recomFood)
                <div class="recomFoodDiv">
                    <h3 class="recomFoodTitle">추천 음식</h3>
                    @foreach ($recomFood as $food)
                    <span>{{$food->food_name}}</span>
                    <span>{{$food->recom_intake}} 인분</span>
                    <span class="nut">칼로리 : {{round($food->kcal * $food->recom_intake)}}</span>
                    <span class="nut">탄수화물 : {{round($food->carbs * $food->recom_intake)}}</span>
                    <span class="nut">단백질 : {{round($food->protein * $food->recom_intake)}}</span>
                    <span class="nut">지방 : {{round($food->fat * $food->recom_intake)}}</span>
                    <br>
                    @endforeach
                    
                    <h3>총 영양 성분</h3>
                    @foreach ($totalnut as $nut)
                    <span>{{$nut}}</span>
                    @endforeach
                    <br>
                    <button type="button" onclick="location.href='{{route('board.create')}}'">식단 공유</button>
                    <button type="button" onclick="location.href='{{route('recom.get')}}'">취소</button>
                    <button type="button" class="reload" onclick="location.reload()"><i class="fa-solid fa-rotate-right"></i></button>
                    <button type="button" class="greenBtn" data-bs-toggle="modal" data-bs-target="#exampleModal0">식단 추가</button>
                    {{-- 식단 명 입력 alert --}}
                    <div class="modal fade" id="exampleModal0" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            {{-- todo : 증량, 감량, 일반 선택 -> 카드형 --}}
                <form action="{{route('recom.post')}}" method="post">
                    @csrf
                    <div class="dietCateDiv">
                        <h3 class="recomFoodTitle">식단 유형</h3>
                        <div class="inputRadioDiv">
                            <input type="radio" name="dietcate" id="loseweight" value="0" required>
                            <label for="loseweight">감량</label>
                            <input type="radio" name="dietcate" id="increase" value="1" required>
                            <label for="increase">증량</label>
                            <input type="radio" name="dietcate" id="health" value="2" required>
                            <label for="health">일반</label>
                        </div>
                        <br>
                        <div class="btnDiv">
                            <button type="button" onclick="location.href='{{route('fav.favdiet')}}'">취소</button>
                            <button type="submit" class="greenBtn">추천받기</button>
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