@extends('chantierOperationReels.layout')


  
@section('content')

  
<div class="container "style="margin-left: 80%;"> 
            <a class="btn btn-primary" href="{{ route('chantierOperationReels.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
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
            <strong>Whoops!</strong> Il y a dejà un enregistement avec ces codes d'opération et de chantier.<br><br>
            
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
        <a class="btn btn-outline-secondary" href="{{ route('chantierOperationReels.index') }}"> Non</a>
        
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
            <h5><i class="fa fa-fw fa-plus-circle"></i>  Ajouter les opérations de chantier</h5>
        </div>
        <div class="card-block">
             <div class="table-responsive">
                <form id="form" class="form-material" action="{{ route('chantierOperationReels.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return verifierChampsOperationReel()" >
                @csrf

            <div class="row justify-content-around" style="margin-bottom: 20px; ">
                <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                    <label class="pivot-label " >Chantier <span class="text-danger">*</span> </label>
                        <div class="select">
                            <select class="form-control" id="chantier" name="chantier_id" >
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
                    <label  >Opérations <span class="text-danger">*</span> </label>
                        <div class="select" >
                            <select id="mySelect" class="select2-multiple" name="operations[]" multiple size="5" style="width: 100%;" >
                            
                               
                            </select>
                        </div>                                                                   
                    </div>
                </div>
            </div>

           

            
                
            <h5 style="margin-bottom:15px">Liste des opérations :</h5>
                    <table class="mytab  m-b-0 text-center" >
                        <thead style="font-weight:bold">
                            <td>Opération</td>
                            <td>Code opération</td>
                            <td>Prix Unitaire de revient</td>
                            <td>Prix Unitaire de vente</td>
                            <td>Quantité Réalisée</td>
                            <td>Date début d'opération</td>
                            <td>Date d'exécution</td>
                            <td>Montant d'exécution de revient</td>
                            <td>Montant d'exécution de vente</td>
                        </thead>
                        <tbody id="x">
                            <tr>
                            <td colspan="7" style="text-align:center;font-weight:bold" >Total des montants</td>
                                <td ><input type="decimal" class="text-center" name="total_rev" value="0" style="border:none;" id="totalR" readonly></td>
                                <td ><input type="decimal" class="text-center" name="total_vent" value="0" style="border:none;" id="totalV" readonly></td>

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


<script>
    $('#chantier').on('change', e => {
        //console.log($('#chantier').val());
        var id = $('#chantier').val();
        $('#mySelect').empty();
        $.ajax({
            url: "/getOperationsExecute/"+id,
            data:{id:this.value},
            success: data => {
                data.operations.forEach(operation =>
               // console.log(operation),
              
                    $('#mySelect').append(`<option value="${operation.id}">${operation.designation_operation}</option>`)
              

                ),
                data.operations.forEach(operation =>
                $('#x').append(`
                                <tr style="display:none; " id="${operation.id}" class="data">
                                    <td style="width: 30px;" > ${operation.designation_operation} </td>
                                    <td style="width: 30px;"> <input type="text" class="text-center"  name="code_operation[]" value="${operation.code_operation}" style="border:none;" readonly> </td>
                                    <td style="width: 30px;"> <input type="text" id="r${operation.id}" class="text-center"  name="prix_unitaire_revient[]" value="${operation.prix_unitaire_revient}" style="border:none;" readonly> </td>
                                    <td style="width: 30px;"> <input type="text" id="v${operation.id}" class="text-center"  name="prix_unitaire_vente[]" value="${operation.prix_unitaire_vente}" style="border:none;" readonly> </td>

                                    
                                    <td style="width: 30px;" id="col${operation.id}"> <input type="number"
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ quantité exécutée est obligatoire!"
                                    class="quantite text-center" id="q${operation.id}" name="quantite_realisee[]" 
                                    style="border:none;" placeholder="Entrer la quantité exécutée"
                                    onchange="recupValeurOperReel(this.value, this.id);" data-required="1" > </td>

                                    <td style="width: 30px;"> <input type="text" id="d${operation.id}" class="text-center"  name="date_deb_operation[]" value="${operation.date_deb_operation}" style="border:none;" readonly> </td>

                                    <td style="width: 30px;"> <input type="date"
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ date d'exécution est obligatoire!"
                                    class="de text-center" id="e${operation.id}" name="date_execution[]" 
                                    style="border:none;" onchange="recupValeurOperReel(this.value, this.id);"
                                     value= "" data-required="1" > </td>

                                     

                                     <td ><input type="decimal" class="montantR text-center" id="montantR${operation.id}" name="montant_execution_revient[]" value="0" style="border:none;" readonly></td>

                                    <td ><input type="decimal" class="montantV text-center" id="montantV${operation.id}" name="montant_execution_vente[]" value="0" style="border:none;" readonly></td>
                                    </tr>
                    `)

                )
            }
        })
    })
</script>



   
@endsection


