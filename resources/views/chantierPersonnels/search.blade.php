@extends('chantierPersonnels.layout')
 
@section('content')

  
<div class="container text-right" > 
            <a class="btn btn-primary" href="{{ route('chantierPersonnels.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 

<div class="col  justify-content-center">  
<div>
@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif  
</div>

<div class="blog-header py-1">
				<h3>Résultat de la recherche </h3>
</div>
		<div>
     
			<table class="table table-striped table-bordered text-center">
                 <thead>
					
			<table class="table table-striped table-bordered text-center">
            
				<thead>
					<tr class="bg-primary text-white">
                    <th >Code du chantier</th>
						<th >Code du personnel</th>
						<th >Action</th>
					</tr>
				</thead>
				<tbody>
                @if ($chantierPersonnels != null)
                    @foreach ($chantierPersonnels as $chantierPersonnel)
                        <tr>
                            <td>{{ $chantierPersonnel->chantier()->code_chantier }}</td>
                            <td>{{ $chantierPersonnel->personnel()->code_personne }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('chantierPersonnels.showPersonnels',$chantierPersonnel->chantier()->id) }}" style="margin-left: 15px;"><i class="fa fa-fw fa-eye"></i> Consulter</a>

                            </td>
                        </tr>
                @endforeach
            @endif
				</tbody>
			</table>
		</div> <!--/.col-sm-12-->
		

</div>





      
@endsection