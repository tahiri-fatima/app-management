<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use App\Models\ChantierNatureFrais;
use App\Models\Frais;
use App\Models\NatureFrais;
use Illuminate\Http\Request;

class FraisController extends Controller
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
        $frais = Frais::all();
        return view('frais.index', compact('frais'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('frais.create');
        $chantiers = Chantier::all();
        $nature_frais = NatureFrais::all();
        return view('frais.create', compact('chantiers','nature_frais'));
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
            'code_frais' => 'required',
            'nature_frais_id' => 'required',
            'date_frais' => 'required',
            'cible_frais' => 'required',
            'chantier_id' => 'required',
        ]);

        $frais = Frais::where('code_frais', '=', $request->code_frais)->first();
        if ($frais === null) {
            Frais::create($request->all());
            return redirect()->back()
                            ->with('success','frais ajouté avec succes.');
        }
        else{
        return redirect()->back()
                        ->with('error_code', 5);
                        
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Frais  $frais
     * @return \Illuminate\Http\Response
     */
    public function show(Frais $frai)
    {
        //return view('frais.show', compact('frai'));
        $chantier = Chantier::where('id', '=', $frai->chantier_id)->first();
        $nature_frais = NatureFrais::where('id', '=', $frai->nature_frais_id)->first();

        return view('frais.show', compact('frai', 'chantier','nature_frais'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Frais  $frais
     * @return \Illuminate\Http\Response
     */
    public function edit(Frais $frai)
    {
        /*
        return view('frais.edit', [
            'frai' => $frai
        ]); */

        $chantiers = Chantier::all();
        $nature_frais = NatureFrais::all();
        $nature_frai = NatureFrais::where('id', '=', $frai->nature_frais_id)->first();
        $chantier = Chantier::where('id', '=', $frai->chantier_id)->first();
        return view('frais.edit', [
            'frai' => $frai,
            'chantiers' => $chantiers, 
            'chantier' => $chantier,
            'nature_frais' => $nature_frais, 
            'nature_frai' => $nature_frai
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Frais  $frais
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Frais $frai)
    {
        $request->validate([
            'code_frais' => 'required',
            'nature_frais_id' => 'required',
            'date_frais' => 'required',
            'cible_frais' => 'required',
            'chantier_id' => 'required',
        ]);
    
        if($request->code_frais !== $frai->code_frais){
            $f = Frais::where('code_frais', '=', $request->code_frais)->first();
            if ($f !== null) {
                return redirect()->back()
                ->with('error_code', 5);
            }
        }

        Frais::where('id', '=',$frai->id)->update($request->except(['_token','_method']));
        return redirect()->route('frais.show', [$frai])
        ->with('success','Modification avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Frais  $frais
     * @return \Illuminate\Http\Response
     */
    public function destroy(Frais $frai)
    {
        try {
            $frai->delete();
            return redirect()->route('frais.index')
                        ->with('success','frais supprimé avec succes.');
          } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('frais.index')
                    ->with('error','Vous ne pouvez pas supprimé cet enregistrement.');
             // var_dump($e->errorInfo);
          }
        
    }

    public function search(){
        $search_c = $_GET['code_frais'];

        $frais = Frais::query()
        ->where('code_frais', 'like', "%".$search_c."%")
        ->orderBy('created_at', 'desc')
        ->get();

        if ($frais->isEmpty()) {
            return redirect()->back()
                        ->with('error_code',0);
        }
        
        return view('frais.search', compact('frais'));
    }

    public function getFrais($id){
        $frais = Frais::where('chantier_id', '=', $id)->get();
        $chantier = Chantier::where('id', '=', $id)->first();
        if ($frais->isEmpty()) {
            return redirect()->back()
                        ->with('warning','Ce chantier n\'a pas des frais');
        }
        $total=0;
        foreach($frais as $frai){
            $nature = NatureFrais::find($frai->nature_frais_id);
            $chantier_nat = ChantierNatureFrais::query()
                ->where('chantier_id', '=', $id)
                ->where('nature_frais_id', '=', $nature->id)
                ->first();
            $frai->setAttribute('nature_frais', $nature->nature_frais);
            $frai->setAttribute('montant_estime', $chantier_nat->montant_estimee);
//dd($chantier_nat);
            $total += $chantier_nat->montant_estimee;
        }
        
       $chantier->setAttribute('total', $total);
     // dd($chantier);
        return view('frais.getFraisEstime', compact('frais', 'chantier'));
    }

   
}
