<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use Illuminate\Http\Request;

class QualificationController extends Controller
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
        $qualifications = Qualification::all();
        return view('qualifications.index', compact('qualifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('qualifications.create');
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
            'code_qual' => 'required',
            'designation_qual' => 'required',
            'salaire_unitaire' => 'required'
        ]);

        $qualifications = Qualification::where('code_qual', '=', $request->code_qual)->first();
        if ($qualifications === null) {
            Qualification::create($request->all());
            return redirect()->back()
                            ->with('success','qualification ajouté avec succes.');
        }
        else{
        return redirect()->back()
                        ->with('error_code', 5);
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function show(Qualification $qualification)
    {
        return view('qualifications.show', compact('qualification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function edit(Qualification $qualification)
    {
        return view('qualifications.edit', [
            'qualification' => $qualification
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Qualification $qualification)
    {
        $request->validate([
            'code_qual' => 'required',
            'designation_qual' => 'required',
            'salaire_unitaire' => 'required'
        ]);
        if($request->code_qual !== $qualification->code_qual){
            $f = Qualification::where('code_qual', '=', $request->code_qual)->first();
            if ($f !== null) {
                return redirect()->back()
                ->with('error_code', 5);
            }
        }

        Qualification::where('id', '=',$qualification->id)->update($request->except(['_token','_method']));
        return redirect()->route('qualifications.gestionForm')
        ->with('success','Modification avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function destroyQualification(Qualification $qualification)
    {
        try {
          //  dd($qualification->id);

            $qualification->delete();
           // dd($a);
            return redirect()->route('qualifications.gestionForm')
                        ->with('success','Qualification supprimé avec succes.');
        
          } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('qualifications.gestionForm')
                    ->with('error','Vous ne pouvez pas supprimé cet enregistrement.');
             // var_dump($e->errorInfo);
          }    
        
    }


    public function gestionForm(){
        if (isset($_GET['ajouter'])) {
          // dd($_GET['ajouter']);
            return redirect()->route('qualifications.create');
        }

        if (isset($_GET['modifier'])) {
            $qualifications = qualification::all();
            // dd ($qualifications);
            return view('qualifications.gestion', compact('qualifications'));
            }
            else{
                $qualifications = qualification::all();
                return view('qualifications.gestion', compact('qualifications'));
            }

        
    }

    public function gotoIndex(){
        if(isset($_GET['qualification_id'])) {
            $id = $_GET['qualification_id'];
    
            if (isset($_GET['supprimer'])) {
              // dd($_GET['supprimer']);
             $qualification = Qualification::find($id);
             // dd($qualification);
                return redirect()->route('qualifications.destroyQualification', $qualification);
            }
    
            if (isset($_GET['modifier2'])) {
                return redirect()->route('qualifications.edit', $id);
                }
    
                if (isset($_GET['consulter'])) {
                  //  dd($_GET['consulter']);

                    return redirect()->route('qualifications.show',$id);
                    }
          } else {
            $qualifications = qualification::all();
            // dd ($qualifications);
            return view('qualifications.gestion', compact('qualifications'))
                    ->with('error','Pouvez vous choisir un qualification!');
             // var_dump($e->errorInfo);
          } 
   
  
    }

}
