<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decompte extends Model
{
    use HasFactory;

    protected $table = "decomptes";


    protected $fillable = [
        'id', 'num_decompte', 'date_decompte','montant_decompte', 'accorde', 'chantier_id',
        'retunue_garantie','revision_prix', 'created_at', 'updated_at'
    ];
    
    public function chantier()
    { 
        return $this->belongsTo(Chantier::class); 
    }
}
