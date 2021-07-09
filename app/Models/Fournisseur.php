<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    protected $table = "fournisseurs";

    protected $fillable = [
        'id', 'code_fournisseur', 'intitule_fournisseur','telephone_fournisseur','email_fournisseur', 'created_at', 'updated_at'
    ];
    

    public function commandes() 
    { 
        return $this->hasMany(Commande::class); 
    }
}
