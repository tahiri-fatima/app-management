@extends('materiels.layout')
 
@section('content')

   

<div class="container " style="margin-left: 70%;" > 
            <a class="btn btn-primary" href="{{ route('materiels.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 

<div class="col  justify-content-center">    

	
<div class="blog-header py-1">
				<h3>Résultat de la recherche </h3>
</div>
		<div>
     
			<table class="table table-striped table-bordered text-center">
				<thead>
					<tr class="bg-primary text-white">
						<th >Code du matériel</th>
						<th >Intitule du matériel</th>
						<th >Action</th>
					</tr>
				</thead>
				<tbody>
                @foreach ($materiels as $materiel)
            <tr>
            <td>{{ $materiel->code_materiel}}</td>
            <td>{{ $materiel->intitule_materiel }}</td>
            <td>
               <a class="btn btn-info" href="{{ route('materiels.show',$materiel->id) }}" style="margin-left: 15px;"><i class="fa fa-fw fa-eye"></i>Consulter</a>
            </td>
        </tr>
        @endforeach
				</tbody>
			</table>
		</div> <!--/.col-sm-12-->
		

</div>





      
@endsection