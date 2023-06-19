const tab1 = document.querySelector('.tab1')
const tab2 = document.querySelector('.tab2')

const user_search = document.querySelector('.user_search')
const fav_diets = document.querySelector('.fav_diets')
const user_select = document.querySelector('.user_select')

tab1.addEventListener('click', (e) => {
    console.log('버튼클릭좀되게해주라고');
    
    
    
    if(fav_diets.style.display == 'none'){
        fav_diets.style.display = 'block';
        user_search.style.display = 'none';
        user_select.style.display = 'none';
    }
});

tab2.addEventListener('click', () => {
    console.log('버튼클릭좀되게해주라고');
    if(user_select.style.display == 'none'){
        user_select.style.display = 'block';
        user_search.style.display = 'none';
        fav_diets.style.display = 'none';
    }else{
        user_select.style.display = 'none'
    }
});

// ---------------------------- 체크박스 ----------------------------

function getCheckboxValue()  {
    // 선택된 목록 가져오기
    const query = 'input[name="usercheck"]:checked';
    const selectedEls = 
        document.querySelectorAll(query);
    
    // 선택된 목록에서 value 찾기
    let result = '';
    selectedEls.forEach((el) => {
        result += el.value + ' ';
    });
    
    // 출력
    document.getElementById('result').innerText
        = result;
}