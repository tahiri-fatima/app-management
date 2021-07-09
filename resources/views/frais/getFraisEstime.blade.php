
@extends('layouts.app')
  
  @section('content')
    
  <div class=" text-right" style="margin-bottom: 30px;margin-top: 20px;margin-right: 100px;"> 
      <a class="btn btn-primary" href="{{ route('chantiers.listeFraisEstime') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
      <button class="btn btn-primary" type="button" onclick="PrintPage()" value="Imprimer" ><i class="fa fa-print" aria-hidden="true"></i>Imprimer</button>
  </div> 
  
  
  
  <div class="col d-flex justify-content-center" id="printableArea"> 
  
  <div style="width:90%" >
      <div class="card ">
  
      <div >
         
         <div class="text-center" style="margin-bottom: 20px; margin-top: 20px">
             <h5> Estimation des frais du chantier <span style="font-weight:bold"> {{ $chantier->intitule_chantier }} </span> </h5>       
        </div>
                      <table class="table m-b-0 text-center" >
                          <thead style="font-weight:bold">
                              <td>Code Frais</td>
                              <td>Catégorie</td>
                              <td>Cible</td>
                              <td>Montant estimé</td>
                          </thead>
                          <tbody >
                          @foreach($frais as $frai)
                              <tr >
                                  <td >{{ $frai->code_frais }} </td>
                                  <td >{{ $frai->nature_frais }} </td>
                                  <td> {{ $frai->cible_frais }}</td>
                                  <td >{{ $frai->montant_estime }} </td>
                              </tr>
                          @endforeach
                          <tr >
                                  <td colspan="3" style="font-weight:bold" >Total Estimation des frais </td>
                                  <td > {{ $chantier->total }} </td>
                              </tr>
                            
                          </tbody>
                      </table>   
  
                   </div>  
  
           
      </div>
  </div>
  
  
  
  @endsection