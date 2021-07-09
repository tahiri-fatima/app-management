@extends('commandeMateriaus.layout')
 
@section('content')

  
<div class="container text-right" > 
            <a class="btn btn-primary" href="{{ route('commandeMateriaus.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
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
						<th >Code de la commande</th>
						<th >Code du Matériau</th>
                        
						<th >Action</th>
					</tr>
				</thead>
				<tbody>
                    @if($commandeMateriaus != null)
                @foreach ($commandeMateriaus as $commandeMateriau)
            <tr>
            <td>{{ $commandeMateriau->commande()->code_commande }}</td>
            <td>{{ $commandeMateriau->materiau()->code_materiau }}</td>
            
            <td>
                  <a class="btn btn-info" href="{{ route('commandeMateriaus.showMateriaux',$commandeMateriau->commande()->id) }}" style="margin-left: 15px;"><i class="fa fa-fw fa-eye"></i> Consulter</a>
    
                  
                            </td>
                        </tr>
                @endforeach
            @endif
				</tbody>
			</table>
		</div> <!--/.col-sm-12-->
		

</div>





      
@endsection