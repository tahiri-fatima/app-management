<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    protected $table = "operations";

    protected $fillable = [
        'id', 'code_operation', 'designation_operation', 'unite', 'soutraitance_id',
      'created_at', 'updated_at'
    ];

    public function chantiers()
    {
        return $this->belongsToMany(Chantier::class, 'chantier_operations');
    }

    public function chantierReels()
    {
        return $this->belongsToMany(Chantier::class, 'chantier_operation_reels');
    }

    public function soutraitance()
    { 
        return $this->belongsTo(Soutraitance::class); 
    }

    
}
