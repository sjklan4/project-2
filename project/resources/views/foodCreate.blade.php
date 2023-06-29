@extends('layout.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/board.css') }}">  
@endsection

@section('title', '사용자 음식 등록')
    
@section('contents')
    <div class="foodShadow">
        <div></div>
        <form action="{{route('food.store')}}" method="post">
            @csrf
            <div class="shadowYellow">
                <div class="foodManage">
                    <h2>사용자 음식 등록</h2>
                    <div class="foodCreateForm">
                        <div class="foodInsertGrid">
                            <div class="foodCreateTitle">
                                <div>
                                    <h5>음식명 입력</h5>
                                    <input type="text" id="foodName" name="foodName" value="{{count($errors) > 0 ? old('foodName') : ''}}" autocomplete="off">
                                    <div class="errorMsg">{{count($errors) > 0 ? $errors->first('foodName', ':message') : ''}}</div>
                                </div>
                                <div>
                                    <h5>1회 제공량</h5>
                                    <div class="inputRadioBtnDiv">
                                        <input type="text" id="serving" name="serving" value="{{count($errors) > 0 ? old('serving') : ''}}" autocomplete="off">
                                        <div class="form_toggle row-vh d-flex flex-row" >
                                            <div class="form_radio_btn">
                                                <input id="radio-1" type="radio" name="ser_unit" value="0" {{ old('ser_unit') == 0 ? 'checked' : '' }} >
                                                <label for="radio-1">g</label>
                                            </div>
                                            <div class="form_radio_btn">
                                                <input id="radio-2" type="radio" name="ser_unit" value="1" {{ old('ser_unit') == 1 ? 'checked' : '' }}>
                                                <label for="radio-2">ml</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="errorMsg">{{count($errors) > 0 ? $errors->first('serving', ':message') : ''}}</div>
                                    <div class="errorMsg">{{count($errors) > 0 ? $errors->first('ser_unit', ':message') : ''}}</div>
                                </div>
                            </div>
                            <div>
                                <h5>영양 성분</h5>
                                <label for="kcal"><i class="bi bi-asterisk"></i> 칼로리(Kcal)</label>
                                <input type="text" id="kcal" name="kcal" value="{{count($errors) > 0 ? old('kcal') : ''}}" autocomplete="off">
                                <div class="errorMsg">{{count($errors) > 0 ? $errors->first('kcal', ':message') : ''}}</div>
                                <label for="carbs"><i class="bi bi-asterisk"></i> 탄수화물(Carbs)</label>
                                <input type="text" id="carbs" name="carbs" value="{{count($errors) > 0 ? old('carbs') : ''}}" autocomplete="off">
                                <div class="errorMsg">{{count($errors) > 0 ? $errors->first('carbs', ':message') : ''}}</div>
                                <label for="protein"><i class="bi bi-asterisk"></i> 단백질(Protein)</label>
                                <input type="text" id="protein" name="protein" value="{{count($errors) > 0 ? old('protein') : ''}}" autocomplete="off">
                                <div class="errorMsg">{{count($errors) > 0 ? $errors->first('protein', ':message') : ''}}</div>
                                <label for="fat"><i class="bi bi-asterisk"></i> 지방(Fat)</label>
                                <input type="text" id="fat" name="fat" value="{{count($errors) > 0 ? old('fat') : ''}}" autocomplete="off">
                                <div class="errorMsg">{{count($errors) > 0 ? $errors->first('fat', ':message') : ''}}</div>
                                <label for="sugar">　당(Sugar)</label>
                                <input type="text" id="sugar" name="sugar" value="{{count($errors) > 0 ? old('sugar') : ''}}" autocomplete="off">
                                <div class="errorMsg">{{count($errors) > 0 ? $errors->first('sugar', ':message') : ''}}</div>
                                <label for="sodium">　나트륨(Sodium)</label>
                                <input type="text" id="sodium" name="sodium" value="{{count($errors) > 0 ? old('sodium') : ''}}" autocomplete="off">
                                <div class="errorMsg">{{count($errors) > 0 ? $errors->first('sodium', ':message') : ''}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rigtTwoBtnDiv">
                <button type="button" onclick="location.href='{{ route('food.index') }}'">취소</button>
                <button type="submit" id="greenBtn">입력</button>
            </div>
        </form>
        <div></div>
    </div>
@endsection