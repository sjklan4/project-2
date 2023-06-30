{{-- 아침 식단 사진 변경 --}}
{{-- <div class="modal fade" id="brfImg" tabindex="-1" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">아침식단사진 변경</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">
            사진 추가<br>
            <form action="{{route('img.edit',['d_id' => $data['diet'][0]->d_id])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="file" name="dietImg">
                <button type="submit">등록하기</button>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-bs-dismiss="modal">닫기</button>
        </div>
    </div>
</div>                    
</div> --}}

{{-- 점심 식단 사진 변경 --}}
{{-- <div class="modal fade" id="lunchImg" tabindex="-1" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">점심식단사진 변경</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">
            사진 추가<br>
            <form action="{{route('img.edit')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="file" name="dietImg">
                <button type="submit">등록하기</button>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-bs-dismiss="modal">닫기</button>
        </div>
    </div>
</div>                    
</div> --}}

{{-- 저녁 식단 사진 변경 --}}
{{-- <div class="modal fade" id="dinnerImg" tabindex="-1" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">저녁 식단사진 변경</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">
            사진 추가<br>                                 
            <form action="{{route('img.edit')}}" method="post">
                @csrf
                @method('put')
                <input type="hidden" name="d_date" value="{{$data['date'] ?? $data['today']}}">
                <input type="hidden" name="d_flg" value="0">
                <input type="file">
                <button type="submit">등록하기</button>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-bs-dismiss="modal">닫기</button>
        </div>
    </div>
</div>                    
</div> --}}

{{-- 간식 식단 사진 변경 --}}
{{-- <div class="modal fade" id="snackImg" tabindex="-1" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">간식 식단사진 변경</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">
            사진 추가<br>                                 
            <form action="{{route('img.edit')}}" method="post">
                @csrf
                @method('put')
                <input type="hidden" name="d_date" value="{{$data['date'] ?? $data['today']}}">
                <input type="hidden" name="d_flg" value="0">
                <input type="file">
                <button type="submit">등록하기</button>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-bs-dismiss="modal">닫기</button>
        </div>
    </div>
</div>                    
</div> --}}