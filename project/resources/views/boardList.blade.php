@extends('layout.layout')

@section('title', 'List')

@section('contents')
    @section('boardNav')
        <!-- As a link -->
        <nav class="navbar bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
            </div>
        </nav>
        
        <!-- As a heading -->
        <nav class="navbar bg-light">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">Navbar</span>
            </div>
        </nav>
    @show
    <a>작성하기</a>
    <table>
        <tr>
            <th>글번호</th>
            <th>글제목</th>
            <th>조회수</th>
            <th>등록일</th>
            <th>수정일</th>
        </tr>
        <tr>
            <td></td>
            <td>게시글 없음</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
@endsection