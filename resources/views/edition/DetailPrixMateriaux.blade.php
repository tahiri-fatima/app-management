
@extends('layouts.app')
  
  @section('content')
    
  <div class="text-right" style="margin-bottom: 30px;margin-top: 20px;margin-right: 100px;"> 
      <a class="btn btn-primary" href="{{ route('chantiers.DetailPrixMateriauxByChantier') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
      <button class="btn btn-primary" type="button" onclick="PrintPage()" value="Imprimer" ><i class="fa fa-print" aria-hidden="true"></i>Imprimer</button>
  </div> 
  
  
  
  <div class="col d-flex justify-content-center" id="printableArea"> 
  
  <div style="width:80%" >
      <div class="card ">
  
      <div class="text-center">
           <img class="img" src="{{url('assets/images/logo.png')}}"  style="width: 170px; height: 70px; margin-top:25px " />

                      <h5 style="margin:30px 15px 30px 15px; text-align:center">Détail des prix élémentaires des matériaux consommables </h5>
      </div>
                      <table class="table m-b-0 text-center">
                          <thead style="font-weight:bold">
                             
                              <td>Intitulé Matériau</td>
                              <td>Prix unitaire</td>
                              <td>Quantité</td>
                              <td>Montant </td>
                          </thead>
                          <tbody >
  
                          @foreach($materiaus as $materiau)
                              <tr >
                                  <td >{{ $materiau->intitule_materiau }} </td>
                                  <td> {{ $materiau->prix_unit_materiau }}</td>
                                  <td >{{ $materiau->quantite_materiau }} </td>
                                  <td >{{ $materiau->montant_materiau }}</td>
                              </tr>
  
                          @endforeach
                              
                              <tr>
                                  <td colspan="3" style="text-align:center; font-weight:bold" >Total </td>
                                  <td >{{$total}}</td>
                              </tr>
                          </tbody>
                      </table>   
  
                   </div>  
  
           
      </div>
  </div>
  
  
  
  @endsection