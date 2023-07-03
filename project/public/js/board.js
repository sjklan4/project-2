// 사진 input 초기화
function resetImg() {
    let img = document.getElementById('picture');
    img.value = "";
}

function throttling(fnc) {
    // let timer;
    // document.querySelector('.likeUpDown').addEventListener('click', function (e) {
    //     if (!timer) {
    //         timer = setTimeout(function() {
    //             timer = null;
    //             fnc;
    //         }, 1000);
    //     }
    // });
}

// 좋아요 증가
function likeUp() {
    const url = "/api/board/likeup";
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const request = new Request(url, {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
            },
        method: 'PUT',
        credentials: "same-origin",
        body: JSON.stringify({
            id1: document.getElementById('value1').value,
            id2: document.getElementById('value2').value
        })
    });

    fetch(request)
    .then(data => {
        if (!data.status) {
            throw new Error(data.status + ' : API 응답 오류');
        }
        return data.json();
    })
    .then(apiData  => {
        if (apiData["errorcode"] === "0") {
            let likeUpDown = document.querySelector('.likeUpDown');
            likeUpDown.id = 'greenBtn';
            likeUpDown.removeAttribute('onclick');
            likeUpDown.setAttribute('onclick', 'likeDown()');

            let likes = document.getElementById('likes');
            likes.innerHTML = apiData['data']['likes'];
        }
    });
}

// 좋아요 감소
function likeDown() {
    const url = "/api/board/likedown";
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const request = new Request(url, {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
            },
        method: 'PUT',
        credentials: "same-origin",
        body: JSON.stringify({
            id1: document.getElementById('value1').value,
            id2: document.getElementById('value2').value
        })
    });

    fetch(request)
    .then(data => {
        if (!data.status) {
            throw new Error(data.status + ' : API 응답 오류');
        }
        return data.json();
    })
    .then(apiData  => {
        if (apiData["errorcode"] === "0") {
            let likeUpDown = document.querySelector('.likeUpDown');
            likeUpDown.removeAttribute( 'id' );
            likeUpDown.removeAttribute( 'onclick' );
            likeUpDown.setAttribute('onclick', 'likeUp()');

            let likes = document.getElementById('likes');
            likes.innerHTML = apiData['data']['likes'];
        }
    });
}

const boardTitle = document.getElementById('title');

function boardFormChk() {
    const boardTitle = document.getElementById('title');
    const boardContent = document.getElementById('content');
    const img = document.getElementById('picture').files[0];

    // 빈값 확인
    if(boardTitle.value === "") {
        boardTitle.focus();
        return false
    }

    if(boardContent.value === "") {
        boardContent.focus();
        return false
    }

    // 유효성 체크
    if(!baordTitleChk(boardTitle.value)) {
        alert("50자 이하로 입력해주세요.");
        boardTitle.focus();
        return false
    }

    if(!boardContentChk(boardContent.value)) {
        alert("4000자 이하로 입력해주세요.");
        boardContent.focus();
        return false
    }
    
    if(img) {
        if(!imgExtensionChk(img)) {
            alert("jpg, png, gif 확장자만 업로드 가능합니다.");
            return false
        }
        
        if(!imgSizeChk(img)) {
            alert("5mb이하 이미지만 업로드 가능합니다.");
            return false
        }
    }
    document.boardForm.submit();
}


// ? --------------------------------
// ? 유효성 관련 함수
function baordTitleChk(boardTitle) {
    let reg = /^.{1,50}$/;
    return reg.test(boardTitle);
}

function boardContentChk(boardContent) {
    let reg = /^.{1,4000}$/;
    return reg.test(boardContent);
}

function imgExtensionChk(img) {
    let reg = /(.*?)\.(jpg|gif|png)$/;
    return reg.test(img.name);
}

function imgSizeChk(img) {
    return img.size <= 5 * 1024 * 1024;
}
// ? --------------------------------

