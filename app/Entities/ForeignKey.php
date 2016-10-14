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
        'id', 'idLocalFiel', 'idLocalTable', 'idReferenceTable','idReferenceFiel','nameLocalTable','nameLocalField','nameReferenceTable','nameReferenceField','nameRelationship'
    ];


	public function fieldLocal()
     {
     	return $this->belongsTo(Field::getClass(), 'idLocalFiel');
     }
    public function fieldReference()
     {
        return $this->belongsTo(Field::getClass(), 'idReferenceFiel');
     }
    
    public function tableLocal()
     {
        return $this->belongsTo(Field::getClass(), 'idLocalTable');
     }
     
    public function tableReference()
     {
        return $this->belongsTo(Field::getClass(), 'idReferenceTable');
     }
}
