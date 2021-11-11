<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CommentService;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * The CommentService implementation.
     *
     * @var CommentService
     */
    protected $comment_service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CommentService $comment_service
    ){
        $this->middleware('auth');
        $this->comment_service = $comment_service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request, int $id)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = Auth::id();
            $this->comment_service->createNewComment($data, $id);
        } catch (Exception $error) {
            return redirect()->route('hikyos.show', $id)->with('error', 'コメントの投稿ができませんでした。');
        }
        return redirect()->route('hikyos.show', $id)->with('success', 'コメントを投稿しました');
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
