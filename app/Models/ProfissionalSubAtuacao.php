<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ProfissionalSubAtuacao.
 *
 * @package namespace App\Models;
 */
class ProfissionalSubAtuacao extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'profissional_sub_atuacoes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profissional_id', 'subatuacao_id'
    ];

    public function profissional()
    {
        return $this->belongsTo(Profissional::class, 'profissional_id');
    }

    public function subatuacao()
    {
        return $this->belongsTo(SubAtuacao::class, 'subatuacao_id');
    }

}
