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

         return redirect()->route('materiaus.show', [$materiau])
         ->with('success','Modification avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materiau  $materiau
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materiau $materiau)
    {
        try {
            $materiau->delete();
            return redirect()->route('materiaus.index')
                        ->with('success','Materiau supprimé avec succes.');
          } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('materiaus.index')
                    ->with('error','Vous ne pouvez pas supprimé cet enregistrement.');
             // var_dump($e->errorInfo);
          }
        
    }

    public function search(){
        $search_c = $_GET['code_materiau'];
        $search_i = $_GET['intitule_materiau'];

        if ($search_c == null){
            $search_c = '#';
        }
        if ($search_i == null){
            $search_i = '#';
        }

        $materiaus = Materiau::query()
        ->where('code_materiau', 'like', "%".$search_c."%")
        ->orWhere('intitule_materiau', 'like', "%".$search_i."%")
        ->orderBy('created_at', 'desc')
        ->get();

        if ($materiaus->isEmpty()) {
            return redirect()->route('materiaus.index')
                        ->with('warning',"N'éxiste aucun materiau avec les informations de la recherche");
        }
        
        return view('materiaus.search', compact('materiaus'));
    }

   
}
