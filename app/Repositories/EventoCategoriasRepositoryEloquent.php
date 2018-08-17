<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EventoCategoriasRepository;
use App\Models\EventoCategoria;
use App\Validators\EventoCategoriasValidator;

/**
 * Class EventoCategoriasRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EventoCategoriasRepositoryEloquent extends BaseRepository implements EventoCategoriasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EventoCategoria::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
