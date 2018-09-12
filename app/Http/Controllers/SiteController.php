<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Repositories\UsersRepository;
use App\Repositories\PaisesRepository;
use App\Repositories\EstadosRepository;
use App\Repositories\CidadesRepository;
use App\Repositories\BannersPrincipaisRepository;
use App\Repositories\AtuacoesRepository;
use App\Repositories\SubAtuacoesRepository;
use App\Repositories\CategoriasRepository;
use App\Repositories\CursoCategoriasRepository;
use App\Repositories\CursosRepository;
use App\Repositories\EmpresasRepository;
use App\Repositories\EmpresaAtuacoesRepository;
use App\Repositories\EmpresaSubAtuacoesRepository;
use App\Repositories\EmpresaBannersRepository;
use App\Repositories\EventoCategoriasRepository;
use App\Repositories\EventosRepository;
use App\Repositories\PostCategoriasRepository;
use App\Repositories\PostsRepository;
use App\Repositories\ProfissionalAtuacoesRepository;
use App\Repositories\ProfissionalSubAtuacoesRepository;
use App\Repositories\ProfissionaisRepository;
use App\Repositories\ProfissionalBannersRepository;
use App\Repositories\UserInteressesRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Mail\MailFaleConosco;



class SiteController extends Controller
{


    protected $repository;
    private $paisesrepository,$estadosrepository,$cidadesrepository,$userinteressesrepository,$profissionaisrepository,$profissionalatuacoesrepository,
    $profissionalsubatuacoesrepository,$empresasrepository,$empresaatuacoesrepository,$empresasubatuacoesrepository,$bannersprincipaisrepository,$atuacoesrepository,
    $subatuacoesrepository,$categoriasrepository,$cursosrepository,$cursocategoriasrepository,$eventosrepository,$eventocategoriasrepository,$postsrepository,
    $postcategoriasrepository, $profissionalbannersrepository, $empresabannersrepository;

    public function __construct(
        UsersRepository $repository,
        PaisesRepository $paisesrepository,
        EstadosRepository $estadosrepository,
        CidadesRepository $cidadesrepository,
        UserInteressesRepository $userinteressesrepository,
        ProfissionaisRepository $profissionaisrepository,
        ProfissionalAtuacoesRepository $profissionalatuacoesrepository,
        ProfissionalSubAtuacoesRepository $profissionalsubatuacoesrepository,
        ProfissionalBannersRepository $profissionalbannersrepository,
        EmpresasRepository $empresasrepository,
        EmpresaAtuacoesRepository $empresaatuacoesrepository,
        EmpresaSubAtuacoesRepository $empresasubatuacoesrepository,
        EmpresaBannersRepository $empresabannersrepository,
        BannersPrincipaisRepository $bannersprincipaisrepository,
        AtuacoesRepository $atuacoesrepository,
        SubAtuacoesRepository $subatuacoesrepository,
        CategoriasRepository $categoriasrepository,
        CursosRepository $cursosrepository,
        CursoCategoriasRepository $cursocategoriasrepository,
        EventosRepository $eventosrepository,
        EventoCategoriasRepository $eventocategoriasrepository,
        PostsRepository $postsrepository,
        PostCategoriasRepository $postcategoriasrepository
    )
    {
        $this->repository = $repository;
        $this->paisesrepository = $paisesrepository;
        $this->estadosrepository = $estadosrepository;
        $this->cidadesrepository = $cidadesrepository; 
        $this->userinteressesrepository = $userinteressesrepository;
        $this->profissionaisrepository = $profissionaisrepository;
        $this->profissionalatuacoesrepository = $profissionalatuacoesrepository;
        $this->profissionalsubatuacoesrepository = $profissionalsubatuacoesrepository;
        $this->profissionalbannersrepository = $profissionalbannersrepository;
        $this->empresasrepository = $empresasrepository;
        $this->empresaatuacoesrepository = $empresaatuacoesrepository;
        $this->empresasubatuacoesrepository = $empresasubatuacoesrepository;
        $this->empresabannersrepository = $empresabannersrepository;
        $this->bannersprincipaisrepository = $bannersprincipaisrepository;
        $this->atuacoesrepository = $atuacoesrepository;
        $this->subatuacoesrepository = $subatuacoesrepository;
        $this->categoriasrepository = $categoriasrepository;
        $this->cursosrepository = $cursosrepository;
        $this->cursocategoriasrepository = $cursocategoriasrepository;
        $this->eventosrepository = $eventosrepository;
        $this->eventocategoriasrepository = $eventocategoriasrepository;
        $this->postsrepository = $postsrepository;
        $this->postcategoriasrepository = $postcategoriasrepository;
    }
  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menus
        $patuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $psubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $eatuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $esubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $vcategorias = $this->categoriasrepository->orderBy('descricao')->findWhereIn('tipo', [7, 8, 9, 10, 11, 12, 13,15]);

        //conteudo
        //cursos
        $cursos =  $this->cursosrepository->scopeQuery(function($query){
            return $query->orderby('destaque_id','desc')->limit(16);
        })->findWhere(['statu_id' => 2]);
        if(count($cursos)>8){
            $cursos = $cursos->random(8); 
        }

        //eventos
        $eventos =  $this->eventosrepository->scopeQuery(function($query){
            return $query->orderby('destaque_id','desc')->orderby('data_inicio')->limit(16);
        })->findWhere(['statu_id' => 2,['data_fim','>=',date('Y-m-d')]]);
        if(count($eventos)>8){
            $eventos = $eventos->random(8); 
        }

        //blog
        $posts = $this->postsrepository->scopeQuery(function($query){
            return $query->limit(8);
        })->findWhere(['statu_id' => 2]);

        //profissionais
        $profissionais = $this->profissionaisrepository->scopeQuery(function($query){
            return $query->orderby('destaque_id','desc')->limit(16);
        })->findWhere(['statu_id' => 2]);
        if(count($profissionais)>8){
            $profissionais = $profissionais->random(8); 
        }
        $profatuacoes_array = array();
        foreach ($profissionais as $profissional){
            $profatuacoes = $this->profissionalatuacoesrepository->scopeQuery(function($query){
                return $query->join('atuacoes', 'atuacoes.id', '=', 'profissional_atuacoes.atuacao_id')
                    ->orderBy('descricao');
                })
                ->findWhere(['profissional_id' => $profissional->id]);
                array_push($profatuacoes_array, $profatuacoes);
        }
                
        //empresas
        $empresas = $this->empresasrepository->scopeQuery(function($query){
            return $query->orderby('destaque_id','desc')->limit(16);
        })->findWhere(['statu_id' => 2]);
        if(count($empresas)>8){
            $empresas = $empresas->random(8); 
        }
        $empatuacoes_array = array();
        foreach ($empresas as $empresa){
            $empatuacoes = $this->empresaatuacoesrepository->scopeQuery(function($query){
                return $query->join('atuacoes', 'atuacoes.id', '=', 'empresa_atuacoes.atuacao_id')
                    ->orderBy('descricao');
                })
                ->findWhere(['empresa_id' => $empresa->id]);
                array_push($empatuacoes_array, $empatuacoes);
        }

        $bannersprincipais = $this->bannersprincipaisrepository->findWhere(['statu_id' => 2]);
        return view('index', compact('patuacoes','psubatuacoes','eatuacoes','esubatuacoes','vcategorias',
        'bannersprincipais','eventos','posts','profissionais','empresas','cursos', 'profatuacoes_array','empatuacoes_array'));
    }

    public function interesses(){
        //menus
        $patuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $psubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $eatuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $esubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $vcategorias = $this->categoriasrepository->orderBy('descricao')->findWhereIn('tipo', [7, 8, 9, 10, 11, 12, 13,15]);


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

        return view('userinteresses.interesses', compact('patuacoes','psubatuacoes','eatuacoes','esubatuacoes','vcategorias','categorias'));
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
        //
    }

    public function eventosposts(Request $request, $categoria)
    {
        //menus
        $patuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $psubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $eatuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $esubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $vcategorias = $this->categoriasrepository->orderBy('descricao')->findWhereIn('tipo', [7, 8, 9, 10, 11, 12, 13,15]);
      
        $search = $request->get('search');
        if($categoria=='todos'){
            $eventos = $this->eventosrepository->scopeQuery(function($query){
                return $query->orderby('destaque_id','desc')
                ->orderby('eventos.updated_at','desc')
                ->where([
                    ['statu_id', '=', 2],
                    ['data_fim', '>=', date('Y-m-d')]
                ]);
            })->paginate(16);
        }else{
            $objtcategoria = $this->categoriasrepository->findByField('slug',$categoria)->first();
            $eventos = $this->eventosrepository->scopeQuery(function($query) use($objtcategoria){
                return $query->join('evento_categorias', 'eventos.id', '=', 'evento_categorias.evento_id')
                ->orderby('destaque_id','desc')
                ->orderby('eventos.updated_at','desc')
                ->where([
                    ['statu_id', '=', 2],
                    ['data_fim', '>=', date('Y-m-d')],
                    ['categoria_id', '=', $objtcategoria->id],
                ])
                ->select('eventos.id', 'imagem1', 'titulo', 'data_inicio', 'data_fim','cidade_id', 'estado_id', 'eventos.slug');
            })->paginate(16);
        }       

       // dd($eventos);


        return view('eventos.posts', compact('patuacoes','psubatuacoes','eatuacoes','esubatuacoes','vcategorias','bannersprincipais','eventos','categoria'));
    }

    public function eventospost($slug)
    {
        //menus
        $patuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $psubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $eatuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $esubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $vcategorias = $this->categoriasrepository->orderBy('descricao')->findWhereIn('tipo', [7, 8, 9, 10, 11, 12, 13,15]);
      
        $evento = $this->eventosrepository->findByField('slug',$slug)->first();
        $evento->data_inicio = Carbon::createFromFormat('Y-m-d H:i:s', $evento->data_inicio)->format('d/m/Y H:i:s');
        $evento->data_fim = Carbon::createFromFormat('Y-m-d H:i:s', $evento->data_fim)->format('d/m/Y H:i:s');

        $eventos =  $this->eventosrepository->orderby('destaque_id','desc')->findWhere(['statu_id' => 2,['data_fim','>=',date('Y-m-d')],['id','<>',$evento->id]]);
        if(count($eventos)>4){
            $eventos = $eventos->random(4); 
        }

        $cursos =  $this->cursosrepository->scopeQuery(function($query){
            return $query->orderby('destaque_id','desc')->limit(16);
        })->findWhere(['statu_id' => 2]);
        if(count($cursos)>8){
            $cursos = $cursos->random(8); 
        }

       
        return view('eventos.post', compact('patuacoes','psubatuacoes','eatuacoes','esubatuacoes','vcategorias','bannersprincipais','evento','eventos','cursos'));
    }

    public function cursosposts(Request $request, $categoria)
    {
         //menus
         $patuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
         $psubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
         $eatuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
         $esubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
         $vcategorias = $this->categoriasrepository->orderBy('descricao')->findWhereIn('tipo', [7, 8, 9, 10, 11, 12, 13,15]);

        if($categoria=='todos'){
            $cursos = $this->cursosrepository->scopeQuery(function($query) use($categoria){
                return $query->join('curso_categorias', 'cursos.id', '=', 'curso_categorias.curso_id')
                ->join('categorias', 'curso_categorias.categoria_id', '=', 'categorias.id')
                ->orderby('destaque_id','desc')
                ->orderby('cursos.updated_at','desc')
                ->where([
                    ['statu_id', '=', 2]
                ])
                ->whereIn('categorias.tipo', [1, 2, 3, 4, 5, 6, 8, 9, 10, 11, 12, 13, 14, 15])
                ->select('cursos.id', 'imagem1', 'titulo', 'sub_titulo', 'cursos.slug')
                ->groupBy('cursos.id');
            })->paginate(16);
        }else{
            $objtcategoria = $this->categoriasrepository->findByField('slug',$categoria)->first();
            $cursos = $this->cursosrepository->scopeQuery(function($query) use($objtcategoria){
                return $query->join('curso_categorias', 'cursos.id', '=', 'curso_categorias.curso_id')
                ->join('categorias', 'curso_categorias.categoria_id', '=', 'categorias.id')
                ->orderby('destaque_id','desc')
                ->orderby('cursos.updated_at','desc')
                ->where([
                    ['statu_id', '=', 2],
                    ['categoria_id', '=', $objtcategoria->id]
                ])
                ->select('cursos.id', 'imagem1', 'titulo', 'sub_titulo', 'cursos.slug')
                ->groupBy('cursos.id');
            })->paginate(16);
        }
        $opcoescategorias = $this->categoriasrepository->orderBy('descricao')->findWhereIn('tipo', [1, 2, 3, 4, 5, 6, 8, 9, 10, 11, 12, 13, 14, 15]);
        return view('cursos.posts', compact('patuacoes','psubatuacoes','eatuacoes','esubatuacoes','vcategorias','bannersprincipais','cursos','categoria','opcoescategorias'));
    }

    public function cursosvcposts(Request $request, $categoria)
    {
         //menus
         $patuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
         $psubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
         $eatuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
         $esubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
         $vcategorias = $this->categoriasrepository->orderBy('descricao')->findWhereIn('tipo', [7, 8, 9, 10, 11, 12, 13,15]);

        if($categoria=='todos'){
            $cursos = $this->cursosrepository->scopeQuery(function($query){
                return $query->join('curso_categorias', 'cursos.id', '=', 'curso_categorias.curso_id')
                ->join('categorias', 'curso_categorias.categoria_id', '=', 'categorias.id')
                ->orderby('destaque_id','desc')
                ->orderby('cursos.updated_at','desc')
                ->where([
                    ['statu_id', '=', 2]
                ])->whereIn('categorias.tipo', [1, 4, 5, 8, 11, 12, 14, 15])
                ->select('cursos.id', 'imagem1', 'titulo', 'sub_titulo', 'cursos.slug')
                ->groupBy('cursos.id');
            })->paginate(16);
        }else{
            $objtcategoria = $this->categoriasrepository->findByField('slug',$categoria)->first();
            $cursos = $this->cursosrepository->scopeQuery(function($query) use($objtcategoria){
                return $query->join('curso_categorias', 'cursos.id', '=', 'curso_categorias.curso_id')
                ->join('categorias', 'curso_categorias.categoria_id', '=', 'categorias.id')
                ->orderby('destaque_id','desc')
                ->orderby('cursos.updated_at','desc')
                ->where([
                    ['statu_id', '=', 2],
                    ['categoria_id', '=', $objtcategoria->id]
                ])->whereIn('categorias.tipo', [1, 4, 5, 8, 11, 12, 14, 15])
                ->select('cursos.id', 'imagem1', 'titulo', 'sub_titulo', 'cursos.slug')
                ->groupBy('cursos.id');
            })->paginate(16);
        }

        $opcoescategorias = $this->categoriasrepository->orderBy('descricao')->findWhereIn('tipo', [1, 4, 5, 8, 11, 12, 14, 15]);
        return view('cursos.vcposts', compact('patuacoes','psubatuacoes','eatuacoes','esubatuacoes','vcategorias','bannersprincipais','cursos','categoria','opcoescategorias'));
    }

    public function cursosprofposts(Request $request, $categoria)
    {
         //menus
         $patuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
         $psubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
         $eatuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
         $esubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
         $vcategorias = $this->categoriasrepository->orderBy('descricao')->findWhereIn('tipo', [7, 8, 9, 10, 11, 12, 13,15]);

        if($categoria=='todos'){
            $cursos = $this->cursosrepository->scopeQuery(function($query){
                return $query->join('curso_categorias', 'cursos.id', '=', 'curso_categorias.curso_id')
                ->join('categorias', 'curso_categorias.categoria_id', '=', 'categorias.id')
                ->orderby('destaque_id','desc')
                ->orderby('cursos.updated_at','desc')
                ->where([
                    ['statu_id', '=', 2]
                ])->whereIn('categorias.tipo', [2, 4, 6, 9, 11, 13, 14, 15])
                ->select('cursos.id', 'imagem1', 'titulo', 'sub_titulo', 'cursos.slug')
                ->groupBy('cursos.id');
            })->paginate(16);
        }else{
            $objtcategoria = $this->categoriasrepository->findByField('slug',$categoria)->first();
            $cursos = $this->cursosrepository->scopeQuery(function($query) use($objtcategoria){
                return $query->join('curso_categorias', 'cursos.id', '=', 'curso_categorias.curso_id')
                ->join('categorias', 'curso_categorias.categoria_id', '=', 'categorias.id')
                ->orderby('destaque_id','desc')
                ->orderby('cursos.updated_at','desc')
                ->where([
                    ['statu_id', '=', 2],
                    ['categoria_id', '=', $objtcategoria->id]
                ])->whereIn('categorias.tipo', [2, 4, 6, 9, 11, 13, 14, 15])
                ->select('cursos.id', 'imagem1', 'titulo', 'sub_titulo', 'cursos.slug')
                ->groupBy('cursos.id');
            })->paginate(16);
        }

        $opcoescategorias = $this->categoriasrepository->orderBy('descricao')->findWhereIn('tipo', [2, 4, 6, 9, 11, 13, 14, 15]);
        return view('cursos.profposts', compact('patuacoes','psubatuacoes','eatuacoes','esubatuacoes','vcategorias','bannersprincipais','cursos','categoria','opcoescategorias'));
    }

    public function cursosempposts(Request $request, $categoria)
    {
         //menus
         $patuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
         $psubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
         $eatuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
         $esubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
         $vcategorias = $this->categoriasrepository->orderBy('descricao')->findWhereIn('tipo', [7, 8, 9, 10, 11, 12, 13,15]);

        if($categoria=='todos'){
            $cursos = $this->cursosrepository->scopeQuery(function($query){
                return $query->join('curso_categorias', 'cursos.id', '=', 'curso_categorias.curso_id')
                ->join('categorias', 'curso_categorias.categoria_id', '=', 'categorias.id')
                ->orderby('destaque_id','desc')
                ->orderby('cursos.updated_at','desc')
                ->where([
                    ['statu_id', '=', 2]
                ])->whereIn('categorias.tipo', [3, 5, 6, 10, 12, 13, 14, 15])
                ->select('cursos.id', 'imagem1', 'titulo', 'sub_titulo', 'cursos.slug')
                ->groupBy('cursos.id');
            })->paginate(16);
        }else{
            $objtcategoria = $this->categoriasrepository->findByField('slug',$categoria)->first();
            $cursos = $this->cursosrepository->scopeQuery(function($query) use($objtcategoria){
                return $query->join('curso_categorias', 'cursos.id', '=', 'curso_categorias.curso_id')
                ->join('categorias', 'curso_categorias.categoria_id', '=', 'categorias.id')
                ->orderby('destaque_id','desc')
                ->orderby('cursos.updated_at','desc')
                ->where([
                    ['statu_id', '=', 2],
                    ['categoria_id', '=', $objtcategoria->id]
                ])->whereIn('categorias.tipo', [3, 5, 6, 10, 12, 13, 14, 15])
                ->select('cursos.id', 'imagem1', 'titulo', 'sub_titulo', 'cursos.slug')
                ->groupBy('cursos.id');
            })->paginate(16);
        }

        $opcoescategorias = $this->categoriasrepository->orderBy('descricao')->findWhereIn('tipo', [3, 5, 6, 10, 12, 13, 14, 15]);
        return view('cursos.empposts', compact('patuacoes','psubatuacoes','eatuacoes','esubatuacoes','vcategorias','bannersprincipais','cursos','categoria','opcoescategorias'));
    }

    public function cursospost($slug)
    {
        //menus
        $patuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $psubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $eatuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $esubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $vcategorias = $this->categoriasrepository->orderBy('descricao')->findWhereIn('tipo', [7, 8, 9, 10, 11, 12, 13,15]);
      
        $curso = $this->cursosrepository->findByField('slug',$slug)->first();
        if($curso->data_inicio!=""){
            $curso->data_inicio = Carbon::createFromFormat('Y-m-d H:i:s', $curso->data_inicio)->format('d/m/Y H:i:s');
        }
        if($curso->data_inicio!=""){
            $curso->data_fim = Carbon::createFromFormat('Y-m-d H:i:s', $curso->data_fim)->format('d/m/Y H:i:s');
        }

        $cursos =  $this->cursosrepository->orderby('destaque_id','desc')->findWhere(['statu_id' => 2,['data_fim','>=',date('Y-m-d')],['id','<>',$curso->id]]);
        if(count($cursos)>4){
            $cursos = $cursos->random(4); 
        }

       
        return view('cursos.post', compact('patuacoes','psubatuacoes','eatuacoes','esubatuacoes','vcategorias','bannersprincipais','curso','cursos'));
    }

    public function blogposts(Request $request, $categoria)
    {
        //menus
        $patuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $psubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $eatuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $esubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $vcategorias = $this->categoriasrepository->orderBy('descricao')->findWhereIn('tipo', [7, 8, 9, 10, 11, 12, 13,15]);
      

        $search = $request->get('search');
        if($categoria=='todos'){
            $posts = $this->postsrepository->scopeQuery(function($query){
                return $query->where([
                    ['statu_id', '=', 2]
                ]);
            })->paginate(16);
        }else{
            $objtcategoria = $this->categoriasrepository->findByField('slug',$categoria)->first();
            $posts = $this->postsrepository->scopeQuery(function($query) use($objtcategoria){
                return $query->join('post_categorias', 'posts.id', '=', 'post_categorias.post_id')
                ->where([
                    ['statu_id', '=', 2],
                    ['categoria_id', '=', $objtcategoria->id]
                ])->select('posts.id', 'imagem1', 'titulo', 'posts.slug');
            })->paginate(16);
        }
       

        return view('blog.posts', compact('patuacoes','psubatuacoes','eatuacoes','esubatuacoes','vcategorias','bannersprincipais','posts','categoria'));
    }

    public function blogpost($slug)
    {
        //menus
        $patuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $psubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $eatuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $esubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $vcategorias = $this->categoriasrepository->orderBy('descricao')->findWhereIn('tipo', [7, 8, 9, 10, 11, 12, 13,15]);
      
        $post = $this->postsrepository->findByField('slug',$slug)->first();
        $posts =  $this->postsrepository->findWhere(['statu_id' => 2,['id','<>',$post->id]]);
        if(count($posts)>4){
            $posts = $posts->random(4); 
        }

        //cursos
        $cursos =  $this->cursosrepository->scopeQuery(function($query){
            return $query->orderby('destaque_id','desc')->limit(16);
        })->findWhere(['statu_id' => 2]);
        if(count($cursos)>8){
            $cursos = $cursos->random(8); 
        }
       
        return view('blog.post', compact('patuacoes','psubatuacoes','eatuacoes','esubatuacoes','vcategorias','bannersprincipais','post','posts','cursos'));
    }

    public function profposts(Request $request, $atuacao)
    {
        //menus
        $patuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $psubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $eatuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $esubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $vcategorias = $this->categoriasrepository->orderBy('descricao')->findWhereIn('tipo', [7, 8, 9, 10, 11, 12, 13,15]);
      

        $search = $request->get('search');
        if($atuacao=='todos'){
            $profissionais = $this->profissionaisrepository->scopeQuery(function($query){
                return $query->orderby('destaque_id','desc')
                ->orderby('updated_at','desc')
                ->where([
                    ['statu_id', '=', 2]
                ]);
            })->paginate(16);
        }else{
            $objtatuacao = $this->atuacoesrepository->findByField('slug',$atuacao)->first();
            $profissionais = $this->profissionaisrepository->scopeQuery(function($query) use($objtatuacao){
                return $query->join('profissional_atuacoes', 'profissionais.id', '=', 'profissional_atuacoes.profissional_id')
                ->orderby('destaque_id','desc')
                ->orderby('profissionais.updated_at','desc')
                ->where([
                    ['statu_id', '=', 2],
                    ['atuacao_id', '=', $objtatuacao->id]
                ])->select('profissionais.id', 'foto', 'name', 'profissionais.slug');
            })->paginate(16);
        }

        $profatuacoes_array = array();
        foreach ($profissionais as $profissional){
            $profatuacoes = $this->profissionalatuacoesrepository->scopeQuery(function($query){
                return $query->join('atuacoes', 'atuacoes.id', '=', 'profissional_atuacoes.atuacao_id')
                    ->orderBy('descricao');
                })
                ->findWhere(['profissional_id' => $profissional->id]);
                array_push($profatuacoes_array, $profatuacoes);
        }
       

        return view('profissionais.posts', compact('patuacoes','psubatuacoes','eatuacoes','esubatuacoes','vcategorias','bannersprincipais','profissionais','atuacao','profatuacoes_array'));
    }

    public function subprofposts(Request $request, $atuacao, $subatuacao)
    {
        //menus
        $patuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $psubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $eatuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $esubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $vcategorias = $this->categoriasrepository->orderBy('descricao')->findWhereIn('tipo', [7, 8, 9, 10, 11, 12, 13,15]);

        $objtatuacao = $this->atuacoesrepository->findByField('slug',$atuacao)->first();
        $objtsubatuacao = $this->subatuacoesrepository->findByField('slug',$subatuacao)->first();
        $opcoessubatuacoes = $this->subatuacoesrepository->scopeQuery(function($query) use($objtatuacao){
            return $query->where([
                ['atuacao_id', '=', $objtatuacao->id]
            ])->orderBy('descricao');
        })->findWhereIn('tipo', [1,3]);


        $search = $request->get('search');
        if($subatuacao=='todos'){
            $profissionais = $this->profissionaisrepository->scopeQuery(function($query) use($objtatuacao){
                return $query->join('profissional_atuacoes', 'profissionais.id', '=', 'profissional_atuacoes.profissional_id')
                ->orderby('destaque_id','desc')
                ->orderby('profissionais.updated_at','desc')
                ->where([
                    ['statu_id', '=', 2],
                    ['atuacao_id', '=', $objtatuacao->id]
                ])->select('profissionais.id', 'foto', 'name', 'profissionais.slug');
            })->paginate(16);
        }else{
            $profissionais = $this->profissionaisrepository->scopeQuery(function($query) use($objtatuacao, $objtsubatuacao){
                return $query->join('profissional_atuacoes', 'profissionais.id', '=', 'profissional_atuacoes.profissional_id')
                ->join('profissional_sub_atuacoes', 'profissionais.id', '=', 'profissional_sub_atuacoes.profissional_id')
                ->orderby('destaque_id','desc')
                ->orderby('profissionais.updated_at','desc')
                ->where([
                    ['statu_id', '=', 2],
                    ['atuacao_id', '=', $objtatuacao->id],
                    ['subatuacao_id', '=', $objtsubatuacao->id]
                ])->select('profissionais.id', 'foto', 'name', 'profissionais.slug');
            })->paginate(16);
        }

        $profatuacoes_array = array();
        foreach ($profissionais as $profissional){
            $profatuacoes = $this->profissionalatuacoesrepository->scopeQuery(function($query){
                return $query->join('atuacoes', 'atuacoes.id', '=', 'profissional_atuacoes.atuacao_id')
                    ->orderBy('descricao');
                })
                ->findWhere(['profissional_id' => $profissional->id]);
                array_push($profatuacoes_array, $profatuacoes);
        }
       

        return view('profissionais.subposts', compact('patuacoes','psubatuacoes','eatuacoes','esubatuacoes','vcategorias','bannersprincipais','profissionais','atuacao','subatuacao','opcoessubatuacoes','profatuacoes_array'));
    }

    public function profpost($slug)
    {
        //menus
        $patuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $psubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $eatuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $esubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $vcategorias = $this->categoriasrepository->orderBy('descricao')->findWhereIn('tipo', [7, 8, 9, 10, 11, 12, 13,15]);
      
        $profissional = $this->profissionaisrepository->findByField('slug',$slug)->first();
        $profatuacoes = $this->profissionalatuacoesrepository->scopeQuery(function($query){
            return $query->join('atuacoes', 'atuacoes.id', '=', 'profissional_atuacoes.atuacao_id')
                ->orderBy('descricao');
            })
            ->findWhere(['profissional_id' => $profissional->id]);
        $banners = $this->profissionalbannersrepository->findWhere([
            'profissional_id'=>$profissional->id,
            'statu_id' => 2, 
            ['data_fim', '>=', date('Y-m-d')],
            ['data_inicio', '<=', date('Y-m-d')]
        ]);

        $profissionais =  $this->profissionaisrepository->orderby('destaque_id','desc')->findWhere(['statu_id' => 2,['id','<>',$profissional->id]]);
        if(count($profissionais)>4){
            $profissionais = $profissionais->random(4); 
        }
        $profatuacoes_array = array();
        foreach ($profissionais as $profissional_outro){
            $profatuacoes_outro = $this->profissionalatuacoesrepository->scopeQuery(function($query){
                return $query->join('atuacoes', 'atuacoes.id', '=', 'profissional_atuacoes.atuacao_id')
                    ->orderBy('descricao');
                })
                ->findWhere(['profissional_id' => $profissional_outro->id]);
                array_push($profatuacoes_array, $profatuacoes_outro);
        }
       
        return view('profissionais.post', compact('patuacoes','psubatuacoes','eatuacoes','esubatuacoes','vcategorias','bannersprincipais','profissionais','profissional','banners','profatuacoes','profatuacoes_array'));
    }

    public function empposts(Request $request, $atuacao)
    {
        //menus
        $patuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $psubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $eatuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $esubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $vcategorias = $this->categoriasrepository->orderBy('descricao')->findWhereIn('tipo', [7, 8, 9, 10, 11, 12, 13,15]);
      

        $search = $request->get('search');
        if($atuacao=='todos'){
            $empresas = $this->empresasrepository->scopeQuery(function($query){
                return $query->orderby('destaque_id','desc')
                ->orderby('empresas.updated_at','desc')
                ->where([
                    ['statu_id', '=', 2]
                ]);
            })->paginate(16);
        }else{
            $objtatuacao = $this->atuacoesrepository->findByField('slug',$atuacao)->first();
            $empresas = $this->empresasrepository->scopeQuery(function($query) use($objtatuacao){
                return $query->join('empresa_atuacoes', 'empresas.id', '=', 'empresa_atuacoes.empresa_id')
                ->orderby('destaque_id','desc')
                ->orderby('empresas.updated_at','desc')
                ->where([
                    ['statu_id', '=', 2],
                    ['atuacao_id', '=', $objtatuacao->id]
                ])->select('empresas.id', 'imagem1', 'name', 'empresas.slug');
            })->paginate(16);
        }
       
        $empatuacoes_array = array();
        foreach ($empresas as $empresa){
            $empatuacoes = $this->empresaatuacoesrepository->scopeQuery(function($query){
                return $query->join('atuacoes', 'atuacoes.id', '=', 'empresa_atuacoes.atuacao_id')
                    ->orderBy('descricao');
                })
                ->findWhere(['empresa_id' => $empresa->id]);
                array_push($empatuacoes_array, $empatuacoes);
        }

        return view('empresas.posts', compact('patuacoes','psubatuacoes','eatuacoes','esubatuacoes','vcategorias','bannersprincipais','empresas','atuacao','empatuacoes_array'));
    }

    public function subempposts(Request $request, $atuacao, $subatuacao)
    {
        //menus
        $patuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $psubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $eatuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $esubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $vcategorias = $this->categoriasrepository->orderBy('descricao')->findWhereIn('tipo', [7, 8, 9, 10, 11, 12, 13,15]);
        
        $objtatuacao = $this->atuacoesrepository->findByField('slug',$atuacao)->first();
        $objtsubatuacao = $this->subatuacoesrepository->findByField('slug',$subatuacao)->first();
        $opcoessubatuacoes = $this->subatuacoesrepository->scopeQuery(function($query) use($objtatuacao){
            return $query->where([
                ['atuacao_id', '=', $objtatuacao->id]
            ])->orderBy('descricao');
        })->findWhereIn('tipo', [2,3]);


        $search = $request->get('search');
        if($subatuacao=='todos'){
            $empresas = $this->empresasrepository->scopeQuery(function($query) use($objtatuacao){
                return $query->join('empresa_atuacoes', 'empresas.id', '=', 'empresa_atuacoes.empresa_id')
                ->orderby('destaque_id','desc')
                ->orderby('empresas.updated_at','desc')
                ->where([
                    ['statu_id', '=', 2],
                    ['atuacao_id', '=', $objtatuacao->id]
                ])->select('empresas.id', 'imagem1', 'name', 'empresas.slug');
            })->paginate(16);
        }else{
            $empresas = $this->empresasrepository->scopeQuery(function($query) use($objtatuacao, $objtsubatuacao){
                return $query->join('empresa_atuacoes', 'empresas.id', '=', 'empresa_atuacoes.empresa_id')
                ->join('empresa_sub_atuacoes', 'empresas.id', '=', 'empresa_sub_atuacoes.empresa_id')
                ->orderby('destaque_id','desc')
                ->orderby('empresas.updated_at','desc')
                ->where([
                    ['statu_id', '=', 2],
                    ['atuacao_id', '=', $objtatuacao->id],
                    ['subatuacao_id', '=', $objtsubatuacao->id]
                ])->select('empresas.id', 'imagem1', 'name', 'empresas.slug');
            })->paginate(16);
        }

        $empatuacoes_array = array();
        foreach ($empresas as $empresa){
            $empatuacoes = $this->empresaatuacoesrepository->scopeQuery(function($query){
                return $query->join('atuacoes', 'atuacoes.id', '=', 'empresa_atuacoes.atuacao_id')
                    ->orderBy('descricao');
                })
                ->findWhere(['empresa_id' => $empresa->id]);
                array_push($empatuacoes_array, $empatuacoes);
        }
       

        return view('empresas.subposts', compact('patuacoes','psubatuacoes','eatuacoes','esubatuacoes','vcategorias','bannersprincipais','empresas','atuacao','subatuacao','opcoessubatuacoes', 'empatuacoes_array'));
    }

    public function emppost($slug)
    {
        //menus
        $patuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $psubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $eatuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $esubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $vcategorias = $this->categoriasrepository->orderBy('descricao')->findWhereIn('tipo', [7, 8, 9, 10, 11, 12, 13,15]);
      
        $empresa = $this->empresasrepository->findByField('slug',$slug)->first();

        $banners = $this->empresabannersrepository->findWhere([
            'empresa_id'=>$empresa->id,
            'statu_id' => 2, 
            ['data_fim', '>=', date('Y-m-d')],
            ['data_inicio', '<=', date('Y-m-d')]
        ]);


        $empresas =  $this->empresasrepository->orderby('destaque_id','desc')->findWhere(['statu_id' => 2,['id','<>',$empresa->id]]);
        if(count($empresas)>4){
            $empresas = $empresas->random(4); 
        }
        $empatuacoes_array = array();
        foreach ($empresas as $empresa_outro){
            $empatuacoes = $this->empresaatuacoesrepository->scopeQuery(function($query){
                return $query->join('atuacoes', 'atuacoes.id', '=', 'empresa_atuacoes.atuacao_id')
                    ->orderBy('descricao');
                })
                ->findWhere(['empresa_id' => $empresa_outro->id]);
                array_push($empatuacoes_array, $empatuacoes);
        }
       
        return view('empresas.post', compact('patuacoes','psubatuacoes','eatuacoes','esubatuacoes','vcategorias','bannersprincipais','empresas','empresa','banners','empatuacoes_array'));
    }

    public function faleconosco(){
        //menus
        $patuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $psubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $eatuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $esubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $vcategorias = $this->categoriasrepository->orderBy('descricao')->findWhereIn('tipo', [7, 8, 9, 10, 11, 12, 13,15]);

        //cursos
        $cursos =  $this->cursosrepository->scopeQuery(function($query){
            return $query->orderby('destaque_id','desc')->limit(16);
        })->findWhere(['statu_id' => 2]);
        if(count($cursos)>8){
            $cursos = $cursos->random(8); 
        }
      
        return view('faleconosco', compact('patuacoes','psubatuacoes','eatuacoes','esubatuacoes','vcategorias','cursos'));
    }

    public function faleconoscoenviarmail(Request $request){

        //dd($request->all());

        Mail::to('contato@oloyfit.com')->send(new MailFaleConosco($request->all()));
        \Session::flash('message', 'E-mail enviado com sucesso.');
       
        return  redirect()->route('faleconosco');
    }

    public function quemsomos(){
        //menus
        $patuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $psubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $eatuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $esubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $vcategorias = $this->categoriasrepository->orderBy('descricao')->findWhereIn('tipo', [7, 8, 9, 10, 11, 12, 13,15]);

        //cursos
        $cursos =  $this->cursosrepository->scopeQuery(function($query){
            return $query->orderby('destaque_id','desc')->limit(16);
        })->findWhere(['statu_id' => 2]);
        if(count($cursos)>8){
            $cursos = $cursos->random(8); 
        }
      
        return view('quemsomos', compact('patuacoes','psubatuacoes','eatuacoes','esubatuacoes','vcategorias','cursos'));
    }

    public function termosprivacidade(){
        //menus
        $patuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $psubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [1,3]);
        $eatuacoes = $this->atuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $esubatuacoes = $this->subatuacoesrepository->orderBy('descricao')->findWhereIn('tipo', [2,3]);
        $vcategorias = $this->categoriasrepository->orderBy('descricao')->findWhereIn('tipo', [7, 8, 9, 10, 11, 12, 13,15]);

        //cursos
        $cursos =  $this->cursosrepository->scopeQuery(function($query){
            return $query->orderby('destaque_id','desc')->limit(16);
        })->findWhere(['statu_id' => 2]);
        if(count($cursos)>8){
            $cursos = $cursos->random(8); 
        }
      
        return view('termosprivacidade', compact('patuacoes','psubatuacoes','eatuacoes','esubatuacoes','vcategorias','cursos'));
    }
}
