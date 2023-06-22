@extends('layout.layout')

@section('title', 'favdiet')

@section('contents')

    {{-- {{var_dump($favname);}} --}}
    
    @for($i = 0; $i < count($favname); $i++)
        <a href="{{route('fav.favfoodinfo', ['fav_id' => $favname[$i]->fav_id])}}">{{$favname[$i]->fav_name}}</a>
        @foreach ($favfood[$i] as $item)
        <span>{{$item->food_name}}</span>
        @endforeach
        <br>
    @endfor
    
    <br>

    <form action="{{route('fav.intakeupdate')}}" method="post">
        @csrf
    @if (isset($foodinfo))
        @foreach ($foodinfo as $item)
            {{-- {{var_dump($item)}} --}}
            {{-- food_id를 input에 담아서 배열로 보내기 위해서 name을 빈배열식으로 주고 hidden으로 받은 food_id 값을 보내준다. 배열로 되어 있는 이유는 지금 받아오는 값들이 배열형식의 다수의 값을 가져 오는 foreach구문이기 때문에 다수의 값들을 한가지 input에 담아서 배열로 보내주기 위해 food_id[]로 만들어야 한다. 지금 오는 값은 food_id=[123,124,2943]식으로 여러개가 오는중 --}}
            <input type="hidden" name="food_id[]" value="{{$item->food_id}}">
            <span hidden>{{$item->food_id}}</span>
            <span>{{$item->food_name}}</span>
            <span>칼로리 : {{$item->kcal}}</span>  
            <span>탄수화물 : {{$item->carbs}}</span>
            <span>지방 : {{$item->fat}}</span>  
            <span>단백질 : {{$item->protein}}</span>
            <span>당분 : {{$item->sugar}}</span>
            <span>나트륨 : {{$item->sodium}}</span>
            <label for="intake">
            <input type="number" name="intake[]" id="intake">인분</label>
            <br>
        @endforeach
    @endif
    <button type="submit">수정</button>
    </form>
@endsection
{{-- {{var_dump($favfood[$i])}} --}}
{{-- @section('js')
    <script src="{{ asset('js/password.js') }}"></script>
@endsection --}}

{{-- <form action="{{route('fav.favfoodinfo')}}" method="post">
</form> --}}



    {{-- @forelse($favname as $val)
        {{ $val->fav_name }}
        @forelse($favfood as $val)
                {{ $val->food_name }}
        @empty
            <p>즐겨 찾는 식단을 추가해주세요</p>
        @endforelse
        <br>
    @empty
        <p>즐겨 찾는 식단을 추가해주세요</p>
    @endforelse --}}



    
    {{-- {{var_dump($favfoodinfo)}}; --}}
                
    {{-- @forelse($favfoodinfo as $val)
        {{$val->food_name}}
    @empty
        <p>식단에 음식을 추가해주세요.</p>
    @endforelse --}}

    {{-- <a href="{{ route('fav.favfoodinfo', ['fav_id' => $val->fav_id]) }}"></a> --}}