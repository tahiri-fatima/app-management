<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chantier extends Model
{
    use HasFactory;

    protected $table = "chantiers";

    protected $fillable = [
        'id', 'code_chantier', 'intitule_chantier','localisation', 'date_debut_chantier', 'date_fin_chantier
        ','numero_marche','montant_marche', 'r_garantie', 'created_at', 'updated_at'
    ];
    
    public function decomptes() 
    { 
        return $this->hasMany(Decompte::class); 
    }

    public function operations()
    {
        return $this->belongsToMany(Operation::class, 'chantier_operations');
    }

    public function nature_frais()
    {
        return $this->belongsToMany(NatureFrais::class, 'chantier_nature_frais');
    }

    public function qualification()
    {
        return $this->belongsToMany(Qualification::class, 'chantier_qualifications');
    }
    

    public function operationReels()
    {
        return $this->belongsToMany(Operation::class, 'chantier_operation_reels');
    }

    public function ordreServices() 
    { 
        return $this->hasMany(OrdreService::class); 
    }

    public function frais() 
    { 
        return $this->hasMany(Frais::class); 
    }

    public function commandes() 
    { 
        return $this->hasMany(Commande::class); 
    }

    public function personnels()
    {
        return $this->belongsToMany(Personnel::class, 'chantier_personnels');
    }

    public function materiels()
    {
        return $this->belongsToMany(Materiel::class, 'chantier_materiels');
    }

   

}
