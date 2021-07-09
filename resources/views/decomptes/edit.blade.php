@extends('decomptes.layout')
   
@section('content')


  
  
<div class="container" style="margin-left: 80%;" > 
            <a class="btn btn-primary" href="{{ route('decomptes.show',$decompte->id) }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
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
@if(!empty(Session::get('error_code')) && Session::get('error_code') == 1)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Il y a dejà un décompte avec ce code de décompte, pouvez vous entrer un autre code ?<br><br>
            
        </div>
    @endif
</div>


<!-- start Formulaire -->

<div class="col d-flex justify-content-center" > 
    <div class="card" style="width:80%">  
        <div class="card-header">
            <h5><i class="fa fa-fw fa-edit"></i>  Ajouter nouveau décompte</h5>
        </div>
        <div class="card-block">
        <p style="font-weight:bold;">Les champs avec <span class="text-danger">*</span> sont obligatoire.</p>

<form class="form-material" action="{{ route('decomptes.update',$decompte->id) }}" method="POST">
    @csrf
   @method('PUT')
            <div class="row justify-content-around" >
                <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                        <input type="number" name="num_decompte" value="{{ $decompte->num_decompte }}" class="form-control" placeholder="Entrer le numéro décompte">
                        <span class="form-bar"></span>
                        <label class="float-label">Numéro décompte <span class="text-danger">*</span> </label>

                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                        <input type="date" name="date_decompte" value="{{ $decompte->date_decompte }}" class="form-control">
                        <span class="form-bar"></span>
                        <label class="float-label">Date décompte <span class="text-danger">*</span> </label>  
                    </div>
                </div>
            </div>
                <div class="row justify-content-around" >
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="text" name="montant_decompte" value="{{ $decompte->montant_decompte }}" class="form-control" placeholder="Entrer le montant du décompte">
                            <span class="form-bar"></span>
                            <label class="float-label">Montant décompte <span class="text-danger">*</span> </label>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="boolean" name="accorde" value="{{ $decompte->accorde }}" class="form-control" placeholder="Entrer 0 ou 1">
                            <span class="form-bar"></span>
                            <label class="float-label">Accordé <span class="text-danger">*</span> </label>

                        </div>
                    </div>
                </div>
                <div class="row justify-content-around" >
                   
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="double" name="revision_prix" value="{{ $decompte->revision_prix }}" class="form-control" placeholder="Entrer le révision du prix">
                            <span class="form-bar"></span>
                            <label class="float-label">Révision prix </label>

                        </div>
                    </div>
               
                <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                    <label class="select-label" > Chantier <span class="text-danger">*</span> </label>
                        <div class="select">
                            <select class="form-control" name="chantier_id">
                            <option value="{{ $chantier->id }}">{{ $chantier->code_chantier }}</option>
                                @foreach($chantiers as $chantier)
                                    <option value="{{ $chantier->id }}">{{ $chantier->intitule_chantier }}</option>
                                @endforeach
                            </select>
                        </div>                
                        <span class="form-bar"></span>              
                    </div>
                </div>
                </div>

                <div class=" text-right">
                     <button type="submit" class="btn btn-primary"> <i class="fa fa-fw fa-edit"></i> Editer</button>
                </div>
                                                 
            </form>
         </div>
    </div>
<!-- end formulaire -->

   
@endsection