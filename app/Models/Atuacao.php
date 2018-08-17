<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Atuacoes.
 *
 * @package namespace App\Models;
 */
class Atuacao extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'atuacoes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descricao',
        'tipo' //1 - profissional, 2 - empresa, 3 - ambos
    ];

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
