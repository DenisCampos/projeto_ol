<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProfissionalSubAtuacoesRepository;
use App\Repositories\ProfissionaisRepository;
use App\Repositories\AtuacoesRepository;
use App\Repositories\SubAtuacoesRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfissionalSubAtuacoesController extends Controller
{
    protected $repository;
    private $atuacoesrepository, $subatuacoesrepository, $profissionaisrepository;

    public function __construct(ProfissionalSubAtuacoesRepository $repository, AtuacoesRepository $atuacoesrepository, SubAtuacoesRepository $subatuacoesrepository, ProfissionaisRepository $profissionaisrepository){
        $this->repository = $repository;
        $this->atuacoesrepository = $atuacoesrepository;
        $this->subatuacoesrepository = $subatuacoesrepository;
        $this->profissionaisrepository = $profissionaisrepository;
    }

    public function index($id, $atuacao){

        if($this->verificaUser($id)==1){
            abort(403);
        }

        $subatuacoes = DB::table('sub_atuacoes')
            ->leftJoin('profissional_sub_atuacoes', function ($join) use ($id) {
                $join->on('sub_atuacoes.id', '=', 'profissional_sub_atuacoes.subatuacao_id')
                    ->where('profissional_sub_atuacoes.profissional_id', '=', $id);
            })
            ->join('atuacoes', function ($join) use ($atuacao){
                $join->on('atuacoes.id', '=', 'sub_atuacoes.atuacao_id')
                     ->where('sub_atuacoes.atuacao_id', '=', $atuacao)
                     ->whereIn('atuacoes.tipo', [1, 3]);
            })
            ->whereIn('sub_atuacoes.tipo', [1, 3])
            ->orderBy('sub_atuacoes.descricao', 'asc')
            ->select('sub_atuacoes.id as sub_atuacoesid', 'sub_atuacoes.descricao', 'profissional_sub_atuacoes.id as psubatuacaoid')
            ->get();
        $profissional = $this->profissionaisrepository->find($id);
        //dd($atuacoes);

        return view('profissionalsubatuacoes.index', compact('profissional', 'subatuacoes', 'atuacao'));
    }

    public function store(Request $request){
        $data['subatuacao_id'] = $request->id;
        $data['profissional_id'] = $request->pid;
        $this->repository->create($data);
        $prof['statu_id'] = '1';
        $prof['situacao_id'] = '1';
        $prof['destaque_id'] = '1';
        $this->profissionaisrepository->update($prof, $request->pid);
        return \Response::json($request->id); 
    }

    public function destroy(Request $request){
        $this->repository->deleteWhere([
            'subatuacao_id'=>$request->id,
            'profissional_id'=>$request->pid,
        ]);
        $prof['statu_id'] = '1';
        $prof['situacao_id'] = '1';
        $prof['destaque_id'] = '1';
        $this->profissionaisrepository->update($prof, $request->pid);
        return \Response::json($request->id); 
    }

    private function verificaUser($id){
        $user = Auth::user()->id;
        $profissional = $this->profissionaisrepository->find($id);
        if($profissional->user_id != $user){
           return 1;
        }else{
            return 0;
        }
    }
}
