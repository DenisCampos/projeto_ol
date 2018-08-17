<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProfissionaisRepository;
use App\Models\Profissional;
use App\Validators\ProfissionaisValidator;

/**
 * Class ProfissionaisRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProfissionaisRepositoryEloquent extends BaseRepository implements ProfissionaisRepository
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
        return Profissional::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
