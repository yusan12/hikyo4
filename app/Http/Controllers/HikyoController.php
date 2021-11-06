<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HikyoRequest;
use App\Comment;
use App\Hikyo;
use Illuminate\Support\Facades\Auth;

class HikyoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('hikyos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ThreadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HikyoRequest $request)
    {
        // save Hikyo
        $hikyo = new Hikyo();
        $hikyo->name = $request->name;
        $hikyo->user_id = Auth::id();
        $hikyo->place = $request->place;
        $hikyo->introduction = $request->introduction;
        $hikyo->time_from_tokyo = $request->time_from_tokyo;
        $hikyo->how_much_from_tokyo = $request->how_much_from_tokyo;
        $hikyo->caution = $request->caution;
        $hikyo->save();
        // save comment
        $comment = new Comment();
        $comment->body = $request->content;
        $comment->user_id = Auth::id();
        $comment->hikyo_id = $hikyo->id;
        $comment->save();
        // redirect to index method
        return redirect()->route('hikyos.index')->with('success', '秘境の新規作成が完了しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
