<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PostsRepository;
use App\Repositories\PostCategoriasRepository;
use App\Repositories\StatusRepository;
use App\Repositories\SituacoesRepository;
use App\Repositories\DestaquesRepository;
use Illuminate\Support\Facades\Auth;


class PostsController extends Controller
{
    protected $repository;
    private $postcategoriasrepository, $statusrepository, $situacoesrepository, $destaquesrepository;

    public function __construct(
        PostsRepository $repository,
        PostCategoriasRepository $postcategoriasrepository,
        StatusRepository $statusrepository,
        SituacoesRepository $situacoesrepository,
        DestaquesRepository $destaquesrepository
    ){
        $this->repository = $repository;
        $this->postcategoriasrepository = $postcategoriasrepository;
        $this->statusrepository = $statusrepository;
        $this->situacoesrepository = $situacoesrepository;
        $this->destaquesrepository = $destaquesrepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->repository->all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = $this->statusrepository->pluck('descricao','id');
        $situacoes = $this->situacoesrepository->pluck('descricao','id');
        $destaques = $this->destaquesrepository->pluck('descricao','id');
        return view('admin.posts.create', compact('status','situacoes','destaques'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $data = $request->all();

        if($request->hasFile('imagem1')){
            $numero_aux = rand(1, 9999);
            $extensao = $request->imagem1->getClientOriginalExtension();
            $file = $request->imagem1;
            $file->move('public/posts_imagens', 'post_destaque'.Auth::user()->id."_".$numero_aux.".".$extensao);
            $url = 'public/posts_imagens/post_destaque'.Auth::user()->id."_".$numero_aux.".".$extensao;
            $data['imagem1'] = $url;
        }else{
            unset($data['imagem1']); 
        }
        if($request->hasFile('imagem2')){
            $numero_aux = rand(1, 9999);
            $extensao = $request->imagem2->getClientOriginalExtension();
            $file = $request->imagem2;
            $file->move('public/posts_imagens', 'post_mini'.Auth::user()->id."_".$numero_aux.".".$extensao);
            $url = 'public/posts_imagens/post_mini'.Auth::user()->id."_".$numero_aux.".".$extensao;
            $data['imagem2'] = $url;
        }else{
            unset($data['imagem2']); 
        }
        $data['user_id'] = $id;

        $this->repository->create($data);
       
        \Session::flash('message', ' Post criada com sucesso.');

        $id = Auth::user()->id;
        $post = $this->repository->findWhere([
            'user_id'=>$id
        ])->max('id');


        return redirect()->route('admin.postcategorias.index', ['id' => $post]);
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
        $post = $this->repository->find($id);
        $status = $this->statusrepository->pluck('descricao','id');
        $situacoes = $this->situacoesrepository->pluck('descricao','id');
        $destaques = $this->destaquesrepository->pluck('descricao','id');
        return view('admin.posts.edit', compact('post','status','situacoes','destaques'));
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
        $data = $request->all();

        $post = $this->repository->find($id);
        
        if($request->hasFile('imagem1')){
            @unlink($post->imagem1);
            $numero_aux = rand(1, 9999);
            $extensao = $request->imagem1->getClientOriginalExtension();
            $file = $request->imagem1;
            $file->move('public/posts_imagens', 'post_destaque'.Auth::user()->id."_".$numero_aux.".".$extensao);
            $url = 'public/posts_imagens/post_destaque'.Auth::user()->id."_".$numero_aux.".".$extensao;
            $data['imagem1'] = $url;
        }else{
            unset($data['imagem1']); 
        }

        if($request->hasFile('imagem2')){
            @unlink($post->imagem2);
            $numero_aux = rand(1, 9999);
            $extensao = $request->imagem2->getClientOriginalExtension();
            $file = $request->imagem2;
            $file->move('public/posts_imagens', 'post_mini'.Auth::user()->id."_".$numero_aux.".".$extensao);
            $url = 'public/posts_imagens/post_mini'.Auth::user()->id."_".$numero_aux.".".$extensao;
            $data['imagem2'] = $url;
        }else{
            unset($data['imagem2']); 
        }
      
        $this->repository->update($data, $id);
        \Session::flash('message', ' Post atualizado com sucesso.');

        return redirect()->route('admin.posts.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $post = $this->repository->find($id);

        @unlink($post->imagem1);
        if($post->imagem2!=""){
            @unlink($post->imagem2);
        }
        $this->postcategoriasrepository->deleteWhere([
            'post_id'=>$id,
        ]);
        $this->repository->delete($id);
        \Session::flash('message', 'Post excluido com sucesso.');

        return redirect()->route('admin.posts.index'); 
    }
}
