@extends('chantierOperations.layout')
 
@section('content')

  
<div class="container text-right" > 
            <a class="btn btn-primary" href="{{ route('chantierOperations.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
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
               
                        <th >Code d'opération</th>
                        <th >Désignation d'opération</th>
                        <th >Action</th>
					</tr>
				</thead>
				<tbody>
                @if ($chantierOperations != null)
                @foreach ($chantierOperations as $chantierOperation)
            <tr>
            <td>{{ $chantierOperation->code_operation }}</td>
            <td>{{ $chantierOperation->designation_operation }}</td>
              
                <td>
                    <a class="btn btn-info" href="{{ route('chantierOperations.showOperations',$chantier->id) }}" ><i class="fa fa-fw fa-eye"></i> Consulter</a>

                            </td>
                        </tr>
                @endforeach
            @endif
				</tbody>
			</table>
		</div> <!--/.col-sm-12-->
		

</div>





      
@endsection