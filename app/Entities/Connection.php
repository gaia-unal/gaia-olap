<?php

namespace App\Entities;


class Connection extends Entity
{
     protected $table = 'connections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'id','userId','name', 'host', 'port', 'userName', 'password', 'database',
        'prefix','schema','collaction','strict','engine'
    ];

  

     /*
     	
      */

    public function user()
     {
     	return $this->belongsTo(User::getClass(), 'userId');
     }

    public function cubes()
    {
        return $this->hasMany(Cube::getClass(), 'connectionId');
    }
}
