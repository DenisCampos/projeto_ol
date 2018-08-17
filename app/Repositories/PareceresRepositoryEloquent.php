<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PareceresRepository;
use App\Models\Parecer;
use App\Validators\PareceresValidator;

/**
 * Class PareceresRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PareceresRepositoryEloquent extends BaseRepository implements PareceresRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Parecer::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
