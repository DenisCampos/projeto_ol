<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserInteressesRepository;
use App\Repositories\CategoriasRepository;
use App\Repositories\UsersRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserInteressesController extends Controller
{
    protected $repository;
    private $categoriasrepository;
    private $usersrepository;

    public function __construct(UserInteressesRepository $repository, CategoriasRepository $categoriasrepository, UsersRepository $usersrepository){
        $this->repository = $repository;
        $this->categoriasrepository = $categoriasrepository;
        $this->usersrepository = $usersrepository;
    }

    public function index(){
        //$categorias = $categoriasrepository->all();
        $id = Auth::user()->id;
        $categorias = DB::table('categorias')
            ->leftJoin('user_interesses', function ($join) use ($id) {
                $join->on('categorias.id', '=', 'user_interesses.categoria_id')
                    ->where('user_interesses.user_id', '=', $id);
            })

            ->orderBy('categorias.descricao', 'asc')
            ->select('categorias.id as categoriaid', 'categorias.descricao', 'user_interesses.id as interessesid')
            ->get();

        //dd($categorias);

        return view('userinteresses.index', compact('categorias'));
    }
    

    public function store(Request $request){
        $data['user_id'] = Auth::user()->id;
        $data['categoria_id'] = $request->id;
        $this->repository->create($data);
        return \Response::json($request->id); 
    }

    public function destroy(Request $request){
        $this->repository->deleteWhere([
            'categoria_id'=>$request->id,
            'user_id'=>Auth::user()->id,
        ]);
        return \Response::json($request->id); 
    }

    public function adminshow($id){
        
        $categorias = DB::table('categorias')
            ->join('user_interesses', function ($join) use ($id) {
                $join->on('categorias.id', '=', 'user_interesses.categoria_id')
                    ->where('user_interesses.user_id', '=', $id);
            })

            ->orderBy('categorias.descricao', 'asc')
            ->select('categorias.id as categoriaid', 'categorias.descricao', 'user_interesses.id as interessesid')
            ->get();
        
        $usuario = $this->usersrepository->find($id);
        //dd($categorias);

        return view('admin.userinteresses.adminshow', compact('categorias', 'usuario'));
    }
}
