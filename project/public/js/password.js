    const chkpasswordbutton = document.getElementById('passwordchk');
    const passwordchanhe = document.getElementById('passwordchg')
    const writeerror = document.getElementById('writeerror');
    const userpasswordField = document.getElementById('password');

    userpasswordField.addEventListener('input', function(){
        if(userpasswordField.value.trim()===""){
            chkpasswordbutton.disabled = true;
            passwordchanhe.disabled = true;
        }
        chkpasswordbutton.disabled = false;
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
                        passwordchanhe.disabled = false;
                    }
            });
    });