
@extends('layouts.app')
  
  @section('content')
    
  <div class=" text-right" style="margin-bottom: 30px;margin-top: 20px;margin-right: 100px;"> 
      <a class="btn btn-primary" href="{{ route('chantiers.listeFraisChantier') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
      <button class="btn btn-primary" type="button" onclick="PrintPage()" value="Imprimer" ><i class="fa fa-print" aria-hidden="true"></i>Imprimer</button>
  </div> 
  
  
  
  <div class="col d-flex justify-content-center" id="printableArea"> 
  
  <div style="width:90%" >
      <div class="card ">
  
      <div>
      <div class="text-center">
           <img class="img" src="{{url('assets/images/logo.png')}}"  style="width: 170px; height: 70px; margin-top:25px " />
           <h5 style="margin:30px 15px 30px 15px; text-align:center">Liste des frais </h5>

                      
            </div>
                      <table class="table m-b-0 text-center" >
                          <thead style="font-weight:bold">
                              <td>Code Frais</td>
                              <td>Catégorie</td>
                              <td>Cible</td>
                              <td>Montant</td>
                          </thead>
                          <tbody >
  <?php $total=0 ?>
                          @foreach($frais as $frai)
                              <tr >
                                  <td >{{ $frai->code_frais }} </td>
                                  <td >{{ $frai->nature_frais }} </td>
                                  <td> {{ $frai->cible_frais }}</td>
                                  <td >{{ $frai->montant_frais }} </td>
                              </tr>
                              <?php $total += $frai->montant_frais ?>
                          @endforeach
                          <tr >
                                  <td colspan="3" style="font-weight:bold" >Total </td>
                                  <td > {{ $total }} </td>
                              </tr>
                            
                          </tbody>
                      </table>   
  
                   </div>  
  
           
      </div>
  </div>
  
  
  
  @endsection