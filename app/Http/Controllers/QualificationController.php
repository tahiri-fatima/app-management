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
        return redirect()->route('qualifications.show', [$qualification])
        ->with('success','Modification avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Qualification $qualification)
    {
        try {
            $qualification->delete();
            return redirect()->route('qualifications.index')
                        ->with('success','Qualification supprimé avec succes.');
          } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('qualifications.index')
                    ->with('error','Vous ne pouvez pas supprimé cet enregistrement.');
             // var_dump($e->errorInfo);
          }
    }

    public function search(){
        $search_c = $_GET['code_qual'];
        $search_i = $_GET['designation_qual'];

        if ($search_c == null){
            $search_c = '#';
        }
        if ($search_i == null){
            $search_i = '#';
        }

        $qualifications = Qualification::query()
        ->where('code_qual', 'like', "%".$search_c."%")
        ->orWhere('designation_qual', 'like', "%".$search_i."%")
        ->orderBy('created_at', 'desc')
        ->get();

        if ($qualifications->isEmpty()) {
            return redirect()->route('qualifications.index')
                        ->with('warning',"N'éxiste aucun qualification avec les informations de la recherche");
        }
        
        return view('qualifications.search', compact('qualifications'));
    }

}
