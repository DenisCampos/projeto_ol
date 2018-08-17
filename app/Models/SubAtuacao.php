<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class SubAtuacoes.
 *
 * @package namespace App\Models;
 */
class SubAtuacao extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'sub_atuacoes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descricao', 
        'atuacao_id',
        'tipo' //1 - profissional, 2 - empresa, 3 - ambos
    ];

    public function atuacao()
    {
        return $this->belongsTo(Atuacao::class, 'atuacao_id');
    }

    public function tipo($tipo){
        if($tipo==1){
            return "Profissional";
        }elseif($tipo==2){
            return "Empresa";
        }else{
            return "Profissional/Empresa";
        }
    }
}
