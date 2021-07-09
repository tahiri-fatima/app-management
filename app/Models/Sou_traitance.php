<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sou_traitance extends Model
{
    use HasFactory;

    protected $table = "soutraitances";

    protected $fillable = [
       'id', 'code_soutraitance', 'intitule_soutraitance','date_soutraitance', 'montant_soutraitance', 'created_at', 'updated_at'
    ];

    public function operations() 
    { 
        return $this->hasMany(Operation::class); 
    }

    
}
