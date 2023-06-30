// 메뉴 탭
const tab1 = document.querySelector('.tab1')
const tab2 = document.querySelector('.tab2')

// 탭 내용
const search = document.getElementsByClassName('user_search')
const fav_diets = document.getElementsByClassName('fav_diets')
const user_select = document.getElementsByClassName('user_select')

// 탭 세부 내용
const uselect = document.getElementsByClassName('uselect')
const nosearch = document.querySelector('.nosearch')

// 유저가 입력한 인분 수
const userving = document.getElementsByClassName('userving')

// appendChild 용 div 선언
const fav_food = document.getElementById('fav_food');
const fav_diet = document.getElementById('fav_diet');

// ---------------------------- 체크박스 및 input ----------------------------

function getFoodValue(userId)  {
    // 선택된 목록 가져오기
    const query = 'input[name="usercheck"]:checked';
    const selectedEls = 
        document.querySelectorAll(query);
    const query2 = 'input[name="userving"]'
    const selectedInp = document.querySelectorAll(query2);
    
    // 선택된 목록에서 value 찾기
    let result = '';
    selectedEls.forEach((el) => {
        result = el.value;
    });

    let amount = '';
    selectedInp.forEach((el2) => {
        amount += el2.value;
        parseFloat(amount);
    });

    if (amount == 0.0) {
        amount = 1;
    }

    console.log(result);
    console.log(amount);

    fetch(`/api/cart/${userId}/${result}/${amount}`, {
        method: "post"
    })
    .then(res => res.json())
    .then( data => { 
        data.forEach(ele => {
            console.log(ele.food_name);
            console.log(ele.amount);
            console.log(ele.cart_id);

            let ffood = document.createElement('span')
            let brp = document.createElement('span')
            ffood.innerHTML = ele.food_name+' | '+ele.amount;
            brp.innerHTML = '<br>';
            
            // 삭제 버튼
            let delfbtn = document.createElement('button')
            delfbtn.innerHTML = 'X';
            delfbtn.setAttribute('type', 'button')
            delfbtn.setAttribute('onclick', "deletefood('"+ele.user_id+','+ele.food_id+','+ele.cart_id+"')")
            // 삭제 버튼 div에 넣기
            fav_food.appendChild(ffood);
            fav_food.appendChild(delfbtn);
            fav_food.appendChild(brp);
            // delfbtn.addEventListener('click', function() {
            //     fav_food.removeChild(ffood);
            //     fav_food.removeChild(brp);
            //     fav_food.removeChild(delfbtn);
            // })
            }
        )}
    )
};

// 삭제 함수
function deletefood(Ids) {
    console.log('asdfd');
    console.log(Ids);
    let ids = Ids.split(',');
    console.log(ids);

    fetch(`/api/fooddelete/${ids[0]}/${ids[1]}/${ids[2]}`, {
        method: "delete"
    })
    .then(res => res.json())
    .then( data => {
        fav_food.replaceChildren()
        data.forEach(ele => {
            console.log(ele.food_name);
            console.log(ele.amount);
            console.log(ele.cart_id);

            let ffood = document.createElement('span')
            let brp = document.createElement('span')
            ffood.innerHTML = ele.food_name+' | '+ele.amount;
            brp.innerHTML = '<br>';


            // fav_food.replaceChildren(ffood);
            
            // 삭제 버튼
            // let delfbtn = document.createElement('button')
            // delfbtn.innerHTML = 'X';
            // delfbtn.setAttribute('type', 'button')
            // delfbtn.setAttribute('onclick', "deletefood('"+ele.user_id+','+ele.food_id+','+ele.cart_id+"')")
            // 삭제 버튼 div에 넣기
            fav_food.appendChild(ffood);
            // fav_food.appendsChild(delfbtn);
            fav_food.appendChild(brp);
            }
        )}
        // console.log(data) )
)}

function getDietValue(userId)  {
    // 선택된 목록 가져오기
    const query = 'input[name="userdiet"]:checked';
    const selectedEls = 
        document.querySelectorAll(query);
    
    // 선택된 목록에서 value 찾기
    let resultdiet = '';
    selectedEls.forEach((el) => {
        resultdiet += el.value;
    });

    fetch(`/api/cart2/${userId}/${resultdiet}`, {
        method: "post"
    })
    .then(res => res.json())
    .then(data => { 
            data.forEach(ele => {
            console.log(ele.fav_id);
            console.log(ele.fav_name);
            console.log(ele.user_id);

            let fdiet = document.createElement('p')
            fdiet.innerHTML = ele.fav_name;
            fav_diet.appendChild(fdiet);

            // 삭제 버튼
            let deldbtn = document.createElement('button')
            deldbtn.setAttribute('type', 'submit')
            // deldbtn.setAttribute('type', 'button')
            // deldbtn.setAttribute('onclick', "location.href='{{route('diet.delete', ['f_id' => ele.fav_id)])}}'")
            fav_diet.appendChild(deldbtn);
            }
        )}
    ) 
}

// ---------------------------- 저장된 식단 ----------------------------

tab1.addEventListener('click', () => {
    let displaysetting = fav_diets[0].style.display;

    if(displaysetting == 'block'){
        fav_diets[0].style.display = 'none'
    }else{
        fav_diets[0].style.display = 'block'
        user_select[0].style.display = 'none'
        search[0].style.display = 'none'
    }
});

// ---------------------------- 선택된 음식 ----------------------------

tab2.addEventListener('click', () => {
    let displaysetting = user_select[0].style.display;

    if(displaysetting == 'block'){
        user_select[0].style.display = 'none'
    }else{
        user_select[0].style.display = 'block'
        fav_diets[0].style.display = 'none'
        search[0].style.display = 'none'
    }
});

// ---------------------------- 선택된 음식 삭제 ----------------------------
