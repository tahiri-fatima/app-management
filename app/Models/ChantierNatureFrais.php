<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChantierNatureFrais extends Model
{
    use HasFactory;
    protected $table = "chantier_nature_frais";

    protected $fillable = [
        'id', 'chantier_id', 'nature_frais_id', 
        'montant_estimee', 
          'created_at', 'updated_at'
    ];

    public function chantier()
    { 
        $chantier = Chantier::where('id', '=', $this->chantier_id)->first();
        return $chantier; 
    }

    public function nature_frais()
    { 
        $nature_frais = NatureFrais::where('id', '=', $this->nature_frais_id)->first();
        return $nature_frais; 
    }
}
