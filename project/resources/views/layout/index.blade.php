@extends('layout.layout')


<button type="button" onclick="location.href='{{route('user.userpsedit')}}'">비밀번호 수정</button>
<button type="button" onclick="location.href='{{route('user.prevateinfo')}}'">개인설정 & 목표 칼로리 수정</button>
<button type="button" onclick="location.href='{{route('user.userfindE')}}'">회원아이디찾기</button>

<button type="button" onclick="location.href='{{route('fav.favdiet')}}'">테스트화면</button>