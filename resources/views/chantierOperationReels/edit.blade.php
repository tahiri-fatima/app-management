@extends('chantierOperationReels.layout')
   
@section('content')


  
<div class="container " style="margin-left: 80%;" > 
            <a class="btn btn-primary" href="{{ route('chantierOperationReels.gestionForm') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 


<div class="col d-flex justify-content-center" > 

<!-- Alert si la date fin est supérieure à la date début !-->
<div class="alert alert-danger message" id="date" style="display: none">
          <p>  <strong>Whoops!</strong> Il faut entrer une date fin d'opéation supérieure à la date début  !<br><br> </p>           
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
    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
        <div class="alert alert-danger message">
            <strong>Whoops!</strong> Il y a dejà un enregistrement avec ce code ce couple de code chantier et opération.<br><br>
            
        </div>
    @endif


</div>


<!-- start Formulaire -->


<div class="col d-flex justify-content-center " >
<div style="width:100%" >

    <div class="card" >  
        <div class="card-header">
            <h5><i class="fa fa-fw fa-plus-circle"></i>  Modifier les opérations du chantier</h5>
        </div>
        <div class="card-block">
        <div class="table-responsive">
            <form class="form-material" action="{{ route('chantierOperationReels.updateOperations', $chantier->id) }}"  enctype="multipart/form-data" onsubmit="return verifierChampsOperationReel()" >
            @csrf
            @method('PUT')

            <div class="row justify-content-around" style="margin-bottom: 20px; ">
                <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                    <label class="pivot-label " >Chantier <span class="text-danger">*</span> </label>
                        <div class="select">
                            <select class="form-control" name="chantier_id" >
                            <option value="{{$chantier->id}}">{{ $chantier->intitule_chantier }}</option>
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
                           
                                @foreach($chantierOperationReels as $chantierOperationReel)
                                    
                                        <option value="{{ $chantierOperationReel->id }}" selected="true"> {{ $chantierOperationReel->designation_operation }}  </option>
                                        
                                @endforeach
                            </select>
                        </div>                                                                   
                    </div>
                </div>
            </div>
            
                
            <h5>Liste des opérations :</h5>
                    <table class="mytab text-center">
                        <thead style="font-weight:bold">
                        <td>Opération</td>
                            <td>Code opération</td>
                            <td>Prix Unitaire de revient</td>
                            <td>Prix Unitaire de vente</td>
                            <td>Quantité Réalisée</td>
                            <td>Date d'exécution</td>
                            <td>Montant d'exécution de revient</td>
                            <td>Montant d'exécution de vente</td>
                            <td>Montant encaissé</td>

                        </thead>
                        <tbody >
                        <?php $k=0; ?>
                       
                            @foreach($chantierOperationReels as $chantierOperationReel)
                                <tr style="display:none;" id="{{ $chantierOperationReel->id }}" class="data">
                                <td style="width: 30px;" > {{ $chantierOperationReel->designation_operation }} </td>
                                    <td style="width: 30px;"> <input type="text" class="text-center"  name="code_operation[]" value="{{$chantierOperationReel->code_operation}}" style="border:none;" readonly> </td>
                                    <td style="width: 30px;"> <input type="text" id="r{{$chantierOperationReel->id}}" class="text-center"  name="prix_unitaire_revient[]" value="{{$chantierOperationReel->prix_unitaire_revient}}" style="border:none;" readonly> </td>
                                    <td style="width: 30px;"> <input type="text" id="v{{$chantierOperationReel->id}}" class="text-center"  name="prix_unitaire_vente[]" value="{{$chantierOperationReel->prix_unitaire_vente}}" style="border:none;" readonly> </td>
                                   
                                  
                                    <td style="width: 30px;" id="col{{$chantierOperationReel->id}}"> <input type="number"
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ quantité exécutée est obligatoire!"
                                    class="quantite text-center" id="q{{$chantierOperationReel->id}}" name="quantite_realisee[]" 
                                    style="border:none;" placeholder="Entrer la quantité exécutée" value="{{$chantierOperationReel->quantite_realisee}}"
                                    onchange="recupValeurOperReel(this.value, this.id);"> </td>

  
                                    <td style="width: 30px;"> <input type="date"
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ date d'exécution est obligatoire!"
                                    class="de text-center" id="e{{$chantierOperationReel->id}}" name="date_execution[]" 
                                    style="border:none;" onchange="recupValeurOperReel(this.value, this.id);"
                                     value= "{{$chantierOperationReel->date_execution}}"  > </td>

                                     <td ><input type="decimal" class="montantR text-center" id="montantR{{$chantierOperationReel->id}}" name="montant_execution_revient[]" value="{{$chantierOperationReel->montant_execution_revient}}" style="border:none;" readonly></td>

                                    <td ><input type="decimal" class="montantV text-center" id="montantV{{$chantierOperationReel->id}}" name="montant_execution_vente[]" value="{{$chantierOperationReel->montant_execution_revient}}" style="border:none;" readonly></td>
                                   
                                    <td style="width: 30px;"> <input type="decimal"
                                    class="montantE text-center" id="m{{$chantierOperationReel->id}}" name="montant_encaisse[]" 
                                    style="border:none;" placeholder="Entrer le montant encaissé"
                                     value= "{{$chantierOperationReel->montant_encaisse}}"  > </td>
                                    
                                   
                                </tr>
                            @endforeach
                                
                                <tr>
                                    <td colspan="6" style="text-align:center; font-weight:bold" >Total des Montants</td>
                                    <td ><input type="decimal" class="text-center" name="total_rev" value="0" style="border:none;" id="totalR" readonly></td>
                                    <td ><input type="decimal" class="text-center" name="total_vent" value="0" style="border:none;" id="totalV" readonly></td>
                                    <td ><input type="decimal" class="text-center" name="total_enc" value="0" style="border:none;" id="totalE" readonly></td>
                                </tr>
                        </tbody>
                    </table>
                   
                <div class=" text-right" style="margin-top: 10px;">
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-fw fa-plus-circle" > </i> Modifier</button>
                </div>
                                                 
            </form>
        </div>
        </div>
            

         </div>
    </div>    
</div>
            

<!-- end Formulaire -->

















@endsection