<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Repositories\EmpresaBannersRepository;
use App\Repositories\EmpresasRepository;

/**
 * Class EmpresaBanner.
 *
 * @package namespace App\Models;
 */
class EmpresaBanner extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'empresa_banners';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'banner',
        'site',
        'data_inicio',
        'data_fim',
        'empresa_id',
        'statu_id',
        'situacao_id'
    ];

    public function empresa(){
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function statu()
    {
        return $this->belongsTo(Statu::class, 'statu_id');
    }

    public function situacao()
    {
        return $this->belongsTo(Situacao::class, 'situacao_id');
    }


}
