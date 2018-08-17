<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Situacoes.
 *
 * @package namespace App\Models;
 */
class Situacao extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'situacoes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descricao'
    ];

}
