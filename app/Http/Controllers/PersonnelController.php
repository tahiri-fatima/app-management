<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use App\Models\Personnel;
use App\Models\Qualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class PersonnelController extends Controller
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
     * Create a new controller instance.
     *
     * @return void
     */
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personnels = Personnel::all();
        return view('personnels.index', compact('personnels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $qualifications = Qualification::all();

      //  $roles = Role::pluck('name','name')->all();
      //  dd($roles);
        return view('personnels.create', compact('roles', 'qualifications'));

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
            'code_personne' => 'required',
            'nom_personne' => 'required',
            'prenom_personne' => 'required',
            'num_cnss' => 'required',
            'montant_cnss' => 'required',
            'date_embauche' => 'required',
            'tele' => 'required|string|min:10|max:13',
            'fonction' => 'required',
            'role_id' => 'required',
            'qualification_id' => 'required'
        ]);
       

        $personnel = Personnel::where('code_personne', '=', $request->code_personne)->first();
        if ($personnel === null) {
            $personnel = new Personnel();
         //   dd($request->tele);
         $tele = strrev($request->tele);
        $password = password_hash($tele, PASSWORD_DEFAULT);

        $personnel->code_personne = $request->code_personne;
        $personnel->nom_personne = $request->nom_personne;
        $personnel->prenom_personne = $request->prenom_personne;
        $personnel->num_cnss = $request->num_cnss;
        $personnel->montant_cnss = $request->montant_cnss;
        $personnel->date_embauche = $request->date_embauche;
        $personnel->tele = $request->tele;
        $personnel->fonction = $request->fonction;
        $personnel->password = $password;
        $personnel->role_id = $request->role_id;
        $personnel->qualification_id = $request->qualification_id;
        $personnel->save();

        $roles = Role::findById($request->role_id);
        $personnel->assignRole($roles);
        //Personnel::create($request->all());
   
            return redirect()->back()
                            ->with('success','Personne ajouté avec succes.');
        }
        else{
        return redirect()->back()
                        ->with('error_code', 5);
                        
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function show(Personnel $personnel)
    {
        $qual = Qualification::where('id', '=', $personnel->qualification_id)->first();
        return view('personnels.show', compact('personnel', 'qual'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function edit(Personnel $personnel)
    {
        $roles = Role::all();
        $qualifications = Qualification::all();
        $qual = Qualification::where('id', '=', $personnel->qualification_id)->first();

        $userRole = Role::where('id', '=', $personnel->role_id)->first();
       // dd($userRole);
      //  $chantiers = Chantier::all();
      //  $chantier = Chantier::where('id', '=', $personnel->chantier_id)->first();
        return view('personnels.edit', [
            'personnel' => $personnel,
            'roles' => $roles,
            'qualifications' => $qualifications,
            'userRole' => $userRole,
            'qual' => $qual
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Personnel $personnel)
    {
     
        $request->validate([
            'code_personne' => 'required',
            'nom_personne' => 'required',
            'prenom_personne' => 'required',
            'num_cnss' => 'required',
            'montant_cnss' => 'required',
            'date_embauche' => 'required',
            'tele' => 'required|string|min:10|max:13',
            'fonction' => 'required',
            'role_id' => 'required',
            'qualification_id' => 'required'
            
        ]);

        if($request->code_personne !== $personnel->code_personne){
            $p = Personnel::where('code_personne', '=', $request->code_personne)->first();
            if ($p !== null) {
                return redirect()->back()
                ->with('error_code', 5);
            }

        }

        if($request->tele !== $personnel->tele){
            $tele = strrev($request->tele);
            $password = password_hash($tele, PASSWORD_DEFAULT);
            $request->merge(['password' => $password]);
        }

        Personnel::where('id', '=',$personnel->id)->update($request->except(['_token','_method']));
        DB::table('model_has_roles')->where('model_id',$personnel->id)->delete();
    
        $role = Role::where('id', '=', $request->role_id)->first();
        $personnel->assignRole($role);
        return redirect()->route('personnels.show', [$personnel])
        ->with('success','Modification avec succès');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personnel $personnel)
    {
        try {
            $personnel->delete();
            return redirect()->route('personnels.index')
                        ->with('success','Personne supprimé avec succes.');
          } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('personnels.index')
                    ->with('error','Vous ne pouvez pas supprimé cet enregistrement.');
             // var_dump($e->errorInfo);
          }
        
    }


    public function search(){
        $search_c = $_GET['code_personne'];
        $search_n = $_GET['nom_personne'];
        $search_p = $_GET['prenom_personne'];

        if ($search_n == null){
            $search_n = '#';
        }
        if ($search_c == null){
            $search_c = '#';
        }
        if ($search_p == null){
            $search_p = '#';
        }

        $personnels = Personnel::query()
        ->where('code_personne', 'like', "%".$search_c."%")
        ->orWhere('nom_personne', 'like', "%".$search_n."%")
        ->orWhere('prenom_personne', 'like', "%".$search_p."%")
        ->orderBy('created_at', 'desc')
        ->get();

        if ($personnels->isEmpty()) {
            return redirect()->back()
                        ->with('error_code',0);
        }
        else{
            return view('personnels.search', compact('personnels'));

        }
    }

 
}