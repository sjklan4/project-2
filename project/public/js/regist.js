
// RFC 5322형식 기준 : 거의 모든 메일의 형식에 대해서 유효성 검사를 실시한다. - 일반적인 유효성 검사로는 메일을 완벽하게 검증하는것이 불가능하여 있는 규칙
const emailRegx = new RegExp("([!#-'*+/-9=?A-Z^-~-]+(\.[!#-'*+/-9=?A-Z^-~-]+)*|\"\(\[\]!#-[^-~ \t]|(\\[\t -~]))+\")@([!#-'*+/-9=?A-Z^-~-]+(\.[!#-'*+/-9=?A-Z^-~-]+)*|\[[\t -Z^-~]*])");

// 중복확인 버튼
const checkEmailbutton = document.getElementById('checkEmail');

// 회원가입 버튼
const signupButton = document.getElementById('signupButton');

// 닉네임 input
const userNkname = document.getElementById('nkname');
const userphone = document.getElementById('user_phone_num');

// 이메일 중복확인
function duplicationEmail(){
    const userEmail = document.getElementById('user_email');
    const url = "/api/user/useremailedt/" + userEmail.value;

    // email 값이 비어있을 경우
    if(userEmail.value.trim()===""){
        alert("이메일을 입력해주세요.");
    }
    else{
        fetch(url)
        .then(data => {
            if(!data.status){
                throw new Error(data.status + ' :API Response Error');
            }
            return data.json();
        })
        .then(apiData => {
            const idspan = document.getElementById('mailMsg');

            if(apiData["errorcode"] === "1"){
                idspan.innerHTML = apiData["msg"];
                idspan.style.color = "#EE6666";
            }
            else if(!emailRegx.test(userEmail.value)){
                idspan.innerHTML = "이메일형식에 맞춰서 입력해주세요";
                idspan.style.color = "#EE6666"
            }
            else{
                idspan.innerHTML = "사용가능한 Email입니다.";
                idspan.style.color = "#6799E4"
                signupButton.disabled = false;
            }
        })
    }
}

function pwCheck(){
    const pw = document.getElementById("password");
    const pwChk = document.getElementById("passwordchk");
    const pwMsg = document.getElementById("pwMsg");

    if(pw.value.trim()==="" && pwChk.value.trim()===""){
        pwMsg.innerHTML = "";
    }
    else if(pw.value === pwChk.value){
        pwMsg.innerHTML = "비밀번호 일치";
        pwMsg.style.color = "#6799E4";
    }
    else{
        pwMsg.innerHTML = "비밀번호 불일치"
        pwMsg.style.color = "#EE6666";
    }
}

// checkEmailbutton.addEventListener('click',function(){
//     const userEmail = document.getElementById('user_email');
//     const url = "/api/user/useremailedt/" + userEmail.value;

//     fetch(url)
//     .then(data => {
//         if(!data.status){
//             throw new Error(data.status + ' :API Response Error');
//         }
//         return data.json();
//     })
//     .then(apiData => {
//         const idspan = document.getElementById('okemail');

//         if(apiData["errorcode"] === "1"){
//             idspan.innerHTML = apiData["msg"];
//             idspan.style.color = "red";
//         }
//         else if(!emailRegx.test(userEmail.value)){
//             idspan.innerHTML = "정규식 에러";
//             idspan.style.color = "red"
//         }
//         else{
//             idspan.innerHTML = "사용가능한 Email입니다.";
//             idspan.style.color = "blue"
//             signupButton.disabled = true;
//         }

//     })
// });

// userEmailField.addEventListener('input', function() {
//         if (userEmailField.value.trim()==="") {
//             emailRegexm.innerHTML = '이메일을 입력해 주세요(공백없이 입력해주세요)';
//             chdeckEmail.disabled = true;
//             signupButton.disabled = true;
//
//         }else if(!emailRegx.test(userEmailField.value)){
//             emailRegexm.innerHTML = '영문(대소)및 숫자로 이메일 형식에 맞춰서 입력해주세요';
//             chdeckEmail.disabled = false;
//             signupButton.disabled = true;
//         }
//         else{
//         emailRegexm.innerHTML ='';
//         chdeckEmailbutton.addEventListener('click',function(){
//             const id = document.getElementById('user_email');
//             const url = "/api/user/useremailedt/" + id.value; //빈값의 경우 처리 과정 추가

//             fetch(url)
//             .then(data => {
//                 if (!data.status) {
//                     throw new Error(data.status + ' : API Response Error' );
//                 }
//                 return data.json();
//             })
//             .then(apiData  => {
//                 const idspan = document.getElementById('okemail');
//                     if(apiData["flg"] === "1") {
//                         idspan.innerHTML = apiData["msg"];
//                         idspan.style.color = 'red'
//                     } else {
//                         idspan.innerHTML = "사용가능한 Email입니다. "
//                         idspan.style.color = 'blue'
//                         signupButton.disabled = false;
//                     }
//             });
//         });

//         nknamechk.addEventListener('input', function(){
//             const nk = document.getElementById('nkname');
//             const url = "/api/user/usernkchk/" + nk.value;
//             fetch(url)
//             .then(data => {
//                 if (!data.status) {
//                     throw new Error(data.status + ' : API Response Error' );
//                 }
//                 return data.json();
//             })
//             .then(apiData  => {
//                 const idspan = document.getElementById('nkRegexm');
//                     if(apiData["flg"] === "1") {
//                         idspan.innerHTML = apiData["msg"];
//                         idspan.style.color = 'red'
//                         signupButton.disabled = true;
//                     } else {
//                         idspan.innerHTML = "사용가능한 닉네임 입니다. "
//                         idspan.style.color = 'blue'
//                         signupButton.disabled = false;
//                     }
//             });
//         });

//         userphonechk.addEventListener('input', function(){
//             const ph = document.getElementById('user_phone_num');
//             const url = "/api/user/userphchk/" + ph.value;
//             fetch(url)
//             .then(data => {
//                 if (!data.status) {
//                     throw new Error(data.status + ' : API Response Error' );
//                 }
//                 return data.json();
//             })
//             .then(apiData  => {
//                 const idspan = document.getElementById('phRegexm');
//                     if(apiData["flg"] === "1") {
//                         idspan.innerHTML = apiData["msg"];
//                         idspan.style.color = 'red'
//                         signupButton.disabled = true;
//                     } else {
//                         idspan.innerHTML = "사용가능한 전화번호 입니다. "
//                         idspan.style.color = "blue"
//                         signupButton.disabled = false;
//                     }
//             });
//         });
//     }
// });
































// let isEmailChecked = false;

// const chdeckEmail = document.getElementById('chdeckEmail');
// const signupButton = document.getElementById('signupButton');
// const userEmailField = document.getElementById('user_email');
// const emailRegx = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
// const emailRegexm = document.getElementById('emailRegexm');
// chdeckEmail.disabled = true;
// // 사용자가 가입 진행도중 이메일 부분을 변경시 다시 확인하도록 하는 구문 - 수정사항 : 형식에 맞춰서 입력시 아래 경고 문구가 없어지지 않음 
// userEmailField.addEventListener('input', function(e) {
    
//     if (userEmailField.value.trim()==="") {
//         emailRegexm.innerHTML = '이메일을 입력해 주세요(공백없이 입력해주세요)';
//         signupButton.disabled = true;
//         chdeckEmail.disabled = true;
        

//     }else if(!emailRegx.test(userEmailField.value)){
//         emailRegexm.innerHTML = '영문(대소)및 숫자로 이메일 형식에 맞춰서 입력해주세요';
//         signupButton.disabled = true;
//         chdeckEmail.disabled = false;
//     }else {
//         emailRegexm.innerHTML = ''; 
//         signupButton.disabled = false;
//         chdeckEmail.disabled = false;
//     }


//     isEmailChecked = false;
//     // signupButton.disabled = true;
// });

// document.getElementById('chdeckEmail').addEventListener('click', async function(e) {
//     e.preventDefault();

//     const speical_pattern = new RegExp('email');

//     const email = userEmailField.value;
//     // const email = document.getElementById('user_email').value; //사용자가 입력한 이메일 가져오는 구문
//     // const signupButton = document.getElementById('signupButton');
//     const url = document.body.getAttribute('data-url'); //서버에 중복 확인요청 보내는 구문 - 
//     const csrfToken = document.body.getAttribute('data-csrf');  //서버에 중복 확인요청 보내는 구문

//     try {
//         const response = await fetch(url, {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json',
//                 'X-CSRF-TOKEN': csrfToken
//             },
//             body: JSON.stringify({ user_email: email }) // user_email의 값을 post로 해서 id값을 서버로 전송
//         })
//         // json 으로 값을 다시 받아오기 위해서 컨트롤러에 이메일 확인 체크 메소드를 작성해서 바디에서 url을 그 라우트로 잡아서 해야 된다. 
//         const data = await response.json(); //서버에서 돌아 온 값들을 data에 담아 준다. - 돌아 온 값은 json으로 해서 변환

//         if(data.exists){
//                 alert('사용중인 이메일 입니다.');
//                 isEmailChecked = false;
//             } else {
//                 alert('사용 가능한 이메일 입니다.');
//                 isEmailChecked = true;
//             }
//     } catch(error) {
//         console.log('Error:', error);
//         isEmailChecked = false;
//     }

//     signupButton.disabled = !isEmailChecked; //가입버튼을 확인 버튼을 클릭하기 전에 비 활성화 시킴
// });


































// 테스트용 구문 -----보지 마세요 -----------------------테스트 용 입니다. ----
// document.getElementById('button1').addEventListener('click', function() {
//     // Enable Button 2 when Button 1 is clicked
//     document.getElementById('button2').disabled = false;
// });

// document.getElementById('button2').addEventListener('click', function(event) {
//     // Check if Button 2 is enabled
//     if (!this.disabled) {
//         // Perform the desired action for Button 2 when it is clicked
//         alert('Button 2 was clicked!');
//     } else {
//         event.preventDefault(); // Prevent the default action of Button 2 if it's disabled
//     }
// });
