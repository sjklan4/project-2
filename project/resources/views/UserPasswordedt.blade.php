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
                        <span style="position: absolute; top:10px; right:10px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16" id="nowicon1">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-slash off" viewBox="0 0 16 16" id="nowicon2">
                                <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                                <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                                <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
                            </svg>
                        </span>
                        @error('bpassword')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="invalid-tooltip position-absolute top-100 start-0"></div>
                        </div>
                    </div>
                </div>
                <div class="row pb-2">
                    <div class="col-sm-6 mb-4">
                        <label for="newpassword" class="form-label fs-base">New password</label>
                        <div class="password-toggle">
                            <input type="password" name="newpassword" id="newpassword" class="form-control form-control-lg">
                            <span style="position: absolute; top:10px; right:10px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16" id="newicon1">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-slash off" viewBox="0 0 16 16" id="newicon2">
                                    <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                                    <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                                    <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
                                </svg>
                            </span>
                        </div>
                        @error('newpassword')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        {{-- <div id="pwMsg"></div> --}}
                    </div>
                    <div class="col-sm-6 mb-4">
                        <label for="newpasswordchk" class="form-label fs-base">Confirm new password</label>
                        <div class="password-toggle">
                            <input type="password" name="newpasswordchk" id="newpasswordchk" class="form-control form-control-lg">
                            <span style="position: absolute; top:10px; right:10px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16" id="newicon3">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-slash off" viewBox="0 0 16 16" id="newicon4">
                                    <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                                    <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                                    <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="d-flex mb-3">
                    <button type="reset" class="btn btn-secondary me-3">Cancel</button>
                    {{-- <button type = "button" id="passwordchg" class="btn btn-success" onclick="chkpass();">변경</button> --}}
                    <button type = "submit" id="passwordchg" class="btn btn-success">변경</button>
                </div>
            </form>
            <div id="passworderror"></div>
        </div>
        <div class="changemsg">
            @if(session('error'))
                {{session('error')}}
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
