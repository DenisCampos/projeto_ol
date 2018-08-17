<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContracts;
use \Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContracts;

class User extends Model implements AuthenticatableContracts, CanResetPasswordContracts
{
    use Notifiable, Authenticatable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'foto', 
        'sexo', 
        'contato', 
        'tipo', 
        'aceitaCO',
        'cidade_id', 
        'estado_id',
        'pais_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sexo($sexo){
        if($sexo==1){
            return "Masculino";
        }else if($sexo==2){
            return "Femenino";
        }else{
            return "Outro";
        }
    }

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

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
