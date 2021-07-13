@extends('chantiers.layout')
   
@section('content')


  
<div class="container" style="margin-left:75%"> 
            <a class="btn btn-primary" href="{{ route('chantiers.gestionForm') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 
   <div class="col d-flex justify-content-center message">
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <!-- Alert si le code est dupliqué !-->
    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Il y a dejà un chantier avec ce code de chantier.<br><br>
            
        </div>
    @endif

<!-- Alert si la date fin est supérieure à la date début !-->
@if(!empty(Session::get('error_code')) && Session::get('error_code') == 2)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Il faut entrer une date fin supérieure à la date début de chantier !<br><br>
            
        </div>
@endif
   </div>

<!-- start Formulaire -->

<div class="col d-flex justify-content-center" > 
    <div class="card" style="width:80%">  
        <div class="card-header">
            <h5><i class="fa fa-fw fa-edit"></i>  Modifier le chantier</h5>
        </div>
        <div class="card-block">
        <p style="font-weight:bold; margin-bottom: 30px;">Les champs avec <span class="text-danger">*</span> sont obligatoire.</p>

            <form class="form-material" action="{{ route('chantiers.update',$chantier->id) }}" method="POST">
                @csrf
            @method('PUT')
                
                <div class="row justify-content-around" >
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                        <label class="float-label" style="top: -14px; font-size: 11px; color: #448aff;">Code du chantier <span class="text-danger">*</span> </label>
                            <input type="text" name="code_chantier" value="{{ $chantier->code_chantier }}" class="form-control" placeholder="Entrer le code du chantier">
                            <span class="form-bar"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                        <label class="float-label" style="top: -14px; font-size: 11px; color: #448aff;">Intitulé du chantier<span class="text-danger">*</span> </label>
                            <input type="text" name="intitule_chantier" value="{{ $chantier->intitule_chantier }}" class="form-control" placeholder="Entrer l'intitulé du chantier">
                            <span class="form-bar"></span>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-around" >
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                        <label class="float-label" style="top: -14px; font-size: 11px; color: #448aff;">Numéro du marche <span class="text-danger">*</span> </label>
                            <input type="text" name="numero_marche" value="{{ $chantier->numero_marche }}" class="form-control" placeholder="Entrer le numéro du marche">
                            <span class="form-bar"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                        <label class="float-label" style="top: -14px; font-size: 11px; color: #448aff;">Localisation <span class="text-danger">*</span> </label>
                            <input type="text" name="localisation" value="{{ $chantier->localisation }}" class="form-control" placeholder="Entrer localisation">
                            <span class="form-bar"></span>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-around" >
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                        <label class="float-label" style="top: -14px; font-size: 11px; color: #448aff;">Date début du chantier <span class="text-danger">*</span> </label>
                            <input type="date" name="date_debut_chantier" value="{{ $chantier->date_debut_chantier }}" class="form-control" placeholder="Entrer la date début du chantier">
                            <span class="form-bar"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                        <label class="float-label" style="top: -14px; font-size: 11px; color: #448aff;">Date fin du chantier  </label>
                            <input type="date" name="date_fin_chantier" value="{{ $chantier->date_fin_chantier }}" class="form-control" placeholder="Entrer la date fin du chantier">
                            <span class="form-bar"></span>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-around" >
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="double" name="montant_marche" value="{{ $chantier->montant_marche }}" class="form-control" placeholder="Entrer le montant de marché">
                            <span class="form-bar"></span>
                            <label class="float-label">Montant de marché <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="double" name="r_garantie" value="{{ $chantier->r_garantie }}" class="form-control" placeholder="Entrer le retenue garantie">
                            <span class="form-bar"></span>
                            <label class="float-label">Retenue garantie <span class="text-danger">*</span> </label>
                        </div>
                    </div>  
                </div>

              
                


                <div class=" text-right">
        <button type="submit" class="btn btn-primary"> <i class="fa fa-fw fa-edit"></i> Editer</button>
</div>
                                                 
            </form>
         </div>
    </div>

<!-- end Formulaire -->

  
@endsection