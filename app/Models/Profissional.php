<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Profissionais.
 *
 * @package namespace App\Models;
 */
class Profissional extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'profissionais';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'slug', 
        'email', 
        'foto', 
        'contato', 
        'descricao', 
        'endereco', 
        'numero', 
        'bairro', 
        'complemento', 
        'cidade_id', 
        'estado_id',
        'pais_id',
        'user_id',
        'site',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'latitude',
        'longitude',
        'statu_id',//1 = despublicado, 2 = publicado
        'situacao_id', //1 = criado, 2 = enviado, 3 = aceito, 4 = negado 
        'destaque_id',//1 = publicacao normal, 2 = em destaque
        'banner', //0 = nao, 1 = sim
    ];

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'cidade_id');
    }

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

    public function getBanner($libera_banner){
        if($libera_banner==0){
            return 'Não liberado';
        }else{
            return 'Liberado';
        }
    }
}
