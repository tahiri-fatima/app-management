<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use App\Models\ChantierOperation;
use App\Models\ChantierOperationReel;
use App\Models\Operation;
use Illuminate\Http\Request;

class ChantierOperationReelController extends Controller
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
        $chantierOperationReels = ChantierOperationReel::all();
        $chantiers = [];
        foreach ($chantierOperationReels as $chantierOperation){
            $chantier = Chantier::where('id', '=', $chantierOperation->chantier_id)->first();
            if(!in_array ( $chantier, $chantiers)){
                array_push($chantiers, $chantier);
            }
        } 
        return view('chantierOperationReels.index', compact('chantiers'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $chantierOperations = ChantierOperation::all();
        $chantiers = [];
        foreach ($chantierOperations as $chantierOperation){
            $chantier = Chantier::where('id', '=', $chantierOperation->chantier_id)->first();
            if(!in_array ( $chantier, $chantiers)){
                array_push($chantiers, $chantier);
            }
          

           // dd($chantier->operations);
        }//dd($chantiers);
        foreach($chantierOperations as $co){
            foreach($chantiers as $chantier){
                foreach($chantier->operations as $operation){
                    $operation->setAttribute('prix_unitaire_revient', $chantierOperation->prix_unitaire_revient);
                    $operation->setAttribute('prix_unitaire_vente', $chantierOperation->prix_unitaire_vente);
                }
               // dd($chantier->operations);
            }
           
        }//dd($chantiers);
  //      $operations = Operation::all();
      //  $chantiers = Chantier::all();
        return view('chantierOperationReels.create', compact( 'chantiers'));
   
    }

    public function getOperationsExecute(Request $request, $id){
        //$id = $_GET['id'];
        
            if ($request->ajax()) {
                $chantierOperations = ChantierOperation::where('chantier_id', '=', $id)->get();
                $operations = [];
                foreach($chantierOperations as $co){
                    $operation = Operation::where('id', '=', $co->operation_id)->first();
                    $operation->setAttribute('date_deb_operation', $co->date_deb_operation);

                    $operation->setAttribute('prix_unitaire_revient', $co->prix_unitaire_revient);
                    $operation->setAttribute('prix_unitaire_vente', $co->prix_unitaire_vente);
                    array_push($operations, $operation);

                    // dd($chantier->operations);
                    }
                return response()->json([
                    'operations' => $operations
                ]);
            }
        
  
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
            'quantite_realisee' => 'required',
            'date_execution' => 'required',
            'montant_execution_revient' => 'required',
            'montant_execution_vente' => 'required',
        ]); 
//dd($request);
        foreach ($request->operations as $operation){
            $chantierOperation = new ChantierOperationReel();
            $chantierOperation->chantier_id = $request->chantier_id;

            
            $co = ChantierOperationReel::query()
            ->where('chantier_id', '=', $request->chantier_id)
            ->where('operation_id', '=', $operation)
            ->where('date_execution', '=', $request->date_execution)
            ->first(); 

            if ($co !== null) {
                return redirect()->back()
                        ->with('error_code', 1);
            }else{

                for($k=0; $k<count($request->date_execution) ; $k++){
                    $op = Operation ::where('code_operation', '=', $request->code_operation[$k])->first();
                    if($op->id == $operation){
                        $chantierOperation->date_execution = $request->date_execution[$k];
                        $chantierOperation->quantite_realisee = $request->quantite_realisee[$k];
                        $chantierOperation->montant_execution_revient = $request->montant_execution_revient[$k];
                        $chantierOperation->montant_execution_vente = $request->montant_execution_vente[$k];
                        $chantierOperation->operation_id = $operation;
                        $chantierOperation->save();
                    }
        
                } 
            } 
        }       

        $chantiers = Chantier::all();
        $operations = Operation::all();

        return redirect()->route('chantierOperationReels.create', compact('chantiers',  'operations'))
                ->with('success','Enregistrement ajouté avec succes.'); 
  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChantierOperationReel  $chantierOperationReel
     * @return \Illuminate\Http\Response
     */
    public function showOperations(Chantier $chantier)
    {
        $operations = [];
        $total_revient = 0.0;
        $total_vente = 0.0;
        $total_encaisse = 0.0;
        $chantierOperationReels = ChantierOperationReel::where('chantier_id', '=', $chantier->id)->get();
        foreach($chantierOperationReels as $chantierOperation){
            $operation = Operation::where('id', '=', $chantierOperation->operation_id)->first();
            $operation->setAttribute('quantite_realisee', $chantierOperation->quantite_realisee);
            $operation->setAttribute('date_execution', $chantierOperation->date_execution);
            $operation->setAttribute('montant_execution_revient', $chantierOperation->montant_execution_revient);
            $operation->setAttribute('montant_execution_vente', $chantierOperation->montant_execution_vente);
            $operation->setAttribute('montant_encaisse', $chantierOperation->montant_encaisse);

            $total_revient += $chantierOperation->montant_execution_revient;
            $total_vente += $chantierOperation->montant_execution_vente;
            $total_encaisse += $chantierOperation->montant_encaisse;

            array_push($operations, $operation);
        }
        $chantier->setAttribute('operations', $operations);
        $chantier->setAttribute('total_vente', $total_vente);
        $chantier->setAttribute('total_revient', $total_revient);
        $chantier->setAttribute('total_encaisse', $total_encaisse);
        return view('chantierOperationReels.show', compact( 'chantier'));
  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChantierOperationReel  $chantierOperationReel
     * @return \Illuminate\Http\Response
     */
    public function editOperations(Chantier $chantier)
    {
       // $operations = Operation::all();
        $chantiers = Chantier::all();
      //  $chantierOperations = ChantierOperation::where('chantier_id', '=', $chantier->id)->get();
        $operations = [];
    
        $chantierOperationReels = ChantierOperationReel::where('chantier_id', '=', $chantier->id)->get();
        foreach($chantierOperationReels as $chantierOperation){
            $operation = Operation::where('id', '=', $chantierOperation->operation_id)->first();
            $co = ChantierOperation::query()
            ->where('chantier_id', '=', $chantier->id)
            ->where('operation_id', '=', $operation->id)
            ->first();

            $chantierOperation->setAttribute('code_operation', $operation->code_operation);
            $chantierOperation->setAttribute('designation_operation', $operation->designation_operation);

            $chantierOperation->setAttribute('date_deb_operation', $co->date_deb_operation);
            $chantierOperation->setAttribute('prix_unitaire_revient', $co->prix_unitaire_revient);
            $chantierOperation->setAttribute('prix_unitaire_vente', $co->prix_unitaire_vente);

          /*  $operation->setAttribute('quantite_realisee', $chantierOperation->quantite_realisee);
            $operation->setAttribute('date_execution',$chantierOperation->date_execution);
            $operation->setAttribute('montant_execution_revient', $chantierOperation->montant_execution_revient);
            $operation->setAttribute('montant_execution_vente', $chantierOperation->montant_execution_vente);

            array_push($operations, $operation);

          $ops[] = $chantierOperation->operation_id;
          $ops[] = $chantierOperation->quantite_realisee;
          $ops[] = $chantierOperation->date_execution;
          $ops[] = $chantierOperation->montant_execution_revient;
          $ops[] = $chantierOperation->montant_execution_vente;
*/
          
        }//dd($operations);
       // dd($chantierOperationReels);
        return view('chantierOperationReels.edit', [
            'chantierOperationReels' => $chantierOperationReels,
            'operations' => $operations,
            'chantiers' => $chantiers,
            'chantier' => $chantier
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChantierOperationReel  $chantierOperationReel
     * @return \Illuminate\Http\Response
     */
    public function updateOperations(Request $request, Chantier $chantier)
    {
        $request->validate([
            'chantier_id' => 'required',
            'operations' => 'required',
            'quantite_realisee' => 'required',
            'date_execution' => 'required',
            'montant_execution_revient' => 'required',
            'montant_execution_vente' => 'required',
        ]);
      
        $chantierOperationReels = ChantierOperationReel::query()
        ->where('chantier_id', '=', $chantier->id)
        ->get(); 

        foreach ($chantierOperationReels as $chantierOperation){
           // 
            if(!in_array($chantierOperation->id, $request->operations)){
              $chantierOperation->delete();
            }
        }
        $k=0;
        foreach ($request->operations as $operation){

            $chantierOperationReel = ChantierOperationReel::query()
            ->where('id', '=', $operation)
            ->first(); 

                    if($request->quantite_realisee[$k] != null){
                        $chantierOperationReel->date_execution = $request->date_execution[$k];
                        $chantierOperationReel->quantite_realisee = $request->quantite_realisee[$k];
                        $chantierOperationReel->montant_execution_revient = $request->montant_execution_revient[$k];
                        $chantierOperationReel->montant_execution_vente = $request->montant_execution_vente[$k];
                        $chantierOperationReel->montant_encaisse = $request->montant_encaisse[$k];

                        $chantierOperationReel->update();
                    }
 
                    $k++;
        }
      return redirect()->route('chantierOperationReels.gestionForm')
      ->with('success','Modification avec succès');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChantierOperationReel  $chantierOperationReel
     * @return \Illuminate\Http\Response
     */
    public function destroyChantierOperations(Chantier $chantier)
    {
        $chantierOperationReels = ChantierOperationReel::where('chantier_id', '=', $chantier->id)->get();
        foreach ($chantierOperationReels as $chantierOperation){
            $chantierOperation->delete();
        }
        
        return redirect()->route('chantierOperationReels.gestionForm')
                        ->with('success','Les opérations du chantier sont supprimé avec succes.');
 
    }
    public function gestionForm(){
        if (isset($_GET['ajouter'])) {
           
            return redirect()->route('chantierOperationReels.create');

        }

        if (isset($_GET['modifier'])) {

            $chantiers = Chantier::all();
            // dd ($chantiers);
            return view('chantierOperationReels.gestion', compact('chantiers'));
            }
            else{
                $chantiers = Chantier::all();

                return view('chantierOperationReels.gestion', compact('chantiers'));

            }

        
    }
    public function gotoIndex(){
        if (isset($_GET['chantier_id'])) {
            $id = $_GET['chantier_id'];
            $chantier = Chantier::find($id);
    
            if (isset($_GET['supprimer'])) {
               
                return redirect()->route('chantierOperationReels.destroyChantierOperations', $id);
    
            }
    
            if (isset($_GET['modifier2'])) {
    
               
                return redirect()->route('chantierOperationReels.editOperations', $chantier->id);
    
                }
    
                if (isset($_GET['consulter'])) {
    
                    return redirect()->route('chantierOperationReels.showOperations',$chantier->id);
        
                    }
          } else {
              $chantiers = Chantier::all();
            return view('chantierOperationReels.gestion', compact('chantiers'))
                    ->with('error','Pouvez vous choisir une chantier!');
             // var_dump($e->errorInfo);
          } 
   
  
    }
    

    public function search(){

        $search_c = $_GET['codechantier'];
        if ($search_c === ''){
            return redirect()->back();
        }
        // get chantier
        $chantier = Chantier::where('code_chantier', '=', $search_c)->first();
        if ($chantier === null){
            return redirect()->route('chantierOperationReels.index')
                         ->with('warning',"N'éxiste aucun chantier avec ce code");
        }
        //
        $chantierOperationReel = ChantierOperationReel::where('chantier_id', '=', $chantier->id)->first();
        if ($chantierOperationReel === null) {
            // dd($chantiers);
             return redirect()->route('chantierOperationReels.index')
                         ->with('warning',"Ce chantier n'a pas encore des exécutions d'opérations");
         }
         
         return redirect()->route('chantierOperationReels.showOperations',$chantier->id);

    }

}
