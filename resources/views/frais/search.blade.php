@extends('frais.layout')
 
@section('content')


<!-- Alert si le code est dupliqué !-->
@if(!empty(Session::get('error_code')) && Session::get('error_code') == 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> N'éxiste aucun frais avec les informations de la recherche !<br><br>
        </div>
@endif

<div class="container " style="margin-left:80%"  > 
            <a class="btn btn-primary" href="{{ route('frais.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 


<div class="col  justify-content-center">    

<div class="blog-header py-1">
				<h3>Résultat de la recherche </h3>
</div>
		<div>
     
			<table class="table table-striped table-bordered text-center">
            <thead>
					<tr class="bg-primary text-white">
                    <th >Code du frais</th>
                        <th >Date du frais</th>
						<th >Montant du frais</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
                @foreach ($frais as $frai)
            <tr>
            <td>{{ $frai->code_frais }}</td>
            <td>{{ $frai->date_frais }}</td>
            <td>{{ $frai->montant_frais }}</td>
            <td>
                    <a class="btn btn-info" href="{{ route('frais.show',$frai->id) }}" style="margin-left: 15px;"><i class="fa fa-fw fa-eye"></i>Consulter</a>
            </td>
        </tr>
        @endforeach
				</tbody>
			</table>
		</div> <!--/.col-sm-12-->
		

</div>
      
@endsection