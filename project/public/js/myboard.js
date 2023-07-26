const boardTab = document.getElementById('tab1');
const replyTab = document.getElementById('tab2');
const boardBtn = document.getElementById('boardBtn');
const replyBtn = document.getElementById('replyBtn');

function tabChange1(){    
    replyTab.classList.add('off');
    boardTab.classList.remove('off');
    boardBtn.style.color = "#195F1C";
    replyBtn.style.color = "black";
}

function tabChange2(){
    boardTab.classList.add('off');
    replyTab.classList.remove('off');
    boardBtn.style.color = "black";
    replyBtn.style.color = "#195F1C";
}