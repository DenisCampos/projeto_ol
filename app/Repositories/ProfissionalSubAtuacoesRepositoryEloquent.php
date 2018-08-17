<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProfissionalSubAtuacoesRepository;
use App\Models\ProfissionalSubAtuacao;
use App\Validators\ProfissionalSubAtuacoesValidator;

/**
 * Class ProfissionalSubAtuacoesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProfissionalSubAtuacoesRepositoryEloquent extends BaseRepository implements ProfissionalSubAtuacoesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProfissionalSubAtuacao::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
