<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BannersPrincipaisRepository;
use App\Models\BannerPrincipal;
use App\Validators\BannersPrincipaisValidator;

/**
 * Class BannersPrincipaisRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BannersPrincipaisRepositoryEloquent extends BaseRepository implements BannersPrincipaisRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BannerPrincipal::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
