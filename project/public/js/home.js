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

