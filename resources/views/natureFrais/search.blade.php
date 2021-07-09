@extends('natureFrais.layout')
 
@section('content')




<div class="container " style="margin-left: 70%;" > 
            <a class="btn btn-primary" href="{{ route('natureFrais.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 


<div class="col  justify-content-center">    

<div class="blog-header py-1">
				<h3>Résultat de la recherche </h3>
</div>
		<div>
     
			<table class="table table-striped table-bordered text-center">
            <thead>
					<tr class="bg-primary text-white">
                    <th >Code nature du frais</th>
						<th >Nature du frais</th>
                        
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
                @foreach ($natureFrais as $natureFrai)
            <tr>
            <td>{{ $natureFrai->code_nature_frais }}</td>
            <td>{{ $natureFrai->nature_frais }}</td>
            
            <td>
                    <a class="btn btn-info" href="{{ route('natureFrais.show',$natureFrai->id) }}" style="margin-left: 15px;"><i class="fa fa-fw fa-eye"></i>Consulter</a>
            </td>
        </tr>
        @endforeach
				</tbody>
			</table>
		</div> <!--/.col-sm-12-->
		

</div>
      
@endsection