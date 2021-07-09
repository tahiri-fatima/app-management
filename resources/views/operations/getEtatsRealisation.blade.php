
@extends('layouts.app')
  
  @section('content')
    
  <div class=" text-right" style="margin-bottom: 30px;margin-top: 20px;margin-right: 100px;"> 
      <a class="btn btn-primary" href="{{ route('operations.EtatsRealisationOperation') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
      <button class="btn btn-primary" type="button" onclick="PrintPage()" value="Imprimer" ><i class="fa fa-print" aria-hidden="true"></i>Imprimer</button>
  </div> 
  
  
  
  <div class="col d-flex justify-content-center" id="printableArea"> 
  
  <div style="width:90%" >
      <div class="card ">
  
      <div>
           <div >
                      <h5 style="margin:30px 15px 30px 15px; text-align:center">Liste des états de la réalisation d'opération {{$operation->designation_operation}} </h5>
                      
            </div>
                      <table class="table m-b-0 text-center" >
                          <thead style="font-weight:bold">
                          
                              
                              <td>Quantité réalisée</td>
                              <td>Quantité prevue</td>
                              <td>Date d'execution</td>
                              <td>Date prevue</td>
                              <td>Pourcentage Réalisée</td>
                          </thead>
                          <tbody >
                          <?php $k = 0; ?>
                          
                          @foreach($chantierOperationReels as $chantierOperation)
                          
                              <tr >  
                                  <td >{{ $chantierOperation->quantite_realisee }} </td>
                                  <td> {{ $chantierOperation->quantite_operation }}</td>
                                  <td >{{ $chantierOperation->date_execution }}</td>
                                  <td >{{ $chantierOperation->date_fin_operation }}</td>
                                  <td > 
                                  <?php
                                        $pourcentage = ($chantierOperation->quantite_realisee  / $chantierOperation->quantite_operation  ) * 100;
                                        $pourcentage = number_format($pourcentage, 2, '.', '');
                                        $k++; ?>
                                    {{ $pourcentage }} 
                                  </td>
                                  
                              </tr>

                             
                              <?php $k++; ?>
                          @endforeach
                          
                            
                          </tbody>
                      </table>   
  
                   </div>  
  
           
      </div>
  </div>
  
  
  
  @endsection