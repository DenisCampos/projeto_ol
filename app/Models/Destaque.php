<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Destaques.
 *
 * @package namespace App\Models;
 */
class Destaque extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'destaques';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descricao'
    ];

}
