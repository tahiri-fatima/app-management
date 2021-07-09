
@extends('layouts.app')
  
  @section('content')
    
  <div class="text-right" style="margin-bottom: 30px;margin-top: 20px;margin-right: 100px;"> 
      <a class="btn btn-primary" href="{{ route('chantiers.listeOperationsChantier') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
      <button class="btn btn-primary" type="button" onclick="PrintPage()" value="Imprimer" ><i class="fa fa-print" aria-hidden="true"></i>Imprimer</button>
     
  </div> 
  
  
  <div class="col d-flex justify-content-center" id="printableArea"> 
  
  <div style="width:90%" >
      <div class="card ">
  
      <div>
      <div class="text-center">
           <img class="img" src="{{url('assets/images/logo.png')}}"  style="width: 170px; height: 70px; margin-top:25px " />

                      <h5 style="margin:30px 15px 30px 15px; text-align:center">Liste des opérations du chantier {{$chantier->intitule_chantier}} </h5>
            </div>
                      <table class="table m-b-0 text-center" >
                            <thead style="font-weight:bold"> 
                                <td>Code opération</td>       
                                <td>Opération</td>
                                <td>Prix unitaire de revient</td>
                                <td>Quantité opération</td>
                                <td>Montant d'opération</td>
                                <td>Taux d'ajustement</td>
                                <td>Montant net Estimé </td>
                            </thead>

                            <tbody >
  
                          @foreach($operations as $operation)
                            <tr >
                                <td >{{ $operation->code_operation }} </td>
                                <td >{{ $operation->designation_operation }} </td>
                                <td> {{ $operation->prix_unitaire_revient }}</td>
                                <td >{{ $operation->quantite_operation }} </td>
                                <td >{{ $operation->montant }} </td>
                                <td >{{ $operation->taux_ajustement }} </td>
                                <td >{{ $operation->montant_net }} </td>   
                            </tr>
                          @endforeach

                        <tr>
                            <td colspan="6" style="font-weight:bold">Total marché</td>
                            <td>{{ $chantier->total }}</td>
                        </tr>
                        </tbody>
                      </table>   
  
                   </div>  
  
           
      </div>
  </div>
  
  
  
  @endsection