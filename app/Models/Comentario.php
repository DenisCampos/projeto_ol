<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Comentarios.
 *
 * @package namespace App\Models;
 */
class Comentario extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'comentarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descricao',
        'user_id',
        'statu_id',
        'post_id',
        'comentario_id'
    ];

    public function statu()
    {
        return $this->belongsTo(Statu::class, 'statu_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function comentario()
    {
        return $this->belongsTo(Comentario::class, 'comentario_id');
    }

}
