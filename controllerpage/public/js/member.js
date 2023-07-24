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

// .btitle 클래스를 가진 모든 요소 가져오기
let elements = document.querySelectorAll('.btitle');

// 각 요소에 대해 반복문 실행
for (let i = 0; i < elements.length; i++) {
    let element = elements[i];
    let text = element.innerText;

    if(text.length >= 20){
        // 문자열 자르기
        let startIndex = 0; // 시작 인덱스
        let endIndex = 20; // 종료 인덱스 (10번째 문자까지 자르기)
        let cutText = text.substring(startIndex, endIndex) + '...';       
        element.innerHTML = cutText;
    }
}


//체크 박스 기능
function selectAll(selectAll)  {
const checkboxes 
        = document.getElementsByName('delchk[]');

    checkboxes.forEach((checkbox) => {
        checkbox.checked = selectAll.checked;
    })
}


function bulkdel(){

    const checkboxes = document.querySelectorAll('input[name="delchk[]"]:checked');

    if (!checkboxes.length) {
        alert('삭제하려는 댓글을 선태해주세요.');
    } else {
        let values = Array.from(checkboxes).map(checkbox => checkbox.value);

        console.log(values); // 이 부분은 reply_id 값의 배열을 콘솔에 기록합니다.
        let frmDel = document.getElementById('selectdel');
        frmDel.append('chkdel', values);
        frmDel.submit();
    }
}

