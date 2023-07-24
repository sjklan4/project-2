// todo 취소나 저장하지 않고 나갔을 때 처리
// window.onbeforeunload = function() {
//     return "저장되지 않은 변경사항이 있습니다. 정말 페이지를 떠나실 건 가요?";
// };

// $(document).on("submit", "form", function(){
//     window.onbeforeunload = null;
// });

// $(document).on("click", function(){
//     window.onbeforeunload = null;
// });


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

function getFoodValue(event, userId)  {    
    // 선택된 목록에서 value 찾기
    let foodId = '';
    let foodAmout = '';
    let food = event.target;
    
    if(event.target.checked)  {
        foodId = event.target.value;
        foodAmout = parseFloat(food.parentNode.childNodes[7].value);
    }

    if (isNaN(foodAmout) === true) {
        foodAmout = 1.0;
    }

    const url = "/api/cart";
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
            value1: userId,
            value2: foodId,
            value3: foodAmout
        })
    });
    
    fetch(request)
    .then(data => data.json()) 
    .then( data => { 
        if(data['errorcode'] === '0') {
            // 검색 페이지에서 해당 div 숨기기
            food.parentNode.style.display = "none";

            // 선택된 음식 탭에 추가
            let ffood = document.createElement('span');
            let intake = document.createElement('span');
            let div = document.createElement('div');
            ffood.innerHTML = data['data'].food_name;
            intake.innerHTML = data['data'].amount + ' 인분';
            
            // 삭제 버튼
            let delfbtn = document.createElement('button')
            delfbtn.innerHTML = 'X';
            delfbtn.setAttribute('type', 'button')
            delfbtn.setAttribute('id', 'delete_btn')
            delfbtn.setAttribute('onclick', "deletefood(" + data['data'].user_id + ',' + data['data'].food_id + ',' + data['data'].cart_id + ")")
    
            // 삭제 버튼 div에 넣기
            fav_food.appendChild(div);
            div.appendChild(ffood);
            div.appendChild(intake);
            div.appendChild(delfbtn)
        } else {
            event.target.checked = false;
            alert(data['msg']);
        }


        //     fav_food.replaceChildren();
        //     apiData.forEach(ele => {
        //     console.log(ele.food_name);
        //     console.log(ele.amount);
        //     console.log(ele.cart_id);

        //     // 선택된 음식 탭에 추가
        //     let ffood = document.createElement('span')
        //     let brp = document.createElement('br')
        //     ffood.innerHTML = ele.food_name+' | '+ele.amount+'인분';
            
        //     // 삭제 버튼
        //     let delfbtn = document.createElement('button')
        //     delfbtn.innerHTML = 'X';
        //     delfbtn.setAttribute('type', 'button')
        //     delfbtn.setAttribute('id', 'delete_btn')
        //     delfbtn.setAttribute('onclick', "deletefood('"+ele.user_id+','+ele.food_id+','+ele.cart_id+"')")

        //     // 삭제 버튼 div에 넣기
        //     fav_food.appendChild(ffood);
        //     fav_food.appendChild(delfbtn)
        //     fav_food.appendChild(brp);
        // })
    })

    
}

// 선택 음식 삭제 함수
function deletefood(userId, foodId, cartId) {
    fetch(`/api/food/${userId}/${foodId}/${cartId}`, {
        method: "delete"
    })
    .then(res => res.json())
    .then( data => {
        fav_food.replaceChildren()
        data.forEach(ele => {
            let ffood = document.createElement('span');
            let intake = document.createElement('span');
            let div = document.createElement('div');
            ffood.innerHTML = ele.food_name;
            intake.innerHTML = ele.amount + ' 인분';
            
            // 삭제 버튼
            let delfbtn = document.createElement('button')
            delfbtn.innerHTML = 'X';
            delfbtn.setAttribute('type', 'button')
            delfbtn.setAttribute('id', 'delete_btn')
            delfbtn.setAttribute('onclick', "deletefood(" + ele.user_id + ',' + ele.food_id + ',' + ele.cart_id + ")")
    
            // 삭제 버튼 div에 넣기
            fav_food.appendChild(div);
            div.appendChild(ffood);
            div.appendChild(intake);
            div.appendChild(delfbtn)
        })
    })
}

// 즐겨찾는 식단 -> 장바구니
function getDietValue(event, userId, favId)  {
        fetch(`/api/cart2/${userId}/${favId}`, {
            method: "post"
        })
        .then(res => res.json())
        .then(data => { 
            if (data['errorcode'] === '0') {
                // 선택된 음식 부분 처리
                fav_diet.replaceChildren()
                data['data'].forEach(ele => {
                    let fdiet = document.createElement('span');
                    let div = document.createElement('div');
                    fdiet.innerHTML = ele.fav_name;
                    
                    // 삭제 버튼
                    let deldbtn = document.createElement('button');
                    deldbtn.innerHTML = 'X';
                    deldbtn.setAttribute('type', 'button')
                    deldbtn.setAttribute('id', 'delete_btn')
                    deldbtn.setAttribute('onclick', "deletediet(" + ele.user_id + ',' + ele.cart_id + ',' + ele.fav_id + ")")
    
                    fav_diet.appendChild(div);
                    div.appendChild(fdiet);
                    div.appendChild(deldbtn);
                    })

                // 저장된 식단 부분
                let favDiv = document.getElementById('favId-' + favId);
                favDiv.style.display = "none";
            } else if (data['errorcode'] === '1') {
                alert(data['msg']);
                event.target.checked = false;
            }
        })
}

// 선택 식단 삭제 함수
function deletediet(userId, cartId, favId) {
    fetch(`/api/diet/${userId}/${cartId}`, {
        method: "DELETE"
    })
    .then(res => res.json())
    .then( data => {
        console.log(data);
        if (data['errorcode'] === '0') {
            fav_diet.replaceChildren()
            data['data'].forEach(ele => {
                let ffood = document.createElement('span')
                let brp = document.createElement('br')
                ffood.innerHTML = ele.fav_name;
    
                // 삭제 버튼
                let deldbtn = document.createElement('button')
                deldbtn.innerHTML = 'X';
                deldbtn.setAttribute('type', 'button')
                deldbtn.setAttribute('id', 'delete_btn')
                deldbtn.setAttribute('onclick', "deletediet(" + ele.user_id + ',' + ele.cart_id + ',' + ele.fav_id + ")")
    
                fav_diet.appendChild(ffood);
                fav_diet.appendChild(deldbtn)
                fav_diet.appendChild(brp);
            })
        } else if(data['errorcode'] === '1') {
            fav_diet.replaceChildren()
        }
        let displayDiv = document.getElementById('favId-' + favId)
        let displayInput = document.getElementById('input-' + favId);
        displayDiv.removeAttribute('style');
        displayInput.checked = false;
    }
)}

// ---------------------------- 저장된 식단 ----------------------------

tab1.addEventListener('click', () => {
    let displaysetting = fav_diets[0].style.display;

    if(displaysetting == 'block'){
        fav_diets[0].style.display = 'none'
    }else{
        fav_diets[0].style.display = 'block'
        user_select[0].style.display = 'none'
        if(search[0]) {
            search[0].style.display = 'none'
        }
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
        if(search[0]) {
            search[0].style.display = 'none'
        }
    }
});