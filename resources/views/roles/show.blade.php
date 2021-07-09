@extends('roles.layout')
  
@section('content')

<div class="container " style="margin-left: 20%;" > 
@can('role-create')
        <a class="btn btn-outline-primary text-right" href="{{ route('roles.create') }}"><i class="fa fa-fw fa-plus-circle"></i> Ajouter nouveau rôle</a> 
       @endcan
        @can('role-edit')
        <a class="btn btn-outline-primary"  href="{{ route('roles.edit',$role->id) }}" ><i class="fa fa-fw fa-edit"></i> Modifier</a>
        @endcan
        @can('role-delete')
        <button type="submit" class="btn btn-outline-primary" onclick="$('#modal').modal('show');"  ><i class="fa fa-fw fa-trash"></i> Supprimer</button>
        @endcan
        <a class="btn btn-outline-primary" href="{{ route('roles.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 

<!-- modal pour confirmer la supression !-->
<div   class="modal" tabindex="-1" role="dialog" id="modal" >
  <div class="modal-dialog" role="document" >
  <form class="modal-content"action="{{ route('roles.destroy',$role->id) }}" method="POST">
      <div class="modal-header" >
        <h5 class="modal-title" style="color:red;" > Confirmation de la supprission</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
          <strong >
            
            <p>Voulez vous supprimer le rôle dont le code {{ $role->name }} ?</p>
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
            <h5>Détails du rôle</h5>
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
                                            <h6>Nom du rôle : </h6> 
                                        </div>
                                    </div>
                                </td>
                                <td >
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6> {{ $role->name }}</h6>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6>Permissions : </h6>
                                        </div>
                                    </div>
                                </td>
                                <td >
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                        @foreach($rolePermissions as $p)
                                            <h6 > {{ $p->name }}</h6>
                                        @endforeach
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