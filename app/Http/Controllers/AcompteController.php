<?php

namespace App\Http\Controllers;

use App\Models\Acompte;
use App\Models\Facture;
use Illuminate\Http\Request;

class AcompteController extends Controller
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
        $acomptes = Acompte::all();
        return view('acomptes.index', compact('acomptes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $factures = Facture::all();
        return view('acomptes.create', compact('factures'));
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
            'code_acompte' => 'required',
            'date_acompte' => 'required',
            'montant_acompte' => 'required',
            'type_reglement' => 'required',
            'facture_id' => 'required'
        ]);

        $acompte = Acompte::where('code_acompte', '=', $request->code_acompte)->first();
        if ($acompte === null) {
            $facture = Facture::where('id', '=', $request->facture_id)->first();
            if ($facture === null) {
                return redirect()->back()
                        ->with('error_code', 2);
            }
            $facture->cumul_acompte += $request->montant_acompte;
            $facture->save();
            Acompte::create($request->all());
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
     * @param  \App\Models\Acompte  $acompte
     * @return \Illuminate\Http\Response
     */
    public function show(Acompte $acompte)
    {
        $facture = Facture::where('id', '=', $acompte->facture_id)->first();
        return view('acomptes.show', compact('acompte', 'facture'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Acompte  $acompte
     * @return \Illuminate\Http\Response
     */
    public function edit(Acompte $acompte)
    {
        $factures = Facture::all();
        $facture = Facture::where('id', '=', $acompte->facture_id)->first();
        return view('acomptes.edit', [
            'acompte' => $acompte,
            'factures' => $factures, 
            'facture' => $facture
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Acompte  $acompte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Acompte $acompte)
    {
        $request->validate([
            'code_acompte' => 'required',
            'date_acompte' => 'required',
            'montant_acompte' => 'required',
            'type_reglement' => 'required',
            'facture_id' => 'required'
        ]);

         if($request->code_acompte !== $acompte->code_acompte){
            $p = Acompte::where('code_acompte', '=', $request->code_acompte)->first();
            if ($p !== null) {
                return redirect()->back()
                ->with('error_code', 5);
            }
        }

        Acompte::where('id',$acompte->id)->update($request->except(['_token','_method']));

        $acomptes = acompte::all();
        return redirect()->route('acomptes.gestionForm')
                            ->with('success','Modification avec succès');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Acompte  $acompte
     * @return \Illuminate\Http\Response
     */
    public function destroyAcompte(Acompte $acompte)
    {
        try {
          //  dd($acompte->id);

            $acompte->delete();
           // dd($a);
            return redirect()->route('acomptes.gestionForm')
                        ->with('success','Acompte supprimé avec succes.');
        
          } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('acomptes.gestionForm')
                    ->with('error','Vous ne pouvez pas supprimé cet enregistrement.');
             // var_dump($e->errorInfo);
          }    
        
    }


    public function gestionForm(){
        if (isset($_GET['ajouter'])) {
          // dd($_GET['ajouter']);
            return redirect()->route('acomptes.create');
        }

        if (isset($_GET['modifier'])) {
            $acomptes = acompte::all();
            // dd ($acomptes);
            return view('acomptes.gestion', compact('acomptes'));
            }
            else{
                $acomptes = acompte::all();
                return view('acomptes.gestion', compact('acomptes'));
            }

        
    }

    public function gotoIndex(){
        if(isset($_GET['acompte_id'])) {
            $id = $_GET['acompte_id'];
    
            if (isset($_GET['supprimer'])) {
              // dd($_GET['supprimer']);
             $acompte = Acompte::find($id);
             // dd($acompte);
                return redirect()->route('acomptes.destroyAcompte', $acompte);
            }
    
            if (isset($_GET['modifier2'])) {
                return redirect()->route('acomptes.edit', $id);
                }
    
                if (isset($_GET['consulter'])) {
                  //  dd($_GET['consulter']);

                    return redirect()->route('acomptes.show',$id);
                    }
          } else {
            $acomptes = acompte::all();
            // dd ($acomptes);
            return view('acomptes.gestion', compact('acomptes'))
                    ->with('error','Pouvez vous choisir un acompte!');
             // var_dump($e->errorInfo);
          } 
   
  
    }
    
}
