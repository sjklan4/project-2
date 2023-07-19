@extends('layout.userinfoNav')

@section('title', '비밀번호 찾기')

@section('passwordcontents')
    <div class="col-md-8 offset-lg-1 pb-5 mb-lg-2 mb-lg-4 pt-md-5 mt-n3 mt-md-0">
        <div class="ps-md-3 ps-lg-0 mt-md-2 pt-md-4 pb-md-2">
            <h1 class="h2 pt-xl-1 pb-3">Security</h1>
            <!-- Password -->
            {{-- <h2 class="h5 text-primary mb-4">Password</h2> --}}
            <form class="needs-validation pb-3 pb-lg-4" action="{{ route('user.userpseditpost') }}" method="post" id="pwForm">
                @csrf
                <div class="row">
                    <div class="col-sm-6 mb-4">
                        <label for="bpassword" class="form-label fs-base">Current password</label>
                        <div class="password-toggle">
                        <input type="password" class="form-control form-control-lg" name="bpassword" id="bpassword" required>
                        <input type="hidden" id="id" value={{session('user_id')}}>
                        {{-- <label class="password-toggle-btn" aria-label="Show/hide password">
                            <input class="password-toggle-check" type="checkbox">
                            <span class="password-toggle-indicator"></span>
                        </label> --}}
                        <div class="invalid-tooltip position-absolute top-100 start-0"></div>
                        </div>
                    </div>
                </div>
                <div class="row pb-2">
                    <div class="col-sm-6 mb-4">
                        <label for="newpassword" class="form-label fs-base">New password</label>
                        <div class="password-toggle">
                            <input type="password" name="newpassword" id="newpassword" class="form-control form-control-lg">
                            <div class="invalid-tooltip position-absolute top-100 start-0"></div>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <label for="newpasswordchk" class="form-label fs-base">Confirm new password</label>
                        <div class="password-toggle">
                            <input type="password" name="newpasswordchk" id="newpasswordchk" class="form-control form-control-lg">
                            <div class="invalid-tooltip position-absolute top-100 start-0"></div>
                        </div>
                    </div>
                </div>
                <div class="d-flex mb-3">
                    <button type="reset" class="btn btn-secondary me-3">Cancel</button>
                    <button type = "button" id="passwordchg" class="btn btn-success" onclick="chkpass();">변경</button>
                </div>
            </form>
        </div>
        <div class="changemsg">
            @if(session('error_chk'))
                {{session('error_chk')}}
            @elseif(session('success'))
                {{session('success')}}
            @endif
        </div>
    </div>

    {{-- <form action="{{ route('user.userpseditpost') }}" method="post" id="pwForm">
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
                        <button type="button" id="passwordchk" class="greenBtn" onclick="chkpass()">확인</button>
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
    </div> --}}

@endsection

@section('js')
    <script src="{{ asset('js/password.js') }}"></script>
@endsection
