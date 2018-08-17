<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class PostCategorias.
 *
 * @package namespace App\Models;
 */
class PostCategoria extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'post_categorias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id', 'categoria_id'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

}
