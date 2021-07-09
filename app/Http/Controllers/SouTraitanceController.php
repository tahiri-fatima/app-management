<?php

namespace App\Http\Controllers;

use App\Models\Sou_traitance;
use Illuminate\Http\Request;

class SouTraitanceController extends Controller
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
        $soutraitances = Sou_traitance::all();
        return view('soutraitances.index', compact('soutraitances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('soutraitances.create');
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
            'code_soutraitance' => 'required',
            'intitule_soutraitance' => 'required',
            'date_soutraitance' => 'required',
            'montant_soutraitance' => 'required'
        ]);

        $soutraitance = Sou_traitance::where('code_soutraitance', '=', $request->code_soutraitance)->first();
        if ($soutraitance === null) {
            Sou_traitance::create($request->all());
            return redirect()->back()
                            ->with('success','soutraitance ajouté avec succes.');
        }
        else{
        return redirect()->back()
                        ->with('error_code', 5);
                        
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sou_traitance  $soutraitance
     * @return \Illuminate\Http\Response
     */
    public function show(Sou_traitance $soutraitance)
    {
        return view('soutraitances.show', compact('soutraitance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sou_traitance  $soutraitance
     * @return \Illuminate\Http\Response
     */
    public function edit(Sou_traitance $soutraitance)
    {
        return view('soutraitances.edit', [
            'soutraitance' => $soutraitance
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sou_traitance  $soutraitance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sou_traitance $soutraitance)
    {
        $request->validate([
            'code_soutraitance' => 'required',
            'intitule_soutraitance' => 'required',
            'date_soutraitance' => 'required',
            'montant_soutraitance' => 'required'
        ]);
    
        if($request->code_soutraitance !== $soutraitance->code_soutraitance){
            $p = Sou_traitance::where('code_soutraitance', '=', $request->code_soutraitance)->first();
            if ($p !== null) {
                return redirect()->back()
                ->with('error_code', 5);
            }

        }

        Sou_traitance::where('id', '=',$soutraitance->id)->update($request->except(['_token','_method']));


         return redirect()->route('soutraitances.show', [$soutraitance])
         ->with('success','Modification avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sou_traitance  $soutraitance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sou_traitance $soutraitance)
    {
        try {
            $soutraitance->delete();
            return redirect()->route('soutraitances.index')
                     ->with('success','Sous traitance supprimé avec succes.');
          } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('soutraitances.index')
                    ->with('error','Vous ne pouvez pas supprimé cet enregistrement.');
             // var_dump($e->errorInfo);
          }
    }

    public function search(){
        $search_c = $_GET['code_soutraitance'];
        $search_i = $_GET['intitule_soutraitance'];

        if ($search_i == null){
            $search_i = '#';
        }
        if ($search_c == null){
            $search_c = '#';
        }

        $soutraitances = Sou_traitance::query()
        ->where('code_soutraitance', 'like', "%".$search_c."%")
        ->orWhere('intitule_soutraitance', 'like', "%".$search_i."%")
        ->orderBy('created_at', 'desc')
        ->get();

        if ($soutraitances->isEmpty()) {
            return redirect()->route('soutraitances.index')
                        ->with('warning',"N'éxiste aucun sous traitance avec les informations de la recherche");
        }
        
        return view('soutraitances.search', compact('soutraitances'));
    }
}
