@extends('chantierNatureFrais.layout')
  
@section('content')

<div class="container " style="margin-left: 80%;" > 
            <a class="btn btn-primary" href="{{ route('chantierNatureFrais.gestionForm') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 

<div class="col d-flex justify-content-center">
<div style="width: 90%;" >
    <div class="card " >

         <div class="card-header">
            <h5>Détails des natures des frais du chantier </h5>
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
                                        <th >Code de nature de frais</th>
                                        <th >Désignation de nature de frais</th>
                                        
                                        <th >Montant Estimée </th>
                                    </tr>
                                </thead>
                            
                            @foreach($chantier->nature_frais as $nature)
                                <tr>
                                    <td ><h6>{{ $nature->code_nature_frais }} </h6></td>
                                    <td ><h6>{{ $nature->nature_frais }} </h6></td>
                                    <td ><h6>{{ $nature->montant_estimee }} </h6></td>
                                    
                                </tr>
                                
                              
                    
                            @endforeach
                            <tr>
                                  <td colspan="2"><h6>Montant net total </h6></td>
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