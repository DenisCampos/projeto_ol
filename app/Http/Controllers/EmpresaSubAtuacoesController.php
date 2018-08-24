<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EmpresaSubAtuacoesRepository;
use App\Repositories\EmpresasRepository;
use App\Repositories\AtuacoesRepository;
use App\Repositories\SubAtuacoesRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmpresaSubAtuacoesController extends Controller
{
    protected $repository;
    private $atuacoesrepository, $subatuacoesrepository, $empresasrepository;

    public function __construct(EmpresaSubAtuacoesRepository $repository, AtuacoesRepository $atuacoesrepository, SubAtuacoesRepository $subatuacoesrepository, EmpresasRepository $empresasrepository){
        $this->repository = $repository;
        $this->atuacoesrepository = $atuacoesrepository;
        $this->subatuacoesrepository = $subatuacoesrepository;
        $this->empresasrepository = $empresasrepository;
    }

    public function index($id, $atuacao){

        if($this->verificaUser($id)==1){
            abort(403);
        }

        $subatuacoes = DB::table('sub_atuacoes')
            ->leftJoin('empresa_sub_atuacoes', function ($join) use ($id) {
                $join->on('sub_atuacoes.id', '=', 'empresa_sub_atuacoes.subatuacao_id')
                    ->where('empresa_sub_atuacoes.empresa_id', '=', $id);
            })
            ->join('atuacoes', function ($join) use ($atuacao){
                $join->on('atuacoes.id', '=', 'sub_atuacoes.atuacao_id')
                     ->where('sub_atuacoes.atuacao_id', '=', $atuacao)
                     ->whereIn('atuacoes.tipo', [2, 3]);
            })
            ->whereIn('sub_atuacoes.tipo', [2, 3])
            ->orderBy('sub_atuacoes.descricao', 'asc')
            ->select('sub_atuacoes.id as sub_atuacoesid', 'sub_atuacoes.descricao', 'empresa_sub_atuacoes.id as esubatuacaoid')
            ->get();
        $empresa = $this->empresasrepository->find($id);
        //dd($atuacoes);

        return view('empresasubatuacoes.index', compact('empresa', 'subatuacoes','atuacao'));
    }

    public function store(Request $request){
        $data['subatuacao_id'] = $request->id;
        $data['empresa_id'] = $request->eid;
        $this->repository->create($data);
        $emp['statu_id'] = '1';
        $emp['situacao_id'] = '1';
        $emp['destaque_id'] = '1';
        $this->empresasrepository->update($emp, $request->eid);
        return \Response::json($request->id); 
    }

    public function destroy(Request $request){
        $this->repository->deleteWhere([
            'subatuacao_id'=>$request->id,
            'empresa_id'=>$request->eid,
        ]);
        $emp['statu_id'] = '1';
        $emp['situacao_id'] = '1';
        $emp['destaque_id'] = '1';
        $this->empresasrepository->update($emp, $request->eid);
        return \Response::json($request->id); 
    }

    private function verificaUser($id){
        $user = Auth::user()->id;
        $empresa = $this->empresasrepository->find($id);
        if($empresa->user_id != $user){
           return 1;
        }else{
            return 0;
        }
    }
}
