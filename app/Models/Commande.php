<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $table = "commandes";

    protected $fillable = [
      'id', 'code_commande','date_commande', 'chantier_id', 'fournisseur_id', 'total_commande', 'created_at', 'updated_at'
    ];
    
    public function chantier()
    { 
        return $this->belongsTo(Chantier::class); 
    }

    public function fournisseur()
    { 
        return $this->belongsTo(Fournisseur::class); 
    }

    public function facture()
    { 
        return $this->hasOne(Facture::class); 
    }

    public function materiaus()
    {
        return $this->belongsToMany(Materiau::class, 'commande_materiaus');
    }
}
