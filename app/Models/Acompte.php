<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acompte extends Model
{
    use HasFactory;

    protected $table = "acomptes";

    protected $fillable = [
       'id', 'code_acompte', 'date_acompte','montant_acompte','type_reglement', 'facture_id', 'created_at', 'updated_at'
    ];
    
    public function facture()
    { 
        return $this->belongsTo(Facture::class); 
    }
}
