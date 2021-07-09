@extends('ordreServices.layout')
   
@section('content')

<div class="container" style="margin-left: 70%;" > 
            <a class="btn btn-primary" href="{{ route('ordreServices.show',$ordreService->id) }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 
   
<div class="col d-flex justify-content-center " >

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
        <div class="alert alert-danger">
          <p>  <strong>Whoops!</strong> Il y a dejà un ordre de service avec ce code d'ordre.<br><br> </p>
            
        </div>
    @endif
</div>


<!-- start Formulaire -->

<div class="col d-flex justify-content-center" > 
    <div class="card" style="width:50%">  
        <div class="card-header">
            <h5><i class="fa fa-fw fa-edit"></i>  Modifier l'ordre de service</h5>
        </div>
        <div class="card-block">
        <p style="font-weight:bold; margin-bottom: 30px;">Les champs avec <span class="text-danger">*</span> sont obligatoire.</p>

        <form class="form-material" action="{{ route('ordreServices.update',$ordreService->id) }}" method="POST">
            @csrf
        @method('PUT')
            
                    <div class="form-group form-primary form-static-label">
                        <input type="text" name="code_ordre_serv" value="{{ $ordreService->code_ordre_serv }}" class="form-control" placeholder="Entrer le code d'ordre de service">
                        <span class="form-bar"></span>
                        <label class="float-label">Code d'ordre de service <span class="text-danger">*</span> </label>

                    </div>
                
                    <div class="form-group form-primary form-static-label">
                        <input type="text" name="type_ordre_serv" value="{{ $ordreService->type_ordre_serv }}" class="form-control" placeholder="Entrer le type d'ordre de service">
                        <span class="form-bar"></span>
                        <label class="float-label">Type d'ordre de service <span class="text-danger">*</span> </label>

                    </div>
               
                        <div class="form-group form-primary form-static-label">
                            <input type="date" name="date_ordre_serv" value="{{ $ordreService->date_ordre_serv }}" class="form-control" >
                            <span class="form-bar"></span>
                            <label class="float-label">date d'ordre de service <span class="text-danger">*</span> </label>

                        </div>
                    
                        <div class="form-group form-primary form-static-label">
                        <label class="select-label">Chantier <span class="text-danger">*</span> </label>
                            <div class="select">
                            <select class="form-control" name="chantier_id">
                            <option value="{{ $chantier->id }}">{{ $chantier->intitule_chantier }}</option>
                                @foreach($chantiers as $chantier)
                                    <option value="{{ $chantier->id }}">{{ $chantier->intitule_chantier }}</option>
                                @endforeach
                            </select>
                            </div>                
                            <span class="form-bar"></span> 
                        </div>
                    

                <div class=" text-right">
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-fw fa-edit"></i> Editer</button>
            </div>
                                                 
            </form>
         </div>
    </div>
<!-- end formulaire -->

 
@endsection