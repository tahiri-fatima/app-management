<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use App\Models\chantierOperation;
use App\Models\ChantierOperationReel;
use App\Models\Execution;
use App\Models\Operation;
use App\Models\Sou_traitance;
use Illuminate\Http\Request;

class OperationController extends Controller
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
        $operations = Operation::all();
        return view('operations.index', compact('operations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $soutraitances = Sou_traitance::all();
        return view('operations.create', compact('soutraitances'));
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
            'code_operation' => 'required',
            'designation_operation' => 'required',
            'unite' => 'required',
            'soutraitance_id' => 'required'
        ]);

        $operation = Operation::where('code_operation', '=', $request->code_operation)->first();
        if ($operation === null) {
            $operation = Operation::create($request->all());

            return redirect()->back()
                            ->with('success','operation ajouté avec succes.');
        }
        else{
        return redirect()->back()
                        ->with('error_code', 1);
                        
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function show(Operation $operation)
    {
        $soutraitance = Sou_traitance::where('id', '=', $operation->soutraitance_id)->first();

        return view('operations.show', compact('operation', 'soutraitance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function edit(Operation $operation)
    {
        $soutraitances = Sou_traitance::all();
        $soutraitance = Sou_traitance::where('id', '=', $operation->soutraitance_id)->first();
        return view('operations.edit', [
            'operation' => $operation,
            'soutraitances' => $soutraitances, 
            'soutraitance' => $soutraitance
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Operation $operation)
    {
        $request->validate([
            'code_operation' => 'required',
            'designation_operation' => 'required',
            'unite' => 'required',
            'soutraitance_id' => 'required'
        ]);

        if($request->code_operation !== $operation->code_operation){
            $f = Operation::where('code_operation', '=', $request->code_operation)->first();
            if ($f !== null) {
                return redirect()->back()
                ->with('error_code', 5);
            }
        }

        Operation::where('id', '=',$operation->id)->update($request->except(['_token','_method']));
        
         return redirect()->route('operations.show', [$operation])
         ->with('success','Modification avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Operation $operation)
    {
        try {
            $operation->delete();
            return redirect()->route('operations.index')
                        ->with('success','operation supprimé avec succes.');
          } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('operations.index')
                    ->with('error','Vous ne pouvez pas supprimé cet enregistrement.');
             // var_dump($e->errorInfo);
          }
        
    }
    
    public function search(){
        $search_c = $_GET['code_operation'];
        $search_d = $_GET['designation_operation'];

        if ($search_c == null){
            $search_c = '#';
        }
        if ($search_d == null){
            $search_d = '#';
        }
        

        $operations = Operation::query()
        ->where('code_operation', 'like', "%".$search_c."%")
        ->orwhere('designation_operation', 'like', "%".$search_d."%")
        ->orderBy('created_at', 'desc')
        ->get();

        if ($operations->isEmpty()) {
            return redirect()->route('operations.index')
                        ->with('warning',"N'éxiste aucune operation avec les informations de la recherche");
        }
        
        return view('operations.search', compact('operations'));
    }

    public function getEtatsRealisation(){
        $operation_id = $_GET['operation_id'];
        $chantier_id = $_GET['chantier_id'];
        //dd($request);
        $operation = Operation::find($operation_id);
        $chantier = Chantier::find($chantier_id);

        $chantierOperationReels = ChantierOperationReel::query()
        ->where('operation_id', '=', $operation_id)
        ->where('chantier_id', '=', $chantier_id)
        ->get();
        $chantierOperation = ChantierOperation::query()
        ->where('operation_id', '=', $operation_id)
        ->where('chantier_id', '=', $chantier_id)
        ->first();

        if (!$chantierOperationReels->isEmpty()){
            foreach($chantierOperationReels as $chantierOperationReel){
                $chantierOperationReel->setAttribute('quantite_operation', $chantierOperation->quantite_operation);
                $chantierOperationReel->setAttribute('date_fin_operation', $chantierOperation->date_fin_operation);
            }
            return view('operations.getEtatsRealisation', compact('operation', 'chantierOperationReels'));
        }      
       // dd($executions);
       return redirect()->back()
       ->with('warning',"N'éxiste aucune information sur l'état de l'opération choisi");
    }

    public function EtatsRealisationOperation()
    {
        $chantiers = Chantier::all();
        return view('edition.EtatsRealisationOperation', compact('chantiers'));
    }

    public function searchOperationEtat(){

        $search_c = $_GET['codeoperation'];
        if ($search_c === ''){
            return redirect()->back();
        }
        // get operation
        $operation = Operation::where('code_operation', '=', $search_c)->first();
        if ($operation === null){
            return redirect()->route('operations.EtatsRealisationOperation')
                         ->with('warning',"N'éxiste aucun opération avec ce code");
        }
        //
        $chantierOperations = chantierOperation::where('operation_id', '=', $operation->id)->get();
        if ($chantierOperations->isEmpty()) {
            // dd($chantiers);
             return redirect()->route('operations.listeExecutionsOperation')
                         ->with('warning',"Cette opération n'a pas encore exécuté");
         }
         
         return redirect()->route('operations.getEtatsRealisation',$operation->id);
    }

}
