<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChantierMateriel extends Model
{
    use HasFactory;

    protected $table = "chantier_materiels";

    protected $fillable = [
        'id', 'chantier_id', 'materiel_id', 'd_debut_service','d_fin_service', 't_ajustement',
        'mont_net', 'duree_reel', 'prix_unit', 'created_at', 'updated_at'
    ];

    public function chantier()
    { 
        $chantier = Chantier::where('id', '=', $this->chantier_id)->first();
        return $chantier; 
    }

    public function materiel()
    { 
        $materiel = Materiel::where('id', '=', $this->materiel_id)->first();
        return $materiel; 
    }

    
}
