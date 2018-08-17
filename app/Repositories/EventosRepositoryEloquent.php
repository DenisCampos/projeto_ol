<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EventosRepository;
use App\Models\Evento;
use App\Validators\EventosValidator;

/**
 * Class EventosRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EventosRepositoryEloquent extends BaseRepository implements EventosRepository
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
        return Evento::class;
    }

    public function findWherePaginate($where, $limit)
    {
        $this->applyCriteria();
        $this->applyScope();
        $this->applyConditions($where);
        $model = $this->model->paginate($limit);
        $this->resetModel();
        return $this->parserResult($model);
    }

    public function findOrWherePaginate($where, $limit)
    {
        $this->applyCriteria();
        $this->applyScope();
        $this->applyConditionsOr($where);
        $model = $this->model->paginate($limit);
        $this->resetModel();
        return $this->parserResult($model);
    }


    protected function applyConditionsOr(array $where)
    {
        $cont = 0;
        foreach ($where as $field => $value) {
            if (is_array($value)) {
                list($field, $condition, $val) = $value;
                if ($cont==0) {
                    $this->model = $this->model->where($field, $condition, $val);
                    $cont++;
                } else {
                    $this->model = $this->model->orWhere($field, $condition, $val);
                }
            } else {
                $this->model = $this->model->where($field, '=', $value);
            }
        }
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
