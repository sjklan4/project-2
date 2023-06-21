@extends('layout.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/board.css') }}">  
@endsection

@section('title', '사용자 음식 등록')
    
@section('contents')
    <div class="shadowYellow">
    <div>사용자 음식 등록</div>
        <form action="{{route('food.store')}}" method="post">
            @csrf
            <div class="foodInsertGrid">
                <div>
                    <div>음식명 입력</div>
                    <input type="text" id="foodName" name="foodName" value="{{count($errors) > 0 ? old('foodName') : ''}}">
                    <div>{{count($errors) > 0 ? $errors->first('foodName', ':message') : ''}}</div>
                    <br>
                    <div>1회 제공량</div>

                    <div class="inputRadioBtnDiv">
                        <input type="text" id="serving" name="serving" value="{{count($errors) > 0 ? old('serving') : ''}}">
                        <div class="form_toggle row-vh d-flex flex-row" >
                            <div class="form_radio_btn">
                                <input id="radio-1" type="radio" name="ser_unit" value="0" {{ old('ser_unit') == 0 ? 'checked' : '' }}>
                                <label for="radio-1">g</label>
                            </div>
                            <div class="form_radio_btn">
                                <input id="radio-2" type="radio" name="ser_unit" value="1" {{ old('ser_unit') == 1 ? 'checked' : '' }}>
                                <label for="radio-2">ml</label>
                            </div>
                        </div>
                    </div>
                    <div>{{count($errors) > 0 ? $errors->first('serving', ':message') : ''}}</div>
                    <div>{{count($errors) > 0 ? $errors->first('ser_unit', ':message') : ''}}</div>
                    <br>
                </div>
                <div>
                    <div>영양 성분</div>
                    <label for="kcal">칼로리(Kcal)</label>
                    <input type="text" id="kcal" name="kcal" value="{{count($errors) > 0 ? old('kcal') : ''}}">
                    <div>{{count($errors) > 0 ? $errors->first('kcal', ':message') : ''}}</div>
                    <br>
                    <label for="carbs">탄수화물(Carbs)</label>
                    <input type="text" id="carbs" name="carbs" value="{{count($errors) > 0 ? old('carbs') : ''}}">
                    <div>{{count($errors) > 0 ? $errors->first('carbs', ':message') : ''}}</div>
                    <br>
                    <label for="protein">단백질(Protein)</label>
                    <input type="text" id="protein" name="protein" value="{{count($errors) > 0 ? old('protein') : ''}}">
                    <div>{{count($errors) > 0 ? $errors->first('protein', ':message') : ''}}</div>
                    <br>
                    <label for="fat">지방(Fat)</label>
                    <input type="text" id="fat" name="fat" value="{{count($errors) > 0 ? old('fat') : ''}}">
                    <div>{{count($errors) > 0 ? $errors->first('fat', ':message') : ''}}</div>
                    <br>
                    <label for="sugar">당(Sugar)</label>
                    <input type="text" id="sugar" name="sugar" value="{{count($errors) > 0 ? old('sugar') : ''}}">
                    <div>{{count($errors) > 0 ? $errors->first('sugar', ':message') : ''}}</div>
                    <br>
                    <label for="sodium">나트륨(Sodium)</label>
                    <input type="text" id="sodium" name="sodium" value="{{count($errors) > 0 ? old('sodium') : ''}}">
                    <div>{{count($errors) > 0 ? $errors->first('sodium', ':message') : ''}}</div>
                    <br>
                </div>
            </div>
            <button type="button" onclick="location.href='{{ route('food.index') }}'">취소</button>
            <button type="submit">입력</button>
        </form>
    </div>
@endsection