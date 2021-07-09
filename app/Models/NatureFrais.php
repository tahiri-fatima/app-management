<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NatureFrais extends Model
{
    protected $table = "nature_frais";

    use HasFactory;

    protected $fillable = [
        'id', 'code_nature_frais', 'nature_frais', 'created_at', 'updated_at'
    ];

    
    public function frais() 
    { 
        return $this->hasMany(Frais::class); 
    }
    public function chantiers()
    {
        return $this->belongsToMany(Chantier::class, 'chantier_nature_frais');
    }
}
