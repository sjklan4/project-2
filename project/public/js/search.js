// v003 add
const searchResult = document.getElementsByClassName("searchResult")
const favDiets = document.getElementsByClassName("favDiets")
const seleted = document.getElementsByClassName("seleted")

favDiets.addEventListner('click', function() {
    let favtitle = document.createElement('h3')
    favtitle.innerHTML('저장된 식단')
})