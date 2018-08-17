<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CursosRepository;
use App\Models\Curso;
use App\Validators\CursosValidator;

/**
 * Class CursosRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CursosRepositoryEloquent extends BaseRepository implements CursosRepository
{
    protected $fieldSearchable = [
        'titulo' => 'like',
    ];
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Curso::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
