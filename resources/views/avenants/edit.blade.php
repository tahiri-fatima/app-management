@extends('avenants.layout')
   
@section('content')



<div class="container " style="margin-left:70%"> 
    <a class="btn btn-primary" href="{{ route('avenants.show',$avenant->id) }}"  ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 
  
<div class="col d-flex justify-content-center">
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
@if(!empty(Session::get('error_code')) && Session::get('error_code') == 1)
        <div class="alert alert-danger message">
          <p>  <strong>Whoops!</strong> Il y a dejà un enregistrement avec ce code.<br><br></p>
            
        </div>
@endif
</div>

<!-- start Formulaire -->

<div class="col d-flex justify-content-center" > 
    <div class="card" style="width:70%">  
        <div class="card-header">
            <h5><i class="fa fa-fw fa-edit"></i>Modifier l'avenant</h5>
        </div>
        <div class="card-block">
        <p style="font-weight:bold; margin-bottom : 30px;">Les champs avec <span class="text-danger">*</span> sont obligatoire.</p>

            <form class="form-material" action="{{ route('avenants.update',$avenant->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row justify-content-around" >
                <div class="col-6">
                  <div class="form-group form-primary form-static-label">
                  <input type="text" name="code_avenant" value="{{ $avenant->code_avenant }}" class="form-control" placeholder="Entrer le code d'avenant">
                      <label class="float-label">Code d'avenant <span class="text-danger">*</span> </label>
                      <span class="form-bar"></span>

                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group form-primary form-static-label">
                  <input type="date" name="date_avenant" value="{{ $avenant->date_avenant }}" class="form-control">
                    <label class="float-label">Date d'avenant<span class="text-danger">*</span> </label>
                    <span class="form-bar"></span>

                  </div>
                </div>
            </div>

            <div class="row justify-content-around" >
                <div class="col-6">
                  <div class="form-group form-primary form-static-label">
                  <input type="text" name="type_avenant" class="form-control" value="{{ $avenant->type_avenant }}" placeholder="Entrer le type d'avenant">
                      <label class="float-label">Type d'avenant <span class="text-danger">*</span> </label>
                      <span class="form-bar"></span>

                  </div>
                </div>
                <div class="col-6">
                <div class="form-group form-primary form-static-label">
                <label  class="select-label"> Opération  <span class="text-danger">*</span> </label>
                    <div class="select">
                        <select class="form-control" name="operation_id" >
                        <option value="{{ $operation->id }}">{{ $operation->designation_operation }}</option>
                            @foreach($operations as $operation)
                                <option value="{{ $operation->id }}">{{ $operation->designation_operation }}</option>
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

<!-- end Formulaire -->

   
@endsection