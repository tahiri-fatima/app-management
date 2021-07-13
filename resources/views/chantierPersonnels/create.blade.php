@extends('chantierPersonnels.layout')


  
@section('content')

  
<div class="container " style="margin-left: 80%;"> 
            <a class="btn btn-primary" href="{{ route('chantierPersonnels.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 

<div class="col d-flex justify-content-center" >
<!-- Alert si la date fin est supérieure à la date début !-->
        <div class="alert alert-danger message" id="date" style="display: none">
            <strong>Whoops!</strong> Il faut entrer une date fin supérieure à la date début de service !<br><br>
            
        </div>



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
            <strong>Whoops!</strong> Il y a dejà un enregistement avec ces codes de chantier et de matériel.<br><br>
            
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
            <p>Enregistrement ajouté avec succes.</p>
            <p>Voulez vous insérer un autre enregistrement ?</p>
        </strong>
      </div>
      <div class="modal-footer">
        <a class="btn btn-outline-secondary" href="{{ route('chantierPersonnels.index') }}"> Non</a>
        
        <button type="button" class="btn btn-outline-success" data-dismiss="modal">Oui</button>
      </div>
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


<!-- start Formulaire -->

<div class="col d-flex justify-content-center " >
<div style="width:100%" >

    <div class="card" >  
        <div class="card-header">
            <h5><i class="fa fa-fw fa-plus-circle"></i>  Ajouter les personnels des chantiers</h5>
        </div>
        <div class="card-block">
        <div class="table-responsive">
            <form class="form-material" id="form" action="{{ route('chantierPersonnels.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return verifierChampsPersonnel()" >
            @csrf

            <div class="row justify-content-around" >
                <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                        <label class="pivot-label " >Chantier <span class="text-danger">*</span> </label>
                            <div class="select">
                                <select class="form-control" name="chantier_id" >
                                <option value="">Choisir chantier</option>
                                    @foreach($chantiers as $chantier)
                                        <option value="{{ $chantier->id }}">{{ $chantier->intitule_chantier }}</option>
                                    @endforeach
                                </select>
                            </div>                
                        <span class="form-bar"></span>    
                    </div>
                </div>

                <div class="col-6">
                    <div class="multi-select" >
                        <label>Personnels <span class="text-danger">*</span> </label>
                        <div class="select" >
                            <select id="mySelect" class="select2-multiple" name="personnels[]" multiple size="5" style="width: 100%;" >
                                @foreach($personnels as $personnel)
                                    <option value="{{ $personnel->id }}"> {{ $personnel->nom_personne }}  </option>
                                @endforeach
                            </select>
                        </div>  
                        <span class="form-bar"></span>                                                                  
                    </div>
                </div>

              
            </div>  
                
                    <h6>Liste des personnels a ajoutés :</h6>
                    <table class="mytab text-center">
                        <thead>
                            <td>Code du personnel</td>
                            <td>Nom personne</td>
                            <td>Salaire Unitaire</td>
                            <td>Date d'affectation</td>
                            <td>Date fin d'affectation</td>
                            <td>Effictif Réel</td>
                            <td>Salaire Réel</td>
                            
                        </thead>
                        <tbody >
                            @foreach($personnels as $personnel)
                                <tr style="display:none;" id="{{ $personnel->id }}" class="data">
                                    <td> <input type="text" class="text-center"  name="code_personne[]" value="{{ $personnel->code_personne }}" style="border:none;" readonly> </td>
                                    <td > {{ $personnel->nom_personne}} </td>
                                    <td> <input type="text" class="text-center"  id="s{{ $personnel->id }}" name="salaire_unitaire[]" value="{{ $personnel->salaire_unitaire }}" style="border:none;" readonly> </td>

                                    <td > <input type="date" 
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ date d'affectation est obligatoire!"
                                    class="date_d text-center" id="d{{ $personnel->id }}" name="date_affect[]" style="border:none;" 
                                     onchange="testDateD(this.value, this.id);" value= "" > </td>
                                    
                                    <td > <input type="date" 
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ date de fin d'affectation est obligatoire!"
                                    class="date_f text-center" id="f{{ $personnel->id }}" name="date_fin_affect[]" style="border:none;" 
                                     onchange="testDateF(this.value, this.id);" value= "" > </td>
                                    
                                    <td > <input type="number" 
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ effictif_reel est raquis!"
                                    class="effictif_reel text-center" id="e{{ $personnel->id }}" name="effictif_reel[]" style="border:none;" 
                                    placeholder="Entrer l'effictif_reel"  value= "" onchange="recupValeurPers(this.value, this.id)" > </td>
                                    
                                    <td ><input type="decimal" class="salaire_reel text-center" id="sr{{ $personnel->id }}" name="salaire_reel[]" value="0" style="border:none;" readonly></td>

                                
                                </tr>
                            @endforeach
                            <tr>
                                    <td colspan="6" style="text-align:center;font-weight:bold" >Montant Salaires</td>
                                    <td ><input type="double" class="text-center" name="montant_salaire"  style="border:none;" id="montant_salaire" readonly></td>
                                </tr>
                                
                                
                        </tbody>
                    </table>
                   
                <div class=" text-right" style="margin-top: 10px;">
                    <button type="button" class="btn btn-primary" onclick="$('#modal2').modal('show');" > <i class="fa fa-fw fa-plus-circle" > </i> Ajouter</button>
                </div>
                                                 
            </form>

        </div>
        

         </div>
    </div>    
</div>

<!-- end Formulaire -->






   
@endsection

