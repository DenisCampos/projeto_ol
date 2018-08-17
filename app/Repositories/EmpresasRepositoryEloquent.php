<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EmpresasRepository;
use App\Models\Empresa;
use App\Validators\EmpresasValidator;

/**
 * Class EmpresasRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EmpresasRepositoryEloquent extends BaseRepository implements EmpresasRepository
{

    protected $fieldSearchable = [
        'name' => 'like',
    ];
    
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Empresa::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
