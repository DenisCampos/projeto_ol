<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PareceresRepository;
use App\Repositories\ProfissionaisRepository;
use App\Repositories\ProfissionalBannersRepository;
use App\Repositories\EmpresasRepository;
use App\Repositories\EmpresaBannersRepository;
use App\Repositories\CursosRepository;
use App\Repositories\EventosRepository;
use Illuminate\Support\Facades\Auth;


class PareceresController extends Controller
{

    protected $repository;
    private $profissionaisrepository, $empresasrepository, $cursosrepository, $eventosrepository, $profissionalbannerrepository, $empresabannerrepository;

    public function __construct(
        PareceresRepository $repository, 
        ProfissionaisRepository $profissionaisrepository, 
        EmpresasRepository $empresasrepository,
        CursosRepository $cursosrepository,
        EventosRepository $eventosrepository,
        ProfissionalBannersRepository $profissionalbannerrepository,
        EmpresaBannersRepository $empresabannerrepository
    ){
        $this->repository = $repository;
        $this->profissionaisrepository = $profissionaisrepository;
        $this->empresasrepository = $empresasrepository;
        $this->cursosrepository = $cursosrepository;
        $this->eventosrepository = $eventosrepository;
        $this->profissionalbannerrepository = $profissionalbannerrepository;
        $this->empresabannerrepository = $empresabannerrepository;
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
        $data['visualizou'] = '1';
        $this->repository->update($data, $id);
        //dd($this->repository->update($data, $id));
        $parecer = $this->repository->find($id);
        if($parecer->tipo==1){
            $dados = $this->profissionaisrepository->find($parecer->id_tipo);
        }elseif($parecer->tipo==2){
            $dados = $this->empresasrepository->find($parecer->id_tipo);
        }elseif($parecer->tipo==3){
            $dados = $this->cursosrepository->find($parecer->id_tipo);
        }elseif($parecer->tipo==4){
            $dados = $this->eventosrepository->find($parecer->id_tipo);
        }elseif($parecer->tipo==5){
            $dados = $this->profissionalbannerrepository->find($parecer->id_tipo);
        }elseif($parecer->tipo==6){
            $dados = $this->empresabannerrepository->find($parecer->id_tipo);
        }

        return view('pareceres.show', compact('parecer', 'dados'));

    }

    public function showall()
    {
        $pareceres = $this->repository->findWhere([
            'user_id'=>Auth::user()->id
        ]);

        $data['visualizou'] = '1';
        foreach($pareceres as $parecer){
            $this->repository->update($data, $parecer->id);
        }

        return view('pareceres.showall', compact('pareceres'));
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
