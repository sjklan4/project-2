function detailReport(id, board) {

    const reporter = document.getElementById('reporter');
    const suspect = document.getElementById('suspect');
    const report_con = document.getElementById('report_con');
    const report_com = document.getElementById('report_com');
    const report_date = document.getElementById('report_date');
    const reportBtn = document.getElementById('reportBtn');

    if (!board) {
        board = 'a';
    }
    fetch(`/api/reportdetail/${id}/${board}`, {
        method: "get"
    })
    .then(res => res.json())
    .then(data => { 
        console.log(data); console.log(data.errcode); console.log(data.msg)
        data['reportdata'].forEach(rep => {
            if(rep.reply_id !== null){
                // 신고당한 댓글 정보
                report_con.innerHTML = '댓글 ID : ' + rep.reply_id
                + '<br> 댓글 내용 : ' 
                + rep.rcontent
            }else{
                // 신고당한 게시판 정보
                report_con.innerHTML = '게시판 ID : ' + rep.board_id 
                + '<br> 게시판 제목 : ' 
                + rep.btitle + ' <br> 게시판 내용 : ' + rep.bcontent
            }
            const hinputreport = document.createElement('input')
            const hinputboard = document.createElement('input')
            const hinputreply = document.createElement('input')

            // 신고 번호
            hinputreport.setAttribute('type', 'hidden')
            hinputreport.setAttribute('name', 'reportId')
            hinputreport.setAttribute('value', rep.rep_id)

            // 신고한 게시판 번호
            hinputboard.setAttribute('type', 'hidden')
            hinputboard.setAttribute('name', 'boardId')
            hinputboard.setAttribute('value', rep.board_id)

            // 신고한 댓글 번호
            hinputreply.setAttribute('type', 'hidden')
            hinputreply.setAttribute('name', 'replyId')
            hinputreply.setAttribute('value', rep.reply_id)
            reportBtn.appendChild(hinputboard);
            reportBtn.appendChild(hinputreport);
            reportBtn.appendChild(hinputreply);
        });
        data['userdata'].forEach(user => {
            reporter.innerHTML = user.reporter + user.reporterid;
            suspect.innerHTML = user.suspect + user.suspectid;
            if (user.complate_flg == 0) {
                user.complate_flg = "대기";
            }else{
                user.complate_flg = "완료";
            }
            report_com.innerHTML = user.complate_flg;
            report_date.innerHTML = user.created_at;

            const hinputuser = document.createElement('input')
            hinputuser.setAttribute('type', 'hidden')
            hinputuser.setAttribute('name', 'userId')
            hinputuser.setAttribute('value', user.suspect)
            reportBtn.appendChild(hinputuser);
        });
    });
}