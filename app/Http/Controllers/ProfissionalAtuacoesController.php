<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProfissionalAtuacoesRepository;
use App\Repositories\ProfissionaisRepository;
use App\Repositories\AtuacoesRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfissionalAtuacoesController extends Controller
{
    protected $repository;
    private $atuacoesrepository, $profissionaisrepository;

    public function __construct(ProfissionalAtuacoesRepository $repository, AtuacoesRepository $atuacoesrepository, ProfissionaisRepository $profissionaisrepository){
        $this->repository = $repository;
        $this->atuacoesrepository = $atuacoesrepository;
        $this->profissionaisrepository = $profissionaisrepository;
    }

    public function index($id){
       
        if($this->verificaUser($id)==1){
            abort(403);
        }
        $atuacoes = DB::table('atuacoes')
            ->leftJoin('profissional_atuacoes', function ($join) use ($id) {
                $join->on('atuacoes.id', '=', 'profissional_atuacoes.atuacao_id')
                    ->where('profissional_atuacoes.profissional_id', '=', $id);
            })
            ->leftJoin('sub_atuacoes', function ($join) use ($id) {
                $join->on('atuacoes.id', '=', 'sub_atuacoes.atuacao_id');
            })
            ->whereIn('atuacoes.tipo', [1, 3])
            ->orderBy('atuacoes.descricao', 'asc')
            ->select('atuacoes.id as atuacaoid','atuacoes.descricao','profissional_atuacoes.id as patuacaoid', DB::raw('count(sub_atuacoes.id) as subcontador'))
            ->groupBy('atuacoes.id')
            ->get();
        $profissional = $id;
        //dd($atuacoes);

        return view('profissionalatuacoes.index', compact('atuacoes','profissional'));
    }

    public function store(Request $request){
        $data['atuacao_id'] = $request->id;
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
            'atuacao_id'=>$request->id,
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
