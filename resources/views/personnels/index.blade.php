@extends('personnels.layout')
 
@section('content')
<div class="col d-flex justify-content-center " > 
<div class="container" >
		<div class="card">
			<div class="card-body">
				
				<div >
					<h5 class="card-title"><i class="fa fa-fw fa-search"></i> Chercher Personnel</h5>

                        <form class="form-material" type="get" action="{{ route('personnels.search') }}" >
                                <div class="row " >
                                    <div class="col " >
                                        <div class="form-group"  >
                                            <input class="form-control mr-ms-2" name="code_personne"  type="search" placeholder="Code du personnel" >
                                        </div>
                                </div>
                                <div class="col " >
                                        <div class="form-group"  >
                                            <input class="form-control mr-ms-2" name="nom_personne"  type="search" placeholder="Nom du personnel" >
                                        </div>
                                </div>
                                <div class="col " >
                                        <div class="form-group"  >
                                            <input class="form-control mr-ms-2" name="prenom_personne"  type="search" placeholder="Prénom du personnel" >
                                        </div>
                                </div>
                                        <div class="form-group "  >
                                            <button class="btn btn-primary" type="submit" value="search" style="margin-right: 15px;" ><i class="fa fa-fw fa-search"></i> Chercher</button>
                                            <button type="reset" class="btn btn-info" > <i class="fa fa-fw fa-sync"></i> Réinitialiser</button>
                                        </div>
                                    
                                </div>
                        </form>
                </div>
            </div>
        </div>
       </div>
</div>
       <div class="form-material">
		<div class="container" style="margin-top: 20px;margin-bottom: 20px;">
			
        <div style="margin-left: 50%;"> 
            <a class="btn btn-primary text-right" href="{{ route('personnels.create') }}"><i class="fa fa-fw fa-plus-circle"></i> Ajouter nouveau personnel</a> 
            <a class="btn btn-primary text-right" href="home" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
        </div> 

		</div> <!--/.container-->

        <div class="col d-flex justify-content-center " > 
            @if ($message = Session::get('success'))
            <div class="alert alert-success message">
                <p>{{ $message }}</p>
            </div>
            @endif

            @if ($message = Session::get('warning'))
            <div class="alert alert-info message">
                <p>{{ $message }}</p>
            </div>
            @endif

            @if ($message = Session::get('error'))
            <div class="alert alert-danger message">
                <p>{{ $message }}</p>
            </div>
            @endif
        </div>

        <h5 style="margin-left: 30px; margin-bottom: 15px;" >Gestion des personnels</h5>   

        <div class="row " style="margin-left: 30px;" >
            <div class="col-6">
                <div class="form-group form-primary form-static-label">
                    <select class="form-control" id="personnels" type="dropdown-toggle" class="form-control" name="personnels" onchange="top.location.href = this.options[this.selectedIndex].value" >
                        <option value="choisir" selected disabled>Choisir personnel</option>
                        @foreach($personnels as $personnel)
                            <option class="personnels" value="{{  route('personnels.show',$personnel->id) }}">{{$personnel->code_personne}}</option>
                        @endforeach
                    </select>
                </div>                
                <span class="form-bar"></span>
                     
            </div>
        </div>


</div>
	

      
@endsection