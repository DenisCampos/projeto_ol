<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class EmpresaCategorias.
 *
 * @package namespace App\Models;
 */
class EmpresaAtuacao extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'empresa_atuacoes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'empresa_id',
        'atuacao_id'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function atuacao()
    {
        return $this->belongsTo(Atuacao::class, 'atuacao_id');
    }
}
