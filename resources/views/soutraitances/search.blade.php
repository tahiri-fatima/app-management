@extends('soutraitances.layout')
 
@section('content')


<!-- Alert si le code est dupliqué !-->
@if(!empty(Session::get('error_code')) && Session::get('error_code') == 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> N'éxiste aucun soutraitance avec les informations de la recherche !<br><br>
        </div>
@endif

<div class="container" style="margin-left: 70%;" > 
            <a class="btn btn-primary" href="{{ route('soutraitances.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 
	
<div class="col  justify-content-center">    

<div class="blog-header py-1">
				<h3>Résultat de la recherche </h3>
</div>
		<div>
     
			<table class="table table-striped table-bordered text-center">
            <thead>
					<tr class="bg-primary text-white">
						<th >Code de sous traitance</th>
						<th >Intitulé de sous traitance</th>
						<th >Action</th>
					</tr>
				</thead>
				<tbody>
                @foreach ($soutraitances as $soutraitance)
            <tr>
            <td>{{ $soutraitance->code_soutraitance }}</td>
            <td>{{ $soutraitance->intitule_soutraitance }}</td>
            <td>  
                 <a class="btn btn-info" href="{{ route('soutraitances.show',$soutraitance->id) }}" style="margin-left: 15px;"><i class="fa fa-fw fa-eye"></i>Consulter</a>

            </td>
        </tr>
        @endforeach
				</tbody>
			</table>
		</div> <!--/.col-sm-12-->
</div>


      
@endsection