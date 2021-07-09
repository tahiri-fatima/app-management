@extends('fournisseurs.layout')
   
@section('content')
  
<div class="container " style="margin-left:70%" > 
            <a class="btn btn-primary" href="{{ route('fournisseurs.show',$fournisseur->id) }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
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
            <strong>Whoops!</strong> Il y a dejà un fournisseur avec ce code de fournisseur.<br><br>
            
        </div>
    @endif
  </div>

<!-- start Formulaire -->

<div class="col d-flex justify-content-center" > 
    <div class="card" style="width:50%">  
        <div class="card-header">
            <h5><i class="fa fa-fw fa-edit"></i>  Modifier le fournisseur</h5>
        </div>
        <div class="card-block">

        <p style="font-weight:bold; margin-bottom : 30px;">Les champs avec <span class="text-danger">*</span> sont obligatoire.</p>

        <form class="form-material" action="{{ route('fournisseurs.update',$fournisseur->id) }}" method="POST">
            @csrf
        @method('PUT')
           
                <div class="form-group form-primary form-static-label">
                    <input type="number" name="code_fournisseur" value="{{ $fournisseur->code_fournisseur }}" class="form-control" placeholder="Entrer le code de fournisseur">
                    <label class="float-label">Code de fournisseur <span class="text-danger">*</span> </label>

                    <span class="form-bar"></span>
 </div>
                          
                  <div class="form-group form-primary form-static-label">
                    <input type="txt" name="intitule_fournisseur" value="{{ $fournisseur->intitule_fournisseur }}" class="form-control" placeholder="Entrer l'intitulé de fournisseur">
                    <label class="float-label">Intitulé de fournisseur <span class="text-danger">*</span> </label>

                    <span class="form-bar"></span>
 </div>   
                
                <div class="form-group form-primary form-static-label">
                    <input type="number" name="telephone_fournisseur" value="{{ $fournisseur->telephone_fournisseur }}" class="form-control" placeholder="Entrer le télephone de fournisseur">
                    <label class="float-label">Télephone de fournisseur <span class="text-danger">*</span> </label>

                    <span class="form-bar"></span>
 </div>

                                
                <div class="form-group form-primary form-static-label">
                    <input type="email" name="email_fournisseur" value="{{ $fournisseur->email_fournisseur }}" class="form-control" placeholder="Entrer l'email de fournisseur">
                    <label class="float-label">Email de fournisseur <span class="text-danger">*</span> </label>

                    <span class="form-bar"></span>
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

<div class="card-header"><strong> Modifier la réparation</strong> </div>

    <div class="card-body">
        
        <div class="col-sm-8">

<form action="{{ route('fournisseurs.update',$fournisseur->id) }}" method="POST">
    @csrf
   @method('PUT')

    <div class="row justify-content-around">
        <div class="col-6">
            <div class="form-group">
                <strong>Code : <span class="text-danger">*</span></strong>
                <input type="text" name="codefournisseur" value="{{ $fournisseur->codefournisseur }}" class="form-control" placeholder="Code">
            </div>
        </div>

        <div class="col-6">
                <div class="form-group">
                    <strong>Intitulé : <span class="text-danger">*</span></strong>
                    <input type="text" class="form-control" name="intitulefournisseur" value="{{ $fournisseur->intitulefournisseur }}" placeholder="Intitulé réparation">
                </div>
        </div>
    </div>

    <div class="row justify-content-around">
        <div class="col-6">
            <div class="form-group">
                <strong>Télephone : <span class="text-danger">*</span></strong>
                <input type="telephone" class="form-control" name="telephonefournisseur" value="{{ $fournisseur->telephonefournisseur }}" placeholder="Télephone">
            </div>
        </div>
        
        <div class="col-6">
            <div class="form-group">
                <strong>Email : <span class="text-danger">*</span></strong>
                <input type="email" class="form-control" name="emailfournisseur" value="{{ $fournisseur->emailfournisseur }}" placeholder="Email">
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