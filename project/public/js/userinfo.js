
// const test = document.getElementsByClassName('list-group-item');

// let li = null;

// for (let i = 0; i < test.length; i++) {
//         li = test[i];
// }

// const today = new Date();
// const birthDate = document.getElementById('user_birth'); 
// const userage = document.getElementById('userage');
// let age = today.getFullYear() - birthDate.getFullYear() + 1;

// const nknamechk = document.getElementById('nkname');

// userage.innerHTML = age;

// nknamechk.addEventListener('change', function(){
//         const nk = document.getElementById('nkname');
//         const url = "/api/user/usernkchk/" + nk.value;
//         fetch(url)
//         .then(data => {
//         if (!data.status) {
//                 throw new Error(data.status + ' : API Response Error' );
//         }
//         return data.json();
//         })
//         .then(apiData  => {
//         const idspan = document.getElementById('nkRegexm');
//                 if(apiData["flg"] === "1") {
//                 idspan.innerHTML = apiData["msg"];
//                 greenBtn.disabled = true;
//                 } else {
//                 idspan.innerHTML = "사용가능한 닉네임 입니다. "
//                 greenBtn.disabled = false;
//                 }
//         });
// });
