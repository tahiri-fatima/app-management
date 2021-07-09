@extends('chantierMateriels.layout')
   
@section('content')


  
<div class="container " style="margin-left:80%"> 
            <a class="btn btn-primary" href="{{ route('chantierMateriels.showMateriels',$chantier->id) }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
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
        <div class="alert alert-danger" >
          <p>  <strong>Whoops!</strong> Il y a dejà un enregistrement avec ce code ce couple de code chantier et matériel.<br><br></p>
            
        </div>
    @endif

<!-- Alert si la date fin est supérieure à la date début !-->
<div class="alert alert-danger" id="date" style="display: none">
         <p>   <strong>Whoops!</strong> Il faut entrer une date fin supérieure à la date début de service !<br><br> </p>
            
        </div>

</div>


<!-- start Formulaire -->
<div class="col d-flex justify-content-center " >
<div style="width:100%" >

    <div class="card" >  
        <div class="card-header">
            <h5><i class="fa fa-fw fa-edit"></i>  Modifier le couple chantier matériel</h5>
        </div>
        <div class="card-block">
        <div class="table-responsive">
        <p style="font-weight:bold;">Les champs avec <span class="text-danger">*</span> sont obligatoire.</p>

            <form class="form-material" action="{{ route('chantierMateriels.updateMateriels',$chantier->id) }}" onsubmit="return verifierChampsChantier()">
                @csrf
            @method('PUT')
                
            <div class="row justify-content-around" >
                <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                        <label class="pivot-label " >Chantier <span class="text-danger">*</span> </label>
                            <div class="select">
                                <select class="form-control" name="chantier_id" >
                                <option value="{{ $chantier->id }}">{{ $chantier->intitule_chantier }}</option>
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
                        <label  >Matériels <span class="text-danger">*</span> </label>
                        <div class="select" >
                            <select id="mySelect" class="select2-multiple" name="materiels[]" multiple size="5" style="width: 100%;" >
                               <?php $k=0; ?>
                                @foreach($materiels as $materiel)
                                    @if($k < count($mats) && $materiel->id == $mats[$k])
                                        <option value="{{ $materiel->id }}" selected="true"> {{ $materiel->intitule_materiel }}  </option>
                                        <?php $k+=6;  ?>
                                    @else
                                    <option value="{{ $materiel->id }}"> {{ $materiel->intitule_materiel }}  </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>                                                                   
                    </div>
                </div>

              
            </div>  
                
            <h5 style="margin-bottom:15px">Liste des matériels :</h5>
                    <table class="mytab text-center">
                        <thead style="font-weight:bold">
                            <td>Code du matériel</td>
                            <td>Intitule du matériel</td>
                            <td>Prix unitaire</td>
                            <td>Date début de service</td>
                            <td>Date fin de service</td>
                            <td>Taux d'ajustement</td>
                            <td>Monatant net</td>
                        </thead>
                        <tbody >
                            <?php $k=0; $length = count($mats); ?>
                            @foreach($materiels as $materiel)
                                <tr style="display:none;" id="{{ $materiel->id }}" class="data">
                                    <td> <input type="text" class="text-center"  name="code_materiel[]" value="{{ $materiel->code_materiel }}" style="border:none;" readonly> </td>
                                    <td > {{ $materiel->intitule_materiel}} </td>

                                   
                                    @if($k < $length && $materiel->id == $mats[$k])
                                    
                                    <td > <input type="double" 
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ prix unitaire est raquis!"
                                    class="prix text-center" id="p{{ $materiel->id }}" name="prix_unit[]" style="border:none;" 
                                     value= "{{$mats[$k+1]}}" onchange="recupValeurMat(this.value, this.id);" > </td>

                                    <td > <input type="date" 
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ date début de service est obligatoire!"
                                    class="date_deb" id="d{{ $materiel->id }}" 
                                    name="d_debut_service[]" value= "{{$mats[$k+2]}}" style="border:none;" 
                                    onchange="testDateD(this.value, this.id);"> </td>
                                    
                                    <td > <input type="date"
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ date fin de service est obligatoire!" 
                                    class="date_fin" id="f{{ $materiel->id }}" name="d_fin_service[]" 
                                    value= "{{$mats[$k+3]}}" style="border:none;" 
                                     onchange="testDateF(this.value, this.id);"> </td>

                                   
                                    

                                    <td > <input type="number" 
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ taux d'ajustement est requis!"
                                    class="taux_aj text-center" id="t{{ $materiel->id }}" name="t_ajustement[]" style="border:none;" 
                                    value= "{{$mats[$k+4]}}" onchange="recupValeurMat(this.value, this.id);" > </td>
                                    
                                    <td > <input type="double" 
                                    class="montant_net text-center" id="m{{ $materiel->id }}" name="mont_net[]" style="border:none;" 
                                    placeholder=""  value="{{$mats[$k+5]}}" > </td>

                                    <?php $k+=6; 
                                    ?>
                                    @else
                                    <td > <input type="double" 
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ prix unitaire est raquis!"
                                    class="prix text-center" id="p{{ $materiel->id }}" name="prix_unit[]" style="border:none;" 
                                    placeholder="Entrer le prix unitaire"  value= "" onchange="recupValeurMat(this.value, this.id);" > </td>

                                    <td > <input type="date" 
                                    data-container="body" data-toggle="popover"  
                                    data-placement="bottom" data-content="Le champ date de début de service est obligatoire!"
                                    class="date_deb text-center" id="d{{ $materiel->id }}" 
                                    name="d_debut_service[]" value= "" style="border:none;" placeholder="Entrer la date début de service" 
                                    onchange="testDateD(this.value, this.id);"> </td>
                                    
                                    <td > <input type="date" 
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ date de fin de service est obligatoire!"
                                    class="date_fin text-center" id="f{{ $materiel->id }}" name="d_fin_service[]" value= "" style="border:none;" placeholder="Entrer la date début de service" 
                                    onchange="testDateF(this.value, this.id);"  > </td>

                                   
                                    <td > <input type="number" 
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ taux d'ajustement est requis!"
                                    class="taux_aj text-center" id="t{{ $materiel->id }}" name="t_ajustement[]" style="border:none;" 
                                    placeholder="Entrer le taux d'ajustement"  value= "" onchange="recupValeurMat(this.value, this.id);" > </td>
                                    
                                    <td > <input type="double" 
                                    class="montant_net text-center" id="m{{ $materiel->id }}" name="mont_net[]" style="border:none;" 
                                    placeholder=""   > </td>
                                    @endif
                                                                      
                                   
                                </tr>
                                
                            @endforeach
                                <tr>
                                    <td colspan="6" style="text-align:center;font-weight:bold" >Total des montants</td>
                                    <td ><input type="double" class="text-center" name="total"  style="border:none;" id="total" readonly></td>
                                </tr>
                        </tbody>
                    </table>
                   
                <div class=" text-right" style="margin-top: 10px;">
                <button type="submit" class="btn btn-primary"> <i class="fa fa-fw fa-edit"></i> Modifier</button>
</div>
                                                 
            </form>

            
        </div>
        
         </div>
    </div>    
</div>

<!-- end Formulaire -->

@endsection