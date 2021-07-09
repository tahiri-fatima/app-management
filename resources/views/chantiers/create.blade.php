@extends('chantiers.layout')


  
@section('content')

  
<div class="container " style="margin-left:75%" > 
            <a class="btn btn-primary" href="{{ route('chantiers.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 

<div class="col d-flex justify-content-center " > 

<!-- Alert si la date fin est supérieure à la date début !-->
@if(!empty(Session::get('error_code')) && Session::get('error_code') == 2)
        <div class="alert alert-danger message">
          <p>  <strong>Whoops!</strong> Il faut entrer une date fin supérieure à la date début de chantier !<br><br></p>
            
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

<!-- Alert si le code est dupliqué !-->
    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 1)
        <div class="alert alert-danger message">
          <p>  <strong>Whoops!</strong> Il y a dejà un chantier avec ce code de chantier.<br><br></p>
            
        </div>
    @endif

<!-- Affichage de modal si le chantier ajouté avec succes. !-->
    @if(!empty(Session::get('success')) && Session::get('success') == 'Enregistrement ajouté avec succes.')
    <script>
        $(function() {
            $('#modal').modal('show');
        });
    </script>
    @endif

<!-- modal si chantier ajouté avec succes !-->
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
            <p>Chantier ajouté avec succes.</p>
            <p>Voulez vous insérer un autre chantier ?</p>
        </strong>
      </div>
      <div class="modal-footer">
        <a class="btn btn-outline-secondary" href="{{ route('chantiers.index') }}"> Non</a>
        
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
            <h5><i class="fa fa-fw fa-plus-circle"></i>  Ajouter nouveau chantier</h5>
        </div>
        <div class="card-block">
        <p style="font-weight:bold;margin-bottom: 30px;">Les champs avec <span class="text-danger">*</span> sont obligatoire.</p>

            <form id="form" class="form-material" action="{{ route('chantiers.store') }}" method="POST">
            @csrf
                
                <div class="row justify-content-around" >
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="text" name="code_chantier" class="form-control" placeholder="Entrer le code du chantier">
                            <span class="form-bar"></span>
                            <label class="float-label">Code du chantier<span class="text-danger">*</span> </label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="text" name="intitule_chantier" class="form-control" placeholder="Entrer l'intitulé du chantier">
                            <span class="form-bar"></span>
                            <label class="float-label">Intitulé du chantier<span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-around" >
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="text" name="numero_marche" class="form-control" placeholder="Entrer le numéro du marche">
                            <span class="form-bar"></span>
                            <label class="float-label">Numéro du marché <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="text" name="localisation" class="form-control" placeholder="Entrer localisation">
                            <span class="form-bar"></span>
                            <label class="float-label">Localisation <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-around" >
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="date" name="date_debut_chantier" class="form-control" placeholder="Entrer la date début du chantier">
                            <span class="form-bar"></span>
                            <label class="float-label">Date début du chantier <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="date" name="date_fin_chantier" class="form-control" placeholder="Entrer la date fin du chantier">
                            <span class="form-bar"></span>
                            <label class="float-label">Date fin du chantier  </label>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-around" >
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="double" name="montant_marche" class="form-control" placeholder="Entrer le montant de marché">
                            <span class="form-bar"></span>
                            <label class="float-label">Montant de marché <span class="text-danger">*</span> </label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="number" name="r_garantie" class="form-control" placeholder="Entrer le retenue garantie">
                            <span class="form-bar"></span>
                            <label class="float-label">Retenue garantie <span class="text-danger">*</span> </label>
                        </div>
                    </div>
                </div>

                
                

                <div class=" text-right" style="margin-top: 10px;">
                    <button type="button" class="btn btn-primary" onclick="$('#modal2').modal('show');"> <i class="fa fa-fw fa-plus-circle"> </i> Ajouter </button>
                    <button type="reset" class="btn btn-info" style="margin-left: 10px;"><i class="fa fa-fw fa-sync" ></i> Réinitialiser</button>
                </div>
                                                 
            </form>
         </div>
    </div>

<!-- end Formulaire -->


   
@endsection

