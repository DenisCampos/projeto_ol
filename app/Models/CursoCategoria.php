<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class CursoCategorias.
 *
 * @package namespace App\Models;
 */
class CursoCategoria extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'curso_categorias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'curso_id', 'categoria_id'
    ];

    public function curso()
    {
        return $this->belongsTo(Evento::class, 'curso_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

}
