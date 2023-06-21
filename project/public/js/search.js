const tab1 = document.querySelector('.tab1')
const tab2 = document.querySelector('.tab2')

// let nosearch = document.getElementsByClassName('nosearch')
let search = document.getElementsByClassName('user_search')
let fav_diets = document.getElementsByClassName('fav_diets')
let user_select = document.getElementsByClassName('user_select')

// ---------------------------- 체크박스 및 input ----------------------------

function getFoodValue()  {
    // 선택된 목록 가져오기
    const query = 'input[name="usercheck"]:checked';
    const selectedEls = 
        document.querySelectorAll(query);
    
    // 선택된 목록에서 value 찾기
    let result = '';
    selectedEls.forEach((el) => {
        result += el.value + '\n';
    });

    document.getElementById('resultfood').innerText
            = result;
}

function getDietValue()  {
    // 선택된 목록 가져오기
    const query = 'input[name="userdiet"]:checked';
    const selectedEls = 
        document.querySelectorAll(query);
    
    // 선택된 목록에서 value 찾기
    let resultdiet = '';
    selectedEls.forEach((el) => {
        resultdiet += el.value + '\n';
    });

    document.getElementById('resultdiet').innerText
            = resultdiet;
}


// todo : 인분 수 겹침 해결하기
const serving = document.getElementById('userving');
serving.addEventListener('input', function() {

    document.getElementById('resultserving').innerText
            = serving.value;
    
})

// ---------------------------- 저장된 식단 ----------------------------

tab1.addEventListener('click', () => {
    var displaysetting = fav_diets[0].style.display;

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
    var displaysetting = user_select[0].style.display;

    if(displaysetting == 'block'){
        user_select[0].style.display = 'none'
    }else{
        user_select[0].style.display = 'block'
        fav_diets[0].style.display = 'none'
        search[0].style.display = 'none'
    }
});
