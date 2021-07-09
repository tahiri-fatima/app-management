@extends('factures.layout')
 
@section('content')
  
<div class="container " style="margin-left: 70%;"  > 
            <a class="btn btn-primary" href="{{ route('factures.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 
	
<div class="col  justify-content-center">    

<div class="blog-header py-1">
				<h3>Résultat de la recherche </h3>
</div>
		<div>
     
			<table class="table table-striped table-bordered text-center">
            <thead>
					<tr class="bg-primary text-white">
                    <th >Code de la facture</th>
						<th >Date de la facture</th>
                        <th >Montant de la facture</th>
						<th >Action</th>
					</tr>
				</thead>
				<tbody>
                @foreach ($factures as $facture)
            <tr>
            <td>{{ $facture->code_facture }}</td>
            <td>{{ $facture->date_facture }}</td>
            <td>{{ $facture->montant_facture }}</td>
            <td>
                    <a class="btn btn-info" href="{{ route('factures.show',$facture->id) }}" style="margin-left: 15px;"><i class="fa fa-fw fa-eye"></i>Consulter</a>
            </td>
        </tr>
        @endforeach
				</tbody>
			</table>
		</div> <!--/.col-sm-12-->
		
</div>
   





      
@endsection