<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ProfissionalAtuacao.
 *
 * @package namespace App\Models;
 */
class ProfissionalAtuacao extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'profissional_atuacoes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profissional_id', 'atuacao_id'
    ];

    public function profissional()
    {
        return $this->belongsTo(Profissional::class, 'profissional_id');
    }

    public function atuacao()
    {
        return $this->belongsTo(Atuacao::class, 'atuacao_id');
    }
}
