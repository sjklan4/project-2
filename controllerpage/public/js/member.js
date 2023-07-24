function release(user_id){

        let confirmdraw = confirm("복구 시키시겠습니까?");
        if(confirmdraw){
            const url = "/api/member/memberreturn"
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const request = new Request(url,{
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token
                },
                method:'POST',
                credentials: "same-origin",
                body: JSON.stringify({
                    user_id:user_id
                })  
            });

            fetch(request)
            .then(response => {
                if (!response.ok) {
                    throw new Error(response.status + ' : API 응답 오류');
                }
                return response.json();
            })
            .then(data => {
                if(data["errorcode"]==="0"){
                    alert("정지 해제");
                    location.reload(true);
                }
                else{
                    alert("실패");
                }
            })
            .catch(error => console.error('Error:', error));
        }
        else{
            alert("취소 되었습니다.");
        }
}

