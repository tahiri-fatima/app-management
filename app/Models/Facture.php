<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $table = "factures";
    
    use HasFactory;

    protected $fillable = [
        'id', 'code_facture', 'date_facture','montant_facture','reglee', 'montant_en_lettre', 'commande_id', 'created_at', 'updated_at'
    ];

    
    public function acomptes() 
    { 
        return $this->hasMany(Acompte::class); 
    }

    public function commades()
    {
        return $this->belongsTo(Commande::class);
    }

   public static function numberTowords($num){
        $ones = array(
            0 =>"Zéro",
            1 => "Un",
            2 => "Deux",
            3 => "Trois",
            4 => "Quatre",
            5 => "Cinq",
            6 => "Six",
            7 => "Sept",
            8 => "Huit",
            9 => "Neuf",
            10 => "Dix",
            11 => "Onze",
            12 => "Douze",
            13 => "Treize",
            14 => "Quatorze",
            15 => "Quinze",
            16 => "Seize",
            17 => "Dix-sept",
            18 => "Dix-huit",
            19 => "Dix-neuf",
            "014" => "Quatorze"
        );
        $tens = array( 
            0 => "Zéro",
            1 => "Dix",
            2 => "Vingt",
            3 => "Trente", 
            4 => "Quarante", 
            5 => "Cinquante", 
            6 => "Soixante", 
            7 => "Soixante-dix", 
            8 => "Quatre-vingts", 
            9 => "Quatre-vingt-dix" 
        ); 
        $hundreds = array( 
            "Cent", 
            "Mille", 
            "Million", 
            "Milliard", 
            "Billion", 
            "Trillion" 
        ); /*limit t trillion */
        $num = number_format($num,2,".",","); 
        $num_arr = explode(".",$num); 
        $wholenum = $num_arr[0]; 
        $decnum = $num_arr[1]; 
        $whole_arr = array_reverse(explode(",",$wholenum)); 
        krsort($whole_arr,1); 
        $rettxt = ""; 
        foreach($whole_arr as $key => $i){
            
            while(substr($i,0,1)=="0")
                    $i=substr($i,1,5);
            if($i < 20){ 
                /* echo "getting:".$i; */
                $rettxt .= $ones[$i]; 
            }elseif($i < 100){ 
                if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)]; 
                if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
            }else{ 
                if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
                if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)]; 
                if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)]; 
            } 
            if($key > 0){ 
                $rettxt .= " ".$hundreds[$key]." "; 
            }
        } 
        if($decnum > 0){
            $rettxt .= " et ";
            if($decnum < 20){
                $rettxt .= $ones[$decnum];
            }elseif($decnum < 100){
                $rettxt .= $tens[substr($decnum,0,1)];
                $rettxt .= " ".$ones[substr($decnum,1,1)];
            }
        }
        return $rettxt;
    }
}
