@extends('layouts.app')
 
@section('content')

<div class="container " style="margin-left: 200px;">  

			<div class="card-body">
                <div>
					<h5 class="card-title"><i class="fa fa-fw fa-search"></i> Chercher fournisseur</h5>

                        <form class="form-material" type="get" action="{{ route('fournisseurs.search') }}" >
                        <div class="row d-flex justify-content-around">
                                <div class="col-4">
                                <div class="form-group" style="margin-right: 15px;" >
                                    <input class="form-control mr-ms-2" name="code_fournisseur"  type="search" placeholder="Code du fournisser" >
                                </div>
                                </div>
                                <div class="col-4">
                                <div class="form-group" style="margin-right: 15px;" >
                                    <input class="form-control mr-ms-2" name="intitule_fournisseur"  type="search" placeholder="Intitulé du fournisser" >
                                </div>
                                </div>
                                <div class="row pull-right" style="margin-right: 15px;">
                                <div class="form-group "  >
                                    <button class="btn btn-primary" type="submit" value="search" style="margin-right: 15px;" ><i class="fa fa-fw fa-search"></i> Chercher</button>
                                    <button type="reset" class="btn btn-info" > <i class="fa fa-fw fa-sync"></i> Réinitialiser</button>
                                </div>
                                </div>
                        </div>
                        </form>
                </div>
            </div>
        </div>
</div>


<div class="form-material" style="margin-top: 20px;margin-bottom: 20px">
		<div class="" style="margin-bottom: 20px;">
			
        <div class="text-right" style="margin-right:100px"> 
            <a class="btn btn-primary " href="home" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
        </div> 

		</div> <!--/.container-->


        <div class="col d-flex justify-content-center ">
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
        </div>

        <div class="col  justify-content-center ">
        <h5 class="m-b-20 m-l-50" >Sélectionner un fournisseur pour afficher ses commandes</h5>

        <div class="row " style="margin-left: 50px;" >
            <div class="col-6">
                <div class="form-group form-primary form-static-label">
                    <select class="form-control" id="fournisseurs" type="dropdown-toggle" class="form-control" name="fournisseurs" onchange="top.location.href = this.options[this.selectedIndex].value" >
                        <option value="choisir" selected disabled>Choisir fournisseur</option>
                        @foreach($fournisseurs as $fournisseur)
                            <option class="fournisseurs" value="{{  route('fournisseurs.getCommandes',$fournisseur->id) }}">{{$fournisseur->intitule_fournisseur}}</option>
                        @endforeach
                    </select>
                </div>                
                <span class="form-bar"></span>
                     
            </div>
        </div>


</div>
	

      
@endsection