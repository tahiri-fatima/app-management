@extends('chantierMateriels.layout')


  
@section('content')

  
<div class="container" style="margin-left:80%"> 
            <a class="btn btn-primary" href="{{ route('chantierMateriels.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
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
         <p>   <strong>Whoops!</strong> Il y a dejà un enregistement avec ces codes de chantier et de matériel.<br></p>
            
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
        <a class="btn btn-outline-secondary" href="{{ route('chantierMateriels.index') }}"> Non</a>
        
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
            <h5><i class="fa fa-fw fa-plus-circle"></i>  Ajouter les matériels des chantiers</h5>
        </div>
        <div class="card-block">
        <div class="table-responsive">
            <form class="form-material" id="form" action="{{ route('chantierMateriels.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return verifierChampsMateriel()" >
            @csrf

            <div class="row justify-content-around" >
                <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                        <label class="pivot-label"  >Chantier <span class="text-danger">*</span> </label>
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
                    <div class="multi-select " >
                        <label  >Matériels <span class="text-danger">*</span> </label>
                        <div class="select" >
                            <select id="mySelect" class="select2-multiple" name="materiels[]" multiple size="5" style="width: 100%;" >
                                @foreach($materiels as $materiel)
                                    <option value="{{ $materiel->id }}"> {{ $materiel->intitule_materiel }}  </option>
                                @endforeach
                            </select>
                        </div>                                                                   
                    </div>
                </div>

              
            </div>  
                
                    <h5 style="margin-bottom:15px">Liste des matériels du chantier  :</h5>
                    <table class="mytab text-center">
                        <thead>
                            <td>Code du matériel</td>
                            <td>Intitule du matériel</td>
                            <td>Prix unitaire</td>
                            <td>Date début de service</td>
                            <td>Date fin de service</td>
                            <td>Taux d'ajustement</td>
                            <td>Montant net</td>
                        </thead>
                        <tbody >
                            @foreach($materiels as $materiel)
                                <tr style="display:none;" id="{{ $materiel->id }}" class="data">
                                    <td> <input type="text" class="text-center"  name="code_materiel[]" value="{{ $materiel->code_materiel }}" style="border:none;" readonly> </td>
                                    <td > {{ $materiel->intitule_materiel}} </td>
  

                                    <td > <input type="decimal" 
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ prix unitaire est raquis!"
                                    class="prix text-center" id="p{{ $materiel->id }}" name="prix_unit[]" style="border:none;" 
                                    placeholder="Entrer le prix unitaire" value= ""  onchange="recupValeurMat(this.value, this.id);"> </td>
                                    
                                    
                                    <td > <input type="date" 
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ date de début de service est obligatoire!"
                                    class="date_deb text-center" id="d{{ $materiel->id }}" name="d_debut_service[]" style="border:none;" 
                                     onchange="testDateD(this.value, this.id);" value= "" > </td>
                                    
                                    <td > <input type="date" 
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ date de fin de service est obligatoire!"
                                    class="date_fin text-center" id="f{{ $materiel->id }}" name="d_fin_service[]" style="border:none;" 
                                     onchange="testDateF(this.value, this.id);" value= "" > </td>
                                    
                                    <td > <input type="number" 
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ taux d'ajustement est raquis!"
                                    class="taux_aj text-center" id="t{{ $materiel->id }}" name="t_ajustement[]" style="border:none;" 
                                    placeholder="Entrer le taux d'ajustement"  value= "" onchange="recupValeurMat(this.value, this.id);" > </td>
                                    
                                    <td > <input type="double" 
                                    class="montant_net text-center" id="m{{ $materiel->id }}" name="mont_net[]" style="border:none;" 
                                    placeholder=""   > </td>
                                
                                </tr>
                            @endforeach
                            <tr>
                                    <td colspan="6" style="text-align:center;font-weight:bold" >Total des montants</td>
                                    <td ><input type="double" class="text-center" name="total_materiel"  style="border:none;" id="total" readonly></td>
                                </tr>
                                
                                
                        </tbody>
                    </table>
                   
                <div class=" text-right" style="margin-top: 10px;">
                    <button type="button" class="btn btn-primary" onclick="$('#modal2').modal('show');"> <i class="fa fa-fw fa-plus-circle" > </i> Ajouter</button>
                </div>
                                                 
            </form>

        </div>
        

         </div>
    </div>    
</div>

<!-- end Formulaire -->






   
@endsection

