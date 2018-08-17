<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserInteressesRepository;
use App\Models\UserInteresses;
use App\Validators\UserInteressesValidator;

/**
 * Class UserInteressesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserInteressesRepositoryEloquent extends BaseRepository implements UserInteressesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserInteresses::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
