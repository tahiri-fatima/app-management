@extends('chantierMateriels.layout')
  
@section('content')

<div class="container " style="margin-left: 80%;" > 
            <a class="btn btn-primary" href="{{ route('chantierMateriels.gestionForm') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 

<div class="col d-flex justify-content-center">
<div style="width: 100%;" >
    <div class="card " >

         <div class="card-header">
            <h5>Détails des matériels du chantier</h5>
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
                                        <th >Code du matériel</th>
                                        <th >Intitulé du matériel</th>
                                        <th >Date début de service</th>
                                        <th >Date fin de service</th>
                                        <th>Prix unitaire</th>
                                        <th >Taux d'ajustement</th>
                                        <th >Montant net</th>
                                        
                                </thead>
                            
                            @foreach($chantier->materiels as $materiel)
                                <tr>
                                    <td ><h6>{{ $materiel->code_materiel }} </h6></td>
                                    <td ><h6>{{ $materiel->intitule_materiel }} </h6></td>
                                    <td ><h6>{{ $materiel->d_debut_service }} </h6></td>
                                    <td ><h6>{{ $materiel->d_fin_service }} </h6></td>
                                    <td ><h6>{{ $materiel->prix_unit }} </h6></td>
                                    <td ><h6>{{ $materiel->t_ajustement }} </h6></td>
                                    <td ><h6>{{ $materiel->mont_net }} </h6></td>
                                </tr>
                                
                              
                    
                            @endforeach

                            <tr>
                                  <td colspan="6"><h6>Montant net total </h6></td>
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