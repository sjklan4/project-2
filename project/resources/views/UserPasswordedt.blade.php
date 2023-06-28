@extends('layout.userinfoNav')

@section('title', 'passwordchange')

@section('passwordcontents')

        <form action="{{ route('user.userpseditpost') }}" method="post">
            @csrf
    <div class="shadowYellow">
        <div>
            <h2>비밀번호 변경</h2>
            <table>
                <tr>
                    <th class="passth" colspan="2"><label for="password">기존비밀번호  </label></th>
                    <td colspan="2">
                        <input type="password" name="bpassword" id="bpassword" placeholder="비밀번호를 입력해 주세요">
                        <button type="button" id="passwordchk" class="greenBtn" >확인</button>
                    </td>
                    <span id="passworderror"></span>
                </tr>
                
                <tr>
                    <th class="passth"  colspan="2"><label for="newpassword">새 비밀번호  </label></th>
                    <td><input type="text" name="newpassword" id="newpassword"></td>
                </tr>
                <tr>
                    <th class="passth"  colspan="2"><label for="newpasswordchk">새 비밀번호 확인  </label></th>
                    <td><input type="text" name="newpasswordchk" id="newpasswordchk"></td>
                </tr>
                <caption class="pscap"><button type = "submit" id="passwordchg" class="greenBtn" disabled>변경</button></caption>
            </table>
            </form>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('js/password.js') }}"></script>
@endsection
