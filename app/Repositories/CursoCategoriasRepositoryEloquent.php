<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CursoCategoriasRepository;
use App\Models\CursoCategoria;
use App\Validators\CursoCategoriasValidator;

/**
 * Class CursoCategoriasRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CursoCategoriasRepositoryEloquent extends BaseRepository implements CursoCategoriasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CursoCategoria::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
