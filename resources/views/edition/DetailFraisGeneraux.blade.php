
@extends('layouts.app')
  
  @section('content')
    
  <div class=" text-right" style="margin-bottom: 30px;margin-top: 20px;margin-right: 100px;"> 
      <a class="btn btn-primary" href="{{ route('chaniers.DetailFraisGenerauxChantier') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
      <button class="btn btn-primary" type="button" onclick="PrintPage()" value="Imprimer" ><i class="fa fa-print" aria-hidden="true"></i>Imprimer</button>
  </div> 
  
  
  
  <div class="col d-flex justify-content-center" id="printableArea"> 
  
  <div style="width:90%" >
      <div class="card ">
  
      <div class="text-center">
           <img class="img" src="{{url('assets/images/logo.png')}}"  style="width: 170px; height: 70px; margin-top:25px " />

      <h5 style="margin:30px 15px 30px 15px; text-align:center">Détail des frais généraux et bénéfices </h5>
      </div>           
                      <table class="table m-b-0 text-center" >
                          <thead style="font-weight:bold">
                              <td>Désignation</td>
                              <td>Montant</td>
                              <td>% de l'offre</td>
                          </thead>
                          <tbody >

                          @foreach($frais as $frai)
                              <tr >
                                  <td > {{$frai->nature_frais->nature_frais}} </td>
                                  <td > {{$frai->montant_frais}} </td>
                                  <td>{{$frai->montant}} </td>
                              </tr>
                          @endforeach
                          <tr >
                                  <td  style="font-weight:bold" >Total Général </td>
                                  <td > {{ $chantier->total_montant }} </td>
                                  <td > {{ $chantier->total_offre }} </td>
                                  
                              </tr>
                            
                          </tbody>
                      </table>   
  
                   </div>  
  
           
      </div>
  </div>
  
  
  
  @endsection