<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdreService extends Model
{
    protected $table = "ordreServices";
    
    use HasFactory;

    protected $fillable = [
        'id', 'code_ordre_serv', 'type_ordre_serv','date_ordre_serv', 'chantier_id', 'created_at', 'updated_at'
    ];

    public function chantier()
    { 
        return $this->belongsTo(Chantier::class); 
    }
}
