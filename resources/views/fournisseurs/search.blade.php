@extends('fournisseurs.layout')
 
@section('content')

  
<div class="container" style="margin-left:70%" > 
            <a class="btn btn-primary" href="{{ route('fournisseurs.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 


<!-- Alert si le code est dupliqué !-->
@if(!empty(Session::get('error_code')) && Session::get('error_code') == 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> N'éxiste aucun fournisseur avec les informations de la recherche !<br><br>
        </div>
@endif

<div class="col  justify-content-center">    

	
<div class="blog-header py-1">
				<h3>Résultat de la recherche </h3>
</div>
		<div>
     
			<table class="table table-striped table-bordered text-center">
				<thead>
                <tr class="bg-primary text-white">
						<th >Code du fournisser</th>
						<th >Intitulé du fournisser</th>
						<th >Action</th>
					</tr>
				</thead>
				<tbody>
                @foreach ($fournisseurs as $fournisseur)
            <tr>
            <td>{{ $fournisseur->code_fournisseur }}</td>
            <td>{{ $fournisseur->intitule_fournisseur }}</td>
            <td>
                    <a class="btn btn-info" href="{{ route('fournisseurs.show',$fournisseur->id) }}" style="margin-left: 15px;"><i class="fa fa-fw fa-eye"></i>Consulter</a>
            </td>
        </tr>
        @endforeach
				</tbody>
			</table>
		</div> <!--/.col-sm-12-->
		

</div>
      
@endsection