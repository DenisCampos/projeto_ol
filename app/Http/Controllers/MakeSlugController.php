<?php

namespace App\Http\Controllers;

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

class MakeSlugController extends Controller
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


    public function index()
    {
        $objetos = $this->repository->all();
        foreach($objetos as $objeto){
            $data['slug'] = $this->montarSlug($objeto->name, $objeto->id, $this->repository);
            $this->repository->update($data, $objeto->id);
        }

        $objetos = $this->paisesrepository->all();
        foreach($objetos as $objeto){
            $data['slug'] = $this->montarSlug($objeto->descricao, $objeto->id, $this->paisesrepository);
            $this->paisesrepository->update($data, $objeto->id);
        }

        $objetos = $this->estadosrepository->all();
        foreach($objetos as $objeto){
            $data['slug'] = $this->montarSlug($objeto->descricao, $objeto->id, $this->estadosrepository);
            $this->estadosrepository->update($data, $objeto->id);
        }

        $objetos = $this->cidadesrepository->all();
        foreach($objetos as $objeto){
            $data['slug'] = $this->montarSlug($objeto->descricao, $objeto->id, $this->cidadesrepository);
            $this->cidadesrepository->update($data, $objeto->id);
        }

        $objetos = $this->categoriasrepository->all();
        foreach($objetos as $objeto){
            $data['slug'] = $this->montarSlug($objeto->descricao, $objeto->id, $this->categoriasrepository);
            $this->categoriasrepository->update($data, $objeto->id);
        }

        $objetos = $this->atuacoesrepository->all();
        foreach($objetos as $objeto){
            $data['slug'] = $this->montarSlug($objeto->descricao, $objeto->id, $this->atuacoesrepository);
            $this->atuacoesrepository->update($data, $objeto->id);
        }

        $objetos = $this->subatuacoesrepository->all();
        foreach($objetos as $objeto){
            $data['slug'] = $this->montarSlug($objeto->descricao, $objeto->id, $this->subatuacoesrepository);
            $this->subatuacoesrepository->update($data, $objeto->id);
        }
        
        $objetos = $this->postsrepository->all();
        foreach($objetos as $objeto){
            $data['slug'] = $this->montarSlug($objeto->titulo, $objeto->id, $this->postsrepository);
            $this->postsrepository->update($data, $objeto->id);
        }

        $objetos = $this->profissionaisrepository->all();
        foreach($objetos as $objeto){
            $data['slug'] = $this->montarSlug($objeto->name, $objeto->id, $this->profissionaisrepository);
            $this->profissionaisrepository->update($data, $objeto->id);
        }

        $objetos = $this->empresasrepository->all();
        foreach($objetos as $objeto){
            $data['slug'] = $this->montarSlug($objeto->name, $objeto->id, $this->empresasrepository);
            $this->empresasrepository->update($data, $objeto->id);
        }

        $objetos = $this->eventosrepository->all();
        foreach($objetos as $objeto){
            $data['slug'] = $this->montarSlug($objeto->titulo, $objeto->id, $this->eventosrepository);
            $this->eventosrepository->update($data, $objeto->id);
        }

        $objetos = $this->cursosrepository->all();
        foreach($objetos as $objeto){
            $data['slug'] = $this->montarSlug($objeto->titulo, $objeto->id, $this->cursosrepository);
            $this->cursosrepository->update($data, $objeto->id);
        }

        return 'Feito';
    }

    private function montarSlug($titulo, $id, $repository){
        $slug = str_slug($titulo, '-');
        $slug_count = $repository->findByField('slug',$slug)->where('id', '!=', $id)->count();
        if($slug_count>0){
            $vefica_slug = $slug_count;
            while($vefica_slug>0){
                $slug_count++;
                $vefica_slug = $repository->findByField('slug',$slug."-".$slug_count)->where('id', '!=', $id)->count();                
            }
            $slug = $slug."-".$slug_count;
        }
        return $slug;
    }
}
