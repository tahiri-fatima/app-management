<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsommationMateriel extends Model
{
    use HasFactory;

    protected $table = "consommationMateriels";

    protected $fillable = [
       'id', 'code_consommation_mat', 'quantite_consommation_mat','date_consommation_mat', 'materiel_id', 'created_at', 'updated_at'
    ];
    
    public function materiel()
    { 
        return $this->belongsTo(Materiel::class); 
    }
}
