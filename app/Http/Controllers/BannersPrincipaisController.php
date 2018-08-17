<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BannersPrincipaisRepository;
use App\Repositories\StatusRepository;
use Illuminate\Support\Facades\Auth;


class BannersPrincipaisController extends Controller
{

    protected $repository;
    private $statusrepository;

    public function __construct(BannersPrincipaisRepository $repository,  StatusRepository $statusrepository){
        $this->repository = $repository;
        $this->statusrepository = $statusrepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = $this->repository->all();
        return view('admin.bannersprincipais.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = $this->statusrepository->pluck('descricao','id');
        return view('admin.bannersprincipais.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if($request->hasFile('imagem')){
            $numero_aux = rand(1, 9999);
            $extensao = $request->imagem->getClientOriginalExtension();
            $file = $request->imagem;
            $file->move('public/banners_principais', 'banners_principais'.Auth::user()->id."_".$numero_aux.".".$extensao);
            $url = 'public/banners_principais/banners_principais'.Auth::user()->id."_".$numero_aux.".".$extensao;
            $data['imagem'] = $url;
        }else{
            unset($data['imagem']); 
        }

        $this->repository->create($data);
       
        \Session::flash('message', ' Banner criado com sucesso.');

        return redirect()->route('admin.bannersprincipais.index');
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
        $banner = $this->repository->find($id);
        $status = $this->statusrepository->pluck('descricao','id');
        return view('admin.bannersprincipais.edit', compact('banner','status'));
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

        $banner = $this->repository->find($id);

        if($request->hasFile('imagem')){
            @unlink($banner->imagem1);
            $numero_aux = rand(1, 9999);
            $extensao = $request->imagem->getClientOriginalExtension();
            $file = $request->imagem;
            $file->move('public/banners_principais', 'banners_principais'.Auth::user()->id."_".$numero_aux.".".$extensao);
            $url = 'public/banners_principais/banners_principais'.Auth::user()->id."_".$numero_aux.".".$extensao;
            $data['imagem'] = $url;
        }else{
            unset($data['imagem']); 
        }
        
        $this->repository->update($data, $id);
        \Session::flash('message', ' Banner atualizado com sucesso.');

        return redirect()->route('admin.bannersprincipais.index');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = $this->repository->find($id);
        @unlink($banner->imagem);
        $this->repository->delete($id);
        \Session::flash('message', 'Banner excluido com sucesso.');

        return redirect()->route('admin.bannersprincipais.index');
    }
}
