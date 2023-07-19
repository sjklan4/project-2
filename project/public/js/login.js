window.onkeydown = function() {
	let kcode = Event.keyCode;
	if(kcode == 8 || kcode == 116) Event.returnValue = false;
}

// ---------------- 0717 add ----------------
// 로그인 유효성 확인
function loginFormChk() {
    const email = document.getElementById('email');
    const password = document.getElementById('password');

    // 빈값 확인
    if(email.value === "") {
        email.focus();
        return false
    }

    if(password.value === "") {
        password.focus();
        return false
    }

    // 유효성 체크
    // if(!emailChk(email.value)) {
    //     alert("이메일 형식으로 입력해주세요.");
    //     email.focus();
    //     return false
    // }

    if(!passwordChk(password.value)) {
        alert("영문/숫자/특수문자를 하나씩 포함한 8~30자리 비밀번호를 입력해주세요.");
        password.focus();
        return false
    }
    
	document.loginForm.submit();
}


// ? --------------------------------
// ? 유효성 관련 함수
function emailChk(email) {
    let reg = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i;
    return reg.test(email);
}

function passwordChk(password) {
    let reg = /^(?=.*[a-zA-Z])(?=.*[!@#$%^*-])(?=.*[0-9]).{8,30}$/;
    return reg.test(password);
}
// ? --------------------------------

// ------------------------------------------
