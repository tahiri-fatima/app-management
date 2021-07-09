@extends('avenants.layout')
 
@section('content')


<div class="container " style="margin-left: 80%;" > 
            <a class="btn btn-primary" href="{{ route('avenants.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 

<div class="col  justify-content-center">    

<div class="blog-header py-1">
				<h3>Résultat de la recherche </h3>
</div>
		<div>
			<table class="table table-striped table-bordered text-center">
            <thead>
					<tr class="bg-primary text-white">
						<th >Code d'avenant</th>
						<th >Date d'avenant</th>
                        <th >Type d'avenant</th>
						<th >Action</th>
					</tr>
				</thead>
				<tbody>
                @foreach ($avenants as $avenant)
            <tr>
            <td>{{ $avenant->code_avenant }}</td>
            <td>{{ $avenant->date_avenant }}</td>
            <td>{{ $avenant->type_avenant }}</td>
            <td>
            <a class="btn btn-info" href="{{ route('avenants.show',$avenant->id) }}" style="margin-left: 15px;"><i class="fa fa-fw fa-eye"></i>Consulter</a>

            </td>
        </tr>
        @endforeach
				</tbody>
			</table>
		</div> <!--/.col-sm-12-->
</div>
      
@endsection