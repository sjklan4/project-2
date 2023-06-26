// 퀘스트 리스트
$(".option").click(function(){
    $(".option").removeClass("active");
    $(this).addClass("active");
});

// 퀘스트 확인 갱신
const questUdtBtn = document.querySelector('.questUdt');
questUdtBtn.addEventListener('click', function(){
    const id = document.getElementById('id');
    const url = "/api/quest";

    fetch(url)
    .then(data => {
        if (!data.status) {
            throw new Error(data.status + ' : API Response Error');
        }
        return data.json();
    })
    .then(apiData  => {
        // const idspan = document.getElementById('errorMsg');
        //     if(apiData["flg"] === "1") {
        //         idspan.innerHTML = apiData["msg"];
        //     } else {
        //         idspan.innerHTML = "사용가능한 Email입니다. "
        //     }
    });
});