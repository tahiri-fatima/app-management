<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChantierOperation extends Model
{
    use HasFactory;

    protected $table = "chantier_operations";

    protected $fillable = [
        'id', 'chantier_id', 'operation_id', 'quantite_operation',
        'montant_estimee', 'taux_ajustement','date_deb_operation', 'prix_unitaire_revient',
        'date_fin_operation','prix_unitaire_vente',
        'created_at', 'updated_at'
    ];

    public function chantier()
    { 
        $chantier = Chantier::where('id', '=', $this->chantier_id)->first();
        return $chantier; 
    }

    public function operation()
    { 
        $operation = Operation::where('id', '=', $this->operation_id)->first();
        return $operation; 
    }
}
