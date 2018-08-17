<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PostCategoriasRepository;
use App\Models\PostCategoria;
use App\Validators\PostCategoriasValidator;

/**
 * Class PostCategoriasRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PostCategoriasRepositoryEloquent extends BaseRepository implements PostCategoriasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PostCategoria::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
