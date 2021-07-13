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


         return redirect()->route('soutraitances.gestionForm')
         ->with('success','Modification avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sou_traitance  $soutraitance
     * @return \Illuminate\Http\Response
     */
    public function destroySoutraitance(Sou_traitance $soutraitance)
    {
        try {
          //  dd($soutraitance->id);

            $soutraitance->delete();
           // dd($a);
            return redirect()->route('soutraitances.gestionForm')
                        ->with('success','Sou_traitance supprimé avec succes.');
        
          } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('soutraitances.gestionForm')
                    ->with('error','Vous ne pouvez pas supprimé cet enregistrement.');
             // var_dump($e->errorInfo);
          }    
        
    }


    public function gestionForm(){
        if (isset($_GET['ajouter'])) {
          // dd($_GET['ajouter']);
            return redirect()->route('soutraitances.create');
        }

        if (isset($_GET['modifier'])) {
            $soutraitances = Sou_traitance::all();
            // dd ($soutraitances);
            return view('soutraitances.gestion', compact('soutraitances'));
            }
            else{
                $soutraitances = Sou_traitance::all();
                return view('soutraitances.gestion', compact('soutraitances'));
            }

        
    }

    public function gotoIndex(){
        if(isset($_GET['soutraitance_id'])) {
            $id = $_GET['soutraitance_id'];
    
            if (isset($_GET['supprimer'])) {
              // dd($_GET['supprimer']);
             $soutraitance = Sou_traitance::find($id);
             // dd($soutraitance);
                return redirect()->route('soutraitances.destroySoutraitance', $soutraitance);
            }
    
            if (isset($_GET['modifier2'])) {
                return redirect()->route('soutraitances.edit', $id);
                }
    
                if (isset($_GET['consulter'])) {
                  //  dd($_GET['consulter']);

                    return redirect()->route('soutraitances.show',$id);
                    }
          } else {
            $soutraitances = Sou_traitance::all();
            // dd ($soutraitances);
            return view('soutraitances.gestion', compact('soutraitances'))
                    ->with('error','Pouvez vous choisir un soutraitance!');
             // var_dump($e->errorInfo);
          } 
   
  
    }
}
