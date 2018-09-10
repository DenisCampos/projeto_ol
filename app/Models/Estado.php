<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Estados.
 *
 * @package namespace App\Models;
 */
class Estado extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'estados';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sigla',
        'descricao',
        'slug', 
        'pais_id'
    ];

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id');
    }

}
