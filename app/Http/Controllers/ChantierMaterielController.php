<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use App\Models\ChantierMateriel;
use App\Models\Materiel;
use Illuminate\Http\Request;

class ChantierMaterielController extends Controller
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
        $chantierMateriels = ChantierMateriel::all();
        $chantiers = [];
        foreach ($chantierMateriels as $chantierMateriel){
            $chantier = Chantier::where('id', '=', $chantierMateriel->chantier_id)->first();
            if(!in_array ( $chantier, $chantiers)){
                array_push($chantiers, $chantier);
            }
        } 
        return view('chantierMateriels.index', compact('chantiers'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materiels = Materiel::all();
        $chantiers = Chantier::all();
        return view('chantierMateriels.create', compact( 'materiels', 'chantiers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        echo json_encode($request->toArray());
        $request->validate([
            'chantier_id' => 'required',
            'materiels' => 'required',
            'd_debut_service' => 'required',
            'd_fin_service' => 'required',
            't_ajustement' => 'required',
            'mont_net' => 'required',
            'prix_unit' => 'required',

        ]);
        foreach ($request->materiels as $materiel){
            $chantierMateriel = new ChantierMateriel();
            $chantierMateriel->chantier_id = $request->chantier_id;

            
            $cm = ChantierMateriel::query()
            ->where('chantier_id', '=', $request->chantier_id)
            ->where('materiel_id', '=', $materiel)
            ->first(); 

            if ($cm !== null) {
                return redirect()->back()
                        ->with('error_code', 1);
            }else{
                for($k=0; $k<count($request->code_materiel) ; $k++){
                    $m1 = Materiel ::where('code_materiel', '=', $request->code_materiel[$k])->first();
                    if($m1->id == $materiel){
                       
                        $chantierMateriel->d_debut_service = $request->d_debut_service[$k];
                        $chantierMateriel->d_fin_service = $request->d_fin_service[$k];
                        $chantierMateriel->prix_unit = $request->prix_unit[$k];
                        $chantierMateriel->t_ajustement = $request->t_ajustement[$k];
                        $chantierMateriel->mont_net = $request->mont_net[$k];
                        $chantierMateriel->materiel_id = $materiel;
                        $chantierMateriel->save();
                    }
                }
            } 
        }       

        $chantiers = Chantier::all();
        $materiels = Materiel::all();

        return redirect()->route('chantierMateriels.create', compact('chantiers',  'materiels'))
                ->with('success','Enregistrement ajouté avec succes.'); 
         
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChantierMateriel  $chantierMateriel
     * @return \Illuminate\Http\Response
     */
    public function showMateriels(Chantier $chantier)
    {
        $total = 0.0;
        $materiels = [];
        $chantierMateriels = ChantierMateriel::where('chantier_id', '=', $chantier->id)->get();
        foreach($chantierMateriels as $chantierMateriel){
            $materiel = Materiel::where('id', '=', $chantierMateriel->materiel_id)->first();
            $materiel->setAttribute('d_debut_service', $chantierMateriel->d_debut_service);
            $materiel->setAttribute('d_fin_service', $chantierMateriel->d_fin_service);
            $materiel->setAttribute('t_ajustement', $chantierMateriel->t_ajustement);
            $materiel->setAttribute('mont_net', $chantierMateriel->mont_net);
            $materiel->setAttribute('prix_unit', $chantierMateriel->prix_unit);


            array_push($materiels, $materiel);
            $total += $chantierMateriel->mont_net;
        }
        $chantier->setAttribute('materiels', $materiels);
        $chantier->setAttribute('total', $total);
        
        return view('chantierMateriels.show', compact('chantier'));
       /* $chantier = Chantier::where('id', '=', $chantierMateriel->chantier_id)->first();
        $materiel = Materiel::where('id', '=', $chantierMateriel->materiel_id)->first();
        return view('chantierMateriels.show', compact('chantierMateriel', 'chantier', 'materiel'));*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChantierMateriel  $chantierMateriel
     * @return \Illuminate\Http\Response
     */
    public function editMateriels(Chantier $chantier)
    {
        $materiels = Materiel::all();
        $chantiers = Chantier::all();
$total = 0;
        $mats = [];
        $chantierMateriels = ChantierMateriel::where('chantier_id', '=', $chantier->id)->get();
        foreach($chantierMateriels as $chantierMateriel){
          $mats[] = $chantierMateriel->materiel_id;
          $mats[] = $chantierMateriel->prix_unit;
          $mats[] = $chantierMateriel->d_debut_service;
          $mats[] = $chantierMateriel->d_fin_service;
          $mats[] = $chantierMateriel->t_ajustement;
          $mats[] = $chantierMateriel->mont_net;
          $total += $chantierMateriel->mont_net;
        }
        $chantier->setAttribute('total', $total);
   // dd($mats);
        return view('chantierMateriels.edit', [
            'chantierMateriels' => $chantierMateriels,
            'materiels' => $materiels,
            'chantiers' => $chantiers,
            'mats' => $mats,
            'chantier' => $chantier
        ]);
  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChantierMateriel  $chantierMateriel
     * @return \Illuminate\Http\Response
     */
    public function updateMateriels(Request $request, Chantier $chantier)
    {
        $request->validate([
            'chantier_id' => 'required',
            'materiels' => 'required',
            'd_debut_service' => 'required',
            'd_fin_service' => 'required',
            't_ajustement' => 'required',
            'mont_net' => 'required',
            'prix_unit' => 'required',
        ]);

        $chantierMateriels = ChantierMateriel::query()
        ->where('chantier_id', '=', $chantier->id)
        ->get(); 

        foreach ($chantierMateriels as $chantierMateriel){
           // 
            if(!in_array($chantierMateriel->materiel_id, $request->materiels)){
              $chantierMateriel->delete();
            }
        }

        foreach ($request->materiels as $materiel){

            $chantierMateriel = ChantierMateriel::query()
            ->where('chantier_id', '=', $chantier->id)
            ->where('materiel_id', '=', $materiel)
            ->first(); 
            
            if ($chantierMateriel !== null) {

                for($k=0; $k<count($request->code_materiel) ; $k++){
                    $m1 = Materiel ::where('code_materiel', '=', $request->code_materiel[$k])->first();
                    if($m1->id == $materiel){
                        
                        
                        $chantierMateriel->prix_unit = $request->prix_unit[$k];
                        $chantierMateriel->d_debut_service = $request->d_debut_service[$k];
                        $chantierMateriel->d_fin_service = $request->d_fin_service[$k];
                        $chantierMateriel->t_ajustement = $request->t_ajustement[$k];
                        $chantierMateriel->mont_net = $request->mont_net[$k];
                        $chantierMateriel->materiel_id = $materiel;
                        $chantierMateriel->update();
                        
                    }
        
                } 
            }else{
                $chantierMateriel = new ChantierMateriel();
                $chantierMateriel->chantier_id = $request->chantier_id;;
                for($k=0; $k<count($request->code_materiel) ; $k++){
                    $m1 = Materiel ::where('code_materiel', '=', $request->code_materiel[$k])->first();
                    if($m1->id == $materiel){
               
                   
                        $chantierMateriel->prix_unit = $request->prix_unit[$k];
                        $chantierMateriel->d_debut_service = $request->d_debut_service[$k];
                        $chantierMateriel->d_fin_service = $request->d_fin_service[$k];
                        $chantierMateriel->t_ajustement = $request->t_ajustement[$k];
                        $chantierMateriel->mont_net = $request->mont_net[$k];
                        $chantierMateriel->materiel_id = $materiel;
                        $chantierMateriel->save();
                    }
        
                } 
            }   
        }
      return redirect()->route('chantierMateriels.showMateriels', [$chantier])
      ->with('success','Modification avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChantierMateriel  $chantierMateriel
     * @return \Illuminate\Http\Response
     */
    public function destroyChantierMateriels(Chantier $chantier)
    {
        $chantierMateriels = ChantierMateriel::where('chantier_id', '=', $chantier->id)->get();
        foreach ($chantierMateriels as $chantierMateriel){
            $chantierMateriel->delete();
        }
        
        return redirect()->route('chantierMateriels.index')
                        ->with('success','Les matériels du chantier sont supprimé avec succes.');
    }

    public function search(){

        $search_c = $_GET['codechantier'];
        if ($search_c === ''){
            return redirect()->back();
        }
        // get chantier
        $chantier = Chantier::where('code_chantier', '=', $search_c)->first();
        if ($chantier === null){
            return redirect()->route('chantiers.listeMaterielsChantier')
                         ->with('warning',"N'éxiste aucun chantier avec ce code");
        }
        //
        $chantierMateriel = ChantierMateriel::where('chantier_id', '=', $chantier->id)->first();
        if ($chantierMateriel === null) {
            // dd($chantiers);
             return redirect()->route('chantiers.listeMaterielsChantier')
                         ->with('warning',"Ce chantier n'a pas encore des matériels");
         }
         
         return redirect()->route('chantiers.getMateriels',$chantier->id);

    }

    public function getChantierInfo(){

        $search_c = $_GET['codechantier'];
        if ($search_c === ''){
            return redirect()->back();
        }
        // get chantier
        $chantier = Chantier::where('code_chantier', '=', $search_c)->first();
        if ($chantier === null){
            return redirect()->route('chantierMateriels.index')
                         ->with('warning',"N'éxiste aucun chantier avec ce code");
        }
        //
        $chantierMateriel = ChantierMateriel::where('chantier_id', '=', $chantier->id)->first();
        if ($chantierMateriel === null) {
            // dd($chantiers);
             return redirect()->route('chantierMateriels.index')
                         ->with('warning',"Ce chantier n'a pas encore des matériels");
         }
         
         return redirect()->route('chantierMateriels.showMateriels',$chantier->id);

    }

    public function getAllMaterielByChantierMateriel($id) {
        $chantierMateriel = ChantierMateriel::find($id);
        $materiels = Materiel::where('materiel_id', '=', $chantierMateriel->materiel_id);
        
       // $materiels = $chantierMateriel->materiels;
        return $materiels;
    }

    public function getAllChantierByChantierMateriel($id) {
        $chantierMateriel = ChantierMateriel::find($id);
        $chantiers = Chantier::where('chantier_id', '=', $chantierMateriel->chantier_id);
       // $chantiers = $chantierMateriel->chantiers;
        return $chantiers;
    }

    public function DetailPrixMaterielChantier(){
        $chantiers = Chantier::all();
        return view('edition.DetailPrixMaterielChantier', compact('chantiers'));
    }

    public function DetailPrixMateriel($id){
        $chantier = Chantier::find($id);
        $chantierMateriels = ChantierMateriel::where('chantier_id','=',$id)->get();
        
        $materiels = $chantier->materiels;
        $total = 0.0;
        if ($chantierMateriels !== null){
            foreach($materiels as $materiel){
                foreach($chantierMateriels as $cm){
                    if($cm->materiel_id === $materiel->id){
                        $montant = 0.0;
                        $type = "Interne";
                        if($materiel->type_interne_externe == 0){
                            $type = "Externe";
                        }
                        $materiel->setAttribute('type', $type);
                        $materiel->setAttribute('mont_net', $cm->mont_net);
                        $materiel->setAttribute('prix_unit', $cm->prix_unit);
                        $datediff = abs(strtotime($cm->d_debut_service) - strtotime($cm->d_fin_service));
                        $duree = round($datediff / (60 * 60 * 24));
                        $materiel->setAttribute('duree', $duree);
                      //  $montant = $duree*$cm->prix_unit;
                       // $materiel->setAttribute('montant', $montant);
                        $total += $cm->mont_net;
                    }  
                }
            }
        }
  // echo json_encode($commandeMateriaus); 
  $chantier->setAttribute('total', $total);

        return view('edition.DetailPrixMateriel',  compact('materiels','chantier'));
    }

    public function searchMaterielsByChantier(){
        $search_c = $_GET['codechantier'];
        if ($search_c === ''){
            return redirect()->back();
        }
        // get chantier
        $chantier = Chantier::where('code_chantier', '=', $search_c)->first();
        if ($chantier === null){
            return redirect()->route('chantierMateriels.DetailPrixMaterielChantier')
                         ->with('warning',"N'éxiste aucun chantier avec ce code");
        }
        //
        $chantierMateriels = ChantierMateriel::where('chantier_id', '=', $chantier->id)->get();
        if ($chantierMateriels->isEmpty()) {
            // dd($chantiers);
             return redirect()->route('chantierMateriels.DetailPrixMaterielChantier')
                         ->with('warning',"Ce chantier n'a pas encore des materiels");
         }
         
         return redirect()->route('chantierMateriels.DetailPrixMateriel',$chantier->id);
    }

    public function ListeChantiersMat(){
        $chantiers = Chantier::all();
        return view('edition.DiffDureeMaterielChan', compact('chantiers'));
    }

    public function DiffDureeEstimeReelMat($id){
        $chantier = Chantier::find($id);
        $materiels = $chantier->materiels;
        $chantierMateriels = ChantierMateriel::where('chantier_id', '=', $id)->get();
        if (!$chantierMateriels->isEmpty()){
            foreach($chantierMateriels as $chantierMateriel){
                foreach($materiels as $materiel){
                    if($materiel->id === $chantierMateriel->materiel_id){
                        $datediff = abs(strtotime($chantierMateriel->d_debut_service) - strtotime($chantierMateriel->d_fin_service));
                        $dureeEstime = round($datediff / (60 * 60 * 24));
                        $diff = abs($dureeEstime - $chantierMateriel->duree_reel);
                        $chantierMateriel->setAttribute('dureeEstime', $dureeEstime);
                        $chantierMateriel->setAttribute('diff', $diff);
                        $chantierMateriel->setAttribute('intitule_materiel', $materiel->intitule_materiel);
                    }
                    
                }
            }
        }
        
        return view('edition.DiffDureeEstimeReel', compact('chantier', 'chantierMateriels'));
    }
}

