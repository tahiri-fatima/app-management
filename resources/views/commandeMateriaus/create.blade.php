@extends('commandeMateriaus.layout')


  
@section('content')

  
<div class="container " style="margin-left: 80%;" > 
            <a class="btn btn-primary" href="{{ route('commandeMateriaus.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
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
    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
        <div class="alert alert-danger message">
         <p>   <strong>Whoops!</strong> Il y a dejà une commade avec ce code.<br><br> </p>
            
        </div>
    @endif

<!-- Affichage de modal si l'enregistrement ajouté avec succes. !-->
    @if(!empty(Session::get('success')) && Session::get('success') == 'Enregistrement ajouté avec succes.')
    <script>
        $(function() {
            $('#myModal').modal('show');
        });
    </script>
    @endif

<!-- modal si commande ajouté avec succes !-->
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
            <p>Enregistrement ajouté avec succes.</p>
            <p>Voulez vous insérer une autre enregistrement ?</p>
        </strong>
      </div>
      <div class="modal-footer">
        <a class="btn btn-outline-secondary" href="{{ route('commandeMateriaus.index') }}"> Non</a>
        
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
<div style="width:100%">
    <div class="card" >  
        <div class="card-header">
            <h5><i class="fa fa-fw fa-plus-circle"></i>  Ajouter les matériaux</h5>
        </div>
        <div class="card-block">
        <div class="table-responsive">
            <form class="form-material" id="form" action="{{ route('commandeMateriaus.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return verifierChampsCommande()" >
            @csrf

            <div class="row justify-content-around" style="margin-bottom: 20px; ">
                <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                    <label class="pivot-label " >Commande <span class="text-danger">*</span> </label>
                        <div class="select">
                            <select class="form-control" name="commande_id" >
                            <option value="">Choisir commande</option>
                                @foreach($commandes as $commande)
                                    <option value="{{ $commande->id }}">{{ $commande->code_commande }}</option>
                                @endforeach
                            </select>
                        </div>                
                        <span class="form-bar"></span>   
                    </div>
                </div>

                <div class="col-6">
                    <div class="multi-select" >
                        <label  >Matériaux <span class="text-danger">*</span> </label>
                        <div class="select" >
                            <select id="mySelect" class="select2-multiple" name="materiaus[]" multiple size="5" style="width: 100%;" >
                                @foreach($materiaus as $materiau)
                                    <option value="{{ $materiau->id }}"> {{ $materiau->intitule_materiau }}  </option>
                                @endforeach
                            </select>
                        </div>                                                                   
                    </div>
                </div>
            </div>
   

              
                
            <h5 style="margin-bottom:15px"><h5>Liste des matériaux commandés :</h5>
                    <table class="mytab  text-center">
                        <thead>
                            <td>Matériau</td>
                            <td>Code matériau</td>
                            <td>Prix Unitaire</td>
                            <td>Quantité</td>
                            <td>Montant</td>
                        </thead>
                        <tbody >
                            @foreach($materiaus as $materiau)
                                <tr style="display:none;" id="{{ $materiau->id }}" class="data">
                                    <td > {{ $materiau->intitule_materiau }} </td>
                                    <td> <input type="text" class="text-center"  name="code_materiau[]" value="{{ $materiau->code_materiau }}" 
                                    style="border:none;" readonly> </td>
                                    <td> <input type="text" class="text-center" id="prix{{ $materiau->id }}"  name="prix_unit_materiau" 
                                    value="{{ $materiau->prix_unit_materiau }}" style="border:none;" readonly> </td>
                                    
                                    <td > <input type="number"
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ quantité est obligatoire!"
                                    class="quantite text-center" id="q{{ $materiau->id }}" name="quantite_materiau[]" style="border:none;" 
                                    placeholder="Entrer la quantité" onchange="qteMateriau(this.value, this.id);"  > </td>
                                    
                                    <td ><input type="decimal" class="montant text-center" id="montant{{ $materiau->id }}" name="montant_materiau[]" value="0" 
                                    style="border:none;" readonly></td>
                                </tr>
                            @endforeach
                                
                                <tr class="text-center">
                                    <td colspan="4"  >Total</td>
                                    <td ><input type="decimal" class="text-center" name="total_commande" value="0" style="border:none;" id="total" readonly></td>
                                </tr>
                        </tbody>
                    </table>
                   
                <div class=" text-right" style="margin-top: 10px;">
                    <button type="button" class="btn btn-primary" onclick="$('#modal2').modal('show');"> <i class="fa fa-fw fa-plus-circle" > </i> Ajouter</button>
                    <button type="reset" class="btn btn-info" style="margin-left: 10px;"><i class="fa fa-fw fa-sync" ></i> Réinitialiser</button>
                </div>
                                                 
            </form>
        </div>
        
            

         </div>
    </div>    
</div>

<!-- end Formulaire -->

    

   
@endsection

