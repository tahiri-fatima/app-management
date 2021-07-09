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
        return redirect()->route('consommationMateriels.show', [$consommationMateriel])
        ->with('success','Modification avec succès');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConsommationMateriel  $consommationMateriel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConsommationMateriel $consommationMateriel)
    {
        $consommationMateriel->delete();
        return redirect()->route('consommationMateriels.index')
                        ->with('success','Consommation du materiel a supprimé avec succes.');
    }

    public function search(){
        $search_c = $_GET['code_consommation_mat'];

        $consommationMateriels = ConsommationMateriel::query()
        ->where('code_consommation_mat', 'like', "%".$search_c."%")
        ->orderBy('created_at', 'desc')
        ->get();

        if ($consommationMateriels->isEmpty()) {
            return redirect()->back()
                        ->with('error_code',0);
        }
        else{
            return view('consommationMateriels.search', compact('consommationMateriels'));

        }
        

    }
}
