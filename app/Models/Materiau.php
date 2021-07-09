<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiau extends Model
{
    protected $table = "materiaus";
    use HasFactory;
    protected $fillable = [
       'id', 'code_materiau', 'intitule_materiau','prix_unit_materiau', 'created_at', 'updated_at'
    ];

    public function commandes()
        {
            return $this->belongsToMany(Materiau::class, 'commande_materiaus');
        }
}
