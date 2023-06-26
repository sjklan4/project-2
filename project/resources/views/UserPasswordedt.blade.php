@extends('layout.userinfoNav')

@section('title', 'passwordchange')

@section('passwordcontents')
    <div class="findps-body">
        <form action="{{ route('user.userpseditpost') }}" method="post">
            @csrf
        <div class="info-tablemenu">
            <table class="findps-table">
                <tr>
                    <th class="passth" colspan="2"><label for="password">기존비밀번호 : </label></th>
                    <td><input type="password" name="password" id="password" placeholder="비밀번호를 입력해 주세요"></td>
                    <td><button type="button" id="passwordchk" disabled>확인</button></td>
                </tr>
                <span id="writeerror"></span>
                <tr>
                    <th class="passth"  colspan="2"><label for="newpassword">새 비밀번호 : </label></th>
                    <td><input type="text" name="newpassword" id="newpassword"></td>
                </tr>
                <tr>
                    <th class="passth"  colspan="2"><label for="newpasswordchk">새 비밀번호 확인 : </label></th>
                    <td><input type="text" name="newpasswordchk" id="newpasswordchk"></td>
                </tr>
                <caption class="pscap"><button type = "submit" id="passwordchg" disabled>변경</button></caption>
            </table>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/password.js') }}"></script>
@endsection
