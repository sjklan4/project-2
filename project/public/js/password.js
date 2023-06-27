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

    // const passworderror = document.getElementById()
    const chkpasswordbutton = document.getElementById('passwordchk');
    chkpasswordbutton.addEventListener('click', function(event) {
        // Prevent the form from submitting the default way
        event.preventDefault();
    
        let currentPassword = document.getElementById('bpassword').value;
    
        // Create a FormData object
        let formData = new FormData();
        formData.append('bpassword', currentPassword);
    
        // Send the request to the server
        fetch("/api/user/userpsedt/", {  // Replace '/password-verification-endpoint' with the actual endpoint in your Laravel app
            method: 'post',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',  // Necessary to work with Laravel
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')  // CSRF token
            },
        }).then(response => response.json())
        .then(data => {
            const idspan = document.getElementById('passworderror');
            if (data.passwordValid) {
                  // Password was verified successfully, handle it here
                
                idspan.innerHTML = '비밀번호 확인 완료';
            } else {
                  // The password did not match, handle it here
                idspan.innerHTML = '비밀번호 불일치';
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    });
    