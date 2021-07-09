@extends('commandeMateriaus.layout')
   
@section('content')


  
<div class="container " style="margin-left: 80%;" > 
            <a class="btn btn-primary" href="{{ route('commandeMateriaus.showMateriaux',$commande->id) }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 

<div class="col d-flex justify-content-center message" > 
   
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
            <strong>Whoops!</strong> Il y a dejà un enregistrement avec ce code ce couple de code commande et matériau.<br><br>
            
        </div>
    @endif

</div>


<!-- start Formulaire -->

<div class="col d-flex justify-content-center" >
<div style="width:100%">
    <div class="card" >  
        <div class="card-header">
            <h5><i class="fa fa-fw fa-plus-circle"></i>  Modifier les matériaux</h5>
        </div>
        <div class="card-block">
        <div class="table-responsive">
            <form class="form-material" action="{{ route('commandeMateriaus.updateMateriaux',$commande->id) }}"  enctype="multipart/form-data" onsubmit="return verifierChampsCommande()" >
            @csrf
            @method('PUT')
            <div class="row justify-content-around" style="margin-bottom: 20px; ">
                <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                    <label class="pivot-label ">Commande <span class="text-danger">*</span> </label>
                        <div class="select">
                            <select class="form-control" name="commande_id" >
                            <option value="{{ $commande->id }}">{{ $commande->code_commande }}</option>
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
                        <label >Matériaux <span class="text-danger">*</span> </label>
                        <div class="select" >
                            <select id="mySelect" class="select2-multiple" name="materiaus[]" multiple size="5" style="width: 100%;" >
                            <?php $k=0; ?>
                                @foreach($materiaus as $materiau)
                                    
                                @if($k < count($materiaux) && $materiau->id == $materiaux[$k])
                                            <option value="{{ $materiau->id }}" selected="true">{{ $materiau->intitule_materiau }}</option>
                                            <?php $k+=2; ?>
                                        @else
                                            <option value="{{ $materiau->id }}"> {{ $materiau->intitule_materiau }}  </option>
                                        @endif
                                @endforeach    
                            </select>
                        </div>                                                                   
                    </div>
                </div>
            </div>
   

              
                
                    <h5>Liste des matériaux commandés :</h5>
                    <table class="mytab m-b-0 text-center">
                        <thead>
                            <td>Matériau</td>
                            <td>Code matériau</td>
                            <td>Prix Unitaire</td>
                            <td>Quantité</td>
                            <td>Montant</td>
                        </thead>
                        <tbody >
<?php $k=0; ?>
                            @foreach($materiaus as $materiau)
                                <tr style="display:none;" id="{{ $materiau->id }}" class="data">
                                    <td > {{ $materiau->intitule_materiau }} </td>
                                    <td> <input type="text" class="text-center"  name="code_materiau[]" value="{{ $materiau->code_materiau }}" 
                                    style="border:none;" readonly> </td>

                                    <td> <input type="text" class="text-center" id="prix{{ $materiau->id }}"  name="prix_unit_materiau"
                                     value="{{ $materiau->prix_unit_materiau }}" style="border:none;" readonly> </td>
                                    <td>
                                    @if($k < count($materiaux) && $materiau->id == $materiaux[$k])                                        <input type="number" 
                                        data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ quantité est obligatoire!"
                                        class="quantite text-center" id="q{{ $materiau->id }}" name="quantite_materiau[]"  style="border:none;" 
                                        placeholder="Entrer la quantité" onchange="qteMateriau(this.value, this.id);"  
                                        value= "{{$materiaux[$k+1]}}" >
                                        <?php $k+=2; ?>
                                    @else
                                        <input type="number" 
                                        data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ quantité est obligatoire!"
                                        class="quantite text-center" id="q{{ $materiau->id }}" name="quantite_materiau[]"  style="border:none;" 
                                        placeholder="Entrer la quantité" onchange="qteMateriau(this.value, this.id);" value= "" >
                                     @endif                                    
                                    </td>
                                    <td ><input type="decimal" class="montant text-center" id="montant{{ $materiau->id }}" name="montant_materiau[]" value="0" style="border:none;" readonly></td>
                                </tr>
                                
                            @endforeach
                                
                                <tr class="text-center">
                                    <td colspan="4"  >Total</td>
                                    <td ><input type="decimal" class="text-center" name="total_commande" value="0" style="border:none;" id="total" readonly></td>
                                </tr>
                        </tbody>
                    </table>
                   
                <div class=" text-right" style="margin-top: 10px;">
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-fw fa-plus-circle" > </i> Modifier</button>
                    <button type="reset" class="btn btn-info" style="margin-left: 10px;"><i class="fa fa-fw fa-sync" ></i> Réinitialiser</button>
                </div>
                                                 
            </form>
        </div>
         </div>
    </div>    
</div>

<!-- end Formulaire -->

@endsection