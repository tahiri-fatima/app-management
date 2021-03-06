@extends('roles.layout')
 
@section('content')

<div class="container " style="margin-left: 70%;" > 
            <a class="btn btn-primary" href="{{ route('roles.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 

        <div class="col  justify-content-center">    

				<h3>Résultat de la recherche</h3>
			
			<table class="table table-striped table-bordered text-center">
				<thead>
					<tr class="bg-primary text-white">
						<th >Code du role</th>
						<th >Nom du role</th>
                        <th >Prénom du role</th>
						<th >Action</th>
					</tr>
				</thead>
				<tbody>
                @foreach ($roles as $role)
            <tr>
            <td>{{ $role->code_role }}</td>
            <td>{{ $role->nom_role }}</td>
            <td>{{ $role->prenom_role }}</td>
            <td>
                 <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}" style="margin-left: 15px;"><i class="fa fa-fw fa-eye"></i>Consulter</a>
    
            </td>
        </tr>
        @endforeach
				</tbody>
			</table>
		</div> <!--/.col-sm-12-->
		

</div>

   
      
@endsection