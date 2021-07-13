@extends('factures.layout')
 
@section('content')

  
<div class="container " style="margin-left: 70%;" > 
            <a class="btn btn-primary" href="{{ route('factures.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 

<div class="col d-flex justify-content-center" > 

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

<!-- Alert si le code est dupliqué !-->
    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 1)
        <div class="alert alert-danger message">
        <p>    <strong>Whoops!</strong> Il y a dejà un enregistrement avec ce code de facture.<br><br> </p>
            
        </div>
    @endif

    <!-- Alert si il y a deja une facture pour cette commande !-->
    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 2)
        <div class="alert alert-danger message">
        <p>    <strong>Whoops!</strong> Il y a dejà une facture pour cette commande.<br><br> </p>
            
        </div>
    @endif

<!-- Affichage de modal si le matériel ajouté avec succes. !-->
    @if(!empty(Session::get('success')) && Session::get('success') == 'Facture ajouté avec succes.')
    <script>
        $(function() {
            $('#modal').modal('show');
        });
    </script>
    @endif

<!-- modal si Matériel ajouté avec succes !-->
<div class="modal" tabindex="-1" role="dialog" id="modal" >
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header" >
        <h5 class="modal-title" style="color:#228B22;" > Ajout avec succes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
          <strong >
            <p>Enregistrement ajouté avec succes.</p>
            <p>Voulez vous insérer un autre enregistrement ?</p>
        </strong>
      </div>
      <div class="modal-footer">
        <a class="btn btn-outline-secondary" href="{{ route('factures.index') }}"> Non</a>
        
        <button type="button" class="btn btn-outline-success" data-dismiss="modal">Oui</button>
      </div>
    </div>
  </div>
</div>

<!-- modal de la confirmation !-->
<div class="modal" tabindex="-1" role="dialog" id="modal2" >
  <div class="modal-dialog" role="document" >
    <div class="modal-content" >
    
    <div class="modal-header" >
        <h5 class="modal-title" style="color:#228B22;" > Confirmation d'ajout</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
          <strong >
            
            <p>Pouvez vous confirmer l'ajout de ce nouveau enregistrement ? </p>
        </strong>
      </div>
      <div class="modal-footer">
        <a type="submit" class="btn btn-outline-success confirmer" > Confirmer</a>
        
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"> Annuler</button>
      </div>
    </div>
    </div>
  </div>

</div>

<!-- start Formulaire -->

<div class="col d-flex justify-content-center" > 
    <div class="card" style="width:80%">  
        <div class="card-header">
            <h5><i class="fa fa-fw fa-plus-circle"></i>  Ajouter nouvelle facture</h5>
        </div>
        <div class="card-block">

        <p style="font-weight:bold; margin-bottom : 30px;">Les champs avec <span class="text-danger">*</span> sont obligatoire.</p>

            <form id="form" class="form-material" action="{{ route('factures.store') }}" method="POST">
            @csrf
            <div class="row justify-content-around" >
                <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                        <input type="text" name="code_facture" class="form-control" placeholder="Entrer le code de la facture">
                        <span class="form-bar"></span>
                        <label class="float-label">Code facture <span class="text-danger">*</span> </label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                        <input type="date" name="date_facture" class="form-control">
                        <span class="form-bar"></span>
                        <label class="float-label">Date facture <span class="text-danger">*</span> </label>  
                    </div>
                </div>
            </div>

                <div class="row justify-content-around" >
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="double" name="montant_facture" class="form-control" placeholder="Entrer le montant de la facture">
                            <span class="form-bar"></span>
                            <label class="float-label">Montant facture <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="boolean" name="reglee" class="form-control" placeholder="Entrer 0 ou 1">
                            <span class="form-bar"></span>
                            <label class="float-label">Facture réglée <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>
               
                <div class="row " >
                    
                <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                    <label class="select-label " >Commande <span class="text-danger">*</span> </label>
                        <div class="select">
                            <select class="form-control" name="commande_id">
                                <option value="">Selectionner commande</option>
                                @foreach($commandes as $commande)
                                    <option value="{{ $commande->id }}">{{ $commande->code_commande }}</option>
                                @endforeach
                            </select>
                        </div>                
                        <span class="form-bar"></span> 
                    </div>
                </div>
                </div>
                <div class=" text-right" style="margin-top: 10px;">
                <button type="button" class="btn btn-primary" onclick="$('#modal2').modal('show');"> <i class="fa fa-fw fa-plus-circle"> </i> Ajouter</button>
                 </div>
                                                 
            </form>
         </div>
    </div>
<!-- end formulaire -->


@endsection