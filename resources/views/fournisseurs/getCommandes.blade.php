@extends('layouts.app')
  
  @section('content')
    
  <div class="text-right" style="margin-bottom: 30px;margin-top: 20px;margin-right: 100px;"> 
      <a class="btn btn-primary" href="{{ route('fournisseurs.listeCommandesFournisseur') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
      <button class="btn btn-primary" type="button" onclick="PrintPage()" value="Imprimer" ><i class="fa fa-print" aria-hidden="true"></i>Imprimer</button>
  </div> 
  
  
  
  <div class="col d-flex justify-content-center" id="printableArea"> 
  
  <div style="width:80%" >
      <div class="card ">
      <div class="text-center">
           <img class="img" src="{{url('assets/images/logo.png')}}"  style="width: 170px; height: 70px; margin-top:25px " />

                      <h5 style="text-align:center;margin:20px 15px 20px 15px;">Liste des commandes du fournisseur {{$fournisseur->intitule_fournisseur}} </h5>
      </div>
                      <table class="table m-b-0 text-center">
                          <thead style="font-weight:bold">
                              <td>Code commande</td>
                              <td>Date de la commande</td>
                              <td>Montant de la commande</td>
                              <td>Cumul acompte</td>
                          </thead>
                          <tbody >
  
                          @foreach($commandes as $commande)
                              <tr>
                                  <td >{{ $commande->code_commande }} </td>
                                  <td >{{ $commande->date_commande }} </td>
                                  <td >{{ $commande->total_commande }}</td>
                                    <td >{{ $commande->cumul_acompte }} </td>
                              </tr>
  
                          @endforeach
                              
                              <tr>
                                  <td colspan="2" style="font-weight: bold;" >Total</td>
                                  <td >{{$fournisseur->total_montant_commandes}}</td>
                                  <td >{{$fournisseur->total_cumul_acompte}}</td>
                              </tr>
                              <tr>
                                  <td colspan="2" style="font-weight: bold;"  >Montant Net</td>
                                  <td colspan="2" >{{$fournisseur->montant_net}}</td>
                              </tr>
                          </tbody>
                      </table>   
  
                   </div>  
  
           
      </div>
  </div>
  
  
  
  @endsection