// 퀘스트 리스트

// 퀘스트 확인 갱신
if(document.querySelector('.questUdt')){
    document.querySelector('.questUdt').addEventListener('click', () => {
        const url = "/api/quest";
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
                log_id: document.getElementById('log_id').value,
                stat_id: document.getElementById('stat_id').value
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
            const idspan = document.getElementById('errorMsg');
            if(apiData["errorcode"] === "1") {
                idspan.innerHTML = apiData["errmsg"];
            } else {
                const questUdtBtn = document.querySelector('.questUdt');
                idspan.innerHTML = apiData["msg"];
                questUdtBtn.style.display = "none";
            }
        });
    });
}