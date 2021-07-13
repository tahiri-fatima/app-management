@extends('chantierPersonnels.layout')
  
@section('content')

<div class="container " style="margin-left: 80%;" > 
            <a class="btn btn-primary" href="{{ route('chantierPersonnels.gestionForm') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 

<div class="col d-flex justify-content-center">
<div style="width: 100%;" >
    <div class="card " >

         <div class="card-header">
            <h5>Détails des personnels du chantier</h5>
                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li><i class="fa fa fa-wrench open-card-option"></i></li>
                        <li><i class="fa fa-window-maximize full-card"></i></li>
                        <li><i class="fa fa-minus minimize-card"></i></li>
                     </ul>
                </div>
            </div>
            
            <div class="card-block">
                <div class="table-responsive">
                    <table class="table  m-b-0 without-header">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6> <span style="font: size 16px; color:#0d46a1;">Code du chantier : </span>  {{ $chantier->code_chantier }}</h6>
                                        </div>
                                    </div>
                                </td>
                             
                                <td>
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6><span style="font: size 16px; color:#0d46a1;">Intitulé du chantier : </span>  {{ $chantier->intitule_chantier }} </h6>
                                        </div>
                                    </div>
                                </td>
                                
                            </tr>
                          
                            <table class="table table-hover m-b-0 text-center">
                                <thead >
                                    <tr style="font: size 16px; color:#0d46a1;">
                                        <th >Code du personnel</th>
                                        <th >Nom du personnel</th>
                                        <th >Date d'affectation</th>
                                        <th >Date fin d'affectation</th>
                                        <th>Effictif Réel</th>
                                        <th >Salaire Réel</th>
                                        
                                </thead>
                            
                            @foreach($chantier->personnels as $personnel)
                                <tr>
                                    <td ><h6>{{ $personnel->code_personne }} </h6></td>
                                    <td ><h6>{{ $personnel->nom_personne }} </h6></td>
                                    <td ><h6>{{ $personnel->date_affect }} </h6></td>
                                    <td ><h6>{{ $personnel->date_fin_affect }} </h6></td>
                                    <td ><h6>{{ $personnel->effictif_reel }} </h6></td>
                                    <td ><h6>{{ $personnel->salaire_reel }} </h6></td>
                                </tr>
                                
                              
                    
                            @endforeach

                            <tr>
                                  <td colspan="5"><h6>Montant Salaire </h6></td>
                                  <td><h6>{{ $personnel->montant_salaire }} </h6></td>

                              </tr>
                            </table>
                     
                           

                            
                        </tbody>
                    </table>
                 </div>
            </div>
        </div>
    </div>
</div>




@endsection