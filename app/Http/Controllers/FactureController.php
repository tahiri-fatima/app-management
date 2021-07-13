<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Facture;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use NumberToWords\NumberToWords;


class FactureController extends Controller
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
        $factures = Facture::all();
        return view('factures.index', compact('factures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $commandes = Commande::all();
        return view('factures.create', compact( 'commandes'));
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
            'code_facture' => 'required',
            'date_facture' => 'required',
            'montant_facture' => 'required',
            'reglee' => 'required',
            'commande_id' => 'required'
        ]);

       /*  // create the number to words "manager" class
         $numberToWords = new NumberToWords();

         // build a new number transformer using the RFC 3066 language identifier
         $numberTransformer = $numberToWords->getNumberTransformer('fr');
         $montant_en_lettre = $numberTransformer->toWords($request->montant_facture); // outputs "five thousand one hundred twenty"
 */
        

        $montant_en_lettre = Facture::numberTowords($request->montant_facture);
        $request->request->add(['montant_en_lettre' => $montant_en_lettre]); //add request
        $cumul_facture = 0.0;
        $request->request->add(['cumul_facture' => $cumul_facture]); //add request
         $facture = Facture::where('code_facture', '=', $request->code_facture)->first();
        if ($facture === null) {
            $commande = Commande::where('id', '=', $request->commande_id)->first();
            if($commande === null){
                return redirect()->back()
                            ->with('error_code', 2);
            }
            Facture::create($request->all());
            return redirect()->back()
                            ->with('success','Facture ajouté avec succes.');
        }
        else{
        return redirect()->back()
                        ->with('error_code', 1);
                        
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function show(Facture $facture)
    {
        $commande = Commande::where('id', '=', $facture->commande_id)->first();
        return view('factures.show', compact('facture', 'commande'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function edit(Facture $facture)
    {
        $commandes = Commande::all();
        $commande = Commande::where('id', '=', $facture->commande_id)->first();
        return view('factures.edit', [
            'facture' => $facture,
            'commandes' => $commandes, 
            'commande' => $commande
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facture $facture)
    {
        $request->validate([
            'code_facture' => 'required',
            'date_facture' => 'required',
            'montant_facture' => 'required',
            'reglee' => 'required',
            'commande_id' => 'required'
        ]);
        
        $montant_en_lettre = Facture::numberTowords($request->montant_facture);
        $request->request->add(['montant_en_lettre' => $montant_en_lettre]); //add request
        if($request->code_facture !== $facture->code_facture){
            $f = Facture::where('code_facture', '=', $request->code_facture)->first();
            if ($f !== null) {
                return redirect()->back()
                ->with('error_code', 5);
            }

        }

        Facture::where('id', '=',$facture->id)->update($request->except(['_token','_method']));

         return redirect()->route('factures.gestionForm')
         ->with('success','Modification avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function destroyFacture(Facture $facture)
    {
        try {
          //  dd($facture->id);

            $facture->delete();
           // dd($a);
            return redirect()->route('factures.gestionForm')
                        ->with('success','Facture supprimé avec succes.');
        
          } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('factures.gestionForm')
                    ->with('error','Vous ne pouvez pas supprimé cet enregistrement.');
             // var_dump($e->errorInfo);
          }    
        
    }


    public function gestionForm(){
        if (isset($_GET['ajouter'])) {
          // dd($_GET['ajouter']);
            return redirect()->route('factures.create');
        }

        if (isset($_GET['modifier'])) {
            $factures = facture::all();
            // dd ($factures);
            return view('factures.gestion', compact('factures'));
            }
            else{
                $factures = facture::all();
                return view('factures.gestion', compact('factures'));
            }

        
    }

    public function gotoIndex(){
        if(isset($_GET['facture_id'])) {
            $id = $_GET['facture_id'];
    
            if (isset($_GET['supprimer'])) {
              // dd($_GET['supprimer']);
             $facture = Facture::find($id);
             // dd($facture);
                return redirect()->route('factures.destroyFacture', $facture);
            }
    
            if (isset($_GET['modifier2'])) {
                return redirect()->route('factures.edit', $id);
                }
    
                if (isset($_GET['consulter'])) {
                  //  dd($_GET['consulter']);

                    return redirect()->route('factures.show',$id);
                    }
          } else {
            $factures = facture::all();
            // dd ($factures);
            return view('factures.gestion', compact('factures'))
                    ->with('error','Pouvez vous choisir un facture!');
             // var_dump($e->errorInfo);
          } 
   
  
    }
}
