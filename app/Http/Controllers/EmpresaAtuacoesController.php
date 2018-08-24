<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EmpresasRepository;
use App\Repositories\EmpresaAtuacoesRepository;
use App\Repositories\AtuacoesRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmpresaAtuacoesController extends Controller
{
    protected $repository;
    private $atuacoesrepository, $empresasrepository;

    public function __construct(EmpresaAtuacoesRepository $repository, AtuacoesRepository $atuacoesrepository, EmpresasRepository $empresasrepository){
        $this->repository = $repository;
        $this->atuacoesrepository = $atuacoesrepository;
        $this->empresasrepository = $empresasrepository;
    }

    public function index($id){

        if($this->verificaUser($id)==1){
            abort(403);
        }

        $atuacoes = DB::table('atuacoes')
            ->leftJoin('empresa_atuacoes', function ($join) use ($id) {
                $join->on('atuacoes.id', '=', 'empresa_atuacoes.atuacao_id')
                    ->where('empresa_atuacoes.empresa_id', '=', $id);
            })
            ->leftJoin('sub_atuacoes', function ($join) use ($id) {
                $join->on('atuacoes.id', '=', 'sub_atuacoes.atuacao_id');
            })
            ->whereIn('atuacoes.tipo', [2, 3])
            ->orderBy('atuacoes.descricao', 'asc')
            ->select('atuacoes.id as atuacaoid', 'atuacoes.descricao', 'empresa_atuacoes.id as eatuacaoid', DB::raw('count(sub_atuacoes.id) as subcontador'))
            ->groupBy('atuacoes.id')
            ->get();
        $empresa = $this->empresasrepository->find($id);
        //dd($atuacoes);

        return view('empresaatuacoes.index', compact('atuacoes','empresa'));
    }

    public function store(Request $request){
        $data['atuacao_id'] = $request->id;
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
            'atuacao_id'=>$request->id,
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
