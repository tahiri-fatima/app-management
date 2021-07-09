@extends('soutraitances.layout')
   
@section('content')

<div class="container" style="margin-left: 70%;" > 
            <a class="btn btn-primary" href="{{ route('soutraitances.show',$soutraitance->id) }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
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
           <p> <strong>Whoops!</strong> Il y a dejà un enregistrement avec ce code de sous traitance.<br><br>  </p>
            
        </div>
    @endif
</div>


<!-- start Formulaire -->

<div class="col d-flex justify-content-center" > 
    <div class="card" style="width:50%">  
        <div class="card-header">
            <h5><i class="fa fa-fw fa-edit"></i>  Modifier sous traitance</h5>
        </div>
        <div class="card-block">
        <p style="font-weight:bold; margin-bottom: 30px; ">Les champs avec <span class="text-danger">*</span> sont obligatoire.</p>

        <form class="form-material" action="{{ route('soutraitances.update',$soutraitance->id) }}" method="POST">
            @csrf
        @method('PUT')
                <div class="form-group form-primary form-static-label">
                    <input type="text" name="code_soutraitance" value="{{ $soutraitance->code_soutraitance }}" class="form-control" placeholder="Entrer le code de sous traitance">
                    <span class="form-bar"></span>
                    <label class="float-label" >Code de sous traitance<span class="text-danger">*</span> </label>

                </div>

                <div class="form-group form-primary form-static-label">
                    <input type="text" name="intitule_soutraitance" value="{{ $soutraitance->intitule_soutraitance }}" class="form-control" placeholder="Entrer l'intitulé de sous traitance">
                    <span class="form-bar"></span>
                    <label class="float-label" >Intitulé de sous traitance<span class="text-danger">*</span> </label>

                    
                </div>

                <div class="form-group form-primary form-static-label">
                    <input type="double" name="montant_soutraitance" value="{{ $soutraitance->montant_soutraitance }}" class="form-control" placeholder="Entrer le montant de sous traitance">
                    <span class="form-bar"></span>
                    <label class="float-label" >Montant de sous traitance<span class="text-danger">*</span> </label>

                </div>

                <div class="form-group form-primary form-static-label">
                    <input type="date" name="date_soutraitance" value="{{ $soutraitance->date_soutraitance }}" class="form-control">
                    <span class="form-bar"></span>
                    <label class="float-label" >Date de sous traitance <span class="text-danger">*</span> </label>

                </div>


                <div class=" text-right">
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-fw fa-edit"></i> Editer</button>
                </div>
                                                 
            </form>
         </div>
    </div>

<!-- end Formulaire -->

    <!-- formulaire 
    <div class="card">

<div class="card-header"><strong> Modifier sous traitance </strong> </div>

    <div class="card-body">
        
        <div class="col-sm-8">

<form action="{{ route('soutraitances.update',$soutraitance->id) }}" method="POST">
    @csrf
   @method('PUT')

   <div class="row " >
        <div class="col-6">
            <div class="form-group">
                <strong>Code : <span class="text-danger">*</span></strong>
                <input type="text" name="codesou_traitance" value="{{ $soutraitance->codesou_traitance }}" class="form-control" placeholder="Code">
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <strong>Intitulé : <span class="text-danger">*</span></strong>
                <input type="text" class="form-control" value="{{ $soutraitance->intitulesou_traitance }}" name="intitulesou_traitance" placeholder="Intitulé ">
            </div>
        </div>
        </div>

        <div class="row justify-content-around">
       
        <div class="col-6">
            <div class="form-group">
                <strong>Montant : <span class="text-danger">*</span></strong>
                <input type="decimal" class="form-control" value="{{ $soutraitance->montantsou_traitance }}" name="montantsou_traitance" placeholder="Montant ">
            </div>
        </div>
        
        <div class="col-6">
            <div class="form-group">
                <strong>Date : <span class="text-danger">*</span></strong>
                <input type="date" class="form-control" value="{{ $soutraitance->datesou_traitance }}" name="datesou_traitance" placeholder="Date ">
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