<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChantierQualification extends Model
{
    use HasFactory;
    protected $table = "chantier_qualifications";

    protected $fillable = [
        'id', 'chantier_id', 'qualification_id', 'effictif_estimee',
        'duree_estimee', 'salaire_estimee',
          'created_at', 'updated_at'
    ];

    public function chantier()
    { 
        $chantier = Chantier::where('id', '=', $this->chantier_id)->first();
        return $chantier; 
    }

    public function qualification()
    { 
        $qualification = Qualification::where('id', '=', $this->qualification_id)->first();
        return $qualification; 
    }
}
