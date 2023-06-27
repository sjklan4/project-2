// 사진 input 초기화
function resetImg() {
    let img = document.getElementById('picture');
    img.value = "";
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