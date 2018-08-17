<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ComentariosRepository;
use App\Models\Comentario;
use App\Validators\ComentariosValidator;

/**
 * Class ComentariosRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ComentariosRepositoryEloquent extends BaseRepository implements ComentariosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Comentario::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
