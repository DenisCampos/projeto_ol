<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Posts.
 *
 * @package namespace App\Models;
 */
class Post extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'slug', 
        'descricao',
        'imagem1',
        'imagem2',
        'user_id',
        'statu_id',//0 = despublicado, 1 = publicado
        'situacao_id',//0 = criado, 1 = enviado, 2 = aceito, 3 = negado 
        'destaque_id',//0 = publicacao normal, 1 = em destaque
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function statu()
    {
        return $this->belongsTo(Statu::class, 'statu_id');
    }

    public function situacao()
    {
        return $this->belongsTo(Situacao::class, 'situacao_id');
    }

    public function destaque()
    {
        return $this->belongsTo(Destaque::class, 'destaque_id');
    }

    public function getStatus($status){
        if($status==0){
            return 'Não publicado';
        }else{
            return 'Publicado';
        }
    }

    public function getSituacao($situacao){
        if($situacao==0){
            return 'Criado';
        }else if($situacao==1){
            return 'Enviado';
        }else if($situacao==2){
            return 'Aceito';
        }else if($situacao==3){
            return 'Negado';
        }
    }

    public function getDestaque($destaque){
        if($destaque==0){
            return 'Normal';
        }else{
            return 'Destaque';
        }
    }
}
