<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AtuacoesRepository;
use App\Models\Atuacao;
use App\Validators\AtuacoesValidator;

/**
 * Class AtuacoesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AtuacoesRepositoryEloquent extends BaseRepository implements AtuacoesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Atuacao::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
