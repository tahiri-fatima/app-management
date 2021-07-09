@extends('chantiers.layout')
 
@section('content')

  
<div class="container " style="margin-left:80%"> 
            <a class="btn btn-primary" href="{{ route('chantiers.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 

<div class="col  justify-content-center">    

<div class="blog-header py-1">
				<h3>Résultat de la recherche </h3>
</div>
		<div>
     
			<table class="table table-striped table-bordered text-center">
                 <thead>
					<tr class="bg-primary text-white">
						<th >Code du chantier</th>
						<th >Intitulé du chantier</th>
						<th >Action</th>
					</tr>
				</thead>
				<tbody>
                @foreach ($chantiers as $chantier)
            <tr>
            <td>{{ $chantier->code_chantier }}</td>
            <td>{{ $chantier->intitule_chantier }}</td>
            <td>
                <a class="btn btn-info" href="{{ route('chantiers.show',$chantier->id) }}" style="margin-left: 15px;"><i class="fa fa-fw fa-eye"></i>Consulter</a>
    
            </td>
        </tr>
        @endforeach
				</tbody>
			</table>
		</div> <!--/.col-sm-12-->
		

</div>





      
@endsection