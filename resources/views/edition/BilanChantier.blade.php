
@extends('layouts.app')
  
  @section('content')
    
  <div class=" text-right" style="margin-bottom: 30px;margin-top: 20px;margin-right: 100px;"> 
        <a class="btn btn-primary" href="{{ route('chantiers.BilanChantierCharts', $chantier->id) }}" >Graphes</a> 

      <a class="btn btn-primary" href="{{ route('chantiers.BilanChantier') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
      <button class="btn btn-primary" type="button" onclick="PrintPage()" value="Imprimer" ><i class="fa fa-print" aria-hidden="true"></i>Imprimer</button>
  
  </div> 




  
  <div class="col d-flex justify-content-center" id="printableArea"> 


  
  
  <div style="width:90%" >
      <div class="card ">
  
      <div>
           <div class="text-center">
           <img class="img" src="{{url('assets/images/logo.png')}}"  style="width: 170px; height: 70px; margin-top:25px " />

                      <h5 style="margin:30px 15px 30px 15px; ">Bilan du chantier {{ $chantier->intitule_chantier }} </h5>
                      
            </div>
                      <table class="mytab m-b-0 text-center" >
                          <thead style="font-weight:bold">
                              <td></td>
                              <td>Montant </td>
                              <td>%</td>
                             
                          </thead>
                          <tbody >
  
                         
                              <tr >
                                  <td >Total Salaires</td>
                                  <td > {{ $chantier->total_sal }} </td>
                                  <td> {{ $chantier->porc_sal }} % </td>
                              </tr>

                              <tr >
                                  <td >Total Matériels</td>
                                  <td > {{ $chantier->total_materiel }} </td>
                                  <td> {{ $chantier->porc_materiel }} % </td>
                              </tr>

                              <tr >
                                  <td >Total Matériaux</td>
                                  <td > {{ $chantier->total_materiau }} </td>
                                  <td> {{ $chantier->porc_materiau }} % </td>
                              </tr>

                              <tr >
                                  <td >Total Frais</td>
                                  <td > {{ $chantier->total_frais }} </td>
                                  <td> {{ $chantier->porc_frais }} % </td>
                              </tr>
                             
                              <tr >
                                  <td style="font-weight:bold" >Total Général </td>
                                  <td > {{ $chantier->total_gen }} </td>
                              </tr>
                        
                         
                            
                          </tbody>
                      </table>   
  
                   </div>  
  
           
      </div>
  </div>
  
  
  
  @endsection


 