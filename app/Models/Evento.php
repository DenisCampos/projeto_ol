<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Support\Carbon;

/**
 * Class Eventos.
 *
 * @package namespace App\Models;
 */
class Evento extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'eventos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo', 
        'descricao', 
        'imagem1', 
        'imagem2', 
        'data_inicio', 
        'data_fim', 
        'endereco', 
        'numero', 
        'bairro', 
        'complemento', 
        'pais_id', 
        'estado_id', 
        'cidade_id', 
        'latitude', 
        'longitude', 
        'contato', 
        'investimento', 
        'user_id', 
        'site',
        'facebook',
        'twitter',
        'instagram',
        'statu_id',//1 = despublicado, 2 = publicado
        'situacao_id', //1 = criado, 2 = enviado, 3 = aceito, 4 = negado 
        'destaque_id'//1 = publicacao normal, 2 = em destaque
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

    public function getData($data){
        return Carbon::createFromFormat('Y-m-d H:i:s', $data)->format('d/m/Y');
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
