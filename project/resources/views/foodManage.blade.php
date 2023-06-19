@extends('layout.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/board.css') }}">  
@endsection

@section('title', '사용자 등록 음식 관리')

@section('contents')
    <div class="shadowYellow">
        <div class="foodInsertTitleGrid">
            <div>사용자 등록 음식 관리</div>
            <div>
                <button type="button" onclick="location.href='{{route('food.create')}}'">음식 추가</button>
            </div>
        </div>
        <div class = "foodInsertGrid">
            <div>
                <div class="shadow">
                    <ul class="nav flex-column">
                        @forelse ($data as $item)
                            <li class="nav-item">
                                <a href="{{route('food.show', ['food' => $item->food_id])}}">{{$item->food_name}}</a>
                            </li>
                        @empty
                            <div>등록된 음식이 없습니다.</div>
                        @endforelse
                    </ul>
                </div>
            </div>
            @if (isset($food))
            <div>
                <form action="{{route('food.update', ['food' => $food->food_id])}}" method="post">
                    @csrf
                    @method('put')
                    <h3>
                        <input type="text" name="foodName" value="{{$food->food_name}}">
                    </h3>
                    <div>
                        <div>영양 성분</div>
                        <label for="kcal">칼로리(Kcal)</label>
                        <input type="text" id="kcal" name="kcal" value="{{$food->kcal}}">
                        <br>
                        <label for="kcal">탄수화물(Carbs)</label>
                        <input type="text" id="carbs" name="carbs" value="{{$food->carbs}}">
                        <br>
                        <label for="kcal">단백질(Protein)</label>
                        <input type="text" id="protein" name="protein" value="{{$food->protein}}">
                        <br>
                        <label for="kcal">지방(Fat)</label>
                        <input type="text" id="fat" name="fat" value="{{$food->fat}}">
                        <br>
                        <label for="kcal">당(Sugar)</label>
                        <input type="text" id="sugar" name="sugar" value="{{$food->sugar}}">
                        <br>
                        <label for="kcal">나트륨(Sodium)</label>
                        <input type="text" id="sodium" name="sodium" value="{{$food->sodium}}">
                        <br>
                        <div>1회 제공량</div>
                        <div class="inputRadioBtnDiv">
                            <input type="text" name="serving" value="{{$food->serving}}">
                            <div class="form_toggle row-vh d-flex flex-row" >
                                @if ($food->ser_unit === '0')
                                    <div class="form_radio_btn">
                                        <input id="radio-1" type="radio" name="ser_unit" value="0" checked>
                                        <label for="radio-1">g</label>
                                    </div>
                                    <div class="form_radio_btn">
                                        <input id="radio-2" type="radio" name="ser_unit" value="1">
                                        <label for="radio-2">ml</label>
                                    </div>
                                @else
                                <div class="form_radio_btn">
                                    <input id="radio-1" type="radio" name="ser_unit" value="0">
                                    <label for="radio-1">g</label>
                                </div>
                                <div class="form_radio_btn">
                                    <input id="radio-2" type="radio" name="ser_unit" value="1" checked>
                                    <label for="radio-2">ml</label>
                                </div>
                                @endif
                                
                            </div>
                        </div>
                        <br>
                        
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            삭제
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">등록 음식 삭제</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                정말 삭제하시겠습니까?
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
                                <form action="{{route('food.destroy', ['food' => $food->food_id])}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-primary">삭제
                                    </button>
                                </form>
                                </div>
                            </div>
                            </div>
                        </div>

                        <button type="submit">수정</button>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/foodManage.js') }}"></script>
@endsection