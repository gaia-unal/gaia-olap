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
        'id', 'tableId','name', 'masked'
    ]


    public function table()
     {
     	return $this->belongsTo(Table::getClass(), 'tableId');
     }

    public function foreignKeys()
    {
        return $this->hasMany(ForeignKey::getClass(), 'fieldId');
    }
}
