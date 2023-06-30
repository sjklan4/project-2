function chkpass(){
    const url = "/api/user/userpsedt";
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const request = new Request(url, {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
            },
        method: 'POST',
        credentials: "same-origin",
        body: JSON.stringify({
            value1: document.getElementById('bpassword').value
            ,value2: document.getElementById('id').value
        })
    });

    fetch(request)
    .then(data => {
        if (!data.status) {
            throw new Error(data.status + ' : API 응답 오류');
        }
        return data.json();
    })
    .then(data  => {
        const idspan = document.getElementById('passworderror');
        if (data["errorcode"] === "0") {
            idspan.innerHTML = '비밀번호 확인 완료';
            document.getElementById('passwordchg').disabled = false;
        } else {
            idspan.innerHTML = '비밀번호 불일치';
        }
    });
}