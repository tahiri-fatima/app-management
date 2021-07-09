<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChantierOperationReel extends Model
{
    use HasFactory;
    protected $table = "chantier_operation_reels";

    protected $fillable = [
        'id', 'chantier_id', 'operation_id', 'quantite_realisee',
        'date_execution', 'montant_execution_revient',
        'montant_execution_vente', 'montant_encaisse',
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
