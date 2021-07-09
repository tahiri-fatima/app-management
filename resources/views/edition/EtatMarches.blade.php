
@extends('layouts.app')
  
  @section('content')
    
  <div class=" text-right" style="margin-bottom: 30px;margin-top: 20px;margin-right: 100px;"> 
      <a class="btn btn-primary" href="{{ route('chaniers.EtatMarchesByChantier') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
      <button class="btn btn-primary" type="button" onclick="PrintPage()" value="Imprimer" ><i class="fa fa-print" aria-hidden="true"></i>Imprimer</button>
  </div> 
  
  
  
  <div class="col d-flex justify-content-center" id="printableArea"> 
  
  <div style="width:90%" >
      <div class="card ">
  
      <div>
      <div class="text-center">
           <img  src="{{url('assets/images/logo.png')}}"  style="width: 170px; height: 70px;  margin-top:25px " />

                      <h5 style="margin:30px 15px 30px 15px; text-align:center">Etat de marchés numéro <span style="font-weight:bold">{{ $chantier->numero_marche }}</span>  </h5>
                      
            </div>
                      <table class="table m-b-0 text-center" >
                          <thead style="font-weight:bold">
                              <td>Opération</td>
                              <td>Montant initial  </td>
                              <td>Date début</td>
                              <td>Travaux réalisés</td>
                              <td>Reste à réaliser</td>
                              <td>Montant encaissé </td>
                              <td>Montant à encaissé </td>
                          </thead>
                          <tbody >
  
                          @foreach($chantierOperationReels as $chantierOperationReel)
                              <tr >
                                  <td> {{ $chantierOperationReel->designation_operation }} </td>
                                  <td > {{ $chantierOperationReel->montant_execution_revient }} </td>
                                  <td > {{ $chantierOperationReel->date_deb_operation}} </td>
                                  <td > {{ $chantierOperationReel->quantite_realisee }} </td>
                                  <td > {{ $chantierOperationReel->reste_realisee }} </td>
                                  <td > {{ $chantierOperationReel->montant_encaisse }}</td>
                                  <td >{{ $chantierOperationReel->reste_encaisse }}</td>
                              </tr>

                             
  
                          @endforeach
                          
                            
                          </tbody>
                      </table>   
  
                   </div>  
  
           
      </div>
  </div>
  
  
  
  @endsection