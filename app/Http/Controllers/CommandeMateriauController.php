<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use App\Models\Commande;
use App\Models\CommandeMateriau;
use App\Models\Fournisseur;
use App\Models\Materiau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommandeMateriauController extends Controller
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
        $commandeMateriaus = CommandeMateriau::all();
      //  dd($commandeMateriaus);
      $commandes = [];


       // $commandes = new Commande();
        foreach ($commandeMateriaus as $cm){
            $c = Commande::where('id', '=', $cm->commande_id)->first();
          //  dd($c);
            //$commandes->add($c);
            if(!in_array ( $c, $commandes)){
                array_push($commandes, $c);
            }
        } 
      //  dd($commandes);
        return view('commandeMateriaus.index', compact('commandes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materiaus = Materiau::all();
        $commandes = Commande::all();
        return view('commandeMateriaus.create', compact( 'materiaus', 'commandes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
   // dd($request);
        $request->validate([
            'materiaus' => 'required',
            'commande_id' => 'required',
            'quantite_materiau' => 'required',
            'montant_materiau' => 'required',
            'total_commande' => 'required',
        ]);
       
        $commande = Commande::where('id', '=', $request->commande_id)->first();
            $commande->total_commande = $request->total_commande;
            $commande->save();

        foreach ($request->materiaus as $materiau){
            $cm = new CommandeMateriau();
            $cm->commande_id = $request->commande_id;

            $f = CommandeMateriau::query()
            ->where('commande_id', '=', $request->commande_id)
            ->where('materiau_id', '=', $materiau)
            ->first(); 
            
            if ($f !== null) {
                return redirect()->back()
                        ->with('error_code', 5);
            }else{
                for($k=0; $k<count($request->quantite_materiau) ; $k++){
                    $m1 = Materiau ::where('code_materiau', '=', $request->code_materiau[$k])->first();
                    if($m1->id == $materiau){
                        $cm->quantite_materiau = $request->quantite_materiau[$k];
                        $cm->montant_materiau = $request->montant_materiau[$k];
                        $cm->materiau_id = $materiau;
                        $cm->save();
                    }
        
                } 
            }

                 
        } 
        $commandes = Commande::all();
        $materiaus = Materiau::all();

        return redirect()->route('commandeMateriaus.create', compact('commandes',  'materiaus'))
                ->with('success','Enregistrement ajouté avec succes.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommandeMateriau  $commandeMateriau
     * @return \Illuminate\Http\Response
     */
    public function show(Commande $commande)
    {
       /* echo json_encode($commande);
        dd($commande);
        $materiaus = [];
        $commandeMateriaus = CommandeMateriau::where('commande_id', '=', $commande->id)->get();
        foreach($commandeMateriaus as $cm){
            $materiau = Materiau::where('id', '=', $cm->materiau_id)->first();
            array_push($materiaus, $materiau);
        }
        $commande->setAttribute('materiaus', $materiaus);
       // dd($commande);
        return view('commandeMateriaus.show', compact('commandeMateriaus', 'commande')); */
    }

    public function showMateriaux(Commande $commande)
    {

       // echo json_encode($commande);
       // dd($commande);
        $materiaus = [];
        $commandeMateriaus = CommandeMateriau::where('commande_id', '=', $commande->id)->get();
        foreach($commandeMateriaus as $cm){
            $materiau = Materiau::where('id', '=', $cm->materiau_id)->first();
            $materiau->setAttribute('quantite_materiau', $cm->quantite_materiau);
            $materiau->setAttribute('montant_materiau', $cm->montant_materiau);

            array_push($materiaus, $materiau);
        }
        $commande->setAttribute('materiaus', $materiaus);
       // dd($commande);
        return view('commandeMateriaus.show', compact( 'commande'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommandeMateriau  $commandeMateriau
     * @return \Illuminate\Http\Response
     */
    public function edit(CommandeMateriau $commandeMateriau)
    {
        $materiaus = Materiau::all();
        $commandes = Commande::all();
        $commande = Commande::where('id', '=', $commandeMateriau->commande_id)->first();
        $materiau = Materiau::where('id', '=', $commandeMateriau->materiau_id)->first();
        return view('commandeMateriaus.edit', [
            'chantierMateriel' => $commandeMateriau,
            'materiaus' => $materiaus,
            'commandes' => $commandes,
            'materiau' => $materiau,
            'commandes' => $commande
        ]);
    }

    public function editMateriaux(Commande $commande)
    {
        $commandes =Commande::all();
        $materiaus =Materiau::all();

        $materiaux = [];
        $commandeMateriaus = CommandeMateriau::where('commande_id', '=', $commande->id)->get();
        foreach($commandeMateriaus as $cm){
          $materiaux[] = $cm->materiau_id;
          $materiaux[] = $cm->quantite_materiau;
        }
      // dd($commande);
     //   $commande->setAttribute('materiaus', $materiaus);
        
        return view('commandeMateriaus.edit', [
            'materiaux' => $materiaux,
            'materiaus' => $materiaus,
            'commandeMateriaus' => $commandeMateriaus,
            'commandes' => $commandes,
            'commande' => $commande
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommandeMateriau  $commandeMateriau
     * @return \Illuminate\Http\Response
     */
    public function updateMateriaux(Request $request, Commande $commande)
    {
     //   dd($request->materiaus);

        $request->validate([
            'materiaus' => 'required',
            'commande_id' => 'required',
            'quantite_materiau' => 'required',
            'montant_materiau' => 'required',
            'total_commande' => 'required',
        ]);
      
       // $commande = Commande::where('id', '=', $request->commande_id)->first();
           $commande->total_commande = $request->total_commande;
            $commande->update();
          //  dd($commande);

          $commandeMateriaus = CommandeMateriau::query()
          ->where('commande_id', '=', $commande->id)
          ->get(); 

          foreach ($commandeMateriaus as $commandeMateriau){
             // 
              if(!in_array($commandeMateriau->materiau_id, $request->materiaus)){
                $commandeMateriau->delete();
              }
          }


        foreach ($request->materiaus as $materiau){

            $cm = CommandeMateriau::query()
            ->where('commande_id', '=', $commande->id)
            ->where('materiau_id', '=', $materiau)
            ->first(); 
            
            if ($cm !== null) {
                for($k=0; $k<count($request->quantite_materiau) ; $k++){
                    $m1 = Materiau ::where('code_materiau', '=', $request->code_materiau[$k])->first();
                    if($m1->id == $materiau){
                        $cm->quantite_materiau = $request->quantite_materiau[$k];
                        $cm->montant_materiau = $request->montant_materiau[$k];
                        $cm->materiau_id = $materiau;
                        $cm->update();
                        
                    }
        
                } 
            }else{
                $cm = new CommandeMateriau();
                $cm->commande_id = $request->commande_id;
                for($k=0; $k<count($request->quantite_materiau) ; $k++){
                    $m1 = Materiau ::where('code_materiau', '=', $request->code_materiau[$k])->first();
                    if($m1->id == $materiau){
                        $cm->quantite_materiau = $request->quantite_materiau[$k];
                        $cm->montant_materiau = $request->montant_materiau[$k];
                        $cm->materiau_id = $materiau;
                        $cm->save();
                    }
        
                } 
            }

                 
        }     
        return redirect()->route('commandeMateriaus.showMateriaux', [$commande]) 
        ->with('success','Modification avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommandeMateriau  $commandeMateriau
     * @return \Illuminate\Http\Response
     */
    public function destroyCommandeMateriaux(Commande $commande)
    {
        $commandeMateriaus = CommandeMateriau::where('commande_id', '=', $commande->id)->get();
        //dd($commande);
        foreach ($commandeMateriaus as $commandeMateriau){
            $commandeMateriau->delete();
        }
        
        return redirect()->route('commandeMateriaus.index')
                        ->with('success','Les matériaux de la commande sont supprimé avec succes.');
    }

    
    public function search(){
        $search_c = $_GET['code_commande'];
        if ($search_c === ''){
            return redirect()->back();
        }
        // get chantier
        $commande = Commande::where('code_commande', '=', $search_c)->first();
        if ($commande === null){
            return redirect()->route('commandes.listeMateriauxCommande')
                         ->with('warning',"N'éxiste aucune commande avec ce code");
        }
        //
        $commandeMateriau = CommandeMateriau::where('commande_id', '=', $commande->id)->first();
        if ($commandeMateriau === null) {
            // dd($chantiers);
             return redirect()->route('commandes.listeMateriauxCommande')
                         ->with('warning',"Cette commande n'a pas encore des matériaux");
         }
         //dd($chantier);
         return redirect()->route('commandes.getMateriaux',$commande->id);
/*
        $search_c = $_GET['code_commande'];
        $search_m = $_GET['code_materiau'];

        $commandeMateriaus = null;
        $commande = Commande::where('code_commande', '=', $search_c)->first();
        $materiau = Materiau::where('code_materiau', '=', $search_m)->first();
        
        if($commande != null && $materiau != null){
            $commandeMateriaus = CommandeMateriau::query()
            ->where('commande_id', '=', $commande->id)
            ->where('materiau_id', '=', $materiau->id)
            ->get();
        }elseif ($commande == null && $materiau != null){
            $commandeMateriaus = CommandeMateriau::query()
                ->where('materiau_id', '=', $materiau->id)
                ->get();
        }elseif($materiau == null && $commande != null){
            $commandeMateriaus = CommandeMateriau::query()
            ->where('commande_id', '=', $commande->id)
            ->get();
        }
 
        return view('commandeMateriaus.search', compact('commandeMateriaus'));*/
    }


    public function DetailPrixMateriaux($id){
        $commandes = Commande::where('chantier_id', '=', $id)->get();
      //  dd($commandes);
        if(!$commandes->isEmpty()){
            $materiaus = [];
            $total = 0.0;
            foreach($commandes as $commande){
                $commandesMateriaus = CommandeMateriau::where('commande_id', '=', $commande->id)->get();
                if(!$commandesMateriaus->isEmpty()){
                    $materiaux = $commande->materiaus;
                    foreach ($materiaux as $materiau){
                        $qte = 0;
                        $montant = 0.0;
                        foreach ($commandesMateriaus as $cmdmat){
                            if($materiau->id == $cmdmat->materiau_id){
                                $qte += $cmdmat->quantite_materiau;
                                $montant += $cmdmat->montant_materiau;
                            }
                        }
                        if(!empty($materiaus)){
                            $check = false;
                            foreach ($materiaus as $mat){
                                if($materiau->id == $mat->id){
                                    $mat->quantite_materiau += $qte;
                                    $mat->montant_materiau += $montant; 
                                    $check = true;
                                    break;                                  
                                }
                            }
                            if(!$check){
                                $materiau->setAttribute('quantite_materiau',$qte);
                                $materiau->setAttribute('montant_materiau',$montant);
                                array_push($materiaus, $materiau);
                            }
                        }else{
                            $materiau->setAttribute('quantite_materiau',$qte);
                            $materiau->setAttribute('montant_materiau',$montant);
                            array_push($materiaus, $materiau);
                        }
                        $total += $montant; 
                    }   
                }
   
                }
                
            }
            else{
                return redirect()->back()
                         ->with('warning',"Le chantier choisi n'a aucun matériaux");
            }
        return view('edition.DetailPrixMateriaux', compact('materiaus', 'total'));
    }
    public function searchMateriauxByCommande(){

        $search_c = $_GET['code_commande'];
        if ($search_c === ''){
            return redirect()->back();
        }
        // get chantier
        $commande = Commande::where('code_commande', '=', $search_c)->first();
        if ($commande === null){
            return redirect()->route('commandeMateriaus.index')
                         ->with('warning',"N'éxiste aucun commande avec ce code");
        }
        //
        $commandeMateriau = CommandeMateriau::where('commande_id', '=', $commande->id)->first();
        if ($commandeMateriau === null) {
            // dd($chantiers);
             return redirect()->route('commandeMateriaus.index')
                         ->with('warning',"Cette commande n'a pas encore des matériaux");
         }
         
         return redirect()->route('commandeMateriaus.showMateriaux',$commande->id);

    }
    
}
