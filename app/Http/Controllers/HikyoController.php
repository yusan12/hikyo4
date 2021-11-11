<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HikyoRequest;
use App\Services\HikyoService;
use App\Repositories\HikyoRepository;
use Illuminate\Support\Facades\Auth;
use Exception;

class HikyoController extends Controller
{
    /**
     * @var hikyoService
     */
    protected $hikyo_service;

    /**
     * The HikyoRepository implementation.
     *
     * @var HikyoRepository
     */
    protected $hikyo_repository;

    /**
     * Create a new controller instance.
     *
     * @param  HikyoService  $hikyo_service
     * @return void
     */
    public function __construct(
        HikyoService $hikyo_service, // インジェクション
        HikyoRepository $hikyo_repository
    ) {
        $this->middleware('auth')->except('index');
        $this->hikyo_service = $hikyo_service; // プロパティに代入する。
        $this->hikyo_repository = $hikyo_repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hikyos = $this->hikyo_service->getHikyos(3);
        return view('hikyos.index', compact('hikyos'));
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
     * @param  App\Http\Requests\HikyoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HikyoRequest $request)
    {
        try {
            $data = $request->only(
                ['name', 'content', 'place', 'introduction', 'time_from_tokyo', 'how_much_from_tokyo', 'caution']
            );
            $this->hikyo_service->createNewHikyo($data, Auth::id()); // new せずとも $this-> の形で呼び出せる（インジェクションした為）。
        } catch (Exception $error) {
            return redirect()->route('hikyos.index')->with('error', '秘境の新規作成に失敗しました。');
        }
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
        $hikyo = $this->hikyo_repository->findById($id);
        $hikyo->load('comments.user');
        return view('hikyos.show', compact('hikyo'));
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
