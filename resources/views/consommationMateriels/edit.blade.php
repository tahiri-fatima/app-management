@extends('consommationMateriels.layout')
   
@section('content')

  
<div class="container "  style="margin-left: 75%;" > 
            <a class="btn btn-primary" href="{{ route('consommationMateriels.show',$consommationMateriel->id) }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
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
            <strong>Whoops!</strong> Il y a dejà une consommation avec ce code de consommation.<br><br>
            
        </div>
    @endif

</div>


<!-- start Formulaire -->

<div class="col d-flex justify-content-center" > 
    <div class="card" style="width:50%">  
        <div class="card-header">
            <h5><i class="fa fa-fw fa-edit"></i>  Modifier la consommation</h5>
        </div>
        <div class="card-block">
        <p style="font-weight:bold; margin-bottom: 30px;">Les champs avec <span class="text-danger">*</span> sont obligatoire.</p>

        <form class="form-material" action="{{ route('consommationMateriels.update',$consommationMateriel->id) }}" method="POST">
    @csrf
   @method('PUT')

                <div class="form-group form-primary form-static-label">
                    <input type="text" name="code_consommation_mat" value="{{ $consommationMateriel->code_consommation_mat }}" placeholder="Entrer le code de la consommation du matériel" class="form-control" >
                    <span class="form-bar"></span>
                    <label class="float-label">Code de la consommation <span class="text-danger">*</span> </label>
                </div>
                        
                  <div class="form-group form-primary form-static-label">
                    <input type="text" name="quantite_consommation_mat" value="{{ $consommationMateriel->quantite_consommation_mat }}" class="form-control" placeholder="Entrer quantité de la consommation du matériel">
                    <span class="form-bar"></span>
                    <label class="float-label">Quantité consommée <span class="text-danger">*</span> </label>
                  </div>   
              
                <div class="form-group form-primary form-static-label">
                    <input type="date" name="date_consommation_mat" value="{{ $consommationMateriel->date_consommation_mat }}" class="form-control" placeholder="Entrer la date de la consommation du matériel">
                    <span class="form-bar"></span>
                    <label class="float-label">Date de la consommation<span class="text-danger">*</span> </label>
                </div>
               
                        <div class="form-group form-primary form-static-label">
                        <label style="top: -14px; font-size: 11px; color: #448aff;"> Matériel consommée <span class="text-danger">*</span> </label>
                            <div class="select">
                            <select class="form-control" name="materiel_id">
                                <option value="{{ $materiel->id }}">{{ $materiel->intitule_materiel }}</option>
                                @foreach($materiels as $materiel)
                                    <option value="{{ $materiel->id }}">{{ $materiel->intitule_materiel }}</option>
                                @endforeach
                            </select>               
                            <span class="form-bar"></span>
                        </div>
                </div>
               
                <div class=" text-right">
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-fw fa-edit"></i> Editer</button>
                </div>
                                                 
            </form>
         </div>
    </div>
<!-- end formulaire -->


    <!-- formulaire 
    <div class="card">

<div class="card-header"><strong> Modifier la consommation</strong> </div>

    <div class="card-body">
        
        <div class="col-sm-8">

<form action="{{ route('consommationMateriels.update',$consommationMateriel->id) }}" method="POST">
    @csrf
   @method('PUT')

<div class="row justify-content-around" >
<div class="col-6">
    <div class="form-group">
    <label ><strong>Code de la consommation <span class="text-danger">*</span></strong></label>
        <input type="text" name="code_consommation_mat" value="{{ $consommationMateriel->codeconsommation_mat }}" class="form-control" placeholder="Code">
    </div>
</div>

<div class="col-6">
                <div class="form-group">
                    <label ><strong>Matériel consommée <span class="text-danger">*</span></strong></label>
                    <div class="select">
                    <select class="form-control" name="materiel_id" >
                        <option value="{{ $materiel->id }}">{{ $materiel->intitule_materiel }}</option>
                        @foreach($materiels as $materiel)
                            <option value="{{ $materiel->id }}">{{ $materiel->intitule_materiel }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
        </div>

</div>

<div class="row justify-content-around">
<div class="col-6">
    <div class="form-group">
    <label ><strong>Quantité consommée : <span class="text-danger">*</span></strong></label>
        <input type="decimal" class="form-control" name="quantite_consommation_mat" value="{{ $consommationMateriel->quantiteconsommation_mat }}" placeholder="Quantite consommation">
    </div>
</div>
<div class="col-6">
    <div class="form-group">
    <label ><strong>Date de la consommation : <span class="text-danger">*</span></strong></label>
        <input type="date" class="form-control" name="date_consommation_mat" value="{{ $consommationMateriel->dateconsommation_mat }}" placeholder="Date consommation">
    </div>
</div>
</div>

<div class=" text-right">
        <button type="submit" class="btn btn-primary"> <i class="fa fa-fw fa-edit"></i> Editer</button>
</div>
</div>

</form>
</div>
    </div>
</div>
!-->

@endsection