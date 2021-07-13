@extends('chantierPersonnels.layout')
   
@section('content')


<div class="container " style="margin-left: 80%;" > 
            <a class="btn btn-primary" href="{{ route('chantierPersonnels.gestionForm') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
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
         <p>   <strong>Whoops!</strong> Il y a dejà un enregistrement avec ce code ce couple de code chantier et personnel.<br><br>
         </p>
        </div>
    @endif

<!-- Alert si la date fin est supérieure à la date début !-->
<div class="alert alert-danger" id="date" style="display: none">
         <p>   <strong>Whoops!</strong> Il faut entrer une date fin supérieure à la date début de service !<br><br>
         </p>
        </div>

</div>


<!-- start Formulaire -->


<div class="col d-flex justify-content-center " >
<div style="width:100%" >

    <div class="card" >  
        <div class="card-header">
            <h5><i class="fa fa-fw fa-edit"></i>  Modifier les personnels du chantier </h5>
        </div>
        <div class="card-block">
        <div class="table-responsive">
        <p style="font-weight:bold;">Les champs avec <span class="text-danger">*</span> sont obligatoire.</p>

            <form class="form-material" action="{{ route('chantierPersonnels.updatePersonnels',$chantier->id) }}" onsubmit="return verifierChampsPersonnel()">
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
                        <label  >Personnels <span class="text-danger">*</span> </label>
                        <div class="select" >
                            <select id="mySelect" class="select2-multiple" name="personnels[]" multiple size="5" style="width: 100%;" >
                            <?php $k=0; ?>
                                @foreach($personnels as $personnel)
                                    @if($k < count($pers) && $personnel->id == $pers[$k])
                                        <option value="{{ $personnel->id }}" selected="true"> {{ $personnel->nom_personne }}  </option>
                                        <?php $k+=5; ?>
                                    @else
                                    <option value="{{ $personnel->id }}"> {{ $personnel->nom_personne }}  </option>
                                    @endif
                                @endforeach
                            </select>
                        </div> 
                        <span class="form-bar"></span>                                                                   
                    </div>
                </div>

              
            </div>  
                
                    <h6>Liste des personnels :</h6>
                    <table class="mytab text-center">
                        <thead style="font-weight:bold">
                            <td>Code du personnel</td>
                            <td>Nom personne</td>
                            <td>Salaire Unitaire</td>
                            <td>Date d'affectation</td>
                            <td>Date fin d'affectation</td>
                            <td>Effictif Réel</td>
                            <td>Salaire Réel</td>
                        </thead>
                        <tbody >
                            <?php $k=0; ?>
                            @foreach($personnels as $personnel)
                                <tr style="display:none;" id="{{ $personnel->id }}" class="data">
                                    <td> <input type="text" class="text-center"  name="code_personne[]" value="{{ $personnel->code_personne }}" style="border:none;" readonly> </td>
                                    <td > {{ $personnel->nom_personne}} </td>
                                    <td> <input type="text" class="text-center"  id="s{{ $personnel->id }}" name="salaire_unitaire[]" value="{{ $personnel->salaire_unitaire }}" style="border:none;" readonly> </td>

                                    
                                    @if($k < count($pers) && $personnel->id == $pers[$k])
                                    
                                    <td > <input type="date" 
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ date d'affectation est obligatoire!"
                                    class="date_d" id="d{{ $personnel->id }}" name="date_affect[]" 
                                    value= "{{$pers[$k+1]}}" style="border:none;" 
                                    placeholder="Entrer la date début de service" onchange="testDateD(this.value, this.id);"> </td>
                                    
                                    <td > <input type="date"
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ date fin d'affectation est obligatoire!" 
                                    class="date_f" id="f{{ $personnel->id }}" name="date_fin_affect[]" 
                                    value= "{{$pers[$k+2]}}" style="border:none;" 
                                    placeholder="Entrer la date début de service" onchange="testDateF(this.value, this.id);"  > </td>
                                    
                                    <td > <input type="number" 
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ effictif_reel est raquis!"
                                    value="{{$pers[$k+3]}}" class="effictif_reel text-center" id="e{{ $personnel->id }}" name="effictif_reel[]" style="border:none;" 
                                    placeholder="Entrer l'effictif_reel"   onchange="recupValeurPers(this.value, this.id)" > </td>
                                    
                                    <td ><input value="{{$pers[$k+4]}}" type="decimal" class="salaire_reel text-center" id="sr{{ $personnel->id }}" name="salaire_reel[]" style="border:none;" readonly></td>

                                
                                    <?php $k+=5; ?>
                                    @else
                                    <td > <input type="date" 
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ date d'affectation est obligatoire!"
                                    value="" class="date_d text-center" id="d{{ $personnel->id }}" name="date_affect[]" style="border:none;" 
                                     onchange="testDateD(this.value, this.id);" value= "" > </td>
                                    
                                    <td > <input type="date" 
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ date de fin d'affectation est obligatoire!"
                                    value="" class="date_f text-center" id="f{{ $personnel->id }}" name="date_fin_affect[]" style="border:none;" 
                                     onchange="testDateF(this.value, this.id);" value= "" > </td>
                                    
                                    <td > <input type="number" 
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ effictif réel est raquis!"
                                    value="" class="effictif_reel text-center" id="e{{ $personnel->id }}" name="effictif_reel[]" style="border:none;" 
                                    placeholder="Entrer l'effictif_reel"  value= "" onchange="recupValeurPers(this.value, this.id)" > </td>
                                    
                                    <td ><input value="" type="decimal" class="salaire_reel text-center" id="sr{{ $personnel->id }}" name="salaire_reel[]"  style="border:none;" readonly></td>

                                     @endif                                    
                                   
                                </tr>
                                
                            @endforeach
                                <tr>
                                    <td colspan="6" style="text-align:center;font-weight:bold" >Montant Salaire</td>

                                    <td ><input type="double" class="text-center" name="montant_salaire"  style="border:none;" id="montant_salaire" readonly></td>

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