<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Pareceres.
 *
 * @package namespace App\Models;
 */
class Parecer extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'pareceres';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo',//1 = profissional, 2 = empresa, 3 = cruso, 4 = evento, 5 = bannerProf, 6 = bannerEmp
        'id_tipo',
        'user_id',
        'parecer',
        'situacao_id',
        'visualizou'
    ];

    public function profissional()
    {
        return $this->belongsTo(Profissional::class, 'id_tipo');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_tipo');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'id_tipo');
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'id_tipo');
    }

    public function bannerprof()
    {
        return $this->belongsTo(ProfissionalBanner::class, 'id_tipo');
    }

    public function banneremp()
    {
        return $this->belongsTo(EmpresaBanner::class, 'id_tipo');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function situacao()
    {
        return $this->belongsTo(Situacao::class, 'situacao_id');
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

    public function getTipo($tipo){
        if($tipo==1){
            return 'Profissional';
        }elseif($tipo==2){
            return 'Empresa';
        }elseif($tipo==3){
            return 'Curso';
        }elseif($tipo==4){
            return 'Evento';
        }elseif($tipo==5 || $tipo==6){
            //profissional e empresa
            return 'Banner';
        }else{
            return 'erro';
        }
    }

    public function getRoute($tipo, $id){
        if($tipo==1){
            return route('profissionais.show',['id'=>$id]);
        }elseif($tipo==2){
            return route('empresas.show',['id'=>$id]);
        }elseif($tipo==3){
            return route('cursos.show',['id'=>$id]);
        }elseif($tipo==4){
            return route('eventos.show',['id'=>$id]);
        }elseif($tipo==5){
            return route('profissionalbanners.index',['id'=>$id]);
        }elseif($tipo==6){
            return route('empresabanners.index',['id'=>$id]);
        }else{
            return 'erro';
        }
    }

}
