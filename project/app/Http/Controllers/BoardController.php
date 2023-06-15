<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Models\Board;
use App\Models\BoardHit;
use App\Models\BoardCate;
use App\Models\BoardLike;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = DB::table('boards')
            ->select('boards.board_id', 'boards.btitle', 'boards.likes', 'board_hits.board_hits', 'board_cates.bcate_name')
            ->join('board_hits','boards.board_id','=', 'board_hits.board_id')
            ->join('board_cates','boards.bcate_id','=', 'board_cates.bcate_id')
            ->orderBy('boards.board_id')
            ->limit(20)
            ->get();

        return view('boardList')->with('data', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('boardCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $boardHit = BoardHit::find($id);
        DB::table('board_hits')
            ->where('board_id', '=', $id)
            ->update(['board_hits' => $boardHit->board_hits + 1]);
        
        $boardHit = BoardHit::find($id);
        $board = Board::find($id);
        $bcate = BoardCate::find($board->bcate_id);

        $arr = [
            'cate'      => $bcate->bcate_name
            ,'title'    => $board->btitle
            ,'content'  => $board->bcontent
            ,'hits'     => $boardHit->board_hits
            ,'id'       => $board->board_id
            ,'like'     => $board->likes
        ];

        return view('boardDetail')->with('data', $arr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $boardHit = BoardHit::find($id);
        $board = Board::find($id);
        $bcate = BoardCate::find($board->bcate_id);

        $arr = [
            'cate'      => $bcate->bcate_name
            ,'title'    => $board->btitle
            ,'content'  => $board->bcontent
            ,'hits'     => $boardHit->board_hits
            ,'id'       => $board->board_id
            ,'like'     => $board->likes
        ];

        return view('boardEdit')->with('data', $arr);
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
        $board = Board::find($id);
        $board->bcate_id = $req->cate;
        $board->btitle = $req->title;
        $board->bcontent = $req->content;
        $board->save();

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
        //
    }

    public function like($id)
    {
        $boardLike = BoardLike::find($id);
        

        return redirect()->back();
    }
}
