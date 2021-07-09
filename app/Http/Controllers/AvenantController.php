<?php

namespace App\Http\Controllers;

use App\Models\Avenant;
use App\Models\Operation;
use Illuminate\Http\Request;

class AvenantController extends Controller
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
        $avenants = Avenant::all();
        return view('avenants.index', compact('avenants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $operations = Operation::all();
        return view('avenants.create', compact('operations'));
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
            'code_avenant' => 'required',
            'date_avenant' => 'required',
            'type_avenant' => 'required',
            'operation_id' => 'required'
        ]);

        $avenant = Avenant::where('code_avenant', '=', $request->code_avenant)->first();
        if ($avenant === null) {
            Avenant::create($request->all());
            return redirect()->back()
                            ->with('success','avenant ajouté avec succes.');
        }
        else{
        return redirect()->back()
                        ->with('error_code', 1);
                        
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Avenant  $avenant
     * @return \Illuminate\Http\Response
     */
    public function show(Avenant $avenant)
    {
       
        $operation = Operation::where('id', '=', $avenant->operation_id)->first();
        return view('avenants.show', compact('avenant', 'operation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Avenant  $avenant
     * @return \Illuminate\Http\Response
     */
    public function edit(Avenant $avenant)
    {
        $operations = Operation::all();
        $operation = Operation::where('id', '=', $avenant->operation_id)->first();
        return view('avenants.edit', [
            'avenant' => $avenant,
            'operations' => $operations, 
            'operation' => $operation
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Avenant  $avenant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Avenant $avenant)
    {
        $request->validate([
            'code_avenant' => 'required',
            'date_avenant' => 'required',
            'type_avenant' => 'required',
            'operation_id' => 'required'
        ]);

        if($request->code_avenant !== $avenant->code_avenant){
            $p = Avenant::where('code_avenant', '=', $request->code_avenant)->first();
            if ($p !== null) {
                return redirect()->back()
                ->with('error_code', 1);
            }

        }

        Avenant::where('id', '=',$avenant->id)->update($request->except(['_token','_method']));

         return redirect()->route('avenants.show', [$avenant])
         ->with('success','Modification avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Avenant  $avenant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Avenant $avenant)
    {
        try {
            $avenant->delete();
            return redirect()->route('avenants.index')
                        ->with('success','avenant supprimé avec succes.');
        
          } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('avenants.index')
                    ->with('error','Vous ne pouvez pas supprimé cet enregistrement.');
             // var_dump($e->errorInfo);
          } 
    }

    public function search(){
        $search_c = $_GET['codeavenant'];

        if ($search_c == null){
            $search_c = '#';
        }
        
        $avenants = Avenant::query()
        ->where('code_avenant', 'like', "%".$search_c."%")
        ->orderBy('created_at', 'desc')
        ->get();

        if ($avenants->isEmpty()) {
            return redirect()->route('avenants.index')
                        ->with('warning',"N'éxiste aucune avenant avec les informations de la recherche");
        }
        
        return view('avenants.search', compact('avenants'));
    }
}
