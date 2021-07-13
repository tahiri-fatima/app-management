@extends('materiels.layout')
   
@section('content')

   

<div class="container " style="margin-left: 70%;" > 
            <a class="btn btn-primary" href="{{ route('materiels.gestionForm') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 

<div class="col d-flex justify-content-center message" >

   
    @if ($errors->any())
        <div class="alert alert-danger">
          <p>  <strong>Whoops!</strong> There were some problems with your input.<br><br> </p>
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
          <p>  <strong>Whoops!</strong> Il y a dejà un matériel avec ce code de matériel.<br><br> </p>
            
        </div>
    @endif
</div>

<!-- start Formulaire -->

<div class="col d-flex justify-content-center" > 
    <div class="card" style="width:80%">  
        <div class="card-header">
            <h5><i class="fa fa-fw fa-edit"></i>  Modifier le matériel</h5>
        </div>
        <div class="card-block">
        <p style="font-weight:bold; margin-bottom : 30px;">Les champs avec <span class="text-danger">*</span> sont obligatoire.</p>

        <form class="form-material" action="{{ route('materiels.update',$materiel->id) }}" method="POST">
            @csrf
        @method('PUT')

            <div class="row justify-content-around">
                 <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                        <input type="text" name="code_materiel" value="{{ $materiel->code_materiel }}" class="form-control" placeholder="Entrer le code du matériel">
                        <span class="form-bar"></span>
                        <label class="float-label">Code du matériel<span class="text-danger">*</span> </label>
                   
                    </div>
                 </div>
                 <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                        <input type="text" name="intitule_materiel" value="{{ $materiel->intitule_materiel }}" class="form-control" placeholder="Entrer l'intitulé du matériel">
                        <span class="form-bar"></span>
                        <label class="float-label">Intitulé du matériel<span class="text-danger">*</span> </label>
                    </div>
                 </div>
            </div>

               

                <div class="row justify-content-around">
                     <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="double" name="taux_consommation" value="{{ $materiel->taux_consommation }}" class="form-control" placeholder="Entrer le taux de consommation">
                            <span class="form-bar"></span>
                        <label class="float-label">Taux de consommation<span class="text-danger">*</span> </label>
                    </div>
                     </div>
                     <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="number" name="quantite" value="{{ $materiel->quantite }}" class="form-control" placeholder="Entrer la quantité">
                            <span class="form-bar"></span>
                        <label class="float-label">Quantité du matériel<span class="text-danger">*</span> </label>
                     </div>
                     </div>
                </div>

                <div class="row ">
                    
                    <div class="col-6">
                       <div class="form-group form-primary form-static-label">
                          <input type="boolean" name="type_interne_externe" value="{{ $materiel->type_interne_externe }}" class="form-control" placeholder="Entrer 0 ou 1">
                          <span class="form-bar"></span>
                        <label class="float-label">Type interne/externe<span class="text-danger">*</span> </label>
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