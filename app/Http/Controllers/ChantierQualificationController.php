<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use App\Models\ChantierQualification;
use App\Models\Qualification;
use Illuminate\Http\Request;

class ChantierQualificationController extends Controller
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
        $chantierQualifications = ChantierQualification::all();
        $chantiers = [];
        foreach ($chantierQualifications as $chantierQualification){
            $chantier = Chantier::where('id', '=', $chantierQualification->chantier_id)->first();
            if(!in_array ( $chantier, $chantiers)){
                array_push($chantiers, $chantier);
            }
        } //dd($chantiers);
        return view('chantierQualifications.index', compact('chantiers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $qualifications = Qualification::all();
        $chantiers = Chantier::all();
        return view('chantierQualifications.create', compact( 'chantiers', 'qualifications'));
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //  dd($request);

        $request->validate([
            'chantier_id' => 'required',
            'qualifications' => 'required',
            'effictif_estimee' => 'required',
            'salaire_estimee' => 'required',
            'duree_estimee' => 'required',
        ]); 
        foreach ($request->qualifications as $qualification){
            $chantierQualification = new ChantierQualification();
            $chantierQualification->chantier_id = $request->chantier_id;
            
            $cp = ChantierQualification::query()
            ->where('chantier_id', '=', $request->chantier_id)
            ->where('qualification_id', '=', $qualification)
            ->first(); 

            if ($cp !== null) {
                return redirect()->back()
                        ->with('error_code', 1);
            }else{

                for($k=0; $k<count($request->effictif_estimee) ; $k++){
                    $op = Qualification ::where('code_qual', '=', $request->code_qual[$k])->first();
                    if($op->id == $qualification){
                       // dd($qualification);
                        $chantierQualification->effictif_estimee = $request->effictif_estimee[$k];
                        $chantierQualification->salaire_estimee = $request->salaire_estimee[$k];
                        $chantierQualification->duree_estimee = $request->duree_estimee[$k];
                        $chantierQualification->qualification_id = $qualification;
                        $chantierQualification->save();
                    }
        
                } 
            } 
        }       

        $chantiers = Chantier::all();
        $qualifications = Qualification::all();

        return redirect()->route('chantierQualifications.create', compact('chantiers',  'qualifications'))
                ->with('success','Enregistrement ajouté avec succes.'); 
   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChantierQualification  $chantierQualification
     * @return \Illuminate\Http\Response
     */
    public function showQualifications(Chantier $chantier)
    {
        $qualifications = [];
        $total_est =0.0;
        $total_sal =0.0;
        $chantierQualifications = ChantierQualification::where('chantier_id', '=', $chantier->id)->get();
        foreach($chantierQualifications as $chantierQualification){
            $qualification = Qualification::where('id', '=', $chantierQualification->qualification_id)->first();
            $qualification->setAttribute('effictif_estimee', $chantierQualification->effictif_estimee);
            $qualification->setAttribute('salaire_estimee', $chantierQualification->salaire_estimee);
            $qualification->setAttribute('duree_estimee', $chantierQualification->duree_estimee);
            $total_est += $chantierQualification->salaire_estimee;
            array_push($qualifications, $qualification);
        }
        $chantier->setAttribute('qualifications', $qualifications);
        $chantier->setAttribute('total_est', $total_est);
        return view('chantierQualifications.show', compact( 'chantier'));
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChantierQualification  $chantierQualification
     * @return \Illuminate\Http\Response
     */
    public function editQualifications(Chantier $chantier)
    {
        $qualifications = Qualification::all();
        $chantiers = Chantier::all();

        $quals = [];
        $chantierQualifications = ChantierQualification::where('chantier_id', '=', $chantier->id)->get();
        foreach($chantierQualifications as $chantierQualification){
          $quals[] = $chantierQualification->qualification_id;
          $quals[] = $chantierQualification->duree_estimee;
          $quals[] = $chantierQualification->effictif_estimee;
          $quals[] = $chantierQualification->salaire_estimee;


          
        }//dd($quals);
       // dd($qualifications);
        return view('chantierQualifications.edit', [
            'chantierQualifications' => $chantierQualifications,
            'qualifications' => $qualifications,
            'chantiers' => $chantiers,
            'quals' => $quals,
            'chantier' => $chantier
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChantierQualification  $chantierQualification
     * @return \Illuminate\Http\Response
     */
    public function updateQualifications(Request $request, Chantier $chantier)
    {
        $request->validate([
            'chantier_id' => 'required',
            'qualifications' => 'required',
            'effictif_estimee' => 'required',
            'salaire_estimee' => 'required',
            'duree_estimee' => 'required',
        ]); 
      
        $chantierQualifications = ChantierQualification::query()
        ->where('chantier_id', '=', $chantier->id)
        ->get(); 

        foreach ($chantierQualifications as $chantierQualification){
           // 
            if(!in_array($chantierQualification->qualification_id, $request->qualifications)){
              $chantierQualification->delete();
            }
        }

        foreach ($request->qualifications as $qualification){

            $chantierQualification = ChantierQualification::query()
            ->where('chantier_id', '=', $chantier->id)
            ->where('qualification_id', '=', $qualification)
            ->first(); 
            
            if ($chantierQualification !== null) {
                for($k=0; $k<count($request->effictif_estimee) ; $k++){
                    $op = Qualification ::where('code_qual', '=', $request->code_qual[$k])->first();
                    if($op->id == $qualification){
                        $chantierQualification->effictif_estimee = $request->effictif_estimee[$k];
                        $chantierQualification->salaire_estimee = $request->salaire_estimee[$k];
                        $chantierQualification->duree_estimee = $request->duree_estimee[$k];
                        $chantierQualification->qualification_id = $qualification;
                       
                        $chantierQualification->update();
                        
                    }
                } 
            }else{
                $chantierQualification = new ChantierQualification();
                $chantierQualification->chantier_id = $request->chantier_id;
                for($k=0; $k<count($request->effictif_estimee) ; $k++){
                    $op = Qualification ::where('code_qual', '=', $request->code_qual[$k])->first();
                    if($op->id == $qualification){
                        $chantierQualification->effictif_estimee = $request->effictif_estimee[$k];
                        $chantierQualification->salaire_estimee = $request->salaire_estimee[$k];
                        $chantierQualification->duree_estimee = $request->duree_estimee[$k];
                        $chantierQualification->qualification_id = $qualification;
                       
                        $chantierQualification->save();
                      }
          
                  }
            }   
        }
      return redirect()->route('chantierQualifications.gestionForm')
      ->with('success','Modification avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChantierQualification  $chantierQualification
     * @return \Illuminate\Http\Response
     */
    public function destroyChantierQualifications(Chantier $chantier)
    {
        $chantierQualifications = ChantierQualification::where('chantier_id', '=', $chantier->id)->get();
        foreach ($chantierQualifications as $chantierQualification){
            $chantierQualification->delete();
        }
        
        return redirect()->route('chantierQualifications.gestionForm')
                        ->with('success','Les qualifications du chantier sont supprimé avec succes.');
  
    }

    
    public function search(){

        $search_c = $_GET['codechantier'];
        if ($search_c === ''){
            return redirect()->back();
        }
        // get chantier
        $chantier = Chantier::where('code_chantier', '=', $search_c)->first();
        if ($chantier === null){
            return redirect()->route('chantierQualifications.index')
                         ->with('warning',"N'éxiste aucun chantier avec ce code");
        }
        //
        $chantierQualification = ChantierQualification::where('chantier_id', '=', $chantier->id)->first();
        if ($chantierQualification === null) {
            // dd($chantiers);
             return redirect()->route('chantierQualifications.index')
                         ->with('warning',"Ce chantier n'a pas encore des qualifications");
         }
         
         return redirect()->route('chantierQualifications.showQualifications',$chantier->id);

    }


    public function gestionForm(){
        if (isset($_GET['ajouter'])) {
           
            return redirect()->route('chantierQualifications.create');

        }

        if (isset($_GET['modifier'])) {

            $chantiers = Chantier::all();
            // dd ($chantiers);
            return view('chantierQualifications.gestion', compact('chantiers'));
            }
            else{
                $chantiers = Chantier::all();

                return view('chantierQualifications.gestion', compact('chantiers'));

            }

        
    }

    public function gotoIndex(){
        if (isset($_GET['chantier_id'])) {
            $id = $_GET['chantier_id'];
            $chantier = Chantier::find($id);
    
            if (isset($_GET['supprimer'])) {
               
                return redirect()->route('chantierQualifications.destroyChantierQualifications', $id);
    
            }
    
            if (isset($_GET['modifier2'])) {
    
               
                return redirect()->route('chantierQualifications.editQualifications', $chantier->id);
    
                }
    
                if (isset($_GET['consulter'])) {
    
                    return redirect()->route('chantierQualifications.showQualifications',$chantier->id);
        
                    }
          } else {
              $chantiers = Chantier::all();
            return view('chantierQualifications.gestion', compact('chantiers'))
                    ->with('error','Pouvez vous choisir une chantier!');
             // var_dump($e->errorInfo);
          } 
   
  
    }
    
}
