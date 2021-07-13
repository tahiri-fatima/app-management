<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use App\Models\Commande;
use App\Models\CommandeMateriau;
use App\Models\Fournisseur;
use App\Models\Materiau;
use Illuminate\Http\Request;

class CommandeController extends Controller
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
        $commandes = Commande::all();
        return view('commandes.index', compact('commandes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $chantiers = Chantier::all();
        $fournisseurs = Fournisseur::all();
    
        return view('commandes.create', compact('chantiers', 'fournisseurs'));
        //return view('commandes.create');
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
            'code_commande' => 'required',
            'date_commande' => 'required',
            'chantier_id' => 'required',
            'fournisseur_id' => 'required'
        ]);

        $commande = Commande::where('code_commande', '=', $request->code_commande)->first();
        if ($commande === null) {
            $request->merge(['total_commande' => 0]);

            $commande = Commande::create($request->all());
          //  $commande->materiaus()->attach($request->materiaus);
           /* $materiaus = Materiau::all();
            $fournisseur = Fournisseur::where('id', '=', $commande->fournisseur_id)->first();
            $request = null;
            return  view('commandeMateriaus.create', compact('materiaus','commande', 'fournisseur'));*/
            return redirect()->back()
                            ->with('success','Enregistrement ajouté avec succes.');
        }
        else{
        return redirect()->back()
                        ->with('error_code', 5);
                        
        } 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function show(Commande $commande)
    {
       
        //return view('commandes.show', compact('commande'));
        $chantier = Chantier::where('id', '=', $commande->chantier_id)->first();
        $fournisseur = Fournisseur::where('id', '=', $commande->fournisseur_id)->first();
        return view('commandes.show', compact('commande', 'chantier', 'fournisseur'));
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function edit(Commande $commande)
    {
        /* return view('commandes.edit', [
            'commande' => $commande
        ]); */
        $materiaus = Materiau::all();
        $fournisseurs = Fournisseur::all();
        $chantiers = Chantier::all();
        $fournisseur = Fournisseur::where('id', '=', $commande->fournisseur_id)->first();
        $chantier = Chantier::where('id', '=', $commande->chantier_id)->first();
        return view('commandes.edit', [
            'commande' => $commande,
            'chantiers' => $chantiers, 
            'chantier' => $chantier,
            'fournisseurs' => $fournisseurs, 
            'fournisseur' => $fournisseur,
            'materiaus' => $materiaus
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commande $commande)
    {
        $request->validate([
            'code_commande' => 'required',
            'date_commande' => 'required',
            'chantier_id' => 'required',
            'fournisseur_id' => 'required'
        ]);

        if($request->code_commande !== $commande->code_commande){
            $c = Commande::where('code_commande', '=', $request->code_commande)->first();
            if ($c !== null) {
                return redirect()->back()
                ->with('error_code', 5);
            }

        }

        Commande::where('id', '=',$commande->id)->update($request->except(['_token','_method', 'materiaus']));
        return redirect()->route('commandes.gestionForm')
        ->with('success','Modification avec succès');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commande  $commande
     * @return \Illuminate\Http\Response
     */
    public function destroyCommande(Commande $commande)
    {
        try {
          //  dd($commande->id);

            $commande->delete();
           // dd($a);
            return redirect()->route('commandes.gestionForm')
                        ->with('success','Commande supprimé avec succes.');
        
          } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('commandes.gestionForm')
                    ->with('error','Vous ne pouvez pas supprimé cet enregistrement.');
             // var_dump($e->errorInfo);
          }    
        
    }


    public function gestionForm(){
        if (isset($_GET['ajouter'])) {
          // dd($_GET['ajouter']);
            return redirect()->route('commandes.create');
        }

        if (isset($_GET['modifier'])) {
            $commandes = commande::all();
            // dd ($commandes);
            return view('commandes.gestion', compact('commandes'));
            }
            else{
                $commandes = commande::all();
                return view('commandes.gestion', compact('commandes'));
            }

        
    }

    public function gotoIndex(){
        if(isset($_GET['commande_id'])) {
            $id = $_GET['commande_id'];
    
            if (isset($_GET['supprimer'])) {
              // dd($_GET['supprimer']);
             $commande = Commande::find($id);
             // dd($commande);
                return redirect()->route('commandes.destroyCommande', $commande);
            }
    
            if (isset($_GET['modifier2'])) {
                return redirect()->route('commandes.edit', $id);
                }
    
                if (isset($_GET['consulter'])) {
                  //  dd($_GET['consulter']);

                    return redirect()->route('commandes.show',$id);
                    }
          } else {
            $commandes = commande::all();
            // dd ($commandes);
            return view('commandes.gestion', compact('commandes'))
                    ->with('error','Pouvez vous choisir un commande!');
             // var_dump($e->errorInfo);
          } 
   
  
    }

    public function getMateriaux($id){
        $commande = Commande::find($id);
        $fournisseur = Fournisseur::where('id', '=', $commande->fournisseur_id)->first();
        $commandeMateriaus = CommandeMateriau::where('commande_id', '=', $id)->get();

        $materiaus = $commande->materiaus;
        if ($commandeMateriaus !== null){
            foreach($materiaus as $materiau){
                foreach($commandeMateriaus as $cm){
                    if($cm->materiau_id === $materiau->id){
                        $materiau->setAttribute('montant_materiau', $cm->montant_materiau);
                    }  
                }
            }
        }
  // echo json_encode($commandeMateriaus); 

        return  view('commandes.getMateriaux', compact('materiaus','commande', 'fournisseur'));
    }

    
    public function listeCommandes($id){
        $chantier = Chantier::find($id);
        $commandes = Commande::where('chantier_id', '=', $id)->get();
      //  dd($commandes);
        $fournisseurs = Fournisseur::all();
        $total = 0.0;
        foreach($commandes as $commande){
            foreach($fournisseurs as $fournisseur){
                if($commande->fournisseur_id === $fournisseur->id){
                    $commande->setAttribute('intitule_fournisseur', $fournisseur->intitule_fournisseur);
                    break;
                }  
            }
            $total += $commande->total_commande;
        }
        $chantier->setAttribute('total', $total);
        //dd($commandes);
        
        return  view('commandes.liste', compact('commandes', 'chantier'));
    }
    
    public function listeMateriauxCommande()
    {
        $commandes = Commande::all();
        return view('edition.listeMateriauxCommande', compact('commandes'));
    }
}
