
@extends('layouts.app')
  
  @section('content')
    
  <div class=" text-right" style="margin-bottom: 30px;margin-top: 20px;margin-right: 100px;"> 
  <a  class="btn btn-primary" href="{{ route('chantiers.DetailPrixSalaireCharts', $chantier->id)}}" style="margin-left: 10px;"> Graphes</a>

      <a class="btn btn-primary" href="{{ route('chantiers.DetailPrixSalairesChantier') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
      <button class="btn btn-primary" type="button" onclick="PrintPage()" value="Imprimer" ><i class="fa fa-print" aria-hidden="true"></i>Imprimer</button>
  </div> 

  
  
  <div class="col d-flex justify-content-center" id="printableArea"> 
  
  <div style="width:90%" >
      <div class="card ">
  
      <div>
      <div class="text-center">
           <img class="img" src="{{url('assets/images/logo.png')}}"  style="width: 170px; height: 70px; margin-top:25px " />

                      <h5 style="margin:30px 15px 30px 15px; text-align:center">Détail des prix élémentaires des salaires </h5>
                      
            </div>
                      <table class="table m-b-0 text-center" >
                          <thead style="font-weight:bold">
                              <td>Qualification</td>
                              <td>Salaire Unitaire</td>
                              <td>Durée</td>
                              <td>Effectif</td>
                              <td>Montant </td>
                              <td>% </td>
                          </thead>
                          <tbody >
  
                          @foreach($personnels as $personnel)
                            @foreach($personnel as $pers)
                              <tr >
                                  <td >{{ $pers->qualification }} </td>
                                  <td> {{ $pers->salaire_unitaire }}</td>
                                  
                                  <td >{{ $pers->duree }} </td>
                                  <td >{{ $pers->effictif_reel }} </td>
                                  <td >{{ $pers->qual_montant }} </td>
                                  <td >{{ $pers->pourcentage }} </td>
                              </tr>
                              @break
                             
                              @endforeach

                          @endforeach
                          <tr>
                                  <td class="text-center" colspan="4" style="font-weight:bold"> Total</td>
                                  <td>{{ $chantier->total }}</td>
                                  <td></td>
                              </tr>
                            
                          </tbody>
                      </table>   
  
                   </div>  
  
           
      </div>
  </div>
  
  
  @endsection