@extends('materiels.layout')
 
@section('content')

  
<div class="col d-flex justify-content-center">

<div class="container" >
    <div class="col d-flex justify-content-center " > 
        @if ($message = Session::get('success'))
        <div class="alert alert-success message">
            <p>{{ $message }}</p>
        </div>
        @endif

        @if ($message = Session::get('warning'))
        <div class="alert alert-info message">
            <p>{{ $message }}</p>
        </div>
        @endif

        @if ($message = Session::get('error'))
        <div class="alert alert-danger message">
            <p>{{ $message }}</p>
        </div>
        @endif
    </div>
    

		<div class="card">
			<div class="card-body">
			
					<h5 class="card-title"> Gestion des matériels</h5>

                        <form class="form-material" type="get" action="{{ route('materiels.gotoIndex') }}" >
                       
                        <div class="row " style="margin-left: 30px;" >
                            <div class="col-6">
                                <div class="form-group form-primary form-static-label">
                                    <select class="form-control" id="materiels" type="dropdown-toggle" class="form-control" name="materiel_id" >
                                        <option value="choisir" selected disabled>Choisir Matériel</option>
                                        @foreach($materiels as $materiel)
                                            <option class="materiels" value="{{$materiel->id }}">{{$materiel->intitule_materiel}}</option>
                                        @endforeach
                                    </select>
                                </div>                
                                <span class="form-bar"></span>
                                        
                            </div>
                        </div>

                        <!-- modal pour confirmer la supression !-->
                        <div   class="modal" tabindex="-1" role="dialog" id="modal" >
                        <div class="modal-dialog" role="document" >
                        <div class="modal-content"  >
                            <div class="modal-header" >
                                <h5 class="modal-title" style="color:red;" > Confirmation de la supprission</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body ">
                                <strong >
                                    
                                    <p>Voulez vous supprimer ce matériel ?</p>
                                </strong>
                            </div>
                            <div class="modal-footer">
                            
                                <button type="button" data-dismiss="modal" class="btn btn-outline-secondary" > Annuler</button>
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="supprimer" value="Supprimer"  class="btn btn-outline-danger"> Supprimer</button>
                            </div>
                        </div>
                            </div>
                        </div>

                            <div class="row justify-content-around">
                              
                            <div class="col">
                                        <div class="form-group " >
                                            <button class="btn btn-outline-primary" name="consulter" type="submit" value="Consulter"  ><i class="fa fa-fw fa-eye"></i>Consulter</button>
                                        </div>
                                </div>
                                @can('edit')
                                <div class="col">
                                        <div class="form-group " >
                                            <button class="btn btn-outline-primary" name="modifier2" type="submit" value="Update"><i class="fa fa-fw fa-edit"></i> Modifier</button>
                                        </div>
                                </div>
                                @endcan

                               
                                @can('delete')
                                <div class="col">
                                        <div class="form-group " >
                                        
                                            <a class="btn btn-outline-primary" style="color:#4680FE"  onclick="$('#modal').modal('show');"   ><i class="fa fa-fw fa-trash"></i>  Supprimer</a>
                                        </div>
                                </div>
                                @endcan

                                <div class="col">
                                    <div class="form-group">
                                    <a class="btn btn-outline-primary" href="{{ route('materiels.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
                                    </div>
                                </div>
                            </div>
                        </form>
            </div>
        </div>
       </div>
</div>

      

      
@endsection