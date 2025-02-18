<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Entidade
 *
 * @property $id
 * @property $created_at
 * @property $updated_at
 *
 * @property Contacto[] $contactos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Entidade extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contactos()
    {
        return $this->hasMany(\App\Models\Contacto::class, 'id', 'entidad_id');
    }
    
}
