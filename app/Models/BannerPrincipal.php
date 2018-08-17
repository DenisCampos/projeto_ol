<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class BannerPrincipal.
 *
 * @package namespace App\Models;
 */
class BannerPrincipal extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'banners_principais';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'imagem',
		'link',
		'titulo',
		'descricao',
		'statu_id'
    ];

    public function statu()
    {
        return $this->belongsTo(Statu::class, 'statu_id');
    }
}
