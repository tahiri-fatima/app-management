@extends('roles.layout')

@section('content')

<div class="container " style="margin-left: 60%;" > 
            @can('role-create')
            <a class="btn btn-success" href="{{ route('roles.create') }}"> Ajouter Nouveau rôle</a>
            @endcan
            <a class="btn btn-primary" href="{{ route('home') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 

<div class="col d-flex justify-content-center" >



@if ($message = Session::get('success'))
    <div class="alert alert-success message">
        <p>{{ $message }}</p>
    </div>
@endif


<table class="table table-bordered mytab text-center">
  <tr>
     <th>No</th>
     <th>Nom</th>
     <th >Action</th>
  </tr>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Consulter</a>
            @can('role-edit')
                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Modifier</a>
            @endcan
            @can('role-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Supprimer', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
    </tr>
    @endforeach
    
</table>
</div>
@endsection