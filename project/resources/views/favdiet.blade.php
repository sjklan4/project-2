@extends('layout.userdietinfo')

@section('title','favdiet')
@section('css')
    <link rel="stylesheet" href="{{asset('css/favdiet.css')}}">
@endsection

@section('contents')


<div class="fav-dietlist">
    
    <div></div>
    <div class="favbox">
        <h2>식단음식 상세정보</h2>
        <div class="box1">
            <div class="dietname">
                <table>
                    <tr>
                    {{-- 아래 구문은 for문을 가지고 컨트롤러의 favname에서 받은 select결과 값의 수만큼을 
                        반복해서 출력하도록 한다. : 지금은 favdiet테이블의 해당 user의 fav_name,fav_id를 user_id컬럼에 있는 유저id 수만큼 가져와서 반복해서 
                        출력 하도록 함(0부터 시작 favname수만큼 하려면 '<'로 표시)--}}
                        @for($i = 0; $i < count($favname); $i++)
                        <th>
                            {{-- 삭제플레그를 위해서 fav_id값을 hidden처리해서 가져옴 --}}
                            <span hidden>{{$favname[$i]->fav_id}}</span>
                            <a href="{{route('fav.favfoodinfo', ['fav_id' => $favname[$i]->fav_id])}}" class ="favdietname">{{$favname[$i]->fav_name}}</a>
                        </th>
                        <td>
                            @foreach ($favfood[$i] as $item)
                            <span>{{$item->food_name}}</span>
                            @endforeach
                        </td>
                    </tr>
                    @endfor
                </table>
            </div>

            <div class="foodnutri">
                <form action="{{route('fav.intakeupdate')}}" method="post">
                    @csrf
                @if (isset($foodinfo))
                    @foreach ($foodinfo as $item)
                        {{-- food_id를 input에 담아서 배열로 보내기 위해서 name을 빈배열식으로 주고 hidden으로 받은 food_id 값을 보내준다. 배열로 되어 있는 이유는 지금 받아오는 값들이 배열형식의 다수의 값을 가져 오는 foreach구문이기 때문에 다수의 값들을 한가지 input에 담아서 배열로 보내주기 위해 food_id[]로 만들어야 한다. 지금 오는 값은 food_id=[123,124,2943]식으로 여러개가 오는중 --}}
                        <input type="hidden" name="food_id[]" value="{{$item->food_id}}">
                        <span hidden>{{$item->fav_f_id}}</span>
                        <span hidden>{{$item->food_id}}</span>
                    <table>
                        <tr>
                            <th>
                                <span>{{$item->food_name}}</span>
                            </th>
                            <td>
                                <span><i class="bi bi-asterisk"></i>칼로리 : {{$item->kcal}}</span>
                            </td>  
                            <td>
                                <span><i class="bi bi-asterisk"></i>탄수화물 : {{$item->carbs}}</span>
                            </td>
                            <td>
                                <span><i class="bi bi-asterisk"></i>지방 : {{$item->fat}}</span>
                            </td> 
                            <td>
                                <span><i class="bi bi-asterisk"></i>단백질 : {{$item->protein}}</span>
                            </td>             
                            <td>
                                <span>당분 : {{$item->sugar}}</span>
                            </td>                                                  
                            <td>
                                <span>나트륨 : {{$item->sodium}}</span>
                            </td>                   
                                <label for="intake">
                            <td><input type="number" name="intake[]" id="intake" value={{$item->fav_f_intake}}  required>인분</label>
                            </td>
                            <td><span class="del-food" id="del-food">
                                    <a href="{{route('fav.del', $item->fav_f_id)}}" class="del-food">X</a>
                                <p class="arrow_box">등록하신 음식이 삭제 됩니다.</p></span>
                            </td>
                            </tr>
                    </table>
                    @endforeach
                    <div class="submitbtn">
                        <button type="button" onclick="location.href='{{route('fav.delete', $id)}}'" id="greenBtn">삭  제</button>
                        <button type="submit" id="greenBtn">수  정</button>
                    </div>
                @endif
            </div>
        </div>    
                    
                </form>
        <div></div>
    </div>
</div>

@endsection

