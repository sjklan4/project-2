$(document).ready(function(){
    var carbVal = $('#carbPro').val();
    var carbMax = $('#carbPro').attr("max");
    var proVal = $('#proteinPro').val();
    var proMax = $('#proteinPro').attr("max");
    var fatVal = $('#fatPro').val();
    var fatMax = $('#fatPro').attr("max");

    // 섭취량이 목표보다 초과할 경우 붉은글씨로 출력
    fcRed();
    function fcRed(){
        if(carbVal >= carbMax){
            $('span.carbSpan').addClass('fc-red');
        }
        if(proVal >= proMax){
            $('span.proteinSpan').addClass('fc-red');
        }
        if(fatVal >= fatMax){
            $('span.fatSpan').addClass('fc-red');
        }
    }

    // input file의 값을 첨부파일 input에 출력
    $("#fileBrf").on('change',function(){
        var fileName = $("#fileBrf").val();
        $(".fileBrfName").val(fileName);
    });

    $("#fileLunch").on('change',function(){
        var fileName = $("#fileLunch").val();
        $(".fileLunchName").val(fileName);
    });

    $("#fileDinner").on('change',function(){
        var fileName = $("#fileDinner").val();
        $(".fileDinnerName").val(fileName);
    });

    $("#fileSnack").on('change',function(){
        var fileName = $("#fileSnack").val();
        $(".fileSnackName").val(fileName);
    });

    // 드롭다운 버튼
    $("span.downbtn1").on("click",function(){
        $("span.upbtn1").css("display","block");
        $("span.downbtn1").css("display","none");
    });
    $("span.upbtn1").on("click",function(){
        $("span.upbtn1").css("display","none");
        $("span.downbtn1").css("display","block");
    });

    $("span.downbtn2").on("click",function(){
        $("span.upbtn2").css("display","block");
        $("span.downbtn2").css("display","none");
    });
    $("span.upbtn2").on("click",function(){
        $("span.upbtn2").css("display","none");
        $("span.downbtn2").css("display","block");
    });

    $("span.downbtn3").on("click",function(){
        $("span.upbtn3").css("display","block");
        $("span.downbtn3").css("display","none");
    });
    $("span.upbtn3").on("click",function(){
        $("span.upbtn3").css("display","none");
        $("span.downbtn3").css("display","block");
    });

    $("span.downbtn4").on("click",function(){
        $("span.upbtn4").css("display","block");
        $("span.downbtn4").css("display","none");
    });
    $("span.upbtn4").on("click",function(){
        $("span.upbtn4").css("display","none");
        $("span.downbtn4").css("display","block");
    });

    $('.brfImg').click(function(){
        $('#brfArea .filebox').removeClass('d-none');
    });
    $('.lunchImg').click(function(){
        $('#lunchArea .filebox').removeClass('d-none');
    });
    $('.dinnerImg').click(function(){
        $('#dinnerArea .filebox').removeClass('d-none');
    });
    $('.snackImg').click(function(){
        $('#snackArea .filebox').removeClass('d-none');
    });
});

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


