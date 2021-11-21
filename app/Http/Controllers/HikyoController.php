<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\HikyoRequest;
use App\Repositories\HikyoRepository;
use App\Services\HikyoService;
use Illuminate\Support\Facades\Auth;
use Exception;
class HikyoController extends Controller
{
    /**
     * The HikyoService implementation.
     *
     * @var HikyoService
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
        HikyoService $hikyo_service,
        HikyoRepository $hikyo_repository
    ) {
        $this->middleware('auth')->except('index');
        $this->hikyo_service = $hikyo_service;
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
        $hikyos->load('comments.user', 'comments.images');
        return view('hikyos.index', compact('hikyos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\HikyoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(HikyoRequest $request)
    {
        try {
            $data = $request->only(
                ['name', 'content']
            );
            $this->hikyo_service->createNewHikyo($data, Auth::id());
        } catch (Exception $error) {
            return redirect()->route('hikyos.index')->with('error', 'スレッドの新規作成に失敗しました。');
        }
        // redirect to index method
        return redirect()->route('hikyos.index')->with('success', 'スレッドの新規作成が完了しました。');
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
        $hikyo->load('comments.user', 'comments.images');
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
