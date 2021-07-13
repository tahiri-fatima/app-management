@extends('materiels.layout')
 
@section('content')

<div class="col d-flex justify-content-center">

<div class="container" >
		<div class="card">
			<div class="card-body">
				
				<div >
					<h5 class="card-title" > Gestion des matériels</h5>

                        <form class="form-material" type="get" action="{{ route('materiels.gestionForm') }}" style="margin-top: 25px;" >
                            <div class="row justify-content-around">
                                <div class="col" >
                                    <div class="form-group" >
                                    <button class="btn btn-primary"  type="submit" value="Ajouter" name="ajouter"  ><i class="fa fa-fw fa-plus-circle"></i> Ajouter nouveau matériel</button>
                                    </div>
                                </div>
                                <div class="col">
                                        <div class="form-group " >
                                            <button class="btn btn-primary" type="submit" value="Modifier" name="modifier" > Modifier/Supprimer</button>
                                        </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                    <a class="btn btn-primary text-right" href="home" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
       </div>
</div>
  

	


@endsection