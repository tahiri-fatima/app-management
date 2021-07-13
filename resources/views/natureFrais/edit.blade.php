@extends('natureFrais.layout')
   
@section('content')

<div class="container " style="margin-left: 70%;" > 
            <a class="btn btn-primary" href="{{ route('natureFrais.gestionForm') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
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
          <p>  <strong>Whoops!</strong> Il y a dejà un type avec ce code, pouvez vous entrer un autre code ?<br><br> </p>
            
        </div>
    @endif
</div>



<!-- start Formulaire -->

<div class="col d-flex justify-content-center" > 
    <div class="card" style="width:70%">  
        <div class="card-header">
            <h5><i class="fa fa-fw fa-edit"></i>  Modifier la nature de frais</h5>
        </div>
        <div class="card-block">
        <p style="font-weight:bold; margin-left: 200px; margin-bottom: 30px; ">Les champs avec <span class="text-danger"> * </span> sont obligatoire.</p>

        <form class="form-material" action="{{ route('natureFrais.update',$natureFrai->id) }}" method="POST">
            @csrf
        @method('PUT')
            <div class="row justify-content-around" >
                <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                        <input type="text" name="code_nature_frais" value="{{ $natureFrai->code_nature_frais }}" class="form-control" placeholder="Entrer le code de la nature du frais">
                        <span class="form-bar"></span>
                        <label Class="float-label" >Code de la nature du frais  <span class="text-danger"> * </span></label>

                    </div>
                </div>
               
            </div>

                <div class="row justify-content-center" >
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="text" name="nature_frais" value="{{ $natureFrai->nature_frais }}" class="form-control" placeholder="Entrer la nature du frais">
                            <span class="form-bar"></span>
                            <label Class="float-label" >Intitulé de la nature du frais  <span class="text-danger"> * </span></label>

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

   
@endsection