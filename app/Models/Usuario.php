<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Usuario extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'tb_cad_usuarios';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'des_nome',
        'des_email',
        'des_cpf',
        'des_telefone',
        'des_path_image',
        'password',
        'flg_ativo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /** Mutators **/
    public function getFlgAtivoAttribute($flg_ativo)
    {
        return $flg_ativo == 'S' ? 'Sim' : 'Não';
    }

    public function getDesCpfAttribute($des_cpf)
    {
        return substr($des_cpf, 0, 3) . '.' . substr($des_cpf, 3, 3) . '.' . substr($des_cpf, 6, 3) . '-' . substr($des_cpf, 9);;
    }

    public function getUpdatedAtAttribute($dat_update) {
        if($dat_update)
            return Carbon::parse($dat_update)->format('d/m/Y H:i:s');
    }

    public function getCreatedAtAttribute($dat_cadastro) {
        if($dat_cadastro)
            return Carbon::parse($dat_cadastro)->format('d/m/Y H:i:s');
    }

    public function getDesTelefoneAttribute($des_telefone)
    {
        if ($des_telefone)
        return '(' . substr($des_telefone, 0, 2) . ') ' . substr($des_telefone, 2, 4) . '-' . substr($des_telefone, 6);
    }

    public function isAtivo()
    {
        return $this->getRawOriginal('flg_ativo') == 'S';
    }
}
