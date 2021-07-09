<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class Personnel extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;

    protected $redirectTo = '/';
    protected $guarded = ['id'];

    protected $table = "personnels";

    protected $fillable = [
        'id', 'code_personne', 'nom_personne','prenom_personne', 'fonction','num_cnss', 'montant_cnss',
        'date_embauche', 'tele', 'role_id', 'qualification_id', 'created_at', 'updated_at'

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function chantiers()
    {
        return $this->belongsToMany(Chantier::class, 'chantier_personnels');
    }


    public function getAuthPassword()
    {
     return $this->password;
    }

    public function personnel()
    {
     return $this;
    }

    public function role()
    { 
        return $this->belongsTo(Role::class); 
    }

    public function qualification()
    { 
        return $this->belongsTo(Qualification::class); 
    }
}
