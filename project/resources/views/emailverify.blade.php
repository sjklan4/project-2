@extends('layout.loginlayout')

@section('title', 'Mail')

@section('contents')
    <form action="{{route('users.verify')}}" method="POST">
        @csrf
        <label for="mailAddress">email : </label>
        <input type="text" id="mailAddress" name="mailAddress" onblur="duplicationEmail()"
            value="{{ $errors->has('user_email') ? '' : old('user_email', isset($data) ? $data->user_email : '') }}" autocomplete="off" required>
        
        @error('user_email')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        {{--todo 임시 br 삭제후 css조정 필요 --}}
        <br>
        <br>
        <div class="loginBtn">
            <button type="submit" id="greenBtn">인증번호발송</button>
        </div>
    </form>
@endsection

@section('js')
    <script src="{{ asset('js/regist.js') }}"></script>
@endsection