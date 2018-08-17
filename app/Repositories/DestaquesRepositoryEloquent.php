<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\DestaquesRepository;
use App\Models\Destaque;
use App\Validators\DestaquesValidator;

/**
 * Class DestaquesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class DestaquesRepositoryEloquent extends BaseRepository implements DestaquesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Destaque::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
