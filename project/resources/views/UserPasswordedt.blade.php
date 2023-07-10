@extends('layout.userinfoNav')

@section('title', '비밀번호 찾기')

@section('passwordcontents')

        <form action="{{ route('user.userpseditpost') }}" method="post" id="pwForm">
            @csrf
    <div class="shadowYellow">
        <div>
            <h2>비밀번호 변경</h2>
            <table>
                <tr>
                    <th class="passth" colspan="2"><label for="password">기존비밀번호  </label></th>
                    <td colspan="2">
                        <input type="password" name="bpassword" id="bpassword" placeholder="비밀번호를 입력해 주세요">
                        <input type="hidden" id="id" value={{session('user_id')}}>
                        {{-- <button type="button" id="passwordchk" class="greenBtn" onclick="chkpass()">확인</button> --}}
                    </td>
                    <span id="passworderror" class="passworderror"></span>
                </tr>
                
                <tr>
                    <th class="passth"  colspan="2"><label for="newpassword">새 비밀번호  </label></th>
                    <td><input type="password" name="newpassword" id="newpassword"></td>
                </tr>
                <tr>
                    <th class="passth"  colspan="2"><label for="newpasswordchk">새 비밀번호 확인  </label></th>
                    <td><input type="password" name="newpasswordchk" id="newpasswordchk"></td>
                </tr>
                <caption class="pscap">
                    <button type = "button" id="passwordchg" class="greenBtn" onclick="chkpass();">변경</button>
                </caption>
            </table>
            <div class="changemsg">
                @if(session('error_chk'))
                    {{session('error_chk')}}
                @elseif(session('success'))
                    {{session('success')}}
                @endif
            </div>
            </form>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('js/password.js') }}"></script>
@endsection
