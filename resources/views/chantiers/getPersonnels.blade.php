
@extends('layouts.app')
  
  @section('content')
    
  <div class=" text-right" style="margin-bottom: 30px;margin-top: 20px;margin-right: 100px;"> 
      <a class="btn btn-primary" href="{{ route('chantiers.listePersonnelsChantier') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
      <button class="btn btn-primary" type="button" onclick="PrintPage()" value="Imprimer" ><i class="fa fa-print" aria-hidden="true"></i>Imprimer</button>
  </div> 
  
  
  
  <div class="col d-flex justify-content-center" id="printableArea"> 
  
  <div style="width:90%" >
      <div class="card ">
  
      <div>
      <div class="text-center">
           <img class="img" src="{{url('assets/images/logo.png')}}"  style="width: 170px; height: 70px; margin-top:25px " />

                      <h5 style="margin:30px 15px 30px 15px; text-align:center">Liste des personnels du chantier {{$chantier->intitule_chantier}} </h5>
                      <h6 style="margin:30px 30px 30px 50px;">
                        <span style="margin-right:100px">  Date début de chantier : {{$chantier->date_debut_chantier}} </span>
                        <span> Date fin de chantier : {{$chantier->date_fin_chantier}} </span>
                        </h6> 
            </div>
                      <table class="table m-b-0 text-center" >
                          <thead style="font-weight:bold">
                              <td>Code Personnel</td>
                              <td>Salaire Unitaire</td>
                              <td>Durée</td>
                              <td>Effictif Réel</td>
                              <td>Salaire Réel</td>
                          </thead>
                          <tbody >
  
                          @foreach($personnels as $personnel)
                              <tr >
                                  <td >{{ $personnel->code_personne }} </td>
                                  <td> {{ $personnel->salaire_unitaire }}</td>
                                  <td >{{ $personnel->duree }} </td>
                                  <td >{{ $personnel->effictif_reel }} </td>
                                  <td >{{ $personnel->salaire_reel }} </td>
                              </tr>

                             
  
                          @endforeach
                          <tr>
                                  <td class="text-center" colspan="4" style="font-weight:bold"> Total général des personnels</td>
                                  <td>{{ $chantier->total }}</td>
                              </tr>
                            
                          </tbody>
                      </table>   
  
                   </div>  
  
           
      </div>
  </div>
  
  
  
  @endsection