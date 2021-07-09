@extends('personnels.layout')
  
@section('content')

<div class="container " style="margin-left: 20%;"> 
        <a class="btn btn-outline-primary text-right" href="{{ route('personnels.create') }}"><i class="fa fa-fw fa-plus-circle"></i> Ajouter nouveau personnel</a> 
        @can('edit')
        <a class="btn btn-outline-primary"  href="{{ route('personnels.edit',$personnel->id) }}" ><i class="fa fa-fw fa-edit"></i> Modifier</a>
        @endcan
        @can('delete')
        <button type="submit" class="btn btn-outline-primary" onclick="$('#modal').modal('show');"  ><i class="fa fa-fw fa-trash"></i> Supprimer</button>
        @endcan
        <a class="btn btn-outline-primary" href="{{ route('personnels.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 

<!-- modal pour confirmer la supression !-->
<div   class="modal" tabindex="-1" role="dialog" id="modal" >
  <div class="modal-dialog" role="document" >
  <form class="modal-content"action="{{ route('personnels.destroy',$personnel->id) }}" method="POST">
      <div class="modal-header" >
        <h5 class="modal-title" style="color:red;" > Confirmation de la supprission</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
          <strong >
            
            <p>Voulez vous supprimer le personnel dont le code {{ $personnel->code_personne }} ?</p>
        </strong>
      </div>
      <div class="modal-footer">
     
        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary" > Annuler</button>
        @csrf
        @method('DELETE')
        <button type="submit"  class="btn btn-outline-danger"> Supprimer</button>
      </div>
  </form>
    </div>
  </div>

<div class="col d-flex justify-content-center"> 

@if ($message = Session::get('success'))
        <div class="alert alert-success message">
            <p>{{ $message }}</p>
        </div>
    @endif
</div>
<div class="col d-flex justify-content-center">
<div class="col-xl-6 col-md-12 ">
    <div class="card table-card">

         <div class="card-header">
            <h5>Détails du personnel</h5>
                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li><i class="fa fa fa-wrench open-card-option"></i></li>
                        <li><i class="fa fa-window-maximize full-card"></i></li>
                        <li><i class="fa fa-minus minimize-card"></i></li>
                     </ul>
                </div>
            </div>
            
            <div class="card-block">
                <div class="table-responsive">
                    <table class="table table-hover m-b-0 without-header">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6>Code du personne : </h6> 
                                        </div>
                                    </div>
                                </td>
                                <td >
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6> {{ $personnel->code_personne }}</h6>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6>Nom du personne : </h6>
                                        </div>
                                    </div>
                                </td>
                                <td >
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6> {{ $personnel->nom_personne }}</h6>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6>Prénom du personne :</h6>
                                        </div>
                                    </div>
                                </td>
                                <td >
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6>{{ $personnel->prenom_personne }}</h6>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6>Qualification : </h6>
                                        </div>
                                    </div>
                                </td>
                                <td >
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6> {{ $qual->designation_qual }} </h6>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6>Numéro de téléphone : </h6>
                                        </div>
                                    </div>
                                </td>
                                <td >
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6> {{ $personnel->tele }} </h6>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6>Numéro CNSS :</h6>
                                        </div>
                                    </div>
                                </td>
                                <td >
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6>{{ $personnel->num_cnss }}</h6>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6>Montant CNSS :</h6>
                                        </div>
                                    </div>
                                </td>
                                <td >
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6>{{ $personnel->montant_cnss }}</h6>
                                        </div>
                                    </div>
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6>Date d'embauche :</h6>
                                        </div>
                                    </div>
                                </td>
                                <td >
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6>{{ $personnel->date_embauche }}</h6>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            
                            <tr>
                                <td>
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6>Fonction :</h6>
                                        </div>
                                    </div>
                                </td>
                                <td >
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6>{{ $personnel->fonction }}</h6>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                    
                        </tbody>
                    </table>
                 </div>
            </div>
        </div>
    </div>
</div>

@endsection