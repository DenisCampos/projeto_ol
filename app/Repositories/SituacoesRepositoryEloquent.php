<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SituacoesRepository;
use App\Models\Situacao;
use App\Validators\SituacoesValidator;

/**
 * Class SituacoesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SituacoesRepositoryEloquent extends BaseRepository implements SituacoesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Situacao::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
