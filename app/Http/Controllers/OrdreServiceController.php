<?php

namespace App\Http\Controllers;

use App\Models\Chantier;
use App\Models\OrdreService;
use Illuminate\Http\Request;

class OrdreServiceController extends Controller
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
        $ordreServices = OrdreService::all();
        return view('ordreservices.index', compact('ordreServices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('ordreServices.create');
        $chantiers = Chantier::all();
        return view('ordreServices.create', compact('chantiers'));
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
            'code_ordre_serv' => 'required',
            'type_ordre_serv' => 'required',
            'date_ordre_serv' => 'required',
            'chantier_id' => 'required'
        ]);

        $ordreService = OrdreService::where('code_ordre_serv', '=', $request->code_ordre_serv)->first();
        if ($ordreService === null) {
            OrdreService::create($request->all());
            return redirect()->back()
                            ->with('success','OrdreService ajouté avec succes.');
        }
        else{
        return redirect()->back()
                        ->with('error_code', 5);
                        
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrdreService  $ordreService
     * @return \Illuminate\Http\Response
     */
    public function show(OrdreService $ordreService)
    {
        $chantier = Chantier::where('id', '=', $ordreService->chantier_id)->first();
        return view('ordreServices.show', compact('ordreService', 'chantier'));
        //return view('ordreServices.show', compact('ordreService'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrdreService  $ordreService
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdreService $ordreService)
    {
       /* return view('ordreServices.edit', [
            'ordreService' => $ordreService
        ]);*/

        $chantiers = Chantier::all();
        $chantier = Chantier::where('id', '=', $ordreService->chantier_id)->first();
        return view('ordreServices.edit', [
            'ordreService' => $ordreService,
            'chantiers' => $chantiers, 
            'chantier' => $chantier
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrdreService  $ordreService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdreService $ordreService)
    {
        $request->validate([
            'code_ordre_serv' => 'required',
            'type_ordre_serv' => 'required',
            'date_ordre_serv' => 'required',
            'chantier_id' => 'required'
        ]);

        if($request->code_ordre_serv !== $ordreService->code_ordre_serv){
            $os = OrdreService::where('code_ordre_serv', '=', $request->code_ordre_serv)->first();
            if ($os !== null) {
                return redirect()->back()
                ->with('error_code', 5);
            }

        }

        OrdreService::where('id', '=',$ordreService->id)->update($request->except(['_token','_method']));
        return redirect()->route('ordreServices.show', [$ordreService])
        ->with('success','Modification avec succès');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrdreService  $ordreService
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdreService $ordreService)
    {
        try {
            $ordreService->delete();
            return redirect()->route('ordreServices.index')
                            ->with('success','ordre de Service supprimé avec succes.');
          } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('ordreServices.index')
                    ->with('error','Vous ne pouvez pas supprimé cet enregistrement.');
             // var_dump($e->errorInfo);
          }
        
    }

    public function search(){
        $search_c = $_GET['code_ordre_serv'];
        $search_t = $_GET['type_ordre_serv'];

        if ($search_t == null){
            $search_t = '#';
        }
        if ($search_c == null){
            $search_c = '#';
        }

        $ordreServices = OrdreService::query()
        ->where('code_ordre_serv', 'like', "%".$search_c."%")
        ->orWhere('type_ordre_serv', 'like', "%".$search_t."%")
        ->orderBy('created_at', 'desc')
        ->get();

        if ($ordreServices->isEmpty()) {
            return redirect()->back()
                        ->with('warning',"N'éxiste aucun ordre Service avec les informations de la recherche");
        }
        
        return view('ordreServices.search', compact('ordreServices'));
    }
}
