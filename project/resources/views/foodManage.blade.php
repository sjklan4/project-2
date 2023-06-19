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
                                <div class="nav-link" class="foodNavBtn">{{$item->food_name}}</div>
                            </li>
                        @empty
                            <div>등록된 음식이 없습니다.</div>
                        @endforelse
                    </ul>
                </div>
            </div>
            <div>
                <h3>Food1</h3>
                <div>
                    <div>영양 성분</div>
                    <form action="">
                        <label for="kcal">칼로리(Kcal)</label>
                        <input type="text" id="kcal" name="kcal" value="1,320">
                        <br>
                        <label for="kcal">탄수화물(Carbs)</label>
                        <input type="text" id="carbs" name="carbs" value="220">
                        <br>
                        <label for="kcal">단백질(Protein)</label>
                        <input type="text" id="protein" name="protein" value="506">
                        <br>
                        <label for="kcal">지방(Fat)</label>
                        <input type="text" id="fat" name="fat" value="300">
                        <br>
                        <label for="kcal">당(Sugar)</label>
                        <input type="text" id="sugar" name="sugar" value="400">
                        <br>
                        <label for="kcal">나트륨(Sodium)</label>
                        <input type="text" id="sodium" name="sodium" value="20">
                        <br>
                        <div>1회 제공량</div>
                        <input type="text" name="serving">
                        <input type="radio" name="ser_unit" value="0">g
                        <input type="radio" name="ser_unit" value="1">ml
                        <br>
                        <button>삭제</button>
                        <button>수정</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/foodManage.js') }}"></script>
@endsection