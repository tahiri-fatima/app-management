
@extends('layouts.app')
  
  @section('content')
    
  <div class=" text-right" style="margin-bottom: 30px;margin-top: 20px;margin-right: 100px;"> 
      <a class="btn btn-primary" href="{{ route('chantierOperations.ListeChantiersOper') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
      <button class="btn btn-primary" type="button" onclick="PrintPage()" value="Imprimer" ><i class="fa fa-print" aria-hidden="true"></i>Imprimer</button>
  </div> 
  
  
  
  <div class="col d-flex justify-content-center" id="printableArea"> 
  
  <div style="width:90%" >
      <div class="card ">
  
      <div>
      <div class="text-center">
           <img class="img" src="{{url('assets/images/logo.png')}}"  style="width: 170px; height: 70px; margin-top:25px " />

                      <h5 style="margin:30px 15px 30px 15px; text-align:center">La différence entre les durées réelles et les durées estimées associée aux opérations du chantier {{$chantier->intitule_chantier}} </h5>
                      
            </div>
                      <table class="table m-b-0 text-center" >
                          <thead style="font-weight:bold">
                              
                              <td>Opération</td>
                              <td>Durée Estimée</td>                              
                              <td>Durée Réelle</td>                              
                              <td>différence Durée</td>
                              <td>Quantité Opération</td>                              
                              <td>Quantité Réalisée</td>                              
                              <td>différence Quantité</td>

                          </thead>
                          <tbody >
  
                          @foreach($chantierOperationReels as $chantierOperationReel)
                              <tr >
                                  <td >{{ $chantierOperationReel->designation_operation }} </td>
                                  <td >{{ $chantierOperationReel->dureeEstime }} </td>
                                  <td> {{ $chantierOperationReel->duree_reel }}</td>
                                  <td >{{ $chantierOperationReel->diff }} </td>
                                  <td >{{ $chantierOperationReel->quantite_operation }} </td>
                                  <td> {{ $chantierOperationReel->quantite_realisee }}</td>
                                  <td >{{ $chantierOperationReel->diffQte }} </td>
                                  
                              </tr>

                             
  
                          @endforeach
                         
                            
                          </tbody>
                      </table>   
  
                   </div>  
  
           
      </div>
  </div>
  
  
  
  @endsection