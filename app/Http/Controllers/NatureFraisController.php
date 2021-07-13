<?php

namespace App\Http\Controllers;

use App\Models\NatureFrais;
use Illuminate\Http\Request;

class NatureFraisController extends Controller
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
        $natureFrais = NatureFrais::all();
        return view('natureFrais.index', compact('natureFrais'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('natureFrais.create');
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
            'code_nature_frais' => 'required',
            'nature_frais' => 'required'
        ]);

        $natureFrais = NatureFrais::where('code_nature_frais', '=', $request->code_nature_frais)->first();
        if ($natureFrais === null) {
            NatureFrais::create($request->all());
            return redirect()->back()
                            ->with('success','nature de frais ajouté avec succes.');
        }
        else{
        return redirect()->back()
                        ->with('error_code', 5);
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NatureFrais  $natureFrais
     * @return \Illuminate\Http\Response
     */
    public function show(NatureFrais $natureFrai)
    {//dd($natureFrai);
        return view('natureFrais.show', compact('natureFrai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NatureFrais  $natureFrais
     * @return \Illuminate\Http\Response
     */
    public function edit(NatureFrais $natureFrai)
    {
        return view('natureFrais.edit', [
            'natureFrai' => $natureFrai
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NatureFrais  $natureFrais
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NatureFrais $natureFrai)
    {
        $request->validate([
            'code_nature_frais' => 'required',
            'nature_frais' => 'required'
        ]);
        if($request->code_nature_frais !== $natureFrai->code_nature_frais){
            $f = NatureFrais::where('code_nature_frais', '=', $request->code_nature_frais)->first();
            if ($f !== null) {
                return redirect()->back()
                ->with('error_code', 5);
            }
        }

        NatureFrais::where('id', '=',$natureFrai->id)->update($request->except(['_token','_method']));
        return redirect()->route('natureFrais.gestionForm')
        ->with('success','Modification avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NatureFrais  $natureFrais
     * @return \Illuminate\Http\Response
     */
    public function destroyNatureFrais(NatureFrais $natureFrai)
    {
        try {
          //  dd($natureFrai->id);

            $natureFrai->delete();
           // dd($a);
            return redirect()->route('natureFrais.gestionForm')
                        ->with('success','NatureFrais supprimé avec succes.');
        
          } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('natureFrais.gestionForm')
                    ->with('error','Vous ne pouvez pas supprimé cet enregistrement.');
             // var_dump($e->errorInfo);
          }    
        
    }


    public function gestionForm(){
        if (isset($_GET['ajouter'])) {
          // dd($_GET['ajouter']);
            return redirect()->route('natureFrais.create');
        }

        if (isset($_GET['modifier'])) {
            $natureFrais = NatureFrais::all();
            // dd ($natureFrais);
            return view('natureFrais.gestion', compact('natureFrais'));
            }
            else{
                $natureFrais = NatureFrais::all();
                return view('natureFrais.gestion', compact('natureFrais'));
            }

        
    }

    public function gotoIndex(){
        if(isset($_GET['natureFrai_id'])) {
            $id = $_GET['natureFrai_id'];
    
            if (isset($_GET['supprimer'])) {
              // dd($_GET['supprimer']);
             $natureFrai = NatureFrais::find($id);
             // dd($natureFrai);
                return redirect()->route('natureFrais.destroyNatureFrais', $natureFrai);
            }
    
            if (isset($_GET['modifier2'])) {
                return redirect()->route('natureFrais.edit', $id);
                }
    
                if (isset($_GET['consulter'])) {
                  //  dd($_GET['consulter']);

                    return redirect()->route('natureFrais.show',$id);
                    }
          } else {
            $natureFrais = NatureFrais::all();
            // dd ($natureFrais);
            return view('natureFrais.gestion', compact('natureFrais'))
                    ->with('error','Pouvez vous choisir un natureFrai!');
             // var_dump($e->errorInfo);
          } 
   
  
    }
}
