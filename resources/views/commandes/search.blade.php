@extends('commandes.layout')
 
@section('content')




  
<div class="container text-right" > 
            <a class="btn btn-primary" href="{{ route('commandes.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 

<div class="col  justify-content-center">   
	
<!-- Alert si le code est dupliqué !-->
@if(!empty(Session::get('error_code')) && Session::get('error_code') == 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> N'éxiste aucune commande avec les informations de la recherche !<br><br>
        </div>
@endif

<div class="blog-header py-1">
				<h3>Résultat de la recherche </h3>
</div>
		<div>
     
			<table class="table table-striped table-bordered text-center">
				<thead>
					<tr class="bg-primary text-white">
						<th >Code de la commande</th>
						<th >Date de la commande</th>
						<th >Action</th>
					</tr>
				</thead>
				<tbody>
                @foreach ($commandes as $commande)
            <tr>
            <td>{{ $commande->code_commande }}</td>
            <td>{{ $commande->date_commande }}</td>
            <td>
                <a class="btn btn-info" href="{{ route('commandes.show',$commande->id) }}" style="margin-left: 15px;"><i class="fa fa-fw fa-eye"></i>Consulter</a>
             
            </td>
        </tr>
        @endforeach
				</tbody>
			</table>
		</div> <!--/.col-sm-12-->
		

</div>
      
@endsection