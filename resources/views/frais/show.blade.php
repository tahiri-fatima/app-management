@extends('frais.layout')
  
@section('content')




<div class="container " style="margin-left:70%"  > 
         <a class="btn btn-outline-primary" href="{{ route('frais.gestionForm') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 
    <div class="col d-flex justify-content-center">
<div class="col-xl-6 col-md-12 ">
    <div class="card table-card">

         <div class="card-header">
            <h5>Détails du frais</h5>
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
                    <table class="table table-hover m-b-0 without-header">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6>Code du frais : </h6> 
                                        </div>
                                    </div>
                                </td>
                                <td >
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6> {{ $frai->code_frais }}</h6>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6>Nature du frais : </h6>
                                        </div>
                                    </div>
                                </td>
                                <td >
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6> {{ $nature_frais->nature_frais  }}</h6>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6>Montant du frais : </h6>
                                        </div>
                                    </div>
                                </td>
                                <td >
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6>{{ $frai->montant_frais }}</h6>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                 

                            <tr>
                                <td>
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6>Date du frais : </h6>
                                        </div>
                                    </div>
                                </td>
                                <td >
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6> {{ $frai->date_frais }} </h6>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6>Cible du frais : </h6> 
                                        </div>
                                    </div>
                                </td>
                                <td >
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6> {{ $frai->cible_frais }}</h6>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6>Chantier :</h6>
                                        </div>
                                    </div>
                                </td>
                                <td >
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6>{{ $chantier->intitule_chantier }}</h6>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                 </div>
            </div>
        </div>
    </div>
</div>


@endsection