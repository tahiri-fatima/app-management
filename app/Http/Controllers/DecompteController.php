<?php

namespace App\Http\Controllers;

use App\Models\Chantier;

use App\Models\Decompte;
use Redirect,Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Symfony\Component\Console\Input\Input;

use function Clue\StreamFilter\append;

class DecompteController extends Controller
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
        $decomptes = Decompte::all();
        return view('decomptes.index', compact('decomptes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('decomptes.create');

        $chantiers = Chantier::all();
  
        return view('decomptes.create', compact( 'chantiers'));
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
            'num_decompte' => 'required',
            'date_decompte' => 'required',
            'montant_decompte' => 'required',
            'accorde' => 'required',
            'revision_prix' => 'required',
            'chantier_id' => 'required'
        ]);
        $decompte = Decompte::where('num_decompte', '=', $request->num_decompte)->first();
        if ($decompte === null) {
            $chantier = Chantier::where('id', '=', $request->chantier_id)->first();
            $retunue_garantie = ($chantier->r_garantie * 10) / 100;
            $request->merge(['retunue_garantie' => $retunue_garantie]);
            Decompte::create($request->all());
            return redirect()->back()
                            ->with('success','decompte ajout?? avec succes.');
        }
        else{
        return redirect()->back()
                        ->with('error_code', 1);
                        
        }   
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Decompte  $decompte
     * @return \Illuminate\Http\Response
     */
    public function show(Decompte $decompte)
    {
        //return view('decomptes.show', compact('decompte'));

        $chantier = Chantier::where('id', '=', $decompte->chantier_id)->first();
        return view('decomptes.show', compact('decompte', 'chantier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Decompte  $decompte
     * @return \Illuminate\Http\Response
     */
    public function edit(Decompte $decompte)
    {
       /* return view('decomptes.edit', [
            'decompte' => $decompte
        ]); */

        $chantiers = Chantier::all();
        $chantier = Chantier::where('id', '=', $decompte->chantier_id)->first();
        return view('decomptes.edit', [
            'decompte' => $decompte,
            'chantiers' => $chantiers, 
            'chantier' => $chantier
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Decompte  $decompte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Decompte $decompte)
    {
        $request->validate([
            'num_decompte' => 'required',
            'date_decompte' => 'required',
            'montant_decompte' => 'required',
            'accorde' => 'required',
            'revision_prix' => 'required',
            'chantier_id' => 'required'
        ]);

        if($request->num_decompte != $decompte->num_decompte){
            $d = Decompte::where('num_decompte', '=', $request->num_decompte)->first();
            if ($d !== null) {
                return redirect()->back()
                ->with('error_code', 1);
            }

        }

        $chantier = Chantier::where('id', '=', $request->chantier_id)->first();
        $retunue_garantie = ($chantier->r_garantie * 10) / 100;
        $request->merge(['retunue_garantie' => $retunue_garantie]);

        Decompte::where('id', '=',$decompte->id)->update($request->except(['_token','_method']));
        return redirect()->route('decomptes.gestionForm')
                        ->with('success','Modification avec succ??s');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Decompte  $decompte
     * @return \Illuminate\Http\Response
     */
    public function destroyDecompte(decompte $decompte)
    {
        try {
          //  dd($decompte->id);

            $decompte->delete();
           // dd($a);
            return redirect()->route('decomptes.gestionForm')
                        ->with('success','D??compte supprim?? avec succes.');
        
          } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('decomptes.gestionForm')
                    ->with('error','Vous ne pouvez pas supprim?? cet enregistrement.');
             // var_dump($e->errorInfo);
          }    
        
    }


    public function gestionForm(){
        if (isset($_GET['ajouter'])) {
          // dd($_GET['ajouter']);
            return redirect()->route('decomptes.create');
        }

        if (isset($_GET['modifier'])) {
            $decomptes = decompte::all();
            // dd ($decomptes);
            return view('decomptes.gestion', compact('decomptes'));
            }
            else{
                $decomptes = decompte::all();
                return view('decomptes.gestion', compact('decomptes'));
            }

        
    }

    public function gotoIndex(){
        if(isset($_GET['decompte_id'])) {
            $id = $_GET['decompte_id'];
    
            if (isset($_GET['supprimer'])) {
              // dd($_GET['supprimer']);
             $decompte = decompte::find($id);
             // dd($decompte);
                return redirect()->route('decomptes.destroyDecompte', $decompte);
            }
    
            if (isset($_GET['modifier2'])) {
                return redirect()->route('decomptes.edit', $id);
                }
    
                if (isset($_GET['consulter'])) {
                  //  dd($_GET['consulter']);

                    return redirect()->route('decomptes.show',$id);
                    }
          } else {
            $decomptes = decompte::all();
            // dd ($decomptes);
            return view('decomptes.gestion', compact('decomptes'))
                    ->with('error','Pouvez vous choisir un d??compte!');
             // var_dump($e->errorInfo);
          } 
   
  
    }

}
