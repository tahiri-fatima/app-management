<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avenant extends Model
{
    use HasFactory;
    protected $table = "avenants";

    protected $fillable = [
        'id','code_avenant', 'date_avenant','type_avenant', 'operation_id', 'created_at', 'updated_at'
    ];
    
    public function operation()
    { 
        return $this->belongsTo(Operation::class); 
    }
}
