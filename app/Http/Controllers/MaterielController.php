<?php

namespace App\Http\Controllers;

use App\Models\Materiel;
use Illuminate\Http\Request;

class MaterielController extends Controller
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
        $materiels = Materiel::all();
        return view('materiels.index', compact('materiels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('materiels.create');
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
            'code_materiel' => 'required',
            'intitule_materiel' => 'required',
            'type_interne_externe' => 'required',
            'taux_consommation' => 'required',
            'quantite' => 'required',
        ]);

        $materiel = Materiel::where('code_materiel', '=', $request->code_materiel)->first();
        if ($materiel === null) {
            Materiel::create($request->all());
            return redirect()->back()
                            ->with('success','Materiel ajouté avec succes.');
        }
        else{
        return redirect()->back()
                        ->with('error_code', 1);
                        
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function show(Materiel $materiel)
    {
        return view('materiels.show', compact('materiel'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function edit(Materiel $materiel)
    {
        return view('materiels.edit', [
            'materiel' => $materiel
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materiel $materiel)
    {
        $request->validate([
            'code_materiel' => 'required',
            'intitule_materiel' => 'required',
            'type_interne_externe' => 'required',
            'taux_consommation' => 'required',
            'quantite' => 'required',
        ]);
        if($request->code_materiel !== $materiel->code_materiel){
            $f = Materiel::where('code_materiel', '=', $request->code_materiel)->first();
            if ($f !== null) {
                return redirect()->back()
                ->with('error_code', 1);
            }
        }

        Materiel::where('id', '=',$materiel->id)->update($request->except(['_token','_method']));
    
         return redirect()->route('materiels.gestionForm')
         ->with('success','Modification avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function destroyMateriel(Materiel $materiel)
    {
        try {
          //  dd($materiel->id);

            $materiel->delete();
           // dd($a);
            return redirect()->route('materiels.gestionForm')
                        ->with('success','Materiel supprimé avec succes.');
        
          } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('materiels.gestionForm')
                    ->with('error','Vous ne pouvez pas supprimé cet enregistrement.');
             // var_dump($e->errorInfo);
          }    
        
    }


    public function gestionForm(){
        if (isset($_GET['ajouter'])) {
          // dd($_GET['ajouter']);
            return redirect()->route('materiels.create');
        }

        if (isset($_GET['modifier'])) {
            $materiels = materiel::all();
            // dd ($materiels);
            return view('materiels.gestion', compact('materiels'));
            }
            else{
                $materiels = materiel::all();
                return view('materiels.gestion', compact('materiels'));
            }

        
    }

    public function gotoIndex(){
        if(isset($_GET['materiel_id'])) {
            $id = $_GET['materiel_id'];
    
            if (isset($_GET['supprimer'])) {
              // dd($_GET['supprimer']);
             $materiel = Materiel::find($id);
             // dd($materiel);
                return redirect()->route('materiels.destroyMateriel', $materiel);
            }
    
            if (isset($_GET['modifier2'])) {
                return redirect()->route('materiels.edit', $id);
                }
    
                if (isset($_GET['consulter'])) {
                  //  dd($_GET['consulter']);

                    return redirect()->route('materiels.show',$id);
                    }
          } else {
            $materiels = materiel::all();
            // dd ($materiels);
            return view('materiels.gestion', compact('materiels'))
                    ->with('error','Pouvez vous choisir un materiel!');
             // var_dump($e->errorInfo);
          } 
   
  
    }

}

