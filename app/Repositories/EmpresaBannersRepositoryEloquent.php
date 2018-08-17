<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EmpresaBannersRepository;
use App\Models\EmpresaBanner;
use App\Validators\EmpresaBannersValidator;

/**
 * Class EmpresaBannersRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EmpresaBannersRepositoryEloquent extends BaseRepository implements EmpresaBannersRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EmpresaBanner::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
