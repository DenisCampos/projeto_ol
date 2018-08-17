<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\StatusRepository;
use App\Models\Statu;
use App\Validators\StatusValidator;

/**
 * Class StatusRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class StatusRepositoryEloquent extends BaseRepository implements StatusRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Statu::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
