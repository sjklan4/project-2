<?php
/*****************************************************
 * 프로젝트명   : project-2
 * 디렉토리     : Controllers
 * 파일명       : BoardController.php
 * 이력         : v001 0526 AR.Choe new
 *****************************************************/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Models\Board;
use App\Models\BoardCate;
use App\Models\BoardLike;
use App\Models\UserInfo;
use App\Models\BoardImg;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        $result = DB::table('boards')
            ->select('boards.board_id', 'boards.btitle', 'boards.likes', 'boards.hits', 'boards.replies', 'board_cates.bcate_name')
            ->join('board_cates','boards.bcate_id','=', 'board_cates.bcate_id')
            ->orderBy('boards.created_at', 'desc')
            ->where('boards.deleted_at', null)
            ->paginate(10)
            ;

        return view('boardList')->with('data', $result);
    }

    public function indexNum($id)
    {
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        $result = DB::table('boards')
            ->select('boards.board_id', 'boards.btitle', 'boards.likes', 'boards.hits', 'boards.replies', 'board_cates.bcate_name')
            ->join('board_cates','boards.bcate_id','=', 'board_cates.bcate_id')
            ->where('boards.bcate_id', $id)
            ->where('boards.deleted_at', null)
            ->orderBy('boards.created_at', 'desc')
            ->paginate(10)
            ;

        return view('boardList')->with('data', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        return view('boardCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        $id = session('user_id');

        // todo 트랜잭션
        // 게시글 테이블에 인서트 후 pk 값 획득
        $board_id = DB::table('boards')->insertGetId([
                'user_id'     => $id
                ,'bcate_id'   => $req->cate
                ,'btitle'     => $req->title
                ,'bcontent'   => $req->content
                ,'created_at' => now()
            ]
            ,'board_id'
        );

        // 이미지 파일이 있다면, 이미지 경로에 저장
        if($req->hasFile('picture')){
            $fileName = time().'_'.$req->file('picture')->getClientOriginalName();
            $path = $req->file('picture')->storeAs('public/images/board', $fileName);

            DB::table('board_imgs')
                ->insert([
                    'board_id'      => $board_id
                    ,'bimg_name'    => $fileName
                    ,'bimg_path'    => $path
                ]);
        }

        return redirect()->route('board.show', ['board' => $board_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $flg = '0')
    {
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        // todo 유효성 검사
        
        $board = Board::find($id);
        // 조회수 증가
        if($flg === '0') {
            DB::table('boards')
                ->where('board_id', '=', $id)
                ->update(['hits' => $board->hits + 1]);
        }
        
        // 게시글 상세 정보 획득
        $board = Board::find($id);
        $bcate = BoardCate::find($board->bcate_id);
        $user = UserInfo::find($board->user_id);
        $boardImg = DB::table('board_imgs')
            ->where('board_id', $id)
            ->select('bimg_name')
            ->get();

        // 댓글 관련 정보 획득
        $reply = DB::table('board_replies')
                ->join('user_infos', 'user_infos.user_id', '=', 'board_replies.user_id')
                ->select('board_replies.rcontent', 'user_infos.nkname', 'board_replies.created_at')
                ->where('board_replies.board_id', $board->board_id)
                ->get();

        $arr = [
            'cate'        => $bcate->bcate_name
            ,'nkname'     => $user->nkname
            ,'title'      => $board->btitle
            ,'content'    => $board->bcontent
            ,'hits'       => $board->hits
            ,'id'         => $board->board_id
            ,'like'       => $board->likes
            ,'user_id'    => $board->user_id
            ,'created_at' => $board->created_at
        ];

        if (isset($boardImg[0])) {
            $arr['img'] = $boardImg[0]->bimg_name;
        }

        return view('boardDetail')->with('data', $arr)->with('reply', $reply);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        $board = Board::find($id);

        return view('boardEdit')->with('data', $board);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        // todo 트랜잭션 처리
        // 게시글 테이블 정보 수정
        $board = Board::find($id);
        $board->bcate_id = $req->cate;
        $board->btitle = $req->title;
        $board->bcontent = $req->content;
        $board->save();

        // 이미지 테이블 정보 수정
        if($req->hasFile('picture')){
            $fileName = time().'_'.$req->file('picture')->getClientOriginalName();
            $path = $req->file('picture')->storeAs('public/images/board', $fileName);

            DB::table('board_imgs')
                ->where('board_id', $id)
                ->update([
                    'bimg_name'    => $fileName
                    ,'bimg_path'    => $path
                ]);

        }

        return redirect()->route('board.show', ['board' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        // todo 유효성 검사

        // 게시글 삭제 처리
        Board::destroy($id);

        // todo 에러처리, 트랜잭션 처리
        return redirect()->route('board.index');
    }

    public function like($id)
    {
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        // todo 유효성 검사

        $user_id = session('user_id');

        // 좋아요 테이블 정보 확인
        $count = DB::table('board_likes')
            ->where('user_id', $user_id)
            ->where('board_id', $id)
            ->count();

        if ($count === 0) {
            DB::transaction(function () use ($id, $user_id) {
                // 좋아요 테이블 인서트
                DB::table('board_likes')->insert([
                    'board_id'    => $id
                    ,'user_id'    => $user_id
                ]);

                // 게시판 테이블 좋아요 수 증가
                $board = Board::find($id);
                DB::table('boards')
                ->where('board_id', '=', $id)
                ->update(['likes' => $board->likes + 1]);
            });
        } else {
            DB::transaction(function () use ($id, $user_id) {
                // 좋아요 테이블 정보 삭제
                DB::table('board_likes')
                    ->where('user_id', $user_id)
                    ->where('board_id', $id)
                    ->delete();

                // 게시판 테이블 좋아요 수 감소
                $board = Board::find($id);
                DB::table('boards')
                ->where('board_id', '=', $id)
                // ->update(['likes' => $board->likes - 1]);
                ->decrement('likes');
            });
        }

        return redirect()->route('board.shows', ['board' => $id, 'flg' => '1']);
    }

    public function replyPost(Request $req) {
        // todo 유효성 검사

        $user_id = session('user_id');
        // 댓글 테이블 인서트
        DB::table('board_replies')->insert([
            'user_id'       => $user_id
            ,'board_id'     => $req->board_id
            ,'rcontent'     => $req->reply
            ,'created_at'   => now()
        ]);

        // 게시글 테이블 댓글 수 업데이트
        $board = Board::find($req->board_id);
        DB::table('boards')
            ->where('board_id', '=', $req->board_id)
            ->update(['replies' => $board->replies + 1]);

        // todo 트랜잭션 처리

        // 게시글 상세 페이지 이동
        return redirect()->route('board.shows', ['board' => $req->board_id, 'flg' => '1']);
    }
}
