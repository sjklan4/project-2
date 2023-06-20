const tab1 = document.querySelector('.tab1')
const tab2 = document.querySelector('.tab2')

// const no_user_search = document.querySelector('.nosearch')
// const fav_diets = document.querySelector('.fav_diets')
// const user_select = document.querySelector('.user_select')

let fav_diets = document.getElementsByClassName('fav_diets')
let user_select = document.getElementsByClassName('user_select')
// const fav_diets = document.getElementsById('fav_diets')
// const user_select = document.getElementsById('user_select')

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

    document.getElementById('result').innerText
            = result;
    }

// ---------------------------- 저장된 식단 ----------------------------

// tab1.addEventListener('click', () => {
//     // console.log(fav_diets);
//     if(fav_diets.style.display == 'none'){
//         fav_diets.style.display = 'block';
//         // no_user_search.style.display = 'none';
//         user_select.style.display = 'none';
//     }else{
//         fav_diets.style.display = 'none';
//     }
// });

// tab1.addEventListener('click', function() {
//     if(fav_diets.classList.contains('d-none')){
//         fav_diets.classList.remove('d-none')
//     }
// });
tab1.addEventListener('click', function(){
    console.log("ggg");
});






// ---------------------------- 선택된 음식 ----------------------------

// tab2.addEventListener('click', () => {
//     if(user_select.style.display == 'none'){
//         user_select.style.display = 'block';
//         // no_user_search.style.display = 'none';
//         fav_diets.style.display = 'none';
//     }else{
//         user_select.style.display = 'none';
//     }
// });
