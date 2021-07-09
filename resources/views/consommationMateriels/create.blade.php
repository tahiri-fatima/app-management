@extends('consommationMateriels.layout')


  
@section('content')

  
<div class="container " style="margin-left: 75%;" > 
            <a class="btn btn-primary" href="{{ route('consommationMateriels.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 

<div class="col d-flex justify-content-center ">
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
    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
        <div class="alert alert-danger message">
            <strong>Whoops!</strong> Il y a dejà une consommation avec ce code de consommation.<br><br>
            
        </div>
    @endif

<!-- Affichage de modal si la consommation ajouté avec succes. !-->
    @if(!empty(Session::get('success')) && Session::get('success') == 'Consommation du materiel a ajouté avec succes.')
    <script>
        $(function() {
            $('#myModal').modal('show');
        });
    </script>
    @endif

<!-- modal si consommation ajouté avec succes !-->
<div class="modal" tabindex="-1" role="dialog" id="myModal" >
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
            <p>Consommation ajouté avec succes.</p>
            <p>Voulez vous insérer une autre consommation ?</p>
        </strong>
      </div>
      <div class="modal-footer">
        <a class="btn btn-outline-secondary" href="{{ route('consommationMateriels.index') }}"> Non</a>
        
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
    <div class="card" style="width:50%">  
        <div class="card-header">
            <h5><i class="fa fa-fw fa-plus-circle"></i>  Ajouter nouvelle consommation</h5>
        </div>
        <div class="card-block">
        <p style="font-weight:bold; margin-bottom: 30px;">Les champs avec <span class="text-danger">*</span> sont obligatoire.</p>

            <form id="form" class="form-material" action="{{ route('consommationMateriels.store') }}" method="POST">
            @csrf
                <div class="form-group form-primary form-static-label">
                    <input type="text" name="code_consommation_mat" class="form-control" placeholder="Entrer le code de la consommation du matériel">
                    <span class="form-bar"></span>
                    <label class="float-label">Code de consommation du matériel <span class="text-danger">*</span> </label>
                </div>

                <div class="form-group form-primary form-static-label">
                    <input type="decimal" name="quantite_consommation_mat" class="form-control" placeholder="Entrer la quantité consommée du matériel">
                    <span class="form-bar"></span>
                    <label class="float-label">Quantité de consommée <span class="text-danger">*</span> </label>
                    
                </div>

                <div class="form-group form-primary form-static-label">
                    <input type="date" name="date_consommation_mat" class="form-control" >
                    <span class="form-bar"></span>
                    <label class="float-label">Date de la consommation <span class="text-danger">*</span> </label>
                </div>


                <div class="form-group form-primary form-static-label">
                <label class="form-label " style="top: -14px; font-size: 11px; color: #448aff;">Matériel consommée <span class="text-danger">*</span> </label>
                    <div class="select">
                        <select class="form-control" name="materiel_id">
                            <option value="">Selectionner matériel</option>
                            @foreach($materiels as $materiel)
                                <option value="{{ $materiel->id }}">{{ $materiel->intitule_materiel }}</option>
                            @endforeach
                        </select>   
                    </div>                
                     <span class="form-bar"></span>
                     
                </div>

                <div class=" text-right" style="margin-top: 10px;">
                <button type="button" class="btn btn-primary" onclick="$('#modal2').modal('show');"> <i class="fa fa-fw fa-plus-circle"> </i> Ajouter</button>
                <button type="reset" class="btn btn-info" style="margin-left: 10px;"><i class="fa fa-fw fa-sync" ></i> Réinitialiser</button>
                 </div>
                                                 
            </form>
         </div>
    </div>

<!-- end Formulaire -->


@endsection