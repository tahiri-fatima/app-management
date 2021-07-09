@extends('acomptes.layout')
 
@section('content')

<div class="container " style="margin-left:80%" > 
            <a class="btn btn-primary" href="{{ route('acomptes.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 
	
<div class="col  justify-content-center"> 
<div class="blog-header py-1">
				<h3>Résultat de la recherche </h3>
</div>
		<div>
     
			<table class="table table-striped table-bordered text-center">
            <thead>
					<tr class="bg-primary text-white">
						<th >Code d'acompte</th>
						<th >Date d'acompte</th>
                        <th >Montant d'acompte</th>
						<th >Action d'acompte</th>
					</tr>
				</thead>
				<tbody>
                @foreach ($acomptes as $acompte)
            <tr>
            <td>{{ $acompte->code_acompte }}</td>
            <td>{{ $acompte->date_acompte }}</td>
            <td>{{ $acompte->montant_acompte }}</td>
            <td>
            <a class="btn btn-info" href="{{ route('acomptes.show',$acompte->id) }}" style="margin-left: 15px;"><i class="fa fa-fw fa-eye"></i>Consulter</a>

            </td>
        </tr>
        @endforeach
				</tbody>
			</table>
		</div> <!--/.col-sm-12-->
		

</div>





      
@endsection