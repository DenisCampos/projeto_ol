<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class EmpresaSubAtuacao.
 *
 * @package namespace App\Models;
 */
class EmpresaSubAtuacao extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'empresa_sub_atuacoes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'empresa_id', 'subatuacao_id'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function subatuacao()
    {
        return $this->belongsTo(SubAtuacao::class, 'subatuacao_id');
    }
}
