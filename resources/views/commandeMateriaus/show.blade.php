@extends('commandeMateriaus.layout')
  
@section('content')


<div class="container " style="margin-left: 80%;" > 
       
       <a class="btn btn-primary" href="{{ route('commandeMateriaus.gestionForm') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
       
</div> 



<div class="col d-flex justify-content-center">
<div style="width: 90%;" >
    <div class="card " >

         <div class="card-header">
            <h5>Détails du commande_matériaux</h5>
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
                                            <h6> <span style="font: size 16px; color:#0d46a1;">Code de la commande : </span>  {{ $commande->code_commande }}</h6>
                                        </div>
                                    </div>
                                </td>
                             
                                <td>
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6><span style="font: size 16px; color:#0d46a1;">Date de la commande : </span>  {{ $commande->date_commande }} </h6>
                                        </div>
                                    </div>
                                </td>
                                
                            </tr>
                          
                            <table class="table table-hover m-b-0 text-center">
                                <thead >
                                    <tr >
                                        <th >Code du Matériau</th>
                                        <th >Intitulé du Matériau</th>
                                        <th >Prix unitaire du matériau</th>
                                        <th >Quantité du matériau</th>
                                        <th >Montant du matériau</th>
                                    </tr>
                                </thead>
                            
                            @foreach($commande->materiaus as $materiau)
                                <tr>
                                    <td ><h6>{{ $materiau->code_materiau }} </h6></td>
                                    <td ><h6>{{ $materiau->intitule_materiau }} </h6></td>
                                    <td ><h6>{{ $materiau->prix_unit_materiau }} </h6></td>
                                    <td ><h6>{{ $materiau->quantite_materiau }} </h6></td>
                                    <td ><h6>{{ $materiau->montant_materiau }} </h6></td>

                                </tr>
                    
                            @endforeach
                              <tr>
                                  <td colspan="4" style="font-weight:bold;"><h6>Montant total de la commande </h6></td>
                                  <td><h6>{{ $commande->total_commande }} </h6></td>
                              </tr>
                            </table>
                            
                            <div class="d-inline-block align-middle">
                                            <div class="d-inline-block">
                                                       </div>
                                        </div>
                           

                            
                        </tbody>
                    </table>
                 </div>
            </div>
        </div>
    </div>
</div>

@endsection