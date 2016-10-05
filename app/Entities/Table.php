<?php

namespace App\Entities;


class Table extends Entity
{
    protected $table = 'tables';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'cubeId','name', 'masked','principal'
    ];

    public function cube()
     {
     	return $this->belongsTo(Cube::getClass(), 'cubeId');
     }

    public function fields()
    {
        return $this->hasMany(Field::getClass(), 'tableId');
    }

    public function foraignKey()
    {
        return $this->hasOne(ForeignKey::getClass(), 'tableId');
    }
}
