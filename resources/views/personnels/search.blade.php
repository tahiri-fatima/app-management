@extends('personnels.layout')
 
@section('content')

<div class="container " style="margin-left: 70%;" > 
            <a class="btn btn-primary" href="{{ route('personnels.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 

        <div class="col  justify-content-center">    

				<h3>Résultat de la recherche</h3>
			
			<table class="table table-striped table-bordered text-center">
				<thead>
					<tr class="bg-primary text-white">
						<th >Code du personne</th>
						<th >Nom du personne</th>
                        <th >Prénom du personne</th>
						<th >Action</th>
					</tr>
				</thead>
				<tbody>
                @foreach ($personnels as $personnel)
            <tr>
            <td>{{ $personnel->code_personne }}</td>
            <td>{{ $personnel->nom_personne }}</td>
            <td>{{ $personnel->prenom_personne }}</td>
            <td>
                 <a class="btn btn-info" href="{{ route('personnels.show',$personnel->id) }}" style="margin-left: 15px;"><i class="fa fa-fw fa-eye"></i>Consulter</a>
    
            </td>
        </tr>
        @endforeach
				</tbody>
			</table>
		</div> <!--/.col-sm-12-->
		

</div>

   
      
@endsection