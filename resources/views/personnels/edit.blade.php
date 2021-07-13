@extends('personnels.layout')


  
@section('content')

<div class="container " style="margin-left: 70%;" > 
            <a class="btn btn-primary" href="{{ route('personnels.gestionForm') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 

<div class="col justify-content-center" >



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
        <div class="alert alert-danger message">
         <p>   <strong>Whoops!</strong> Il y a dejà un personne avec ce code de personne.<br><br>  </p>
            
        </div>
    @endif

<!-- Affichage de modal si le personne ajouté avec succes. !-->
    @if(!empty(Session::get('success')) && Session::get('success') == 'Personne ajouté avec succes.')
    <script>
        $(function() {
            $('#myModal').modal('show');
        });
    </script>
    @endif

<!-- modal si Personne ajouté avec succes !-->
<div class="modal" tabindex="-1" role="dialog" id="myModal" >
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header" >
        <h5 class="modal-title" style="color:#228B22;" > Ajout avec succes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
          <strong >
            <p>Personne ajouté avec succes.</p>
            <p>Voulez vous insérer un autre personne ?</p>
        </strong>
      </div>
      <div class="modal-footer">
        <a class="btn btn-outline-secondary" href="{{ route('personnels.index') }}"> Non</a>
        
        <button type="button" class="btn btn-outline-success" data-dismiss="modal">Oui</button>
      </div>
    </div>
  </div>
</div>
</div>




<!-- start Formulaire -->

<div class="col d-flex justify-content-center" > 
    <div class="card" style="width:80%">  
        <div class="card-header">
            <h5><i class="fa fa-fw fa-edit"></i>  Modifier le personnel</h5>
        </div>
        <div class="card-block">
        <p style="font-weight:bold; margin-bottom : 30px;">Les champs avec <span class="text-danger">*</span> sont obligatoire.</p>

            <form class="form-material" action="{{ route('personnels.update',$personnel->id) }}" method="POST">
    @csrf
   @method('PUT')

   <div class="row justify-content-around">
                 <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                        <input type="text" name="code_personne" value="{{$personnel->code_personne }}" class="form-control" placeholder="Entrer le code du personnel">
                        <span class="form-bar"></span>
                        <label class="float-label">Code du personnel<span class="text-danger">*</span> </label>
                    </div>
                 </div>
                 <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                        <input type="text" name="nom_personne" value="{{$personnel->nom_personne }}"  class="form-control" placeholder="Entrer le nom du personnel">
                        <span class="form-bar"></span>
                        <label class="float-label">Nom du personnel<span class="text-danger">*</span> </label>
                    </div>
                 </div>
            </div>

            <div class="row justify-content-around">
                     <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="text" name="prenom_personne" value="{{$personnel->prenom_personne }}"  class="form-control" placeholder="Entrer le prénom du personnel">
                            <span class="form-bar"></span>
                            <label class="float-label">Prénom du personnel<span class="text-danger">*</span> </label>
                        </div>
                     </div>

                     <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                           <input type="text" name="fonction" value="{{$personnel->fonction }}"  class="form-control" placeholder="Entrer la foction">
                            <span class="form-bar"></span>
                            <label class="float-label">Fonction<span class="text-danger">*</span> </label>
                        </div>
                    </div>
                   
                </div>

                <div class="row justify-content-around">
                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="text" name="num_cnss" value="{{$personnel->num_cnss }}"  class="form-control" placeholder="Entrer le numéro de la CNSS">
                            <span class="form-bar"></span>
                            <label class="float-label">Numéro de la CNSS <span class="text-danger">*</span> </label>
                        </div>
                     </div>

                     <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="double" name="montant_cnss" value="{{$personnel->montant_cnss }}"  class="form-control" placeholder="Entrer le montant de la CNSS">
                            <span class="form-bar"></span>
                            <label class="float-label">Montant de la CNSS<span class="text-danger">*</span> </label>
                        </div>
                     </div>
                   
                </div>

    

                <div class="row justify-content-around">
                     <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="date" name="date_embauche" value="{{$personnel->date_embauche }}"  class="form-control" placeholder="Entrer le numéro de téléphone" >
                            <span class="form-bar"></span>
                            <label class="float-label">Date d'embauche<span class="text-danger">*</span> </label>
                        </div>
                     </div>

                     <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <input type="text" name="tele" value="{{$personnel->tele }}"  class="form-control" >
                            <span class="form-bar"></span>
                            <label class="float-label">Numéro de téléphone<span class="text-danger">*</span> </label>
                        </div>
                     </div>
                </div>

                <div class="row justify-content-around"> 
                <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <label class="select-label " >Qualification <span class="text-danger">*</span> </label>
                                <div class="select">
                                    <select class="form-control" name="qualification_id">
                                        <option value="{{ $qual->id }}" >{{$qual->designation_qual  }}</option>
                                        @foreach($qualifications as $qual)
                                            <option value="{{ $qual->id }}">{{ $qual->designation_qual }}</option>
                                        @endforeach
                                    </select>
                                </div>                
                            <span class="form-bar"></span> 
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group form-primary form-static-label">
                            <label class="select-label " >Rôle <span class="text-danger">*</span> </label>
                                <div class="select">
                                    <select class="form-control" name="role_id">
                                        <option value="{{ $userRole->id }}">{{$userRole->name }} </option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
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