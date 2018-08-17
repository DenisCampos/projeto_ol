<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EmpresaAtuacoesRepository;
use App\Models\EmpresaAtuacao;
use App\Validators\EmpresaAtuacoesValidator;

/**
 * Class EmpresaAtuacoesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EmpresaAtuacoesRepositoryEloquent extends BaseRepository implements EmpresaAtuacoesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EmpresaAtuacao::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
