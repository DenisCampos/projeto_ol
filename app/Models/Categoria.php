<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Categorias.
 *
 * @package namespace App\Models;
 */
class Categoria extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'categorias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descricao',
        'tipo'  
    ];

    public function tipo($tipo){
        if($tipo==1){
            return "Para Você";
        }elseif($tipo==2){
            return "Para Profissional";
        }elseif($tipo==3){
            return "Para Empresa";
        }elseif($tipo==4){
            return "Você/Profissional";
        }elseif($tipo==5){
            return "Você/Empresa";
        }elseif($tipo==6){
            return "Profissional/Empresa";
        }elseif($tipo==7){
            return "Para Evento";
        }elseif($tipo==8){
            return "Você/Evento";
        }elseif($tipo==9){
            return "Profissional/Evento";
        }elseif($tipo==10){
            return "Empresa/Evento";
        }elseif($tipo==11){
            return "Você/Profissional/Evento";
        }elseif($tipo==12){
            return "Você/Empresa/Evento";
        }elseif($tipo==13){
            return "Profissional/Empresa/Evento";
        }elseif($tipo==14){
            return "Você/Profissional/Empresa";
        }else{
            return "Todos";
        }
    }
}
