
@extends('layouts.app')
  
  @section('content')
    
  <div class="text-right" style="margin-bottom: 30px;margin-top: 20px;margin-right: 100px;"> 
      <a class="btn btn-primary" href="{{ route('chantiers.listeDecomptesChantier') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
      <button class="btn btn-primary" type="button" onclick="PrintPage()" value="Imprimer" ><i class="fa fa-print" aria-hidden="true"></i>Imprimer</button>
     
  </div> 
  
  
  <div class="col d-flex justify-content-center" id="printableArea"> 
  
  <div style="width:90%" >
      <div class="card ">
  
      <div>
      <div class="text-center">
           <img class="img" src="{{url('assets/images/logo.png')}}"  style="width: 170px; height: 70px; margin-top:25px " />

                      <h5 style="margin:30px 15px 30px 15px; text-align:center">Liste des décomptes du chantier {{$chantier->intitule_chantier}} </h5>
            </div>
                      <table class="table m-b-0 text-center" >
                            <thead style="font-weight:bold"> 
                                <td>Numéro de prix</td>       
                                <td>Designation d'opération</td>
                                <td>Quantité réalisée</td>
                                <td>Prix unitaire de revient</td>
                                <td>Montant HT </td>
                            </thead>

                            <tbody >
  
                            @foreach($decomptes as $decompte)
                            
                            <tr >
                                        <td  rowspan = "{{$count}}" class="align-middle"  >{{ $decompte->num_decompte }} </td>
                                @foreach($chantierOperationReels as $operation)
                                
                                        <td >{{ $operation->designation_operation }}  </td>
                                        <td> {{ $operation->quantite_realisee }}</td>
                                        <td > {{ $operation->chantierOperation->prix_unitaire_revient }} </td>
                                        
                                        <td >{{ $operation->montantHt }} </td>   
                                    </tr>
                                
                            @endforeach
                          @endforeach

                        <tr>
                            <td colspan="4" style="font-weight:bold">Total HT</td>
                            <td>{{ $chantier->totalHt }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="font-weight:bold">TVA 20%</td>
                            <td> {{ $chantier->tva }} </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="font-weight:bold">Total TTC</td>
                            <td> {{ $chantier->totalTTC }} </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="font-weight:bold">Total retenue</td>
                            <td> {{ $chantier->tRetenue }} </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="font-weight:bold">Total net</td>
                            <td> {{ $chantier->totalNet }} </td>
                        </tr>
                        </tbody>
                      </table>   
  
                   </div>  
  
           
      </div>
  </div>
  
  
  
  @endsection