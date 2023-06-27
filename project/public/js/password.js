    const chkpasswordbutton = document.getElementById('passwordchk');
    const passwordchanhe = document.getElementById('passwordchg')
    const writeerror = document.getElementById('writeerror');
    const userpasswordField = document.getElementById('password');

    // userpasswordField.addEventListener('input', function(){
    //     if(userpasswordField.value.trim()===""){
    //         chkpasswordbutton.disabled = true;
    //         passwordchanhe.disabled = true;
    //     }
    //     chkpasswordbutton.disabled = false;
    // });
    
    chkpasswordbutton.addEventListener('click',function(){
        
        const password = document.getElementById('password');
        const url = "/api/user/userpsedt/" + password.value; 

        fetch(url)
            .then(data => {
                if (!data.status) {
                    throw new Error(data.status + ' : API Response Error' );
                }
                return data.json();
            })
            .then(apiData  => {
                const idspan = document.getElementById('writeerror');
                    if(apiData["flg"] === "1") {
                        idspan.innerHTML = apiData["msg"];
                    } else {
                        idspan.innerHTML = "확인되었습니다."
                        passwordchanhe.disabled = false;
                    }
            });
    });



    // function likeUp() {
    //     const url = "/api/board/likeup"; =라우트 주소
    //     const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    //     const request = new Request(url, {  
    //         headers: {
    //             "Content-Type": "application/json",
    //             "Accept": "application/json, text-plain, */*",
    //             "X-Requested-With": "XMLHttpRequest",
    //             "X-CSRF-TOKEN": token
    //             },
    //         method: 'PUT',  =메소드 변경
    //         credentials: "same-origin",
    //         body: JSON.stringify({  = input값 위치
    //             id1: document.getElementById('value1').value,
    //             id2: document.getElementById('value2').value
    //         })
    //     });
    // fetch : request 