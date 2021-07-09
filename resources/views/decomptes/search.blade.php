@extends('decomptes.layout')
 
@section('content')


  
<div class="container" style="margin-left: 70%;" > 
            <a class="btn btn-primary" href="{{ route('decomptes.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 

<div class="col  justify-content-center">    

<div class="blog-header py-1">
				<h3>Résultat de la recherche </h3>
</div>
		<div>
     
			<table class="table table-striped table-bordered text-center">
            <thead>
					<tr class="bg-primary text-white">
					    <th >Numéro du décompte</th>
						<th >Date du décompte</th>
                        <th >Montant du décompte</th>
						<th >Action</th>
					</tr>
				</thead>
				<tbody>
                @foreach ($decomptes as $decompte)
            <tr>
            <td>{{ $decompte->num_decompte }}</td>
            <td>{{ $decompte->date_decompte }}</td>
            <td>{{ $decompte->montant_decompte }}</td>
            <td>
               <a class="btn btn-info" href="{{ route('decomptes.show',$decompte->id) }}" style="margin-left: 15px;"><i class="fa fa-fw fa-eye"></i>Consulter</a>
    
                   
            </td>
        </tr>
        @endforeach
				</tbody>
			</table>
		</div> <!--/.col-sm-12-->
		
</div>
   





      
@endsection