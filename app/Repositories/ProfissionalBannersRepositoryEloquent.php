<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProfissionalBannersRepository;
use App\Models\ProfissionalBanner;
use App\Validators\ProfissionalBannersValidator;

/**
 * Class ProfissionalBannersRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProfissionalBannersRepositoryEloquent extends BaseRepository implements ProfissionalBannersRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProfissionalBanner::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
