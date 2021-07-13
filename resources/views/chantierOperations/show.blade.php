@extends('chantierOperations.layout')
  
@section('content')


<div class="container " style="margin-left: 80%;" > 
            <a class="btn btn-primary" href="{{ route('chantierOperations.gestionForm') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 


<div class="col d-flex justify-content-center">
<div style="width: 90%;" >
    <div class="card " >

         <div class="card-header">
            <h5>Détails des opérations du chantier </h5>
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
                                            <h6><span style="font: size 16px; color:#0d46a1;">Désignation du chantier : </span>  {{ $chantier->intitule_chantier }} </h6>
                                        </div>
                                    </div>
                                </td>
                                
                            </tr>
                          
                            <table class="table table-hover m-b-0 text-center">
                                <thead >
                                    <tr style="font: size 16px; color:#0d46a1;">
                                        <th >Code d'opération</th>
                                        <th >Désignation d'opération</th>
                                        <th >Date début d'opération</th>
                                        <th >Date fin d'opération</th>
                                        <th >Prix unitaire d'opération</th>
                                        <th >Quantité d'opération </th>
                                        <th >Prix de vente</th>
                                       
                                        <th >Taux d'ajustement</th>
                                        <th >Montant net </th>
                                    </tr>
                                </thead>
                            
                            @foreach($chantier->operations as $operation)
                                <tr>
                                    <td ><h6>{{ $operation->code_operation }} </h6></td>
                                    <td ><h6>{{ $operation->designation_operation }} </h6></td>
                                    <td ><h6>{{ $operation->date_deb_operation }} </h6></td>
                                    <td ><h6>{{ $operation->date_fin_operation }} </h6></td>
                                    <td ><h6>{{ $operation->prix_unitaire_revient }} </h6></td>
                                    <td ><h6>{{ $operation->quantite_operation }} </h6></td>
                                    <td ><h6>{{ $operation->prix_unitaire_vente }} </h6></td>
                                    <td ><h6>{{ $operation->taux_ajustement }} </h6></td>
                                    <td ><h6>{{ $operation->montant_estimee }} </h6></td>
                                </tr>
                                
                              
                    
                            @endforeach
                            <tr>
                                  <td colspan="8"><h6>Montant net total </h6></td>
                                  <td><h6>{{ $chantier->total }} </h6></td>
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