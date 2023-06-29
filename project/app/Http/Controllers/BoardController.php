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
use App\Models\BoardReply;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 로그인 확인
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        // 게시글 정보 획득
        $result = Board::join('board_cates','boards.bcate_id','=', 'board_cates.bcate_id')
            ->select('boards.board_id', 'boards.btitle', 'boards.likes', 'boards.hits', 'boards.replies', 'board_cates.bcate_name', 'boards.created_at')
            ->orderBy('boards.created_at', 'desc')
            ->paginate(10)
            ;


        return view('boardList')->with('data', $result);
    }

    public function indexNum($id)
    {
        // 로그인 확인
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        // 게시글 정보 획득
        $result = Board::join('board_cates','boards.bcate_id','=', 'board_cates.bcate_id')
            ->select('boards.board_id', 'boards.btitle', 'boards.likes', 'boards.hits', 'boards.replies', 'board_cates.bcate_name', 'boards.created_at')
            ->where('boards.bcate_id', $id)
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
        // 로그인 확인
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
        // 로그인 확인
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        // 유효성 검사
        $rules = [
            'cate'      => 'required'
            ,'title'    => 'required|max:50'
            ,'content'  => 'required|max:4000'
            ,'picture'  => 'file|mimes:jpg,png,gif|max:5120'
        ];

        $messages = [
            'cate.required'     => '카테고리는 필수 입력 항목입니다.',
            'title.required'    => '제목은 필수 입력 항목입니다.',
            'title.max'         => ':max자까지 입력 가능합니다.',
            'content.required'  => '본문은 필수 입력 항목입니다.',
            'content.max'       => ':max자까지 입력 가능합니다.',
            'picture.mimes'     => 'jpg, png, gif 파일만 업로드 가능합니다.',
            'picture'           => '5mb까지 업로드 가능합니다.',
        ];

        $validator = Validator::make($req->only('cate', 'title', 'content', 'picture'), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        // todo 트랜잭션
        // 게시글 테이블에 인서트 후 pk 값 획득
        $board_id = DB::table('boards')->insertGetId([
                'user_id'     => Auth::user()->user_id
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

        // 해당 유저의 해당 글 좋아요 확인
        $like_count = DB::table('board_likes')
            ->where('user_id', Auth::user()->user_id)
            ->where('board_id', $id)
            ->first();
        
        $like_flg = 0;
        if (isset($like_count)) { // 좋아요가 있을 때
            $like_flg = 1;
        }
        
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
        $reply = BoardReply::join('user_infos', 'user_infos.user_id', '=', 'board_replies.user_id')
                ->select('board_replies.rcontent', 'user_infos.nkname', 'board_replies.created_at', 'board_replies.reply_id', 'board_replies.user_id')
                ->where('board_replies.board_id', $board->board_id)
                ->paginate(5);

        $arr = [
            'cate'        => $bcate->bcate_name
            ,'nkname'     => $user->nkname
            ,'title'      => $board->btitle
            ,'content'    => nl2br($board->bcontent)
            ,'hits'       => $board->hits
            ,'id'         => $board->board_id
            ,'like'       => $board->likes
            ,'user_id'    => $board->user_id
            ,'created_at' => $board->created_at
            ,'like_flg'   => $like_flg
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

        // todo 이미지 수정 기능

        $board = Board::find($id);
        $bcate = BoardCate::orderBy('bcate_id')->get();
        
        return view('boardEdit')->with('data', $board)->with('cate', $bcate);
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

        // 유효성 검사
        $rules = [
            'cate'      => 'required'
            ,'title'    => 'required|max:50'
            ,'content'  => 'required|max:4000'
            ,'picture'  => 'file|mimes:jpg,png,gif|max:5120'
        ];

        $messages = [
            'cate.required'     => '카테고리는 필수 입력 항목입니다.',
            'title.required'    => '제목은 필수 입력 항목입니다.',
            'title.max'         => ':max자까지 입력 가능합니다.',
            'content.required'  => '본문은 필수 입력 항목입니다.',
            'content.max'       => ':max자까지 입력 가능합니다.',
            'picture.mimes'     => 'jpg, png, gif 파일만 업로드 가능합니다.',
            'picture'           => '5mb까지 업로드 가능합니다.',
        ];

        $validator = Validator::make($req->only('cate', 'title', 'content', 'picture'), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
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
        // 유효성 검사
        $rules = [
            'reply'    => 'required|max:200'
        ];

        $messages = [
            'reply.required'    => '댓글은 필수 입력 항목입니다.',
            'reply.max'         => '200자까지 입력가능합니다.',
        ];

        $validator = Validator::make($req->only('reply'), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('board.shows', ['board' => $req->board_id, 'flg' => '1'])
                ->withErrors($validator)
                ->withInput();
        }

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

    // 댓글 삭제
    public function replyDelete($board, $id) {
        
        if(auth()->guest()) {
            return redirect()->route('user.login');
        }

        // todo 유효성 검사

        // 댓글 삭제 처리
        BoardReply::destroy($id);

        // todo 에러처리, 트랜잭션 처리
        return redirect()->route('board.shows', ['board' => $board, 'flg' => '1']);
    }

}
