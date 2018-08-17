<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProfissionalAtuacoesRepository;
use App\Models\ProfissionalAtuacao;
use App\Validators\ProfissionalAtuacoesValidator;

/**
 * Class ProfissionalAtuacoesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProfissionalAtuacoesRepositoryEloquent extends BaseRepository implements ProfissionalAtuacoesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProfissionalAtuacao::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
