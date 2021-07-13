<?php

namespace App\Http\Controllers;

use App\Models\CommandeMateriau;
use App\Models\Materiau;
use Illuminate\Http\Request;

class MateriauController extends Controller
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
        $materiaus = Materiau::all();
        return view('materiaus.index', compact('materiaus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('materiaus.create');
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
            'code_materiau' => 'required',
            'intitule_materiau' => 'required',
            'prix_unit_materiau' => 'required'
        ]);

        $materiau = Materiau::where('code_materiau', '=', $request->code_materiau)->first();
        if ($materiau === null) {
            Materiau::create($request->all());
            return redirect()->back()
                            ->with('success','Materiau ajouté avec succes.');
        }
        else{
        return redirect()->back()
                        ->with('error_code', 1);
                        
        }     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materiau  $materiau
     * @return \Illuminate\Http\Response
     */
    public function show(Materiau $materiau)
    {
        return view('materiaus.show', compact('materiau'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Materiau  $materiau
     * @return \Illuminate\Http\Response
     */
    public function edit(Materiau $materiau)
    {
        return view('materiaus.edit', [
            'materiau' => $materiau
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materiau  $materiau
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materiau $materiau)
    {
        $request->validate([
            'code_materiau' => 'required',
            'intitule_materiau' => 'required',
            'prix_unit_materiau' => 'required'
        ]);

        if($request->code_materiau !== $materiau->code_materiau){
            $p = Materiau::where('code_materiau', '=', $request->code_materiau)->first();
            if ($p !== null) {
                return redirect()->back()
                ->with('error_code', 1);
            }

        }

        Materiau::where('id', '=',$materiau->id)->update($request->except(['_token','_method']));

         return redirect()->route('materiaus.gestionForm')
         ->with('success','Modification avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materiau  $materiau
     * @return \Illuminate\Http\Response
     */
    public function destroyMateriau(Materiau $materiau)
    {
        try {
          //  dd($materiau->id);

            $materiau->delete();
           // dd($a);
            return redirect()->route('materiaus.gestionForm')
                        ->with('success','Materiau supprimé avec succes.');
        
          } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('materiaus.gestionForm')
                    ->with('error','Vous ne pouvez pas supprimé cet enregistrement.');
             // var_dump($e->errorInfo);
          }    
        
    }


    public function gestionForm(){
        if (isset($_GET['ajouter'])) {
          // dd($_GET['ajouter']);
            return redirect()->route('materiaus.create');
        }

        if (isset($_GET['modifier'])) {
            $materiaus = materiau::all();
            // dd ($materiaus);
            return view('materiaus.gestion', compact('materiaus'));
            }
            else{
                $materiaus = materiau::all();
                return view('materiaus.gestion', compact('materiaus'));
            }

        
    }

    public function gotoIndex(){
        if(isset($_GET['materiau_id'])) {
            $id = $_GET['materiau_id'];
    
            if (isset($_GET['supprimer'])) {
              // dd($_GET['supprimer']);
             $materiau = Materiau::find($id);
             // dd($materiau);
                return redirect()->route('materiaus.destroyMateriau', $materiau);
            }
    
            if (isset($_GET['modifier2'])) {
                return redirect()->route('materiaus.edit', $id);
                }
    
                if (isset($_GET['consulter'])) {
                  //  dd($_GET['consulter']);

                    return redirect()->route('materiaus.show',$id);
                    }
          } else {
            $materiaus = materiau::all();
            // dd ($materiaus);
            return view('materiaus.gestion', compact('materiaus'))
                    ->with('error','Pouvez vous choisir un materiau!');
             // var_dump($e->errorInfo);
          } 
   
  
    }

   
}
