    // const chkpasswordbutton = document.getElementById('passwordchk');
    // const passwordchanhe = document.getElementById('passwordchg')
    // const writeerror = document.getElementById('writeerror');
    // const userpasswordField = document.getElementById('password');

    // // userpasswordField.addEventListener('input', function(){
    // //     if(userpasswordField.value.trim()===""){
    // //         chkpasswordbutton.disabled = true;
    // //         passwordchanhe.disabled = true;
    // //     }
    // //     chkpasswordbutton.disabled = false;
    // // });
    
    // chkpasswordbutton.addEventListener('click',function(){
        
    //     const password = document.getElementById('password');
    //     const url = "/api/user/userpsedt/" + password.value; 
    //     const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    //     const request = new Request(url, {  
    //                 headers: {
    //                     "Content-Type": "application/json",
    //                     "Accept": "application/json, text-plain, */*",
    //                     "X-Requested-With": "XMLHttpRequest",
    //                     "X-CSRF-TOKEN": token
    //                     },
    //                 method: 'GET',
    //                 credentials: "same-origin",
    //                 body: JSON.stringify({
    //                                 id1: document.getElementById('value1').value,
    //                     })
    //     });

    //     fetch(url)
    //         .then(data => {
    //             if (!data.status) {
    //                 throw new Error(data.status + ' : API Response Error' );
    //             }
    //             return data.json();
    //         })
    //         .then(apiData  => {
    //             const idspan = document.getElementById('writeerror');
    //                 if(apiData["flg"] === "1") {
    //                     idspan.innerHTML = apiData["msg"];
    //                 } else {
    //                     idspan.innerHTML = "확인되었습니다."
    //                     passwordchanhe.disabled = false;
    //                 }
    //         });
    // });


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
                // Password was verified successfully, handle it here
            idspan.innerHTML = '비밀번호 확인 완료';
            document.getElementById('passwordchg').disabled = false;
        } else {
                // The password did not match, handle it here
            idspan.innerHTML = '비밀번호 불일치';
        }
    });
}