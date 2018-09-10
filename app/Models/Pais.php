<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Paises.
 *
 * @package namespace App\Models;
 */
class Pais extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'paises';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descricao',
        'slug'
    ];

}
