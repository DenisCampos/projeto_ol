<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PostsRepository;
use App\Models\Post;
use App\Validators\PostsValidator;

/**
 * Class PostsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PostsRepositoryEloquent extends BaseRepository implements PostsRepository
{
    protected $fieldSearchable = [
        'titulo' => 'like',
    ];
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Post::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
