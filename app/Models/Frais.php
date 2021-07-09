<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frais extends Model
{
    use HasFactory;

    protected $table = "frais";

    protected $fillable = [
        'id', 'code_frais', 'nature','date_frais', 'montant_frais',  'cible_frais', 'chantier_id', 'nature_frais_id', 'created_at', 'updated_at'
    ];
    

    public function chantier()
    { 
        return $this->belongsTo(Chantier::class); 
    }

    public function nature_frais()
    { 
        return $this->belongsTo(NatureFrais::class); 
    }
}
