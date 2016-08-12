<?php

namespace App\Entities;


class Cube extends Entity
{
     protected $table = 'cubes';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'id','connectionId','name', 'description'
    ];


    public function connection()
     {
     	return $this->belongsTo(Connection::getClass(), 'connectionId');
     }

    public function tables()
    {
        return $this->hasMany(Table::getClass(), 'cubeId');
    }
}

