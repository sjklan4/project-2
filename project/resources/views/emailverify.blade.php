@extends('layout.loginlayout')

@section('title', 'Mail')

@section('contents')
    <form action="{{route('users.verify')}}" method="POST">
        @csrf
        <label for="mailAddress">email : </label>
        <input type="text" id="mailAddress" name="mailAddress">
        <button type="submit">submit</button>
    </form>
@endsection

@section('js')
@endsection