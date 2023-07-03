window.onload = function(){
        
    function onClick() {
        document.querySelector('.modal_wrap').style.display ='block';
    }   
    function offClick() {
        document.querySelector('.modal_wrap').style.display ='none';
    }
    document.getElementById('suggest').addEventListener('click', onClick);
    document.querySelector('.exit').addEventListener('click', offClick);
    
};


const suggestkcal = document.getElementById('suggest-cal');

suggestkcal.addEventListener('click', function(){
    const gender = document.getElementById('gender').value;
    let birthDate = new Date(document.getElementById('user_birth').value);
    const tall = document.getElementById('tall').value;
    const weight = document.getElementById('weight').value;
    const acctivaty = document.querySelector('input[name="acctivaty"]:checked').value; //입력된 값안에서 이름이 name으로 된 부분에서 체크된 부분의 value를 반환시킨다. 
    const today = new Date();
    // const suggest_kcal = document.getElementById('goal_kcal');
    const maxdate = document.getElementById('maxdate');

    let age = today.getFullYear() - birthDate.getFullYear() + 1;
    if(birthDate > today){
        maxdate.innerHTML = '생년월일을 확인해주세요';
        this.value = '';
    }
    else{
        if(gender === "0"){
            let BMR = (10 * weight)+(6.25 * tall)-(5 * age)+5
                if(acctivaty ==="0"){
                    // let result = document.getElementById('calcul-kcal').value = BMR * 1.2;
                    // math.floor(result);
                    let result = BMR * 1.2;
                    document.getElementById('calcul-kcal').value = Math.floor(result);
                }
                else if(acctivaty ==="1"){
                    // let result = document.getElementById('calcul-kcal').value = BMR * 1.55;
                    // math.floor(result);
                    let result = BMR * 1.55;
                    document.getElementById('calcul-kcal').value = Math.floor(result);
                }
                else{
                    // let result = document.getElementById('calcul-kcal').value = BMR * 1.9;
                    // math.floor(result);
                    let result = BMR * 1.9
                    document.getElementById('calcul-kcal').value = Math.floor(result);
                }
            }
        else{
            let BMR = (10 * weight)+(6.25 * tall)-(5 * age)-161
                if(acctivaty ==="0"){
                    // let result = document.getElementById('calcul-kcal').value = BMR * 1.2;
                    // math.floor(result);
                    let result = BMR * 1.2;
                    document.getElementById('calcul-kcal').value = Math.floor(result);
                }
                else if(acctivaty ==="1"){
                    // let result = document.getElementById('calcul-kcal').value = BMR * 1.55;
                    // math.floor(result);
                    let result = BMR * 1.55;
                    document.getElementById('calcul-kcal').value = Math.floor(result);
                }
                else{
                    // let result = document.getElementById('calcul-kcal').value = BMR * 1.9;
                    // math.floor(result);
                    let result = BMR * 1.9;
                    document.getElementById('calcul-kcal').value = Math.floor(result);
                }
            }
    }
});

//Mifflin St Jeor(미플린 세인트 지어 방정식)< 해리스-베네딕 방식보다 5프로 정확함>

const suggestinsert = document.getElementById('suggest-insert');
suggestinsert.addEventListener('click',function(){
    const calculdata = document.getElementById('calcul-kcal').value;
    document.getElementById('goal_kcal').value = calculdata;
    document.querySelector('.modal_wrap').style.display ='none';
});

let now_utc = Date.now()
let timeOff = new Date().getTimezoneOffset()*60000;
let today = new Date(now_utc-timeOff).toISOString().split("T")[0];
document.getElementById("user_birth").setAttribute("max", today);