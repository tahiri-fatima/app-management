@extends('acomptes.layout')
   
@section('content')

<div class="container " style="margin-left:70%"> 
            <a class="btn btn-primary" href="{{ route('acomptes.gestionForm') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 
<div class="col d-flex justify-content-center" > 
   <!-- Alert si le code est dupliqué !-->
   @if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
        <div class="alert alert-danger message">
            <strong>Whoops!</strong> Il y a dejà un enregistrement avec ce code.<br><br>
            
        </div>
    @endif


    @if ($errors->any())
        <div class="alert alert-danger message">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  </div>
  
<!-- start Formulaire -->

<div class="col d-flex justify-content-center" > 
    <div class="card" style="width:70%">  
        <div class="card-header">
            <h5><i class="fa fa-fw fa-edit"></i>  Modifier l'acompte</h5>
        </div>
        <div class="card-block">
        <p style="font-weight:bold; margin-bottom : 30px;">Les champs avec <span class="text-danger">*</span> sont obligatoire!</p>

            <form class="form-material" action="{{ route('acomptes.update',$acompte->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row justify-content-around" >
                <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="text" name="code_acompte" class="form-control" value="{{ $acompte->code_acompte }}" placeholder="Entrer le code d'acompte">
                            <span class="form-bar"></span>
                            <label class="float-label">Code d'acompte <span class="text-danger">*</span> </label>
                        </div>
                </div>
                    <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                        <input type="date" name="date_acompte" class="form-control" value="{{ $acompte->date_acompte }}">
                        <span class="form-bar"></span>
                        <label class="float-label">Date d'acompte <span class="text-danger">*</span> </label>
                    </div>
                    </div>
            </div>
                <div class="row justify-content-around" >
        <div class="col-6">
                <div class="form-group form-primary form-static-label">
                    <input type="text" name="montant_acompte" class="form-control" value="{{ $acompte->montant_acompte }}" placeholder="Entrer le montant d'acompte">
                    <span class="form-bar"></span>
                    <label class="float-label">Montant d'acompte <span class="text-danger">*</span> </label>
                </div>
        </div>
                <div class="col-6">
                <div class="form-group form-primary form-static-label">
                    <input type="text" name="type_reglement" class="form-control" value="{{ $acompte->type_reglement }}" placeholder="Entrer le type de réglement d'acompte">
                    <span class="form-bar"></span>
                    <label class="float-label">Type de réglement d'acompte <span class="text-danger">*</span> </label>
                </div>
                </div>
                </div>
        <div class="row ">
                <div class="col-6">
                <div class="form-group form-primary form-static-label">
                <label class="select-label " >Facture <span class="text-danger">*</span> </label>
                    <div class="select">
                        <select class="form-control" name="facture_id"  >
                        <option  value="{{ $facture->id }}">{{ $facture->code_facture }}</option>
                            @foreach($factures as $facture)
                                <option value="{{ $facture->id }}">{{ $facture->code_facture }}</option>
                            @endforeach
                        </select>
                    </div>                
                     <span class="form-bar"></span>
                </div> 
                </div>

               
        </div>
               
                <div class=" text-right">
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-fw fa-edit"></i> Modifier</button>
                </div>                         
            </form>
         </div>
    </div>
<!-- end formulaire-->
</div>

  
@endsection