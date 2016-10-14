<?php

namespace App\Entities;

class Field extends Entity
{
    protected $table = 'fields';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'id', 'tableId','name', 'masked','type','visible','primariKey'
    ];

    public function table()
     {
     	return $this->belongsTo(Table::getClass(), 'tableId');
     }

    public function localForeignKeys()
    {
        return $this->hasMany(ForeignKey::getClass(), 'idLocalFiel');
    }

    public function referenceForeignKeys()
    {
        return $this->hasMany(ForeignKey::getClass(), 'idReferenceFiel');
    }
}
