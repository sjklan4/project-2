@extends('layout.loginlayout')

@section('title', 'Mail')

@section('emailcontents')
    <form action="{{route('user.mailpost')}}" method="POST">
        @csrf
        <label for="mailAddress">email : </label>
        <input type="text" id="mailAddress" name="mailAddress">
        <button type="submit">submit</button>
    </form>
@endsection

@section('js')
@endsection