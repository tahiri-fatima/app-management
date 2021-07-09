<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use App\Models\ChantierOperation;
use App\Models\ChantierOperationReel;
use App\Models\Operation;
use Illuminate\Http\Request;

class ChantierOperationController extends Controller
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
        $chantierOperations = ChantierOperation::all();
        $chantiers = [];
        foreach ($chantierOperations as $chantierOperation){
            $chantier = Chantier::where('id', '=', $chantierOperation->chantier_id)->first();
            if(!in_array ( $chantier, $chantiers)){
                array_push($chantiers, $chantier);
            }
        } //dd($chantiers);
        return view('chantierOperations.index', compact('chantiers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $operations = Operation::all();
        $chantiers = Chantier::all();
        return view('chantierOperations.create', compact( 'chantiers', 'operations'));
   
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
            'operations' => 'required',
            'quantite_operation' => 'required',
            'montant_estimee' => 'required',
            'taux_ajustement' => 'required',
            'date_deb_operation' => 'required',
            'date_fin_operation' => 'required',
            'prix_unitaire_revient' => 'required',
            'prix_unitaire_vente' => 'required',
        ]); 
//dd($request);
        foreach ($request->operations as $operation){
            $chantierOperation = new ChantierOperation();
            $chantierOperation->chantier_id = $request->chantier_id;

            
            $co = ChantierOperation::query()
            ->where('chantier_id', '=', $request->chantier_id)
            ->where('operation_id', '=', $operation)
            ->first(); 

            if ($co !== null) {
                return redirect()->back()
                        ->with('error_code', 1);
            }else{

                for($k=0; $k<count($request->quantite_operation) ; $k++){
                    $op = Operation ::where('code_operation', '=', $request->code_operation[$k])->first();
                    if($op->id == $operation){
                        $chantierOperation->prix_unitaire_revient = $request->prix_unitaire_revient[$k];
                        $chantierOperation->quantite_operation = $request->quantite_operation[$k];
                        $chantierOperation->montant_estimee = $request->montant_estimee[$k];
                        $chantierOperation->taux_ajustement = $request->taux_ajustement[$k];
                        $chantierOperation->date_deb_operation = $request->date_deb_operation[$k];
                        $chantierOperation->date_fin_operation = $request->date_fin_operation[$k];
                       // $chantierOperation->quantite_realisee = 0;
                        $chantierOperation->prix_unitaire_vente = $request->prix_unitaire_vente[$k];
                        $chantierOperation->operation_id = $operation;
                        $chantierOperation->save();
                    }
        
                } 
            } 
        }       

        $chantiers = Chantier::all();
        $operations = Operation::all();

        return redirect()->route('chantierOperations.create', compact('chantiers',  'operations'))
                ->with('success','Enregistrement ajouté avec succes.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChantierOperation  $chantierOperation
     * @return \Illuminate\Http\Response
     */
    public function show(ChantierOperation $chantierOperation)
    {
        //
    }
    public function showOperations(Chantier $chantier)
    {
        $operations = [];
        $total =0.0;
        $chantierOperations = ChantierOperation::where('chantier_id', '=', $chantier->id)->get();
        foreach($chantierOperations as $chantierOperation){
            $operation = Operation::where('id', '=', $chantierOperation->operation_id)->first();
            $operation->setAttribute('prix_unitaire_revient', $chantierOperation->prix_unitaire_revient);
            $operation->setAttribute('quantite_operation', $chantierOperation->quantite_operation);
            $operation->setAttribute('taux_ajustement', $chantierOperation->taux_ajustement);
            $operation->setAttribute('montant_estimee', $chantierOperation->montant_estimee);
            $operation->setAttribute('date_deb_operation', $chantierOperation->date_deb_operation);
            $operation->setAttribute('date_fin_operation', $chantierOperation->date_fin_operation);
            $operation->setAttribute('prix_unitaire_vente', $chantierOperation->prix_unitaire_vente);
            $total += $chantierOperation->montant_estimee;
            array_push($operations, $operation);
        }
        $chantier->setAttribute('operations', $operations);
        $chantier->setAttribute('total', $total);
        return view('chantierOperations.show', compact( 'chantier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChantierOperation  $chantierOperation
     * @return \Illuminate\Http\Response
     */
    public function edit(ChantierOperation $chantierOperation)
    {
        //
    }

    public function editOperations(Chantier $chantier)
    {
        $operations = Operation::all();
        $chantiers = Chantier::all();

        $ops = [];
        $chantierOperations = ChantierOperation::where('chantier_id', '=', $chantier->id)->get();
        foreach($chantierOperations as $chantierOperation){
          $ops[] = $chantierOperation->operation_id;
          $ops[] = $chantierOperation->date_deb_operation;
          $ops[] = $chantierOperation->date_fin_operation;
          $ops[] = $chantierOperation->prix_unitaire_revient;
          $ops[] = $chantierOperation->quantite_operation;
          $ops[] = $chantierOperation->prix_unitaire_vente;
         
          $ops[] = $chantierOperation->taux_ajustement;
          $ops[] = $chantierOperation->montant_estimee;
          
        }//dd($ops);
       // dd($chantierOperations);
        return view('chantierOperations.edit', [
            'chantierOperations' => $chantierOperations,
            'operations' => $operations,
            'chantiers' => $chantiers,
            'ops' => $ops,
            'chantier' => $chantier
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChantierOperation  $chantierOperation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChantierOperation $chantierOperation)
    {
        //
    }
    public function updateOperations(Request $request, Chantier $chantier)
    {
        $request->validate([
            'chantier_id' => 'required',
            'operations' => 'required',
            'quantite_operation' => 'required',
            'montant_estimee' => 'required',
            'taux_ajustement' => 'required',
            'date_deb_operation' => 'required',
            'date_fin_operation' => 'required',
            'prix_unitaire_revient' => 'required',
            'prix_unitaire_vente' => 'required',
        ]);
      
        $chantierOperations = ChantierOperation::query()
        ->where('chantier_id', '=', $chantier->id)
        ->get(); 

        foreach ($chantierOperations as $chantierOperation){
           // 
            if(!in_array($chantierOperation->operation_id, $request->operations)){
              $chantierOperation->delete();
            }
        }

        foreach ($request->operations as $operation){

            $chantierOperation = ChantierOperation::query()
            ->where('chantier_id', '=', $chantier->id)
            ->where('operation_id', '=', $operation)
            ->first(); 
            
            if ($chantierOperation !== null) {
                for($k=0; $k<count($request->quantite_operation) ; $k++){
                    $op = Operation::where('code_operation', '=', $request->code_operation[$k])->first();
                    if($op->id == $operation){
                        $chantierOperation->prix_unitaire_revient = $request->prix_unitaire_revient[$k];
                        $chantierOperation->quantite_operation = $request->quantite_operation[$k];
                        $chantierOperation->montant_estimee = $request->montant_estimee[$k];
                        $chantierOperation->taux_ajustement = $request->taux_ajustement[$k];
                        $chantierOperation->date_deb_operation = $request->date_deb_operation[$k];
                        $chantierOperation->date_fin_operation = $request->date_fin_operation[$k];
                        
                        $chantierOperation->prix_unitaire_vente = $request->prix_unitaire_vente[$k];
                        $chantierOperation->operation_id = $operation;
                        $chantierOperation->update();
                        
                    }
                } 
            }else{
                $chantierOperation = new ChantierOperation();
                $chantierOperation->chantier_id = $request->chantier_id;
                for($k=0; $k<count($request->quantite_operation) ; $k++){
                    $op = Operation::where('code_operation', '=', $request->code_operation[$k])->first();
                    if($op->id == $operation){
                        $chantierOperation->prix_unitaire_revient = $request->prix_unitaire_revient[$k];
                        $chantierOperation->quantite_operation = $request->quantite_operation[$k];
                        $chantierOperation->montant_estimee = $request->montant_estimee[$k];
                        $chantierOperation->taux_ajustement = $request->taux_ajustement[$k];
                        $chantierOperation->operation_id = $operation;
                        $chantierOperation->date_deb_operation = $request->date_deb_operation[$k];
                        $chantierOperation->date_fin_operation = $request->date_fin_operation[$k];
                      
                        $chantierOperation->prix_unitaire_vente = $request->prix_unitaire_vente[$k];
                        $chantierOperation->save();
                      }
          
                  }
            }   
        }
      return redirect()->route('chantierOperations.showOperations', [$chantier])
      ->with('success','Modification avec succès');
 }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChantierOperation  $chantierOperation
     * @return \Illuminate\Http\Response
     */
    public function destroyChantierOperations(Chantier $chantier)
    {
        $chantierOperations = ChantierOperation::where('chantier_id', '=', $chantier->id)->get();
        foreach ($chantierOperations as $chantierOperation){
            $chantierOperation->delete();
        }
        
        return redirect()->route('chantierOperations.index')
                        ->with('success','Les opérations du chantier sont supprimé avec succes.');
    }
 

    public function search(){

        $search_c = $_GET['codechantier'];
        if ($search_c === ''){
            return redirect()->back();
        }
        // get chantier
        $chantier = Chantier::where('code_chantier', '=', $search_c)->first();
        if ($chantier === null){
            return redirect()->route('chantiers.listeOperationsChantier')
                         ->with('warning',"N'éxiste aucun chantier avec ce code");
        }
        //
        $chantierOperation = ChantierOperation::where('chantier_id', '=', $chantier->id)->first();
        if ($chantierOperation === null) {
            // dd($chantiers);
             return redirect()->route('chantiers.listeOperationsChantier')
                         ->with('warning',"Ce chantier n'a pas encore des opérations");
         }
         
         return redirect()->route('chantiers.getOperations',$chantier->id);
    }

    public function ListeChantiersOper(){
        $chantiers = Chantier::all();
        return view('edition.DiffDureeOperChan', compact('chantiers'));
    }

    public function DiffEstimeReel($id){
        $chantier = Chantier::find($id);
        $operations = $chantier->operations;
        $chantierOperationReels = ChantierOperationReel::query()
        ->where('chantier_id', '=', $id)
        ->get();
        $chantierOperations = ChantierOperation::where('chantier_id', '=', $id)->get();
        if (!$chantierOperationReels->isEmpty()){
            foreach($chantierOperationReels as $chantierOperationReel){
                foreach($operations as $operation){
                    $chantierOperation = ChantierOperation::query()
                        ->where('chantier_id', '=', $id)
                        ->where('operation_id', '=', $operation->id)
                        ->first();
                    if($operation->id === $chantierOperationReel->operation_id){
                        $datediffEst = abs(strtotime($chantierOperation->date_deb_operation) - strtotime($chantierOperation->date_fin_operation));
                        $dureeEstime = round($datediffEst / (60 * 60 * 24));
                       // dd($dureeEstime);
                       
                        $datediffReel = abs(strtotime($chantierOperationReel->date_execution) - strtotime($chantierOperation->date_deb_operation));
                        $duree_reel = round($datediffReel / (60 * 60 * 24));
                        $diff = abs($dureeEstime - $duree_reel);
                       
                        
                      //  $diff = abs($dureeEstime - $chantierOperation->duree_reel);
                        $diffQte = $chantierOperation->quantite_operation - $chantierOperationReel->quantite_realisee;
                        $chantierOperationReel->setAttribute('dureeEstime', $dureeEstime);
                        $chantierOperationReel->setAttribute('duree_reel', $duree_reel);
                        $chantierOperationReel->setAttribute('diff', $diff);
                        $chantierOperationReel->setAttribute('diffQte', $diffQte);
                        $chantierOperationReel->setAttribute('designation_operation', $operation->designation_operation);
                        $chantierOperationReel->setAttribute('quantite_operation', $chantierOperation->quantite_operation);

                    }
                    
                }
            }
        }
      //  dd($chantierOperations);
        return view('edition.DiffEstimeReelOper', compact('chantier', 'chantierOperationReels'));
    }

    public function searchOperationsByChantier(){

        $search_c = $_GET['codechantier'];
        if ($search_c === ''){
            return redirect()->back();
        }
        // get chantier
        $chantier = Chantier::where('code_chantier', '=', $search_c)->first();
        if ($chantier === null){
            return redirect()->route('chantierOperations.index')
                         ->with('warning',"N'éxiste aucun chantier avec ce code");
        }
        //
        $chantierOperation = ChantierOperation::where('chantier_id', '=', $chantier->id)->first();
        if ($chantierOperation === null) {
            // dd($chantiers);
             return redirect()->route('chantierOperations.index')
                         ->with('warning',"Ce chantier n'a pas encore des opérations");
         }
         
         return redirect()->route('chantierOperations.showOperations',$chantier->id);

    }


}
