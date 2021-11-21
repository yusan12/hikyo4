<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use App\Services\ImageService;
use App\Services\CommentService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    /**
     * The CommentService implementation.
     *
     * @var CommentService
     */
    protected $comment_service;

    /**
     * The ImageService implementation.
     *
     * @var ImageService
     */
    protected $image_service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CommentService $comment_service,
        ImageService $image_service
    ) {
        $this->middleware('auth');
        $this->comment_service = $comment_service;
        $this->image_service = $image_service;
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
            $comment = $this->comment_service->createNewComment($data, $id);

            $images = $request->file('images');
            if ($images) {
                $this->image_service->createNewImages($images, $comment->id);
            }
        } catch (Exception $error) {
            return redirect()->route('hikyos.show', $id)->with('error', 'メッセージの投稿ができませんでした。');
        }
        return redirect()->route('hikyos.show', $id)->with('success', 'メッセージを投稿しました');
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
