<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PaisesRepository;

class PaisesController extends Controller
{
    protected $repository;

    public function __construct(PaisesRepository $repository){
        $this->repository = $repository;
    }

    public function index()
    {
        $paises = $this->repository->orderBy('descricao')->all();
        //dd($Paíss);

        return view('admin.paises.index', compact('paises'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.paises.create');
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
        $data['slug'] = $this->montarSlug($data['descricao'], '');
        $this->repository->create($data);
        \Session::flash('message', ' País criada com sucesso.');
        return redirect()->route('admin.paises.index');
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
        $pais = $this->repository->find($id);
        return view('admin.paises.edit', compact('pais'));
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
        $data['slug'] = $this->montarSlug($data['descricao'], $id);
        $this->repository->update($data, $id);
        \Session::flash('message', ' País atualizada com sucesso.');
        return redirect()->route('admin.paises.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        \Session::flash('message', ' País deletada com sucesso.');
        return redirect()->route('admin.paises.index');
    }

    private function montarSlug($titulo, $id){
        $slug = str_slug($titulo, '-');
        $slug_count = $this->repository->findByField('slug',$slug)->where('id', '!=', $id)->count();
        if($slug_count>0){
            $vefica_slug = $slug_count;
            while($vefica_slug>0){
                $slug_count++;
                $vefica_slug = $this->repository->findByField('slug',$slug."-".$slug_count)->where('id', '!=', $id)->count();                
            }
            $slug = $slug."-".$slug_count;
        }
        return $slug;
    }
}
