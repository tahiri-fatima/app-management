@extends('frais.layout')
   
@section('content')

<div class="container" style="margin-left:80%" > 
            <a class="btn btn-primary" href="{{ route('frais.show',$frai->id) }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
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
          <p>  <strong>Whoops!</strong> Il y a dejà un frais avec ce code, pouvez vous entrer un autre code ?<br><br>  </p>
            
        </div>
    @endif
</div>



<!-- start Formulaire -->

<div class="col d-flex justify-content-center" > 
    <div class="card" style="width:70%">  
        <div class="card-header">
            <h5><i class="fa fa-fw fa-edit"></i>  Modifier le frais</h5>
        </div>
        <div class="card-block">
        <p style="font-weight:bold; ">Les champs avec <span class="text-danger">*</span> sont obligatoire.</p>

        <form class="form-material" action="{{ route('frais.update',$frai->id) }}" method="POST">
            @csrf
        @method('PUT')
            <div class="row justify-content-around" >
                <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                        <input type="text" name="code_frais" value="{{ $frai->code_frais }}" class="form-control" placeholder="Entrer le code du frais">
                        <label class="float-label"> Code du frais <span class="text-danger">*</span> </label>
                        <span class="form-bar"></span>

                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                        <input type="date" name="date_frais" value="{{ $frai->date_frais }}" class="form-control">
                        <label class="float-label"> Date du frais <span class="text-danger">*</span> </label>

                        <span class="form-bar"></span>
 </div>
                </div>
            </div>

                <div class="row justify-content-around" >
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="double" name="montant_frais" value="{{ $frai->montant_frais }}" class="form-control" placeholder="Entrer le montant du frais">
                            <label class="float-label"> Montant du frais  </label>

                            <span class="form-bar"></span>
                        </div>
                    </div>
                    <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                        <input type="text" name="cible_frais" value="{{ $frai->cible_frais }}" class="form-control" placeholder="Entrer le code du frais">
                        <label class="float-label"> Cible du frais <span class="text-danger">*</span> </label>

                        <span class="form-bar"></span>

                    </div>
                </div>
                </div>
               <div class="row">
               <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                    <label class="select-label" > Nature de frais <span class="text-danger">*</span></label>
                        <div class="select">
                        <select class="form-control" name="nature_frais_id">
                        <option value="{{ $nature_frai->id }}">{{ $nature_frai->nature_frais }}</option>
                            @foreach($nature_frais as $nature_frai)
                                <option value="{{ $nature_frai->id }}">{{ $nature_frai->nature_frais }}</option>
                            @endforeach
                        </select>
                        </div>                
                        <span class="form-bar"></span> 
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                    <label class="select-label"> Chantier  <span class="text-danger">*</span></label>
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
                </div>
               </div>

         

                <div class=" text-right">
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-fw fa-edit"></i> Editer</button>
            </div>
                                                 
            </form>
         </div>
    </div>

    <!-- end formulaire  -->

    <!-- formulaire 
    <div class="card">

<div class="card-header"><strong> Modifier le frais</strong> </div>

    <div class="card-body">
        
        <div class="col-sm-8">

<form action="{{ route('frais.update',$frai->id) }}" method="POST">
    @csrf
   @method('PUT')

   <div class="row justify-content-around" >
        <div class="col-6">
            <div class="form-group">
            <label > <strong>Code : <span class="text-danger">*</span></strong></label>
                <input type="text" name="codefrais" class="form-control" value="{{ $frai->codefrais }}"  placeholder="Code">
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
            <label ><strong>Nature : <span class="text-danger">*</span></strong></label>
                <input type="text" class="form-control" name="nature" value="{{ $frai->nature }}"  placeholder="Nature">
            </div>
        </div>
        </div>

        <div class="row justify-content-around">
       
        <div class="col-6">
            <div class="form-group">
            <label > <strong>Date de frais : <span class="text-danger">*</span></strong></label>
                <input type="date" class="form-control" name="datefrais" value="{{ $frai->datefrais }}" placeholder="Date frais">
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
            <label > <strong>Montant de frais : <span class="text-danger">*</span></strong></label>
                <input type="decimal" class="form-control" name="montantfrais" value="{{ $frai->montantfrais }}" placeholder="Montant frais">
            </div>
        </div>

        </div>

        <div class="row ">
            <div class="col-6">
                <div class="form-group">
                    <label ><strong>Chantier : <span class="text-danger">*</span></strong></label>
                    <div class="select">
                    <select class="form-control" name="chantier_id" >
                        <option value="{{ $chantier->id }}">{{ $chantier->intitulechantier }}</option>
                        @foreach($chantiers as $chantier)
                            <option value="{{ $chantier->id }}">{{ $chantier->intitulechantier }}</option>
                        @endforeach
                    </select>
                    </div>
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