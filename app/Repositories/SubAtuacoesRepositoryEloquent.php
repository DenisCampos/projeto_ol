<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SubAtuacoesRepository;
use App\Models\SubAtuacao;
use App\Validators\SubAtuacoesValidator;

/**
 * Class SubAtuacoesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SubAtuacoesRepositoryEloquent extends BaseRepository implements SubAtuacoesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SubAtuacao::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
