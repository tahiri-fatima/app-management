<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use App\Models\ChantierMateriel;
use App\Models\chantierOperation;
use App\Models\ChantierOperationReel;
use App\Models\ChantierPersonnel;
use App\Models\ChantierQualification;
use App\Models\Commande;
use App\Models\CommandeMateriau;
use App\Models\Frais;
use App\Models\Materiel;
use App\Models\NatureFrais;
use App\Models\Operation;
use App\Models\Personnel;
use App\Models\Qualification;
use Illuminate\Http\Request;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;


use function PHPUnit\Framework\isEmpty;

class ChantierController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:list|create|edit|delete|show', ['only' => ['index','show']]);
        $this->middleware('permission:create', ['only' => ['create','store']]);
        $this->middleware('permission:edit', ['only' => ['edit','update']]);
        $this->middleware('permission:delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chantiers = Chantier::all();
        return view('chantiers.index', compact('chantiers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        return view('chantiers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code_chantier' => 'required',
            'intitule_chantier' => 'required',
            'localisation' => 'required',
            'date_debut_chantier' => 'required',
            'montant_marche' => 'required',
            'r_garantie' => 'required',
            'numero_marche' => 'required',
        ]);
        

        if($request->date_fin_chantier !== null && strtotime($request->date_fin_chantier) < strtotime($request->date_debut_chantier)){
            return redirect()->back()
                        ->with('error_code', 2);
        }

        $chantier = Chantier::where('code_chantier', '=', $request->code_chantier)->first();
        if ($chantier === null) {
            $chantier = Chantier::create($request->all());
          return redirect()->back()
                        ->with('success','Enregistrement ajouté avec succes.');
           
        }
        else{
        return redirect()->back()
                        ->with('error_code', 1);
                        
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chantier  $chantier
     * @return \Illuminate\Http\Response
     */
    public function show(Chantier $chantier)
    {
        return view('chantiers.show', compact('chantier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chantier  $chantier
     * @return \Illuminate\Http\Response
     */
    public function edit(Chantier $chantier)
    {
        //$materiels = Materiel::all();
        //$ouvrages = Overage::all();
     /*   return view('chantiers.edit', [
            'chantier' => $chantier,
            'materiels' => $materiels,
            'ouvrages' => $ouvrages
        ]);*/

        return view('chantiers.edit', [
            'chantier' => $chantier
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chantier  $chantier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chantier $chantier)
    {
        $request->validate([
            'code_chantier' => 'required',
            'intitule_chantier' => 'required',
            'localisation' => 'required',
            'date_debut_chantier' => 'required',
            'numero_marche' => 'required',
            'montant_marche' => 'required',
            'r_garantie' => 'required',
            
        ]);

        if($request->date_fin_chantier !== null && strtotime($request->date_fin_chantier) < strtotime($request->date_debut_chantier)){
            return redirect()->back()
                        ->with('error_code', 2);
        }

        if($request->code_chantier !== $chantier->code_chantier){
            $f = Chantier::where('code_chantier', '=', $request->code_chantier)->first();
            if ($f !== null) {
                return redirect()->back()
                ->with('error_code', 5);
            }
        }

        Chantier::where('id', '=',$chantier->id)->update($request->except(['_token','_method']));

         return redirect()->route('chantiers.show', [$chantier])
         ->with('success','Modification avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chantier  $chantier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chantier $chantier)
    {
        try {
            $chantier->delete();
            return redirect()->route('chantiers.index')
                    ->with('success','Chantier supprimé avec succes.');
        
          } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('chantiers.index')
                    ->with('error','Vous ne pouvez pas supprimé cet enregistrement.');
             // var_dump($e->errorInfo);
          }    
        
    }

    

    public function search(){
        $search_c = $_GET['codechantier'];
        $search_i = $_GET['intitulechantier'];

        if ($search_c == null){
            $search_c = '#';
        }
        if ($search_i == null){
            $search_i = '#';
        }

        $chantiers = Chantier::query()
        ->where('code_chantier', 'like', "%".$search_c."%")
        ->orWhere('intitule_chantier', 'like', "%".$search_i."%")
        ->orderBy('created_at', 'desc')
        ->get();

        if ($chantiers->isEmpty()) {
           // dd($chantiers);
            return redirect()->route('chantiers.index')
                        ->with('warning',"N'éxiste aucun chantier avec les informations de la recherche");
        }
        
        return view('chantiers.search', compact('chantiers'));
    }


    

    public function getMateriels($id){
        $chantier = Chantier::find($id);
        $chantierMateriels = ChantierMateriel::where('chantier_id', '=', $id)->get();

        $materiels = $chantier->materiels;
        $total = 0.0;
        if ($chantierMateriels !== null){
            foreach($materiels as $materiel){
                foreach($chantierMateriels as $cm){
                    if($cm->materiel_id === $materiel->id){
                        $montant = 0.0;
                        $materiel->setAttribute('t_ajustement', $cm->t_ajustement);
                        $materiel->setAttribute('mont_net', $cm->mont_net);
                        $materiel->setAttribute('prix_unit', $cm->prix_unit);
                        $datediff = abs(strtotime($cm->d_debut_service) - strtotime($cm->d_fin_service));
                        $duree = round($datediff / (60 * 60 * 24));
                        $materiel->setAttribute('duree', $duree);
                        $montant = $duree*$cm->prix_unit;
                        $materiel->setAttribute('montant', $montant);
                        $total += $cm->mont_net;
                    }  
                }
            }
        }
  // echo json_encode($commandeMateriaus); 
  $chantier->setAttribute('total', $total);

        return  view('chantiers.getMateriels', compact('materiels','chantier'));
    }

    public function getOperations($id){
        $chantier = Chantier::find($id);
        $operations = $chantier->operations;
        $chantierPersonnels = chantierOperation::where('chantier_id', '=', $id)->get();

        if ($chantierPersonnels !== null){
            // initialiser le total 
            $total = 0.0;
            foreach($operations as $operation){
                foreach($chantierPersonnels as $chantierPersonnel){
                    if($chantierPersonnel->operation_id === $operation->id){
                        $operation->setAttribute('quantite_operation', $chantierPersonnel->quantite_operation);
                        $operation->setAttribute('montant_net', $chantierPersonnel->montant_estimee);
                        $operation->setAttribute('taux_ajustement', $chantierPersonnel->taux_ajustement);
                        $operation->setAttribute('prix_unitaire_revient', $chantierPersonnel->prix_unitaire_revient);
                        // calcule du montant d'operation      
                        $montant = $chantierPersonnel->prix_unitaire_revient*$chantierPersonnel->quantite_operation;
                        $operation->setAttribute('montant', number_format($montant, 2, '.', ' '));             
                        // calcule de total 
                        $total += $chantierPersonnel->montant_estimee;
                    }                           
                }                       
            }                                   
            // Ajouter l'attribut total dans la table chantier 
            $chantier->setAttribute('total', $total);
        }
        return  view('chantiers.getOperations', compact('operations','chantier'));
    }

    public function listeOperationsChantier()
    {
        $chantiers = Chantier::all();
        return view('edition.listeOperationsChantier', compact('chantiers'));
    }

    public function listeMaterielsChantier()
    {
        $chantiers = Chantier::all();
      //if(app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName() == 'listeMaterielsChantier'){ }        
        return view('edition.listeMaterielsChantier', compact('chantiers'));
    }

    public function listeFraisChantier()
    {
        $chantiers = Chantier::all();
        $natureFrais = NatureFrais::all();
        return view('edition.listeFraisChantier', compact('chantiers', 'natureFrais'));
    }

    public function getFrais(Request $request){
        $chantier_id = $request->chantier_id;
        $nature_id = $request->nature_frais_id;

        if($chantier_id != null && $nature_id != null){
            $frais = Frais::query()
            ->where('chantier_id', '=', $chantier_id)
            ->Where('nature_frais_id', '=', $nature_id)
            ->orderBy('created_at', 'desc')
            ->get();
            if ($frais->isEmpty()) {
                // dd($chantiers);
                 return redirect()->route('chantiers.listeFraisChantier')
                             ->with('warning',"Il n'y a pas des frais avec les informations choisi ");
             }else{
                foreach($frais as $frai){
                    $nature = NatureFrais::find($nature_id);
                    $chantier = Chantier::find($chantier_id);
                    $frai->setAttribute('intitule_chantier', $chantier->intitule_chantier);
                    $frai->setAttribute('nature_frais', $nature->nature_frais);
                }
            }
        }elseif($chantier_id != null && $nature_id == null){
            //  $chantier = Chantier::where('id', '=', $chantier_id);
            $chantier = Chantier::find($chantier_id);
            $frais = Frais::query()
                ->where('chantier_id', '=', $chantier->id)
                ->orderBy('created_at', 'desc')
                ->get();
                if ($frais->isEmpty()) {
                    // dd($chantiers);
                     return redirect()->route('chantiers.listeFraisChantier')
                                 ->with('warning',"Il n'y a pas des frais avec les informations choisi ");
                 }else{
                     foreach($frais as $frai){
                         $nature = NatureFrais::find($frai->nature_frais_id);
                         $frai->setAttribute('nature_frais', $nature->nature_frais);
                         $frai->setAttribute('intitule_chantier', $chantier->intitule_chantier);
                     }
                 }
        }else{
            //  $chantier = Chantier::where('id', '=', $chantier_id);
                $nature = NatureFrais::find($nature_id);
                $frais = Frais::query()
                ->Where('nature_frais_id', '=', $nature->id)
                ->orderBy('created_at', 'desc')
                ->get();
                if ($frais->isEmpty()) {
                    // dd($chantiers);
                     return redirect()->route('chantiers.listeFraisChantier')
                                 ->with('warning',"Il n'y a pas des frais avec les informations choisi ");
                 }else{
                    foreach($frais as $frai){
                        $chantier = Chantier::find($frai->chantier_id);
                        $frai->setAttribute('nature_frais', $nature->nature_frais);
                        $frai->setAttribute('intitule_chantier', $chantier->intitule_chantier);
                    }
        }
        
    }  
     //   dd($frais);
        return view('chantiers.listeFrais', compact('frais'));
    }
    
    
    public function getPersonnels ($id){
        $chantier = Chantier::find($id);
        $personnels = $chantier->personnels;
        $chantierPersonnels = ChantierPersonnel::where('chantier_id', '=', $id)->get();

        if ($chantierPersonnels !== null){
            // initialiser le total     
            $total =  0.0;    
            $montant_net = 0.0;
            foreach($personnels as $personnel){
                foreach($chantierPersonnels as $chantierPersonnel){
                    if($chantierPersonnel->personnel_id === $personnel->id){
                        $datediff = abs(strtotime($chantierPersonnel->date_affect) - strtotime($chantierPersonnel->date_fin_affect));
                        $duree = round($datediff / (60 * 60 * 24));
                        $personnel->setAttribute('duree', $duree);
                        $qual = Qualification::where('id', '=', $personnel->qualification_id)->first();
                           // dd($qual);
                            $personnel->setAttribute('salaire_unitaire', $qual->salaire_unitaire);

                        //$montant_net = $duree*$chantierPersonnel->effictif_reel*$personnel->salaire_reel;
                        $personnel->setAttribute('salaire_reel', $chantierPersonnel->salaire_reel);
                        $personnel->setAttribute('effictif_reel', $chantierPersonnel->effictif_reel);
                                    
                        // calcule de total 
                        $total +=  $chantierPersonnel->salaire_reel; 
                    }                           
                }                       
            }                                   
            // Ajouter l'attribut total dans la table chantier 
            $chantier->setAttribute('total', $total);
        }

   /*     $datediff = abs(strtotime($chantier->date_affect) - strtotime($chantier->date_fin_affect));
        $duree = round($datediff / (60 * 60 * 24));
        $chantier->setAttribute('duree', $duree);
        foreach($personnels as $personnel){
            $montant_net = $duree*$chantier->effictif*$personnel->salaire_mensuel;
            $personnel->setAttribute('montant_net', $montant_net);
            $total +=  $montant_net;   
        }
        */
        $chantier->setAttribute('total', $total);
//dd($personnels);
        return  view('chantiers.getPersonnels ', compact('personnels','chantier'));
    }

    public function listePersonnelsChantier()
    {
        $chantiers = Chantier::all();
        return view('edition.listePersonnelsChantier', compact('chantiers'));
    }

    public function searchChantierPersonnels(){

        $search_c = $_GET['codechantier'];
        if ($search_c === ''){
            return redirect()->back();
        }
        // get chantier
        $chantier = Chantier::where('code_chantier', '=', $search_c)->first();
        if ($chantier === null){
            return redirect()->route('chantiers.listePersonnelsChantier')
                         ->with('warning',"N'éxiste aucun chantier avec ce code");
        }
        //
        $chantierPersonnels = ChantierPersonnel::where('chantier_id', '=', $chantier->id)->get();
        if ($chantierPersonnels->isEmpty()) {
            // dd($chantiers);
             return redirect()->route('chantiers.listePersonnelsChantier')
                         ->with('warning',"Ce chantier n'a pas encore des personnels");
         }
         
         return redirect()->route('chantiers.getPersonnels',$chantier->id);
    }

    public function listeFraisEstime()
    {
        $chantiers = Chantier::all();
        return view('edition.listeFraisEstime', compact('chantiers'));
    }

    public function listeDecomptesChantier()
    {
        $chantiers = Chantier::all();
        return view('edition.listeDecomptesChantier', compact('chantiers'));
    }

    public function getDecomptes($id){

        $chantier = Chantier::find($id);  
       // dd($operations);
        $operations = $chantier->operations;
       // dd($operations);
        $chantierOperationReels = ChantierOperationReel::where('chantier_id', '=', $id)->get();
        $count = count($chantierOperationReels);
        //dd($chantierOperations);
        if ($chantierOperationReels !== null){
            // initialiser le total 
            $montantHt = 0.0;
            $totalHt = 0.0;
            $tva = 0.0;
            $totalTTC = 0.0;
            $totalNet = 0.0;
            $tRetenue = 0.0;
            foreach($chantierOperationReels as $chantierOperationReel){
                foreach($operations as $operation){
                    if($chantierOperationReel->operation_id === $operation->id){
                        $chantierOperation = ChantierOperation::query()
                        ->where('chantier_id', '=', $id)
                        ->where('operation_id', '=', $operation->id)
                        ->first();

                            $chantierOperationReel->setAttribute('chantierOperation', $chantierOperation);   

                        $chantierOperationReel->setAttribute('designation_operation', $operation->designation_operation);   
                        $montantHt =  $chantierOperationReel->montant_execution_revient;
                        $chantierOperationReel->setAttribute('montantHt', $montantHt);
                        $totalHt += $montantHt;          
                    }                           
                }                     
            }
            $decomptes = $chantier->decomptes;
            if(!$decomptes->isEmpty()){
                foreach($decomptes as $decompte){
                    $tRetenue = $decompte->retunue_garantie;
                    break;
                }
            } 
            $tva = ($totalHt * 20) / 100;   
            $totalTTC = $totalHt + $tva;  
            $totalNet =  $totalTTC - $tRetenue;                            
            // Ajouter l'attribut total dans la table chantier 
           $chantier->setAttribute('totalHt', $totalHt);
           $chantier->setAttribute('tva', $tva);
           $chantier->setAttribute('totalTTC', $totalTTC);
           $chantier->setAttribute('tRetenue', $tRetenue);
           $chantier->setAttribute('totalNet', $totalNet);
        }
      //  dd($decomptes);
        // dd($chantierOperations);
        return  view('chantiers.getDecomptes', compact('chantier', 'decomptes', 'chantierOperationReels', 'count'));

    }

    public function getBilan(){
        $id = $_GET['chantier_id'];
        if (isset($_GET['graphes'])) {
            //var_dump('graphes');
           
            return redirect()->route('chantiers.BilanChantierCharts', $id);

        }
        // get chantier
        $chantier = Chantier::find($id);
        // initialisation des montant total
        $total_sal = 0.0;
        $total_materiel = 0.0;
        $total_materiau = 0.0;
        $total_frais = 0.0;
        $total_gen = 0.0;
        // recuperation des personnels du chantier
        $chantierPersonnels = ChantierPersonnel::where('chantier_id', '=', $id)->get();
        foreach($chantierPersonnels as $chantierPersonnel){
            // calcul de la somme des salaires des personnels du chantier
            $total_sal += $chantierPersonnel->montant_salaire;
        }
        // recuperation des materiels du chantier
        $chantierMateriels = ChantierMateriel::where('chantier_id', '=', $id)->get();
        foreach($chantierMateriels as $chantierMateriel){
            // calcul de la somme des montants des materiels du chantier
            $total_materiel += $chantierMateriel->mont_net;
        }
        // recuperation des frais du chantier
        $chantierFrais = Frais::where('chantier_id', '=', $id)->get();
        foreach($chantierFrais as $frais){
                        // calcul de la somme des montants des frais du chantier
            $total_frais += $frais->montant_frais;
        }
        // recuperation des commandes du chantier
        $commandes = Commande::where('chantier_id', '=', $id)->get();  
        foreach($commandes as $commande){
            // recuperation des materiaux des commandes du chantier
            $commandeMateriaus = CommandeMateriau::where('commande_id', '=', $commande->id)->get();
            
            // calcul de la somme des montants des materiaux commandés du chantier
            foreach($commandeMateriaus as $commandeMateriau){
              //  dd($commandeMateriau); 
                $total_materiau += $commandeMateriau->montant_materiau;
            } 
       }
       
        // calcul du total général du chantier
        $total_gen = $total_materiau + $total_frais + $total_materiel + $total_sal ;
        // calcul des pourcentages du chantier  
        $porc_sal = 0;
            $porc_materiel = 0;
            $porc_materiau = 0;
            $porc_frais = 0;
        if($total_gen != 0){
            $porc_sal = ($total_sal / $total_gen) * 100;
            $porc_materiel = ($total_materiel / $total_gen) * 100;
            $porc_materiau = ($total_materiau / $total_gen) * 100;
            $porc_frais = ($total_frais / $total_gen) * 100;
        }
       
       // dd($chantierMateriaux);  
       // stocker les valeur calcules dans chantier
        $chantier->setAttribute('total_sal', $total_sal);
        $chantier->setAttribute('total_frais', $total_frais);
        $chantier->setAttribute('total_materiel', $total_materiel);
        $chantier->setAttribute('total_materiau', $total_materiau);
        $chantier->setAttribute('total_gen', $total_gen);
        $chantier->setAttribute('porc_sal', number_format($porc_sal, 2, '.', ' '));
        $chantier->setAttribute('porc_materiel', number_format($porc_materiel, 2, '.', ' '));
        $chantier->setAttribute('porc_materiau', number_format($porc_materiau, 2, '.', ' '));
        $chantier->setAttribute('porc_frais', number_format($porc_frais, 2, '.', ' '));

       

        return  view('edition.BilanChantier', compact('chantier'));

    }

    public function BilanChantier(){
        $chantiers = Chantier::orderby('created_at', 'desc')->get();
        return  view('edition.ListChantierBilan', compact('chantiers'));

    }

    public function BilanChantierCharts($id){
         // get chantier
         $chantier = Chantier::find($id);
         // initialisation des montant total
         $total_sal = 0.0;
         $total_materiel = 0.0;
         $total_materiau = 0.0;
         $total_frais = 0.0;
         $total_gen = 0.0;
         // recuperation des personnels du chantier
         $chantierPersonnels = ChantierPersonnel::where('chantier_id', '=', $id)->get();
         foreach($chantierPersonnels as $chantierPersonnel){
             // calcul de la somme des salaires des personnels du chantier
             $total_sal += $chantierPersonnel->montant_salaire;
         }
         // recuperation des materiels du chantier
         $chantierMateriels = ChantierMateriel::where('chantier_id', '=', $id)->get();
         foreach($chantierMateriels as $chantierMateriel){
             // calcul de la somme des montants des materiels du chantier
             $total_materiel += $chantierMateriel->mont_net;
         }
         // recuperation des frais du chantier
         $chantierFrais = Frais::where('chantier_id', '=', $id)->get();
         foreach($chantierFrais as $frais){
                         // calcul de la somme des montants des frais du chantier
             $total_frais += $frais->montant_frais;
         }
         // recuperation des commandes du chantier
         $commandes = Commande::where('chantier_id', '=', $id)->get();  
         foreach($commandes as $commande){
             // recuperation des materiaux des commandes du chantier
             $commandeMateriaus = CommandeMateriau::where('commande_id', '=', $commande->id)->get();
             
             // calcul de la somme des montants des materiaux commandés du chantier
             foreach($commandeMateriaus as $commandeMateriau){
               //  dd($commandeMateriau); 
                 $total_materiau += $commandeMateriau->montant_materiau;
             } 
        }
        
         // calcul du total général du chantier
         $total_gen = $total_materiau + $total_frais + $total_materiel + $total_sal ;
         // calcul des pourcentages du chantier  
         $porc_sal = 0;
             $porc_materiel = 0;
             $porc_materiau = 0;
             $porc_frais = 0;
         if($total_gen != 0){
             $porc_sal = ($total_sal / $total_gen) * 100;
             $porc_materiel = ($total_materiel / $total_gen) * 100;
             $porc_materiau = ($total_materiau / $total_gen) * 100;
             $porc_frais = ($total_frais / $total_gen) * 100;
         }
         $title = 'Détail des Prix élémentaires du chantier '.$chantier->intitule_chantier;
        $chart = LarapexChart::setTitle($title)
        ->setLabels(['Salaires', 'Matériels', 'Matériaux', 'Frais'])
        ->setDataset([$porc_sal, $porc_materiel, $porc_materiau, $porc_frais]);

        $chartPie = LarapexChart::setType('pie')
        ->setTitle($title)
        ->setLabels(['Salaires', 'Matériels', 'Matériaux', 'Frais'])
        ->setDataset([$porc_sal, $porc_materiel, $porc_materiau, $porc_frais]);
        $chartPie->pieChart();

        $chartBar = LarapexChart::setType('bar')
            ->setTitle($title)
            ->setLabels(['Salaires', 'Matériels', 'Matériaux', 'Frais'])

            ->setXAxis(['Salaires', 'Matériels', 'Matériaux', 'Frais'])
            ->setDataset([
                [ 'name' => ['Salaires'],
                    'data' => [ number_format($porc_sal, 2, '.', ' ')  ] ],
                [  'name' => ['Matériels'],
                    'data' => [ number_format($porc_materiel, 2, '.', ' ') ] ],
                [ 'name' => ['Matériaux'],
                    'data' => [  number_format($porc_materiau, 2, '.', ' ')]  ],
                [  'name' => ['Frais'],
                    'data' => [ number_format($porc_frais, 2, '.', ' ') ] ]
            ]);

        return  view('edition.BilanChantierCharts', compact('chart', 'chartPie', 'chartBar', 'chantier'));

    }

    public function DetailPrixSalairesChantier()
    {
        $chantiers = Chantier::all();
        return view('edition.DetailPrixSalairesChantier', compact('chantiers'));
    }

    public function DetailPrixMateriauxByChantier()
    {
        $chantiers = Chantier::all();
        return view('edition.DetailPrixMateriauxByChantier', compact('chantiers'));
    }

    public function DetailPrixSalaires(){
       
       
        $id = $_GET['chantier_id'];

        if (isset($_GET['graphes'])) {
            //var_dump('graphes');
           
            return redirect()->route('chantiers.DetailPrixSalaireCharts', $id);

        }
       
        $chantier = Chantier::find($id);
       // dd($chantier);
        $personnels = $chantier->personnels->groupby('qualification_id');
       // $qualification = array();
        $chantierPersonnels = ChantierPersonnel::where('chantier_id','=',$id)->get();
        $total =  0.0;
        $qualif = [];
        if(!$chantierPersonnels->isEmpty()){
            foreach($personnels as $personnel){
                $qual_montant = 0.0;
                // dd($personnel);
               foreach($personnel as $pers){
                 foreach($chantierPersonnels as $chantierPersonnel){
                     if($chantierPersonnel->personnel_id === $pers->id){
                         $qual= Qualification::find($pers->qualification_id);
                         // Ajouter les attributs de chantierPersonnel  dans la table personnel 
                         $pers->setAttribute('qualification', $qual->designation_qual);
                         $pers->setAttribute('salaire_unitaire', $qual->salaire_unitaire);
                         $pers->setAttribute('effictif_reel', $chantierPersonnel->effictif_reel);

                         $pers->setAttribute('salaire_reel', $chantierPersonnel->salaire_reel);
                         //$pers->setAttribute('montant_estime', $chantierPersonnel->montant_estime);
                         // calcule duree
                         $datediff = abs(strtotime($chantierPersonnel->date_affect) - strtotime($chantierPersonnel->date_fin_affect));
                         $duree = round($datediff / (60 * 60 * 24));
                        $pers->setAttribute('duree', $duree);  
                        
                       // $montant = $duree*$pers->salaire_mensuel;
                       // $pers->setAttribute('montant', $montant); 
                        $qual_montant +=  $chantierPersonnel->salaire_reel; 
                        $total +=  $chantierPersonnel->salaire_reel; 
                     }                           
                 } 
                }
                foreach($personnel as $pers){
                    $pers->setAttribute('qual_montant', $qual_montant);  

                }

                 }
             }
             foreach($personnels as $personnel){
                if($total != 0){
                    foreach($personnel as $pers){
                        $pourcentage = (number_format(($pers->qual_montant/$total)*100, 2, '.', ' '));
                        $pers->setAttribute('pourcentage', $pourcentage);     
                    }    
                }
            }
          // dd($personnels);
        $chantier->setAttribute('total', $total);
//dd($personnels);
        if (isset($_GET['tableau'])) {
            return view('edition.DetailPrixSalaires', compact('personnels','chantier'));
        }
    }

    public function DetailPrixSalaireCharts($id){
        $chantier = Chantier::find($id);
        $personnels = $chantier->personnels->groupby('qualification_id');
        $chantierPersonnels = ChantierPersonnel::where('chantier_id','=',$id)->get();
        $total =  0.0;
        $qualif = [];
        if(!$chantierPersonnels->isEmpty()){ 
            foreach($personnels as $personnel){
                $qual_montant = 0.0;
               foreach($personnel as $pers){
                 foreach($chantierPersonnels as $chantierPersonnel){
                     if($chantierPersonnel->personnel_id === $pers->id){
                         $qual= Qualification::find($pers->qualification_id);
                         $pers->setAttribute('qualification', $qual->designation_qual);
                         //array_push($qual->designation_qual, $qualif);
                        $qual_montant +=  $chantierPersonnel->salaire_reel; 
                        $total +=  $chantierPersonnel->salaire_reel; 
                     }                           
                 } 
                }
                foreach($personnel as $pers){
                    $pers->setAttribute('qual_montant', $qual_montant);  

                }
                 }
             }
             foreach($personnels as $personnel){
                if($total != 0){
                    foreach($personnel as $pers){
                        $pourcentage = (number_format(($pers->qual_montant/$total)*100, 2, '.', ' '));
                        
                        $pers->setAttribute('pourcentage', $pourcentage);     
                    }
              }
            }
           // dd($personnels);
            foreach($personnels as $personnel){
                    foreach($personnel as $pers){
                        array_push($qualif, $pers->qualification);
                        array_push($qualif, $pers->pourcentage);
                         break;    
                    }
            }
            $des = '';
            $pourc = '';
            for ($k=0; $k<count($qualif) ; $k=$k+2) {
            // dd($qualif[$k]);
               
                $des .= "'".$qualif[$k]. "',"; 
                $pourc .= $qualif[$k+1]. ","; 
            }
            $des = substr_replace($des ,"",-1);
            $pourc = substr_replace($pourc ,"",-1);

           //dd($des);
          $title = 'Détail des Prix élémentaires du chantier '.$chantier->intitule_chantier;
          $chart = LarapexChart::setTitle($title)
        ->setLabels([$des])
        ->setDataset([$pourc]);

        $chartPie = LarapexChart::setType('pie')
        ->setTitle($title)
        ->setLabels([$des])
        ->setDataset([$pourc]);
        $chartPie->pieChart();
        
  

        return view('edition.DetailPrixSalaireCharts', compact('chart', 'chartPie', 'chantier'));
   
    }

    public function DetailFraisGenerauxChantier(){
        $chantiers = Chantier::all();
        return view('edition.DetailFraisGenerauxChantier', compact('chantiers'));
    }

    public function DetailFraisGeneraux($id){
        $chantier = Chantier::find($id);
        $frais = $chantier->frais;
        $total_offre = 0.0;
        $total_montant = 0.0;
        $montant = 0.0;
        if (!$frais->isEmpty()) {
            foreach($frais as $frai){
                $montant = ($frai->montant_frais/$chantier->montant_marche)*100;
               
                $frai->setAttribute('montant', number_format($montant, 2, '.', ' '));
                $total_offre +=  $montant;
                $total_montant += $frai->montant_frais;
            }
         }
         $chantier->setAttribute('total_offre', number_format($total_offre, 2, '.', ' '));
         $chantier->setAttribute('total_montant', $total_montant);
        return view('edition.DetailFraisGeneraux', compact('chantier', 'frais'));
    }

    public function EtatMarchesByChantier(){
        $chantiers = Chantier::all();
        return view('edition.EtatMarchesByChantier', compact('chantiers'));
    }

    public function EtatMarche($id){
        $chantier = Chantier::find($id);
        $chantierOperations = ChantierOperation::where('chantier_id', '=', $id)->get();
        $chantierOperationReels = ChantierOperationReel::where('chantier_id', '=', $id)->get();

        $operations = $chantier->operations;

        if(!$chantierOperationReels->isEmpty()){
            foreach ($chantierOperationReels as $chantierOperationReel){
                foreach ($chantierOperations as $co){
                    foreach ($operations as $operation){
                        if($operation->id === $co->operation_id && $operation->id === $chantierOperationReel->operation_id){
                        //  dd($operation);
                            $chantierOperationReel->setAttribute('date_deb_operation', $co->date_deb_operation);
                            $chantierOperationReel->setAttribute('designation_operation', $operation->designation_operation);
                            $reste_realisee = $co->quantite_operation - $chantierOperationReel->quantite_realisee;
                            $reste_encaisse = $chantierOperationReel->montant_execution_revient - $chantierOperationReel->montant_encaisse;

                        // dd($reste_realisee);
                            $chantierOperationReel->setAttribute('reste_realisee', $reste_realisee);
                            $chantierOperationReel->setAttribute('reste_encaisse', $reste_encaisse);

                        }
                    }
                }   
            }
        }
        return view('edition.EtatMarches', compact('chantier', 'chantierOperationReels'));
    }

    public function searchChantier(){

        $search_c = $_GET['codechantier'];
        if ($search_c === ''){
            return redirect()->back();
        }
        // get chantier
        $chantier = Chantier::where('code_chantier', '=', $search_c)->first();
        if ($chantier === null){
            return redirect()->route('chantiers.listePersonnelsChantier')
                         ->with('warning',"N'éxiste aucun chantier avec ce code");
        }
         
         return redirect()->route('chantiers.EtatMarche',$chantier->id);
    }

    public function ListeCommandeChantier(){
        $chantiers = Chantier::all();
        return view('edition.ListeCommandeChantier', compact('chantiers'));
    }

    public function searchMateriauxByChantier(){
        $search_c = $_GET['codechantier'];
        if ($search_c === ''){
            return redirect()->back();
        }
        // get chantier
        $chantier = Chantier::where('code_chantier', '=', $search_c)->first();
        if ($chantier === null){
            return redirect()->back()
                         ->with('warning',"N'éxiste aucun chantier avec ce code");
        }
        //
        $chantierMateriels = ChantierMateriel::where('chantier_id', '=', $chantier->id)->get();
        if ($chantierMateriels->isEmpty()) {
            // dd($chantiers);
             return redirect()->back()
                         ->with('warning',"Ce chantier n'a pas encore des materiels");
         }
         
         return redirect()->route('commandesMateriaus.DetailPrixMateriaux',$chantier->id);
    }

}


