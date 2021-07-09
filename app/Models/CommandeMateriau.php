<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeMateriau extends Model
{
    protected $table = "commande_materiaus";

    use HasFactory;
    protected $fillable = [
        'materiaus', 'code_commande', 'quantite_materiau', 'montant_materiau', 'total_commande', 'id', 'commande_id', 'materiau_id',  'created_at', 'updated_at'
   
    ];

    public function commande()
    { 
       // $chantierMateriel = ChantierMateriel::find($this->id);
        $commande = Commande::where('id', '=', $this->commande_id)->first();
        return $commande; 
    }

    public function materiau()
    { 
      //  $chantierMateriel = ChantierMateriel::find($this->id);
        $materiau = Materiau::where('id', '=', $this->materiau_id)->first();
        return $materiau; 
    }

}
