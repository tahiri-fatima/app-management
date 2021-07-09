@extends('chantierNatureFrais.layout')
   
@section('content')


  
<div class="container " style="margin-left: 80%;"> 
            <a class="btn btn-primary" href="{{ route('chantierNatureFrais.showNatureFrais',$chantier->id) }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
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
            <strong>Whoops!</strong> Il y a dejà un enregistrement avec ce code ce couple de code chantier et nature Frais.<br><br>
            
        </div>
    @endif


</div>


<!-- start Formulaire -->


<div class="col d-flex justify-content-center " >
<div style="width:100%" >

    <div class="card" >  
        <div class="card-header">
            <h5><i class="fa fa-fw fa-plus-circle"></i>  Modifier les nature Frais du chantier</h5>
        </div>
        <div class="card-block">
        <div class="table-responsive">
            <form class="form-material" action="{{ route('chantierNatureFrais.updateNatureFrais', $chantier->id) }}"  enctype="multipart/form-data" onsubmit="return verifierChampsNatureFrais()" >
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
                        <label  >Nature Frais <span class="text-danger">*</span> </label>
                        <div class="select" >
                            <select id="mySelect" class="select2-multiple" name="nature_frais[]" multiple size="5" style="width: 100%;" >
                            <?php $k=0; ?>
                                @foreach($nature_frais as $nature_frai)
                                    @if($k < count($natureFrais) && $nature_frai->id == $natureFrais[$k])
                                        <option value="{{ $nature_frai->id }}" selected="true"> {{ $nature_frai->nature_frais }}  </option>
                                        <?php $k+=2; ?>
                                    @else
                                        <option value="{{ $nature_frai->id }}"> {{ $nature_frai->nature_frais }}  </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>                                                                   
                    </div>
                </div>
            </div>

            

            
                
                    <h5>Liste des nature Frais :</h5>
                    <table class="mytab text-center">
                        <thead style="font-weight:bold">
                            <td>Nature Frais</td>
                            <td>Code nature Frais</td>
   
                            <td>Montant Estimée</td>
                        </thead>
                        <tbody >
                        <?php $k=0; ?>
                            @foreach($nature_frais as $nature_frai)
                                <tr style="display:none;" id="{{ $nature_frai->id }}" class="data">
                                    <td > {{ $nature_frai->nature_frais }} </td>
                                    <td> <input type="text" class="text-center"  name="code_nature_frais[]" value="{{ $nature_frai->code_nature_frais }}" style="border:none;" readonly> </td>

                                    @if($k < count($natureFrais) && $nature_frai->id == $natureFrais[$k])
                                   

                                    <td style="width: 30px;"> <input type="double"
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ du montant estimée est obligatoire!"
                                    class="montantEst  text-center" id="montant{{ $nature_frai->id }}" name="montant_estimee[]" 
                                    style="border:none;" value= "{{$natureFrais[$k+1]}}" data-required="1" > </td>

                                    <?php $k+=2; ?>
                                    @else
                                    

                                   
                                    <td > <input type="number"
                                    data-container="body" data-toggle="popover"  data-placement="bottom" data-content="Le champ du montant estimée est obligatoire!"
                                     class="montantEst text-center" id="montant{{ $nature_frai->id }}" name="montant_estimee[]" style="border:none;"
                                     placeholder="Entrer le montant estimée" value= ""  > </td>


                                    @endif                                    
                                    
                                    
                                    
                                </tr>
                            @endforeach
                                
                                <tr>
                                    <td colspan="2" style="text-align:center; font-weight:bold" >Total</td>
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