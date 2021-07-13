<?php

namespace App\Http\Controllers;

use App\Models\ConsommationMateriel;
use App\Models\Materiel;
use Illuminate\Http\Request;

class ConsommationMaterielController extends Controller
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
        $consommationMateriels = ConsommationMateriel::all();
        return view('consommationMateriels.index', compact('consommationMateriels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materiels = Materiel::all();
        return view('consommationMateriels.create', compact('materiels'));
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
            'code_consommation_mat' => 'required',
            'quantite_consommation_mat' => 'required',
            'date_consommation_mat' => 'required',
            'materiel_id' => 'required'
        ]);

        $consommationMateriel = ConsommationMateriel::where('code_consommation_mat', '=', $request->code_consommation_mat)->first();
        if ($consommationMateriel === null) {
            ConsommationMateriel::create($request->all());
            return redirect()->back()
                            ->with('success','Consommation du materiel a ajouté avec succes.');
        }
        else{
        return redirect()->back()
                        ->with('error_code', 5);
                        
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConsommationMateriel  $consommationMateriel
     * @return \Illuminate\Http\Response
     */
    public function show(ConsommationMateriel $consommationMateriel)
    {
        $materiel = Materiel::where('id', '=', $consommationMateriel->materiel_id)->first();
        return view('consommationMateriels.show', compact('consommationMateriel', 'materiel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ConsommationMateriel  $consommationMateriel
     * @return \Illuminate\Http\Response
     */
    public function edit(ConsommationMateriel $consommationMateriel)
    {

        $materiels = Materiel::all();
        $materiel = Materiel::where('id', '=', $consommationMateriel->materiel_id)->first();
        return view('consommationMateriels.edit', [
            'consommationMateriel' => $consommationMateriel,
            'materiels' => $materiels, 
            'materiel' => $materiel
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConsommationMateriel  $consommationMateriel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConsommationMateriel $consommationMateriel)
    {
        $request->validate([
            'code_consommation_mat' => 'required',
            'quantite_consommation_mat' => 'required',
            'date_consommation_mat' => 'required',
            'materiel_id' => 'required'
        ]);

        if($request->code_consommation_mat !== $consommationMateriel->code_consommation_mat){
            $p = ConsommationMateriel::where('code_consommation_mat', '=', $request->code_consommation_mat)->first();
            if ($p !== null) {
                return redirect()->back()
                ->with('error_code', 5);
            }

        }

        ConsommationMateriel::where('id', '=',$consommationMateriel->id)->update($request->except(['_token','_method']));
        return redirect()->route('consommationMateriels.gestionForm')
        ->with('success','Modification avec succès');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConsommationMateriel  $consommationMateriel
     * @return \Illuminate\Http\Response
     */
    public function destroyConsommationMateriel(ConsommationMateriel $consommationMateriel)
    {
        try {
          //  dd($consommationMateriel->id);

            $consommationMateriel->delete();
           // dd($a);
            return redirect()->route('consommationMateriels.gestionForm')
                        ->with('success','Consommation Matériel supprimé avec succes.');
        
          } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('consommationMateriels.gestionForm')
                    ->with('error','Vous ne pouvez pas supprimé cet enregistrement.');
             // var_dump($e->errorInfo);
          }    
        
    }


    public function gestionForm(){
        if (isset($_GET['ajouter'])) {
          // dd($_GET['ajouter']);
            return redirect()->route('consommationMateriels.create');
        }

        if (isset($_GET['modifier'])) {
            $consommationMateriels = consommationMateriel::all();
            // dd ($consommationMateriels);
            return view('consommationMateriels.gestion', compact('consommationMateriels'));
            }
            else{
                $consommationMateriels = consommationMateriel::all();
                return view('consommationMateriels.gestion', compact('consommationMateriels'));
            }

        
    }

    public function gotoIndex(){
        if(isset($_GET['consommationMateriel_id'])) {
            $id = $_GET['consommationMateriel_id'];
    
            if (isset($_GET['supprimer'])) {
              // dd($_GET['supprimer']);
             $consommationMateriel = ConsommationMateriel::find($id);
             // dd($consommationMateriel);
                return redirect()->route('consommationMateriels.destroyConsommationMateriel', $consommationMateriel);
            }
    
            if (isset($_GET['modifier2'])) {
                return redirect()->route('consommationMateriels.edit', $id);
                }
    
                if (isset($_GET['consulter'])) {
                  //  dd($_GET['consulter']);

                    return redirect()->route('consommationMateriels.show',$id);
                    }
          } else {
            $consommationMateriels = consommationMateriel::all();
            // dd ($consommationMateriels);
            return view('consommationMateriels.gestion', compact('consommationMateriels'))
                    ->with('error','Pouvez vous choisir un consommationMateriel!');
             // var_dump($e->errorInfo);
          } 
   
  
    }
}
