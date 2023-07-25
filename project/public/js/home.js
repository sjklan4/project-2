// const { extendWith } = require("lodash");

$(document).ready(function(){
    var carbVal = Number($('#carbPro').attr('value'));
    var carbMax = Number($('#carbPro').attr("max"));
    var proVal = Number($('#proteinPro').attr('value'));
    var proMax = Number($('#proteinPro').attr("max"));
    var fatVal = Number($('#fatPro').attr('value'));
    var fatMax = Number($('#fatPro').attr("max"));

    // 섭취량이 목표보다 초과할 경우 붉은글씨로 출력
    fcRed(carbVal, carbMax, 'span.carbSpan');
    fcRed(proVal, proMax, 'span.proteinSpan');
    fcRed(fatVal, fatMax, 'span.fatSpan');

    function fcRed(val,max,span){
        if (val > max) {
            $(span).addClass('fc-red')
        }
    }

    // input file의 값을 첨부파일 input에 출력
    printFile('#fileBrf','.fileBrfName');
    printFile('#fileLunch','.fileLunchName');
    printFile('#fileDinner','.fileDinnerName');
    printFile('#fileSnack','.fileSnackName');

    function printFile(file,name){
        $(file).on('change',function(){
            var fileName = $(file).val();
            $(name).val(fileName);
        })
    }

    // 목표설정 아이콘 hover
    $('.test').mouseenter(function(){
        $(this).children("svg").toggle();
        $(this).children("span").toggle();
    });
    $('.test').mouseleave(function(){
        $(this).children("span").toggle();
        $(this).children("svg").toggle();
    });

    // 드롭다운 버튼
    dropBtn("#brfBtn");
    dropBtn("#lunchBtn");
    dropBtn("#dinnerBtn");
    dropBtn("#snackBtn");

    function dropBtn(btn){
        $(btn).on("click",function(){
            if($(btn).attr("aria-expanded")){
                $(this).children("span").toggle();
            }   
        });
    }

    // 이미지수정 박스 출력
    printImgEdit('.brfImg','#brfArea .filebox');
    printImgEdit('.lunchImg','#lunchArea .filebox');
    printImgEdit('.dinnerImg','#dinnerArea .filebox');
    printImgEdit('.snackImg','#snackArea .filebox');

    function printImgEdit(img,fileBox){
        $(img).on('click',function(){
            $(fileBox).toggle();
        });
    }

});

// 날짜이동 버튼
const inputDate = document.getElementById('calendar');
let date = inputDate.value; // input date value 값

// 기준날짜 가져오기
let now = new Date(date);
let nowString = formatDate(now);

const dateForm = document.getElementById('dateForm');

// 이전 날짜로 이동하는 함수
function prev(){
    now.setDate(now.getDate() - 1);
    nowString = formatDate(now);
    inputDate.value = nowString;
    dateForm.submit();
}

// 다음 날짜로 이동하는 함수
function next(){
    now.setDate(now.getDate() + 1);
    nowString = formatDate(now);
    inputDate.value = nowString;
    dateForm.submit();
}

// 날짜 형식 변경 함수 (YYYY-MM-DD)
function formatDate(date){
    let year = date.getFullYear();
    let month = String(date.getMonth() + 1).padStart(2,'0');
    let day = String(date.getDate()).padStart(2, '0');
    return year + '-' + month + '-' + day;
}

// 섭취 음식 삭제 부분

function delintake(df_id) {
    let confirmDelete = confirm("음식 정보를 삭제 하시겠습니까?");

    if (confirmDelete) {
        const url = "/api/foods";
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const request = new Request(url, {
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token
            },
            method: 'DELETE',
            credentials: "same-origin",
            body: JSON.stringify({
                df_id: df_id
            })  
        });

        fetch(request)
        .then(apiData => {
            if (apiData["errorcode"]=== "0") {
                throw new Error('API 응답 오류');
            }
            alert('삭제 되었습니다.');
            return;
        })
        .then(apiData => {
            console.log(apiData);
            document.getElementById('foodlist'+ df_id).style.display ="none"
        })
        .catch(error => console.error('Error:', error));
    }
}



// 섭취량 변경 부분

function updateIntake(df_id) {
    const df_intake = document.getElementById('df_intake' + df_id);
    const confirmation = confirm("정말로 섭취량을 변경하시겠습니까?");
        
            if (confirmation) {
                
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const url = "api/intakes/"+ df_id;
                const request = new Request(url, {
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    method: 'PUT',
                    credentials: "same-origin",
                    body: JSON.stringify({
                        df_id: df_id,
                        df_intake: df_intake.value
                    })
                });

                fetch(request)
                .then(apiData => {
                    if (apiData["errorcode"]=== "0") {
                        throw new Error('API 응답 오류');
                    }
                    alert('변경 되었습니다.');
                    return;
                })
                .then(apiData => console.log(apiData));
            }
    }


// const editchk = document.getElementsByClassName('editBtn');
// for (let i = 0; i < editchk.length; i++) {
//     editchk[i].addEventListener('click', function() {

//         const confirmation = confirm("정말로 섭취량을 변경하시겠습니까?");
//         if (confirmation) {

//             let df_intake = this.parentElement.querySelector('input[name="df_intake"]').getAttribute('value');
//             fetch(`api/home/intakeupdate/${id}`, {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': df_intake
//                 },
//                 body: JSON.stringify({ df_intake: df_intake })
//             })
//             .then(response => response.json())
//             .then(data => console.log(data));
//         }
//     });
// }




// function updateIntake(clickedButton) {
//     const confirmation = confirm("정말로 섭취량을 변경하시겠습니까?");

//     if (confirmation) {
//         let id = clickedButton.dataset.id;
//         const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

//         // debug here
//         const closestForm = clickedButton.closest('form');
//         console.log('Closest form: ', closestForm);

//         const intakeValue = closestForm.querySelector('input[name="df_intake"]').value;
//         const request = new Request(`/home/intakeupdate/${id}`, {
//             headers: {
//                 'Content-Type': 'application/json',
//                 'X-CSRF-TOKEN': token
//             },
//             method: 'POST',
//             credentials: "same-origin",
//             body: JSON.stringify({ value: intakeValue })
//         });

//         fetch(request)
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error(response.status + ' : API 응답 오류');
//             }
//             return response.json();
//         })
//         .then(data => console.log(data));
//     }
// }


// function updateIntake() {
//     const confirmation = confirm("정말로 섭취량을 변경하시겠습니까?");

//     if (confirmation) {
//         const editintake = document.getElementById('editForm');
//         const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
//         const request = new Request(`/home/intakeupdate/${id}`, {
//             headers: {
//                 'Content-Type': 'application/json',
//                 "Accept": "application/json, text-plain, */*",
//                 "X-Requested-With": "XMLHttpRequest",
//                 'X-CSRF-TOKEN': token
//             },
//             method: 'POST',
//             credentials: "same-origin",
//             body: JSON.stringify({
//                 value: document.getElementsByClassName('editBtn').value
//             })
//         });

//         fetch(request)
//         .then(response => {
//             if (!response.status) {
//                 throw new Error(response.status + ' : API 응답 오류');
//             }
//             return response.json();
//         })
//         .then(data => console.log(data));
//     }
// }



// function updateIntake() {
//     const confirmation = confirm("정말로 섭취량을 변경하시겠습니까?");

//     if (confirmation) {
//         const intake = document.getElementsByClassName('intakedata').value;
//         const url = "api/home/intakeupdate";

//         const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
//         const request = new Request(url, {
//             headers: {
//                 'Content-Type': 'application/json',
//                 "Accept": "application/json, text-plain, */*",
//                 "X-Requested-With": "XMLHttpRequest",
//                 'X-CSRF-TOKEN': token
//             },
//             method: 'POST',
//             credentials: "same-origin",
//             body: JSON.stringify({
//                 df_intake: intake
//             })
//         });

//         fetch(request)
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error(response.status + ' : API 응답 오류');
//             }
//             return response.json();
//         })
//         .then(data => console.log(data))
//         .catch((error) => {
//             console.error('Error:', error);
//         });
//     }
// }