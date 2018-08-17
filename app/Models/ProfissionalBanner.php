<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Repositories\ProfissionalBannersRepository;
use App\Repositories\ProfissionaisRepository;


/**
 * Class ProfissionalBanners.
 *
 * @package namespace App\Models;
 */
class ProfissionalBanner extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'profissional_banners';

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
        'profissional_id',
        'statu_id',
        'situacao_id'
    ];

    public function profissional(){
        return $this->belongsTo(Profissional::class, 'profissional_id');
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
