<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use App\Models\ChantierPersonnel;
use App\Models\ChantierQualification;
use App\Models\Personnel;
use App\Models\Qualification;
use Illuminate\Http\Request;

class ChantierPersonnelController extends Controller
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
        $chantierPersonnels = ChantierPersonnel::all();
        $chantiers = [];
        foreach ($chantierPersonnels as $chantierPersonnel){
            $chantier = Chantier::where('id', '=', $chantierPersonnel->chantier_id)->first();
            if(!in_array ( $chantier, $chantiers)){
                array_push($chantiers, $chantier);
            }
        } //dd($chantiers);
        return view('chantierPersonnels.index', compact('chantiers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personnels = Personnel::all();
        foreach($personnels as $personnel){
            $qual = Qualification::where('id', '=', $personnel->qualification_id)->first();
            //dd($qual);

            $personnel->setAttribute('salaire_unitaire', $qual->salaire_unitaire);
        }
       // dd($personnels);
        $chantiers = Chantier::all();
        return view('chantierPersonnels.create', compact( 'chantiers', 'personnels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //  dd(request());
        $request->validate([
            'chantier_id' => 'required',
            'personnels' => 'required',
            'date_affect' => 'required',
            'date_fin_affect' => 'required',
            'effictif_reel' => 'required',
            'montant_salaire' => 'required',
            'salaire_reel' => 'required',
        ]); 
//dd($request);
        foreach ($request->personnels as $personnel){
            $chantierPersonnel = new ChantierPersonnel();
            $chantierPersonnel->chantier_id = $request->chantier_id;

            
            $cp = ChantierPersonnel::query()
            ->where('chantier_id', '=', $request->chantier_id)
            ->where('personnel_id', '=', $personnel)
            ->first(); 

            if ($cp !== null) {
                return redirect()->back()
                        ->with('error_code', 1);
            }else{

                for($k=0; $k<count($request->date_affect) ; $k++){
                    $op = Personnel ::where('code_personne', '=', $request->code_personne[$k])->first();
                    if($op->id == $personnel){

                      
                      //  $chantierPersonnel->duree_reel = $duree;
                        $chantierPersonnel->date_affect = $request->date_affect[$k];
                        $chantierPersonnel->date_fin_affect = $request->date_fin_affect[$k];
                        $chantierPersonnel->effictif_reel = $request->effictif_reel[$k];
                        $chantierPersonnel->montant_salaire = $request->montant_salaire;
                        $chantierPersonnel->salaire_reel = $request->salaire_reel[$k];
                        $chantierPersonnel->personnel_id = $personnel;
                        $chantierPersonnel->save();
                    }
        
                } 
            } 
        }       

        $chantiers = Chantier::all();
        $personnels = Personnel::all();

        return redirect()->route('chantierPersonnels.create', compact('chantiers',  'personnels'))
                ->with('success','Enregistrement ajouté avec succes.'); 
    }

    public function showPersonnels(Chantier $chantier)
    {
        $personnels = [];
        $total_sal =0.0;
        $chantierPersonnels = ChantierPersonnel::where('chantier_id', '=', $chantier->id)->get();
        foreach($chantierPersonnels as $chantierPersonnel){
            $personnel = Personnel::where('id', '=', $chantierPersonnel->personnel_id)->first();
            $personnel->setAttribute('date_affect', $chantierPersonnel->date_affect);
            $personnel->setAttribute('date_fin_affect', $chantierPersonnel->date_fin_affect);
            $personnel->setAttribute('effictif_reel', $chantierPersonnel->effictif_reel);
            $personnel->setAttribute('montant_salaire', $chantierPersonnel->montant_salaire);
            $personnel->setAttribute('salaire_reel', $chantierPersonnel->salaire_reel);
            array_push($personnels, $personnel);
        }
        $chantier->setAttribute('personnels', $personnels);
        //$chantier->setAttribute('total_sal', $total_sal);
        return view('chantierPersonnels.show', compact( 'chantier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChantierPersonnel  $chantierPersonnel
     * @return \Illuminate\Http\Response
     */
    public function edit(ChantierPersonnel $chantierPersonnel)
    {
        //
    }

    public function editPersonnels(Chantier $chantier)
    {
        $personnels = Personnel::all();
        foreach($personnels as $personnel){
            $qual = Qualification::where('id', '=', $personnel->qualification_id)->first();
            //dd($qual);

            $personnel->setAttribute('salaire_unitaire', $qual->salaire_unitaire);
        }
        $chantiers = Chantier::all();

        $pers = [];
        $chantierPersonnels = ChantierPersonnel::where('chantier_id', '=', $chantier->id)->get();
        foreach($chantierPersonnels as $chantierPersonnel){
          $pers[] = $chantierPersonnel->personnel_id;
          $pers[] = $chantierPersonnel->date_affect;
          $pers[] = $chantierPersonnel->date_fin_affect;
          $pers[] = $chantierPersonnel->effictif_reel;
          $pers[] = $chantierPersonnel->salaire_reel;
        //  $pers[] = $chantierPersonnel->montant_salaire;
          
        }//dd($ops);
       // dd($personnels);
        return view('chantierPersonnels.edit', [
            'chantierPersonnels' => $chantierPersonnels,
            'personnels' => $personnels,
            'chantiers' => $chantiers,
            'pers' => $pers,
            'chantier' => $chantier
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChantierPersonnel  $chantierPersonnel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChantierPersonnel $chantierPersonnel)
    {
        //
    }
    public function updatePersonnels(Request $request, Chantier $chantier)
    {
        $request->validate([
            'chantier_id' => 'required',
            'personnels' => 'required',
            'date_affect' => 'required',
            'date_fin_affect' => 'required',
            'effictif_reel' => 'required',
            'montant_salaire' => 'required',
            'salaire_reel' => 'required',
        ]);
      
        $chantierPersonnels = ChantierPersonnel::query()
        ->where('chantier_id', '=', $chantier->id)
        ->get(); 

        foreach ($chantierPersonnels as $chantierPersonnel){
           // 
            if(!in_array($chantierPersonnel->personnel_id, $request->personnels)){
              $chantierPersonnel->delete();
            }
        }

        foreach ($request->personnels as $personnel){

            $chantierPersonnel = ChantierPersonnel::query()
            ->where('chantier_id', '=', $chantier->id)
            ->where('personnel_id', '=', $personnel)
            ->first(); 
            
            if ($chantierPersonnel !== null) {
                for($k=0; $k<count($request->date_affect) ; $k++){
                    $op = Personnel ::where('code_personne', '=', $request->code_personne[$k])->first();
                    if($op->id == $personnel){
                        $chantierPersonnel->date_affect = $request->date_affect[$k];
                        $chantierPersonnel->date_fin_affect = $request->date_fin_affect[$k];
                        $chantierPersonnel->effictif_reel = $request->effictif_reel[$k];
                        $chantierPersonnel->montant_salaire = $request->montant_salaire;
                        $chantierPersonnel->salaire_reel = $request->salaire_reel[$k];
                        $chantierPersonnel->personnel_id = $personnel;
                        $chantierPersonnel->update();
                        
                    }
                } 
            }else{
                $chantierPersonnel = new ChantierPersonnel();
                $chantierPersonnel->chantier_id = $request->chantier_id;
                for($k=0; $k<count($request->date_affect) ; $k++){
                    $op = Personnel ::where('code_personne', '=', $request->code_personne[$k])->first();
                    if($op->id == $personnel){
                        
                        $chantierPersonnel->date_affect = $request->date_affect[$k];
                        $chantierPersonnel->date_fin_affect = $request->date_fin_affect[$k];
                        $chantierPersonnel->effictif_reel = $request->effictif_reel[$k];
                        $chantierPersonnel->montant_salaire = $request->montant_salaire;
                        $chantierPersonnel->salaire_reel = $request->salaire_reel[$k];
                        $chantierPersonnel->personnel_id = $personnel;
                        $chantierPersonnel->save();
                      }
          
                  }
            }   
        }
      return redirect()->route('chantierPersonnels.showPersonnels', [$chantier])
      ->with('success','Modification avec succès');
 }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChantierPersonnel  $chantierPersonnel
     * @return \Illuminate\Http\Response
     */

    public function destroyChantierPersonnels(Chantier $chantier)
    {
        $chantierPersonnels = ChantierPersonnel::where('chantier_id', '=', $chantier->id)->get();
        foreach ($chantierPersonnels as $chantierPersonnel){
            $chantierPersonnel->delete();
        }
        
        return redirect()->route('chantierPersonnels.index')
                        ->with('success','Les personnels du chantier sont supprimé avec succes.');
    }

    public function search(){

        $search_c = $_GET['codechantier'];
        if ($search_c === ''){
            return redirect()->back();
        }
        // get chantier
        $chantier = Chantier::where('code_chantier', '=', $search_c)->first();
        if ($chantier === null){
            return redirect()->route('chantiers.listePersonnelsChantier')
                         ->with('warning',"N'éxiste aucun chantier avec ce code");
        }
        //
        $chantierPersonnel = ChantierPersonnel::where('chantier_id', '=', $chantier->id)->first();
        if ($chantierPersonnel === null) {
            // dd($chantiers);
             return redirect()->route('chantiers.listePersonnelsChantier')
                         ->with('warning',"Ce chantier n'a pas encore des opérations");
         }
         
         return redirect()->route('chantiers.getPersonnels',$chantier->id);
    }

    public function searchChantierPersonnels(){

        $search_c = $_GET['codechantier'];
        if ($search_c === ''){
            return redirect()->back();
        }
        // get chantier
        $chantier = Chantier::where('code_chantier', '=', $search_c)->first();
        if ($chantier === null){
            return redirect()->route('chantiers.listePersonnelsChantier')
                         ->with('warning',"N'éxiste aucun chantier avec ce code");
        }
        //
        $chantierPersonnels = ChantierPersonnel::where('chantier_id', '=', $chantier->id)->get();
        if ($chantierPersonnels->isEmpty()) {
            // dd($chantiers);
             return redirect()->route('chantiers.listePersonnelsChantier')
                         ->with('warning',"Ce chantier n'a pas encore des personnels");
         }
         
         return redirect()->route('chantiers.DetailPrixSalaires',$chantier->id);
    }

    public function ListeChantiers(){
        $chantiers = Chantier::all();
        return view('edition.DiffDureePersonnelChan', compact('chantiers'));
    }

    public function DiffDureeEstimeReel($id){
        $chantier = Chantier::find($id);
        $personnels = $chantier->personnels;
        $chantierPersonnels = ChantierPersonnel::where('chantier_id', '=', $id)->get();
        if (!$chantierPersonnels->isEmpty()){
            foreach($chantierPersonnels as $chantierPersonnel){
                foreach($personnels as $personnel){
                    $chantierQual = ChantierQualification::query()
                    ->where('chantier_id', '=', $id)
                    ->where('qualification_id', '=', $personnel->id)
                    ->first();
                   // dd($chantierQual);
                    if($personnel->id === $chantierPersonnel->personnel_id){
                        $datediff = abs(strtotime($chantierPersonnel->date_affect) - strtotime($chantierPersonnel->date_fin_affect));
                        $duree_reel = round($datediff / (60 * 60 * 24));
                        if ($chantierQual != null){
                            $dureeEstime = $chantierQual->duree_estimee; 
                        }else{
                            $dureeEstime = 0; 
                        }
                        $diff = abs($dureeEstime - $duree_reel);
                        $chantierPersonnel->setAttribute('dureeEstime', $dureeEstime);
                        $chantierPersonnel->setAttribute('duree_reel', $duree_reel);

                        $chantierPersonnel->setAttribute('diff', $diff);
                        $chantierPersonnel->setAttribute('nom_personnel', $personnel->nom_personne);
                        $chantierPersonnel->setAttribute('prenom_personnel', $personnel->prenom_personne);

                    }
                    
                }
            }
        }
        
        return view('edition.DiffDureeEstimeReelPersonnel', compact('chantier', 'chantierPersonnels'));
    }

    public function searchPersonnelsByChantier(){

        $search_c = $_GET['codechantier'];
        if ($search_c === ''){
            return redirect()->back();
        }
        // get chantier
        $chantier = Chantier::where('code_chantier', '=', $search_c)->first();
        if ($chantier === null){
            return redirect()->route('chantierPersonnels.index')
                         ->with('warning',"N'éxiste aucun chantier avec ce code");
        }
        //
        $chantierPersonnel = ChantierPersonnel::where('chantier_id', '=', $chantier->id)->first();
        if ($chantierPersonnel === null) {
            // dd($chantiers);
             return redirect()->route('chantierPersonnels.index')
                         ->with('warning',"Ce chantier n'a pas encore des personnels");
         }
         
         return redirect()->route('chantierPersonnels.showPersonnels',$chantier->id);

    }

}
