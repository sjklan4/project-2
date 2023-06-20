    const chkpasswordbutton = document.getElementById('passwordchk');
    const writeerror = document.getElementById('writeerror');
    const userpasswordField = document.getElementById('password');

    userpasswordField.addEventListener('oninput', function(){
    
    });
    
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
                        passwordchg.disabled = false;
                    }
            });
    });