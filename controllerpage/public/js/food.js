function foodDel(food_id) {
    let confirmDelete = confirm("음식 정보를 삭제 하시겠습니까?");

    if (confirmDelete) {
        const url = "/api/userfood/del/" + food_id;
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const delDate = document.getElementsByClassName('delDate');
        const request = new Request(url, {
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token
            },
            method: 'DELETE',
            credentials: "same-origin",
            body: JSON.stringify({
                food_id: food_id
            })  
        });

        fetch(request)
        .then(response => {
            if (!response.ok) {
                throw new Error(response.status + ' : API 응답 오류');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            alert('삭제되었습니다.');
            location.reload();
        })
        .catch(error => console.error('Error:', error));
    }
}
