@extends('chantierOperations.layout')
   
@section('content')


  
<div class="container " style="margin-left: 80%;" > 
            <a class="btn btn-primary" href="{{ route('chantierOperations.showOperations',$chantier->id) }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
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
            <form class="form-material" action="{{ route('chantierOperations.updateOperations', $chantier->id) }}"  enctype="multipart/form-data" onsubmit="return verifierChampsOperation()" >
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
                            <?php $k=0; ?>
                                @foreach($operations as $operation)
                                    @if($k < count($ops) && $operation->id == $ops[$k])
                                        <option value="{{ $operation->id }}" selected="true"> {{ $operation->designation_operation }}  </option>
                                        <?php $k+=8; ?>
                                    @else
                                        <option value="{{ $operation->id }}"> {{ $operation->designation_operation }}  </option>
                                    @endif
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
                            <td>Date début d'opération</td>
                            <td>Date fin d'opération</td>
                            <td>Prix unitaire de revient</td>
                            <td>Quantité d'opération</td>
                            <td>Prix unitaire de vente</td>    
                            <td>Taux d'ajustement</td>
                            <td>Montant net</td>
                        </thead>
                        <tbody >
                        <?php $k=0; ?>
                            @foreach($operations as $operation)
                                <tr style="display:none;" id="{{ $operation->id }}" class="data">
                                    <td > {{ $operation->designation_operation }} </td>
                                    <td> <input type="text" class="text-center"  name="code_operation[]" value="{{ $operation->code_operation }}" style="border:none;" readonly> </td>

                                    @if($k < count($ops) && $operation->id == $ops[$k])
                                    <td style="width: 30px;" id="col{{ $operation->id }}"> 
                                    <input type="date" data-container="body" data-toggle="popover"  
                                    data-placement="bottom" data-content="Le champ date début d'opération est obligatoire!"
                                    class="dd text-center" id="d{{ $operation->id }}" name="date_deb_operation[]"
                                    style="border:none;" onchange="testDateD(this.value, this.id);"
                                    value= "{{$ops[$k+1]}}" data-required="1" > </td>
                                    
                                    <td style="width: 30px;"> <input type="date"
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ date fin d'opération est obligatoire!"
                                    class="df  text-center" id="f{{ $operation->id }}" name="date_fin_operation[]" 
                                    style="border:none;" 
                                    onchange="testDateF(this.value, this.id);"
                                     value= "{{$ops[$k+2]}}" data-required="1" > </td>

                                    <td > <input type="number"
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ prix unitaire de revient est obligatoire!"
                                    class="prix text-center" id="p{{ $operation->id }}" name="prix_unitaire_revient[]" style="border:none;" 
                                    placeholder="Entrer le prix unitaire"
                                     value= "{{$ops[$k+3]}}"   onchange="recupValeurOper(this.value, this.id);"  > </td>

                                    <td > <input type="number" 
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ quantité d'opération est obligatoire!"
                                    class="quantite text-center" id="q{{ $operation->id }}" name="quantite_operation[]" style="border:none;" 
                                    placeholder="Entrer la quantité d'opération" 
                                    value= "{{$ops[$k+4]}}" onchange="recupValeurOper(this.value, this.id);"  > </td>

                                    <td style="width: 30px;" id="col{{ $operation->id }}"> <input type="double"
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ prix unitaire de vente est obligatoire!"
                                    class="prix-vente text-center" id="pv{{ $operation->id }}" name="prix_unitaire_vente[]" 
                                    style="border:none;" placeholder="Entrer le prix de vente" 
                                    value= "{{$ops[$k+5]}}"
                                    onchange="recupValeurOper(this.value, this.id);" data-required="1" > </td>

                                    <td > <input type="number"
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ taux d'ajustement est obligatoire!"
                                    class="taux text-center" id="t{{ $operation->id }}" name="taux_ajustement[]" style="border:none;" 
                                    placeholder="Entrer le taux d'ajustement" value= "{{$ops[$k+6]}}"   onchange="recupValeurOper(this.value, this.id);"  > </td>

                                    <td ><input type="decimal" class="montant text-center" id="montant{{ $operation->id }}" name="montant_estimee[]" value="0" style="border:none;" 
                                    value= "{{$ops[$k+7]}}" readonly></td>

                                    <?php $k+=8; ?>
                                    @else
                                    

                                    <td style="width: 30px;" id="col{{ $operation->id }}"> <input type="date"
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ date début d'opération est obligatoire!"
                                    class="dd text-center" id="d{{ $operation->id }}" name="date_deb_operation[]"
                                    style="border:none;" onchange="testDateD(this.value, this.id);"
                                    value= "" data-required="1" > </td>
                                    
                                    <td style="width: 30px;"> <input type="date"
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ date fin d'opération est obligatoire!"
                                    class="df  text-center" id="f{{ $operation->id }}" name="date_fin_operation[]" 
                                    style="border:none;" 
                                    onchange="testDateF(this.value, this.id);" value= "" data-required="1" > </td>

                                    <td > <input type="double" 
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ prix unitaire est obligatoire!"
                                    class="prix text-center" id="p{{ $operation->id }}" name="prix_unitaire_revient[]" style="border:none;" placeholder="Entrer le prix unitaire"
                                      value= "" onchange="recupValeurOper(this.value, this.id);"> </td>

                                    <td > <input type="number" 
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ quantité d'opération est obligatoire!"
                                    class="quantite text-center" id="q{{ $operation->id }}" name="quantite_operation[]" style="border:none;" placeholder="Entrer la quantité d'opération"
                                      value= "" onchange="recupValeurOper(this.value, this.id);"> </td>

                                      <td style="width: 30px;" id="col{{ $operation->id }}"> <input type="double"
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ prix de vente est obligatoire!"
                                    class="prix-vente text-center" id="pv{{ $operation->id }}" name="prix_unitaire_vente[]" 
                                    style="border:none;" placeholder="Entrer le prix de vente"
                                    onchange="recupValeurOper(this.value, this.id);" data-required="1" > </td>

                                    <td > <input type="number"
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ taux d'ajustement est obligatoire!"
                                     class="taux text-center" id="t{{ $operation->id }}" name="taux_ajustement[]" style="border:none;"
                                     placeholder="Entrer le taux d'ajustement" value= "" onchange="recupValeurOper(this.value, this.id);"  > </td>

                                    <td ><input type="decimal" class="montant text-center" id="montant{{ $operation->id }}" name="montant_estimee[]" value="0" style="border:none;"  value= "" readonly></td>

                                    @endif                                    
                                    
                                    
                                    
                                </tr>
                            @endforeach
                                
                                <tr>
                                    <td colspan="8" style="text-align:center; font-weight:bold" >Total</td>
                                    <td ><input type="decimal" class="text-center" name="total" value="0" style="border:none;" id="total" readonly></td>
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
</div>

<!-- end Formulaire -->


























@endsection