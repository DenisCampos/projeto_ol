<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PostCategoriasRepository;
use App\Repositories\CategoriasRepository;
use App\Repositories\PostsRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostCategoriasController extends Controller
{

    protected $repository;
    private $categoriasrepository, $postsrepository;

    public function __construct(PostCategoriasRepository $repository, CategoriasRepository $categoriasrepository, PostsRepository $postsrepository){
        $this->repository = $repository;
        $this->categoriasrepository = $categoriasrepository;
        $this->postsrepository = $postsrepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($post)
    {

        $postid = $post;

        $categorias = DB::table('categorias')
            ->leftJoin('post_categorias', function ($join) use ($post) {
                $join->on('categorias.id', '=', 'post_categorias.categoria_id')
                    ->where('post_categorias.post_id', '=', $post);
            })

            ->orderBy('categorias.descricao', 'asc')
            ->select('categorias.id as categoriaid', 'categorias.descricao', 'post_categorias.id as categoria_post')
            ->get();

        //dd($categorias);

        return view('admin.postcategorias.index', compact('categorias','postid'));
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['post_id'] = $request->idp;
        $data['categoria_id'] = $request->id;
        $this->repository->create($data);
        return \Response::json($request->id); 
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
        $this->repository->deleteWhere([
            'categoria_id'=>$request->id,
            'post_id'=>$request->idp,
        ]);
        return \Response::json($request->id); 
    }
}
