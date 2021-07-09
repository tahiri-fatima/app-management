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
    
         return redirect()->route('materiels.show', [$materiel])
         ->with('success','Modification avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materiel $materiel)
    {
        try {
            $materiel->delete();
            return redirect()->route('materiels.index')
                        ->with('success','Materiel supprimé avec succes.');
          } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('materiels.index')
                    ->with('error','Vous ne pouvez pas supprimé cet enregistrement.');
             // var_dump($e->errorInfo);
          }
        
    }

    public function search(){
        $search_c = $_GET['code_materiel'];
        $search_i = $_GET['intitule_materiel'];

        if ($search_c == null){
            $search_c = '#';
        }
        if ($search_i == null){
            $search_i = '#';
        }

        $materiels = Materiel::query()
        ->where('code_materiel', 'like', "%".$search_c."%")
        ->orWhere('intitule_materiel', 'like', "%".$search_i."%")
        ->orderBy('created_at', 'desc')
        ->get();

        if ($materiels->isEmpty()) {
            return redirect()->route('materiels.index')
                        ->with('warning',"N'éxiste aucun materiel avec les informations de la recherche");
        }
        
        return view('materiels.search', compact('materiels'));
    }

}

