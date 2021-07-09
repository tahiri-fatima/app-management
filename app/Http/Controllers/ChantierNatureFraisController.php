<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use App\Models\ChantierNatureFrais;
use App\Models\NatureFrais;
use Illuminate\Http\Request;

class ChantierNatureFraisController extends Controller
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
        $chantierNatureFrais = ChantierNatureFrais::all();
        $chantiers = [];
        foreach ($chantierNatureFrais as $chantierNatFrai){
            $chantier = Chantier::where('id', '=', $chantierNatFrai->chantier_id)->first();
            if(!in_array ( $chantier, $chantiers)){
                array_push($chantiers, $chantier);
            }
        } //dd($chantiers);
        return view('chantierNatureFrais.index', compact('chantiers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nature_frais = NatureFrais::all();
        $chantiers = Chantier::all();
        return view('chantierNatureFrais.create', compact( 'chantiers', 'nature_frais'));
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
            'chantier_id' => 'required',
            'nature_frais' => 'required',
            'montant_estimee' => 'required'
        ]); 
//dd($request);
        foreach ($request->nature_frais as $nature_frai){
            $chantierNatureFrai = new ChantierNatureFrais();
            $chantierNatureFrai->chantier_id = $request->chantier_id;

            $co = ChantierNatureFrais::query()
            ->where('chantier_id', '=', $request->chantier_id)
            ->where('nature_frais_id', '=', $nature_frai)
            ->first(); 

            if ($co !== null) {
                return redirect()->back()
                        ->with('error_code', 1);
            }else{
                for($k=0; $k<count($request->montant_estimee) ; $k++){
                    $nf = NatureFrais ::where('code_nature_frais', '=', $request->code_nature_frais[$k])->first();
                    if($nf->id == $nature_frai){
                        $chantierNatureFrai->montant_estimee = $request->montant_estimee[$k];                        
                        $chantierNatureFrai->nature_frais_id = $nature_frai;
                        $chantierNatureFrai->save();
                    }
        
                } 
            } 
        }       

        $chantiers = Chantier::all();
        $nature_frais = NatureFrais::all();

        return redirect()->route('chantierNatureFrais.create', compact('chantiers',  'nature_frais'))
                ->with('success','Enregistrement ajouté avec succes.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChantierNatureFrais  $chantierNatureFrais
     * @return \Illuminate\Http\Response
     */
    public function showNatureFrais(Chantier $chantier)
    {
        $nature_frais = [];
        $total =0.0;
        $chantierNatureFrais = ChantierNatureFrais::where('chantier_id', '=', $chantier->id)->get();
        foreach($chantierNatureFrais as $chantierNatureFrai){
            $nature_frai = NatureFrais::where('id', '=', $chantierNatureFrai->nature_frais_id)->first();
            $nature_frai->setAttribute('montant_estimee', $chantierNatureFrai->montant_estimee);
            
            $total += $chantierNatureFrai->montant_estimee;
            array_push($nature_frais, $nature_frai);
        }
        $chantier->setAttribute('nature_frais', $nature_frais);
        $chantier->setAttribute('total', $total);
        return view('chantierNatureFrais.show', compact( 'chantier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChantierNatureFrais  $chantierNatureFrais
     * @return \Illuminate\Http\Response
     */
    public function editNatureFrais(Chantier $chantier)
    {
        $nature_frais = NatureFrais::all();
        $chantiers = Chantier::all();

        $natureFrais = [];
        $chantierNatureFrais = chantierNatureFrais::where('chantier_id', '=', $chantier->id)->get();
        foreach($chantierNatureFrais as $chantierNatureFrai){
          $natureFrais[] = $chantierNatureFrai->nature_frais_id;
          $natureFrais[] = $chantierNatureFrai->montant_estimee;
 
        }//dd($ops);
        return view('chantierNatureFrais.edit', [
            'chantierNatureFrais' => $chantierNatureFrais,
            'nature_frais' => $nature_frais,
            'chantiers' => $chantiers,
            'natureFrais' => $natureFrais,
            'chantier' => $chantier
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChantierNatureFrais  $chantierNatureFrais
     * @return \Illuminate\Http\Response
     */
    public function updateNatureFrais(Request $request, Chantier $chantier)
    {
        $request->validate([
            'chantier_id' => 'required',
            'nature_frais' => 'required',
            'montant_estimee' => 'required'
        ]); 

        $chantierNatureFrais = ChantierNatureFrais::query()
        ->where('chantier_id', '=', $chantier->id)
        ->get(); 

        foreach ($chantierNatureFrais as $chantierNatureFrai){
            // 
             if(!in_array($chantierNatureFrai->nature_frais_id, $request->nature_frais)){
               $chantierNatureFrai->delete();
             }
         }

        foreach ($request->nature_frais as $nature_frai){

            $chantierNatureFrai = ChantierNatureFrais::query()
            ->where('chantier_id', '=', $request->chantier_id)
            ->where('nature_frais_id', '=', $nature_frai)
            ->first(); 

            if ($chantierNatureFrai !== null) {
                for($k=0; $k<count($request->montant_estimee) ; $k++){
                    $op = NatureFrais::where('code_nature_frais', '=', $request->code_nature_frais[$k])->first();
                    if($op->id == $nature_frai){
                        $chantierNatureFrai->montant_estimee = $request->montant_estimee[$k];
                        
                        $chantierNatureFrai->nature_frais_id = $nature_frai;
                        $chantierNatureFrai->update();
                        
                    }
                }
            }else{
                $chantierNatureFrai = new ChantierNatureFrais();
                $chantierNatureFrai->chantier_id = $request->chantier_id;

                for($k=0; $k<count($request->montant_estimee) ; $k++){
                    $nf = NatureFrais::where('code_nature_frais', '=', $request->code_nature_frais[$k])->first();
                    if($nf->id == $nature_frai){
                        $chantierNatureFrai->montant_estimee = $request->montant_estimee[$k]; 
                        $chantierNatureFrai->nature_frais_id = $nature_frai;
                       
                        $chantierNatureFrai->save();
                    }
        
                } 
            } 
        } 
        
        return redirect()->route('chantierNatureFrais.showNatureFrais', [$chantier])
        ->with('success','Modification avec succès');
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChantierNatureFrais  $chantierNatureFrais
     * @return \Illuminate\Http\Response
     */
    public function destroyChantierNatureFrais(Chantier $chantier)
    {
        $chantierNatureFrais = chantierNatureFrais::where('chantier_id', '=', $chantier->id)->get();
        foreach ($chantierNatureFrais as $chantierNatureFrai){
            $chantierNatureFrai->delete();
        }
        
        return redirect()->route('chantierNatureFrais.index')
                        ->with('success','Les natures du frais du chantier sont supprimé avec succes.');
    }

    public function search(){

        $search_c = $_GET['codechantier'];
        if ($search_c === ''){
            return redirect()->back();
        }
        // get chantier
        $chantier = Chantier::where('code_chantier', '=', $search_c)->first();
        if ($chantier === null){
            return redirect()->route('chantierNatureFrais.index')
                         ->with('warning',"N'éxiste aucun chantier avec ce code");
        }
        //
        $chantierNatureFrai = ChantierNatureFrais::where('chantier_id', '=', $chantier->id)->first();
        if ($chantierNatureFrai === null) {
            // dd($chantiers);
             return redirect()->route('chantierNatureFrais.index')
                         ->with('warning',"Ce chantier n'a pas encore des natures des frais");
         }
         
         return redirect()->route('chantierNatureFrais.showNatureFrais',$chantier->id);

    }
}
