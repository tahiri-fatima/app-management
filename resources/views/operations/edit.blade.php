@extends('operations.layout')
   
@section('content')

<div class="container " style="margin-left: 70%;" > 
            <a class="btn btn-primary" href="{{ route('operations.show',$operation->id) }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
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
         <p>   <strong>Whoops!</strong> Il y a dejà une opération avec ce code.<br><br> </p>
            
        </div>
    @endif
</div>


<!-- start Formulaire -->

<div class="col d-flex justify-content-center" > 
    <div class="card" style="width:70%">  
        <div class="card-header">
            <h5><i class="fa fa-fw fa-edit"></i> Modifier l'opération</h5>
        </div>
        <div class="card-block">
        <p style="font-weight:bold; margin-bottom : 30px;">Les champs avec <span class="text-danger">*</span> sont obligatoire.</p>

        <form class="form-material" action="{{ route('operations.update',$operation->id) }}" method="POST">
            @csrf
        @method('PUT')
            <div class="row justify-content-around" >
                <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                        <input type="text" name="code_operation" value="{{ $operation->code_operation }}" class="form-control" placeholder="Entrer le code de l'opération">
                        <span class="form-bar"></span>
                        <label class="float-label" >Code d'opération <span class="text-danger">*</span> </label>

                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                        <input type="text"  class="form-control" name="designation_operation" value="{{ $operation->designation_operation }}" placeholder="Entrer la désignation de l'opération">
                        <span class="form-bar"></span>
                        <label class="float-label" >Désignation d'opération <span class="text-danger">*</span> </label>  
                  </div>
                </div>
            </div>

                <div class="row justify-content-around" >
                   
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="text" name="unite" class="form-control" value="{{ $operation->unite }}" placeholder="Entrer l'unité">
                            <span class="form-bar"></span>
                            <label class="float-label" >Unité <span class="text-danger">*</span> </label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <label  class="select-label">Sous traitance <span class="text-danger">*</span> </label>
                            <div class="select">
                                <select class="form-control" name="soutraitance_id">
                                    <option value="{{ $soutraitance->id }}">{{ $soutraitance->intitule_soutraitance }}</option>
                                    @foreach($soutraitances as $soutraitance)
                                        <option value="{{ $soutraitance->id }}">{{ $soutraitance->intitule_soutraitance }}</option>
                                    @endforeach
                                </select>
                            </div>                
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