<?php

namespace App\Http\Controllers;

use App\Models\Acompte;
use App\Models\Commande;
use App\Models\Facture;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
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
        $fournisseurs = Fournisseur::all();
        return view('fournisseurs.index', compact('fournisseurs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fournisseurs.create');
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
            'code_fournisseur' => 'required',
            'intitule_fournisseur' => 'required',
            'telephone_fournisseur' => 'required',
            'email_fournisseur' => 'required'
        ]);

        $fournisseur = Fournisseur::where('code_fournisseur', '=', $request->code_fournisseur)->first();
        if ($fournisseur === null) {
            Fournisseur::create($request->all());
            return redirect()->back()
                            ->with('success','fournisseur ajouté avec succes.');
        }
        else{
        return redirect()->back()
                        ->with('error_code', 1);
                        
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function show(Fournisseur $fournisseur)
    {
        return view('fournisseurs.show', compact('fournisseur'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit(Fournisseur $fournisseur)
    {
        return view('fournisseurs.edit', [
            'fournisseur' => $fournisseur
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fournisseur $fournisseur)
    {
        $request->validate([
            'code_fournisseur' => 'required',
            'intitule_fournisseur' => 'required',
            'telephone_fournisseur' => 'required',
            'email_fournisseur' => 'required'
        ]);

        if($fournisseur->code_fournisseur != $request->code_fournisseur){
            $f = Fournisseur::where('code_fournisseur', '=', $request->code_fournisseur)->first();
            if ($f !== null) {
                return redirect()->back()
                            ->with('error_code', 1);
            }
        }
       
        Fournisseur::where('id',$fournisseur->id)->update($request->except(['_token','_method']));

         return redirect()->route('fournisseurs.gestionForm')
         ->with('success','Modification avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function destroyFournisseur(Fournisseur $fournisseur)
    {
        try {

            $fournisseur->delete();
           // dd($a);
            return redirect()->route('fournisseurs.gestionForm')
                        ->with('success','Fournisseur supprimé avec succes.');
        
          } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('fournisseurs.gestionForm')
                    ->with('error','Vous ne pouvez pas supprimé cet enregistrement.');
             // var_dump($e->errorInfo);
          }    
        
    }


    public function gestionForm(){
        if (isset($_GET['ajouter'])) {
          // dd($_GET['ajouter']);
            return redirect()->route('fournisseurs.create');
        }

        if (isset($_GET['modifier'])) {
            $fournisseurs = Fournisseur::all();
            return view('fournisseurs.gestion', compact('fournisseurs'));
            }
            else{
                $fournisseurs = fournisseur::all();
                return view('fournisseurs.gestion', compact('fournisseurs'));
            }

        
    }

    public function gotoIndex(){
        if(isset($_GET['fournisseur_id'])) {
            $id = $_GET['fournisseur_id'];
    
            if (isset($_GET['supprimer'])) {
              // dd($_GET['supprimer']);
             $fournisseur = fournisseur::find($id);
                return redirect()->route('fournisseurs.destroyFournisseur', $fournisseur);
            }
    
            if (isset($_GET['modifier2'])) {
                return redirect()->route('fournisseurs.edit', $id);
                }
    
                if (isset($_GET['consulter'])) {
                  //  dd($_GET['consulter']);

                    return redirect()->route('fournisseurs.show',$id);
                    }
          } else {
            $fournisseurs = Fournisseur::all();
            return view('fournisseurs.gestion', compact('fournisseurs'))
                    ->with('error','Pouvez vous choisir un fournisseur!');
             // var_dump($e->errorInfo);
          } 
   
  
    }

    public function getCommandes($id){
        $fournisseur = Fournisseur::find($id);
        $commandes = Commande::where('fournisseur_id', '=', $id)->get();

        $total_montant_commandes = 0.0;
        $total_cumul_acompte = 0.0;
        if ($commandes !== null){
            foreach($commandes as $commande){
                $total_montant_commandes += $commande->total_commande;
                $facture = Facture::where('commande_id', '=', $commande->id)->first();
                if ($facture === null){
                    $cumul_acompte = 0.0;
                }else{
                    $cumul_acompte = $facture->cumul_acompte;
                }
                $commande->setAttribute('cumul_acompte', $cumul_acompte);
                $total_cumul_acompte += $cumul_acompte;
                /*if($commande->materiau_id === $materiau->id){
                    //$materiau->setAttribute('montant_materiau', $cm->montant_materiau);
                }  */
              //  dd($commande);

            }
            $fournisseur->setAttribute('total_montant_commandes', $total_montant_commandes);
            $fournisseur->setAttribute('total_cumul_acompte', $total_cumul_acompte);
            $fournisseur->setAttribute('montant_net', $total_montant_commandes-$total_cumul_acompte);


        }
  // echo json_encode($commandeMateriaus); 

        return  view('fournisseurs.getCommandes', compact('commandes', 'fournisseur'));
    }

    public function listeCommandesFournisseur()
    {
        $fournisseurs = Fournisseur::all();
        return view('edition.listeCommandesFournisseur', compact('fournisseurs'));
    }
}
