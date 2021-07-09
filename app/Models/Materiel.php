<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    use HasFactory;

    protected $table = "materiels";

    protected $fillable = [
        'id', 'code_materiel', 'intitule_materiel', 'type_interne_externe', 'taux_consommation', 'quantite',
         'created_at', 'updated_at'
    ];
    
    
   

    public function consommationMateriels() 
    { 
        return $this->hasMany(ConsommationMateriel::class); 
    }

   

    public function chantiers()
    {
        return $this->belongsToMany(Chantier::class, 'chantier_materiels');
    }
}
