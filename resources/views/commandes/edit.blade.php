@extends('commandes.layout')
   
@section('content')
  
<div class="container " style="margin-left: 80%;" > 
            <a class="btn btn-primary" href="{{ route('commandes.show',$commande->id) }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 

<div class="col  justify-content-center message" > 

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
         <p>   <strong>Whoops!</strong> Il y a dejà une commade avec ce code.<br><br> </p>
            
        </div>
    @endif
</div>

    
<!-- start Formulaire -->

<div class="col d-flex justify-content-center" > 
    <div class="card" style="width:70%">  
        <div class="card-header">
            <h5><i class="fa fa-fw fa-edit"></i>  Modifier la commande</h5>
        </div>
        <div class="card-block">
        <p style="font-weight:bold; margin-bottom : 30px;">Les champs avec <span class="text-danger">*</span> sont obligatoire.</p>

            <form class="form-material" action="{{ route('commandes.update',$commande->id) }}" method="POST">
                @csrf
            @method('PUT')
                
                <div class="row justify-content-around" >
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                        <label class="select-label" >Code de la commande <span class="text-danger">*</span> </label>
                            <input type="text" name="code_commande" value="{{ $commande->code_commande }}" class="form-control" placeholder="Entrer le code de la commande">
                            <span class="form-bar"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                        <label class="select-label" >Date de la commande <span class="text-danger">*</span> </label>
                            <input type="date" name="date_commande" value="{{ $commande->date_commande }}" class="form-control" placeholder="Entrer l'intitulé du chantier">
                            <span class="form-bar"></span>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-around" >
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <label class="select-label " >Fournisseur <span class="text-danger">*</span> </label>
                            <div class="select">
                                <select class="form-control" name="fournisseur_id">
                                    <option value="{{ $commande->fournisseur_id }}">{{ $fournisseur->intitule_fournisseur }}</option>
                                    @foreach($fournisseurs as $fournisseur)
                                        <option value="{{ $fournisseur->id }}">{{ $fournisseur->intitule_fournisseur }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="form-bar"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <label class="select-label " >Chantier <span class="text-danger">*</span> </label>
                            <div class="select">
                                <select class="form-control" name="chantier_id">
                                <option value="{{ $commande->chantier_id }}">{{ $chantier->intitule_chantier }}</option>
                                    @foreach($chantiers as $chantier)
                                        <option value="{{ $chantier->id }}">{{ $chantier->intitule_chantier }}</option>
                                    @endforeach
                            </select>
                            </div>
                            <span class="form-bar"></span>
                        </div>
                    </div>
                    
                </div>      

                <div class=" text-right" style="margin-top: 10px;">
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-fw fa-plus-circle"> </i> Ajouter</button>
                    <button type="reset" class="btn btn-info" style="margin-left: 10px;"><i class="fa fa-fw fa-sync" ></i> Réinitialiser</button>
                </div>
                                                 
            </form>
         </div>
    </div>

<!-- end Formulaire -->



    <!-- formulaire 
    <div class="card">

<div class="card-header"><strong> Modifier la commande</strong> </div>

    <div class="card-body">
        
        <div class="col-sm-8">

<form action="{{ route('commandes.update',$commande->id) }}" method="POST">
    @csrf
   @method('PUT')

    <div class="row justify-content-around">
        <div class="col-6">
            <div class="form-group">
            <label > <strong>Code : <span class="text-danger">*</span></strong></label>
                <input type="text" name="codecommande" value="{{ $commande->codecommande }}" class="form-control" placeholder="Code">
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
            <label><strong>Date de la commande : <span class="text-danger">*</span></strong></label>
                <input type="date" class="form-control" name="datecommande" value="{{ $commande->datecommande }}" placeholder="Date commande">
            </div>
        </div>
    </div>

    <div class="row justify-content-around">
        <div class="col-6">
            <div class="form-group">
                <label ><strong>Chantier : <span class="text-danger">*</span></strong></label>
                <div class="select">
                <select class="form-control" name="chantier_id" >
                    <option value="{{ $chantier->id }}">{{ $chantier->intitulechantier }}</option>
                    @foreach($chantiers as $chantier)
                        <option value="{{ $chantier->id }}">{{ $chantier->intitulechantier }}</option>
                    @endforeach
                </select>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <labe><strong>Fournisseur : <span class="text-danger">*</span></strong></label>
                <div class="select">
                <select class="form-control" name="fournisseur_id" >
                    <option value="{{ $fournisseur->id }}">{{ $fournisseur->intitulefournisseur }}</option>
                    @foreach($fournisseurs as $fournisseur)
                        <option value="{{ $fournisseur->id }}">{{ $fournisseur->intitulefournisseur }}</option>
                    @endforeach
                </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
    <div class="col-6">
                <div class="form-group">
                    <label><strong>Matériaux : <span class="text-danger">*</span></strong></label>
                    <div class="select">
                    <select class="form-control" multiple name="materiaus[]">
                        @foreach($materiaus as $materiau)
                            <option value="{{ $materiau->id }}" {{ in_array($materiau->id, old('materiaus') ?: $commande->materiaus->pluck('id')->all()) ? 'selected' : '' }}>{{ $materiau->intitulemateriau }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
            </div>
    </div>

<div class=" text-right">
        <button type="submit" class="btn btn-primary"> <i class="fa fa-fw fa-edit"></i> Editer</button>
</div>
</div>

</form>
</div>
    </div>
</div>!-->
@endsection