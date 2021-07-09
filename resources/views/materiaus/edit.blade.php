@extends('materiaus.layout')
   
@section('content')


<div class="container " style="margin-left: 70%;" > 
            <a class="btn btn-primary" href="{{ route('materiaus.show',$materiau->id) }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
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
            <strong>Whoops!</strong> Il y a dejà un enregistrement avec ce code de matériau.<br><br>
            
        </div>
    @endif
</div>

<!-- start Formulaire -->

<div class="col d-flex justify-content-center" > 
    <div class="card" style="width:50%">  
        <div class="card-header">
            <h5><i class="fa fa-fw fa-edit"></i>  Modifier le matériau</h5>
        </div>
        <div class="card-block">
        <p style="font-weight:bold;">Les champs avec <span class="text-danger">*</span> sont obligatoire.</p>

        <form class="form-material" action="{{ route('materiaus.update',$materiau->id) }}" method="POST">
            @csrf
        @method('PUT')
                <div class="form-group form-primary form-static-label">
                    <input type="text" name="code_materiau" value="{{ $materiau->code_materiau }}" class="form-control" placeholder="Entrer le code du matériau">
                    <label class="float-label">Code du matériau<span class="text-danger">*</span> </label>
                    <span class="form-bar"></span>

                </div>

                <div class="form-group form-primary form-static-label">
                    <input type="text" name="intitule_materiau" value="{{ $materiau->intitule_materiau }}" class="form-control" placeholder="Entrer l'intitulé du matériau">
                    <label class="float-label">Intitulé du matériau<span class="text-danger">*</span> </label>
                    <span class="form-bar"></span>
                </div>

                <div class="form-group form-primary form-static-label">
                    <input type="double" name="prix_unit_materiau" value="{{ $materiau->prix_unit_materiau }}" class="form-control" placeholder="Entrer le prix d'unitaire du matériau">
                    <label class="float-label">Prix d'unitaire du matériau<span class="text-danger">*</span> </label>
                    <span class="form-bar"></span>
                </div>

                <div class=" text-right">
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-fw fa-edit"></i> Editer</button>
            </div>
                                                 
            </form>
         </div>
    </div>

<!-- end Formulaire -->


    <!-- formulaire 
    <div class="card" style="width:50%;">

<div class="card-header"><strong> Modifier le matériau</strong> </div>

    <div class="card-body">
        
        <div class="col-sm-8">

<form action="{{ route('materiaus.update',$materiau->id) }}" method="POST">
    @csrf
   @method('PUT')

<div class="row justify-content-around">
    <div >
        <div class="form-group">
            <strong>Code : <span class="text-danger">*</span></strong>
            <input type="text" class="form-control" name="codemateriau" value="{{ $materiau->codemateriau }}" class="form-control" placeholder="Code">
        </div>
    </div>
</div>

<div class="row justify-content-around">
    <div >
        <div class="form-group">
            <strong>Intitulé matériau : <span class="text-danger">*</span></strong>
            <input type="text" class="form-control" value="{{ $materiau->intitulemateriau }}" name="intitulemateriau" placeholder="intitulé matériau">
        </div>
    </div>
</div>

<div class="row justify-content-around">
    <div >
        <div class="form-group">
            <strong>Prix unitaire matériau : <span class="text-danger">*</span></strong>
            <input type="double" name="prixunitmateriau" class="form-control" value="{{ $materiau->prixunitmateriau }}" placeholder="Prix unitaire matériau">
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