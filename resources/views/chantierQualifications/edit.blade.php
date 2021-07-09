@extends('chantierQualifications.layout')
   
@section('content')


  
<div class="container" style="margin-left: 80%;"> 
            <a class="btn btn-primary" href="{{ route('chantierQualifications.showQualifications',$chantier->id) }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
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
            <strong>Whoops!</strong> Il y a dejà un enregistrement avec ce code ce couple de code chantier et qualification.<br><br>
            
        </div>
    @endif


</div>


<!-- start Formulaire -->

<div class="col d-flex justify-content-center " >
<div style="width:100%" >

    <div class="card" >  
        <div class="card-header">
            <h5><i class="fa fa-fw fa-plus-circle"></i>  Modifier les qualifications du chantier</h5>
        </div>
        <div class="card-block">
        <div class="table-responsive">
            <form class="form-material" action="{{ route('chantierQualifications.updateQualifications', $chantier->id) }}"  enctype="multipart/form-data" onsubmit="return verifierChampsQual()" >
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
                        <label  >Qualifications <span class="text-danger">*</span> </label>
                        <div class="select" >
                            <select id="mySelect" class="select2-multiple" name="qualifications[]" multiple size="5" style="width: 100%;" >
                            <?php $k=0; ?>
                                @foreach($qualifications as $qualification)
                                    @if($k < count($quals) && $qualification->id == $quals[$k])
                                        <option value="{{ $qualification->id }}" selected="true"> {{ $qualification->designation_qual }}  </option>
                                        <?php $k+=4; ?>
                                    @else
                                        <option value="{{ $qualification->id }}"> {{ $qualification->designation_qual }}  </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>                                                                   
                    </div>
                </div>
            </div>

            

            
                
                    <h5>Liste des qualifications :</h5>
                    <table class="mytab text-center">
                        <thead style="font-weight:bold">
                            <td>Qualification</td>
                            <td>Code qualification</td>
                            <td>Salaire Unitaire</td>
                            <th >Effictif Estimée</th>
                            <th >Durée Estimée</th>
                            <th >Salaire Estimée</th>
                        </thead>
                        <tbody >
                        <?php $k=0; ?>
                            @foreach($qualifications as $qualification)
                                <tr style="display:none;" id="{{ $qualification->id }}" class="data">
                                    <td style="width: 30px;" > {{ $qualification->designation_qual }} </td>
                                    <td style="width: 30px;"> <input type="text"  class="text-center"  name="code_qual[]" value="{{ $qualification->code_qual }}" style="border:none;" readonly> </td>
                                    <td style="width: 30px;"> <input type="text" id="s{{ $qualification->id }}"   class="text-center"  name="salaire_unitaire[]" value="{{ $qualification->salaire_unitaire }}" style="border:none;" readonly> </td>
                                
                                    @if($k < count($quals) && $qualification->id == $quals[$k])
                                                      
                                    <td style="width: 30px;" id="col{{ $qualification->id }}"> <input type="number"
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ durée estimée est obligatoire!"
                                    class="duree text-center" id="d{{ $qualification->id }}" name="duree_estimee[]" 
                                    style="border:none;" placeholder="Entrer la durée estimée"
                                    onchange="recupValeurQual(this.value, this.id);" value="{{$quals[$k+1]}}" data-required="1" > </td>

                                    <td style="width: 30px;" id="col{{ $qualification->id }}"> <input type="number"
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ effictif estimée est obligatoire!"
                                    class="eff text-center" id="e{{ $qualification->id }}" name="effictif_estimee[]" 
                                    style="border:none;" placeholder="Entrer l'effictif estimée"
                                    onchange="recupValeurQual(this.value, this.id);" value="{{$quals[$k+2]}}" data-required="1" > </td>

                                    <td ><input type="decimal" class="montant text-center" value="{{$quals[$k+3]}}" id="montant{{ $qualification->id }}" name="salaire_estimee[]" style="border:none;" readonly></td>
                                </tr>

                                    <?php $k+=4; ?>
                                    @else
                                    
                  
                                    <td style="width: 30px;" id="col{{ $qualification->id }}"> <input type="number"
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ durée estimée est obligatoire!"
                                    class="duree text-center" id="d{{ $qualification->id }}" name="duree_estimee[]" 
                                    style="border:none;" placeholder="Entrer la durée estimée"
                                    onchange="recupValeurQual(this.value, this.id);" value="" data-required="1" > </td>

                                    <td style="width: 30px;" id="col{{ $qualification->id }}"> <input type="number"
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ effictif estimée est obligatoire!"
                                    class="eff text-center" id="e{{ $qualification->id }}" name="effictif_estimee[]" 
                                    style="border:none;" placeholder="Entrer l'effictif estimée"
                                    onchange="recupValeurQual(this.value, this.id);" value="" data-required="1" > </td>

                                    <td ><input type="decimal" class="montant text-center" id="montant{{ $qualification->id }}" name="salaire_estimee[]" value="0" style="border:none;" readonly></td>
                                </tr>
                                    @endif                                    
                                    
                                    
                                    
                                </tr>
                            @endforeach
                                
                                <tr>
                                    <td colspan="10" style="text-align:center; font-weight:bold" >Total</td>
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