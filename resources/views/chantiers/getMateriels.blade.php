
@extends('layouts.app')
  
  @section('content')
    
  <div class=" text-right" style="margin-bottom: 30px;margin-top: 20px;margin-right: 100px;"> 
      <a class="btn btn-primary" href="{{ route('chantiers.listeMaterielsChantier') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
      <button class="btn btn-primary" type="button" onclick="PrintPage()" value="Imprimer" ><i class="fa fa-print" aria-hidden="true"></i>Imprimer</button>
  </div> 
  
  
  
  <div class="col d-flex justify-content-center" id="printableArea"> 
  
  <div style="width:90%" >
      <div class="card ">
  
      <div>
      <div class="text-center">
           <img class="img" src="{{url('assets/images/logo.png')}}"  style="width: 170px; height: 70px; margin-top:25px " />

                      <h5 style="margin:30px 15px 30px 15px; text-align:center">Liste des matériels du chantier {{$chantier->intitule_chantier}} </h5>
                      <h6 style="margin:30px 30px 30px 50px;">
                        <span style="margin-right:100px">  Date début de chantier : {{$chantier->date_debut_chantier}} </span>
                        <span> Date fin de chantier : {{$chantier->date_fin_chantier}} </span>
                        </h6> 
            </div>
                      <table class="table m-b-0 text-center" >
                          <thead style="font-weight:bold">
                              <td>Code Matériel</td>
                              <td>Désignation du Matériel</td>
                              <td>Prix unitaire</td>
                              <td>Durée</td>
                              <td>Quantité</td>
                              <td>Montant</td>
                              <td>Taut d'ajustement</td>
                              <td>Montant net</td>
                          </thead>
                          <tbody >
  
                          @foreach($materiels as $materiel)
                              <tr >
                                  <td >{{ $materiel->code_materiel }} </td>
                                  <td >{{ $materiel->intitule_materiel }} </td>
                                  <td> {{ $materiel->prix_unit }}</td>
                                  <td >{{ $materiel->duree }} </td>
                                  <td >{{ $materiel->quantite }} </td>
                                  <td >{{ $materiel->montant }} </td>
                                  <td> {{ $materiel->t_ajustement }}</td>
                                  <td >{{ $materiel->mont_net }} </td>
                              </tr>

                             
  
                          @endforeach
                          <tr>
                                  <td class="text-center" colspan="7" style="font-weight:bold"> Total géneral des materiels</td>
                                  <td>{{ $chantier->total }}</td>
                              </tr>
                            
                          </tbody>
                      </table>   
  
                   </div>  
  
           
      </div>
  </div>
  
  
  
  @endsection