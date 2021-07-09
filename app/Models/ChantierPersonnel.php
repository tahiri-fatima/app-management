<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChantierPersonnel extends Model
{
    use HasFactory;

    protected $table = "chantier_personnels";

    protected $fillable = [
        'id', 'chantier_id', 'personnel_id', 'date_affect',
         'date_fin_affect', 'effictif_reel','montant_salaire', 
         'salaire_reel',
          'created_at', 'updated_at'
    ];

    public function chantier()
    { 
        $chantier = Chantier::where('id', '=', $this->chantier_id)->first();
        return $chantier; 
    }

    public function personnel()
    { 
        $personnel = Personnel::where('id', '=', $this->personnel_id)->first();
        return $personnel; 
    }
}
