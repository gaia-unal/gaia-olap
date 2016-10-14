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

    public function localForaignKeys()
    {
        return $this->hasMany(ForeignKey::getClass(), 'idLocalTable');
    }

    public function referenceForaignKeys()
    {
        return $this->hasMany(ForeignKey::getClass(), 'idReferenceTable');
    }
}
