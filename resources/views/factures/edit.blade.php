@extends('factures.layout')
   
@section('content')
  
<div class="container " style="margin-left: 70%;"  > 
            <a class="btn btn-primary" href="{{ route('factures.gestionForm') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 

<div class="col  justify-content-center message" > 


<!-- Alert si le code est dupliqué !-->
@if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
        <div class="alert alert-danger">
        <p>    <strong>Whoops!</strong> Il y a dejà un enregistrement avec ce code de facture.<br><br> </p>
            
        </div>
    @endif
   
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
</div>


<!-- start Formulaire -->

<div class="col d-flex justify-content-center" > 
    <div class="card" style="width:80%">  
        <div class="card-header">
            <h5> <i class="fa fa-fw fa-edit"></i>  Modifier la facture</h5>
        </div>
        <div class="card-block">

        <p style="font-weight:bold; margin-bottom : 30px;">Les champs avec <span class="text-danger">*</span> sont obligatoire.</p>


        <form class="form-material" action="{{ route('factures.update',$facture->id) }}" method="POST">
            @csrf
        @method('PUT')

            <div class="row justify-content-around" >
                <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                        <input type="text" name="code_facture"  value="{{ $facture->code_facture }}" class="form-control" placeholder="Entrer le code de la facture">
                        <span class="form-bar"></span>
                        <label class="float-label">Code facture <span class="text-danger">*</span> </label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                        <input type="date" name="date_facture"  value="{{ $facture->date_facture }}" class="form-control">
                        <span class="form-bar"></span>
                        <label class="float-label">Date facture <span class="text-danger">*</span> </label>  
                    </div>
                </div>
            </div>

                <div class="row justify-content-around" >
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="text" name="montant_facture"  value="{{ $facture->montant_facture }}" class="form-control" placeholder="Entrer le montant de la facture">
                            <span class="form-bar"></span>
                            <label class="float-label">Montant facture <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="boolean" name="reglee" value="{{ $facture->reglee }}" class="form-control" placeholder="Entrer 0 ou 1">
                            <span class="form-bar"></span>
                            <label class="float-label">Facture réglée <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>
               <div class="row">
                <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                    <label class="select-label " >Commade <span class="text-danger">*</span> </label>
                        <div class="select">
                            <select class="form-control" name="commande_id">
                            <option value="{{ $commande->id }}">{{ $commande->code_commande }}</option>
                                @foreach($commandes as $commande)
                                    <option value="{{ $commande->id }}">{{ $commande->code_commande }}</option>
                                @endforeach
                            </select>
                        </div>                
                        <span class="form-bar"></span> 
                    </div>
                </div>
               </div>
                <div class=" text-right">
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-fw fa-edit"></i> Editer</button>
                  </div>
                                                 
            </form>
         </div>
    </div>
<!-- end formulaire -->


@endsection