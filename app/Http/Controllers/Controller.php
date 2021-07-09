<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function search(){
        $search_c = $_GET['page'];

        if ($search_c == 'acompte'){
            return redirect()->route('acomptes.index');
        }
        if ($search_c == 'avenant'){
            return redirect()->route('avenants.index');
        }
        if ($search_c == 'chantier'){
            return redirect()->route('chantiers.index');
        }
        if ($search_c == 'commande'){
            return redirect()->route('commandes.index');
        }
        if ($search_c == 'consommation'){
            return redirect()->route('consommationMateriels.index');
        }
        if ($search_c == 'décompte'){
            return redirect()->route('decomptes.index');
        }
        if ($search_c == 'entretien'){
            return redirect()->route('entretiens.index');
        }
        if ($search_c == 'execution'){
            return redirect()->route('executions.index');
        }
        if ($search_c == 'facture'){
            return redirect()->route('factures.index');
        }
        
        
    }
}
