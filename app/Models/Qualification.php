<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $table = "qualifications";

    use HasFactory;

    protected $fillable = [
        'id', 'code_qual', 'designation_qual', 'salaire_unitaire', 
        'created_at', 'updated_at'
    ];

    
    public function personnels() 
    { 
        return $this->hasMany(Personnel::class); 
    }

    public function chantiers()
    {
        return $this->belongsToMany(Chantier::class, 'chantier_qualifications');
    }

}
