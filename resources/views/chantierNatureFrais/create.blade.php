@extends('chantierNatureFrais.layout')


  
@section('content')

  
<div class="container  " style="margin-left: 80%;" > 
            <a class="btn btn-primary" href="{{ route('chantierNatureFrais.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 

<div class="col d-flex justify-content-center" >
<!-- Alert si la date fin est supérieure à la date début !-->
        <div class="alert alert-danger" id="date" style="display: none">
            <strong>Whoops!</strong> Il faut entrer une date fin d'opéation supérieure à la date début  !<br><br>
            
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
            <strong>Whoops!</strong> Il y a dejà un enregistement avec ces codes de nature frais et de chantier.<br><br>
            
        </div>
    @endif

<!-- Affichage de modal si l'enregistrement ajouté avec succes. !-->
    @if(!empty(Session::get('success')) && Session::get('success') == 'Enregistrement ajouté avec succes.')
    <script>
        $(function() {
            $('#modal').modal('show');
        });
    </script>
    @endif

<!-- modal si l'enregistrement ajouté avec succes !-->
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
        <a class="btn btn-outline-secondary" href="{{ route('chantierNatureFrais.index') }}"> Non</a>
        
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
            <h5><i class="fa fa-fw fa-plus-circle"></i>  Ajouter les nature fraiss de chantier</h5>
        </div>
        <div class="card-block">
             <div class="table-responsive">
                <form id="form" class="form-material" action="{{ route('chantierNatureFrais.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return verifierChampsNatureFrais()" >
                @csrf

            <div class="row justify-content-around" style="margin-bottom: 20px; ">
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
                    <label  >Nature frais <span class="text-danger">*</span> </label>
                        <div class="select" >
                            <select id="mySelect" class="select2-multiple" name="nature_frais[]" multiple size="5" style="width: 100%;" >
                                @foreach($nature_frais as $nature_frai)
                                    <option value="{{ $nature_frai->id }}"> {{ $nature_frai->nature_frais }}  </option>
                                @endforeach
                            </select>
                        </div>                                                                   
                    </div>
                </div>
            </div>

            

            
                
            <h5 style="margin-bottom:15px">Liste des nature frais :</h5>
                    <table class="mytab  m-b-0 text-center" >
                        <thead style="font-weight:bold">
                            <td>Nature frais</td>
                            <td>Code nature frais</td>
                            <td>Montant Estimée</td>
                        </thead>
                        <tbody >
                            @foreach($nature_frais as $nature_frai)
                                <tr style="display:none; " id="{{ $nature_frai->id }}" class="data">
                                    <td style="width: 30px;" > {{ $nature_frai->nature_frais }} </td>
                                    <td style="width: 30px;"> <input type="text" class="text-center"  name="code_nature_frais[]" value="{{ $nature_frai->code_nature_frais }}" style="border:none;" readonly> </td>

                                    <td style="width: 30px;" id="col{{ $nature_frai->id }}"> <input type="double"
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ montant estimée est obligatoire!"
                                    class="montantEst text-center" id="montant{{ $nature_frai->id }}" name="montant_estimee[]" 
                                    style="border:none;" placeholder="Entrer le montant estimée"
                                     > </td>

                                    </tr>
                            @endforeach
                                
                                <tr>
                                    <td colspan="2" style="text-align:center;font-weight:bold" >Total des montants</td>
                                    <td ><input type="decimal" class="text-center" name="total_chantier" value="0" style="border:none;" id="total" readonly></td>
                                </tr>
                        </tbody>
                    </table>
                   
                <div class=" text-right" style="margin-top: 10px;">
                <div class="popover_buttons">
                    <button type="button" class="btn btn-primary" onclick="$('#modal2').modal('show');"> <i class="fa fa-fw fa-plus-circle" > </i> Ajouter</button>
                
                    <button type="reset" class="btn btn-info" style="margin-left: 10px;"><i class="fa fa-fw fa-sync" ></i> Réinitialiser</button>
                </div>
                </div>                           
            </form>
             </div>
            
        </div>
         </div>
    </div>    
</div>

<!-- end Formulaire -->



   
@endsection


