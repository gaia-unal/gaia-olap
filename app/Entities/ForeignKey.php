<?php

namespace App\Entities;


class ForeignKey extends Entity
{
    protected $table = 'foreignKey';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'fieldId', 'tableId', 'nameRelationship'
    ]

	public function field()
     {
     	return $this->belongsTo(Field::getClass(), 'fieldId');
     }
    
    public function table()
     {
        return $this->belongsTo(Field::getClass(), 'tableId');
     }
}
