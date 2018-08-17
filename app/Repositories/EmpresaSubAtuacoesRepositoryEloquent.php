<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EmpresaSubAtuacoesRepository;
use App\Models\EmpresaSubAtuacao;
use App\Validators\EmpresaSubAtuacoesValidator;

/**
 * Class EmpresaSubAtuacoesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EmpresaSubAtuacoesRepositoryEloquent extends BaseRepository implements EmpresaSubAtuacoesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EmpresaSubAtuacao::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
