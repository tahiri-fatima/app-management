@extends('layouts.app')
 
@section('content')

<div class="container" style="margin: 30px 50px 30px 180px ">
		
			<div class="card-body">
					<h5 class="card-title"><i class="fa fa-fw fa-search"></i> Chercher chantier</h5>

                    <form class="form-material" type="get" action="{{ route('chantiers.search') }}" >
                        <div class="row justify-content-around">
                                <div class="col-4">
                                <div class="form-group" style="margin-right: 15px;" >
                                    <input class="form-control mr-ms-2" name="codechantier"  type="search" placeholder="Code du chantier" >
                                </div>
                                </div>
                                <div class="col-4">
                                <div class="form-group" style="margin-right: 15px;" >
                                    <input class="form-control mr-ms-2" name="intitulechantier"  type="search" placeholder="Intitulé du chantier" >
                                </div>
                                </div>
                                <div class="row pull-right" style="margin-right: 15px;">
                                <div class="form-group " >
                                    <button class="btn btn-primary" type="submit" value="search" style="margin-right: 15px;" ><i class="fa fa-fw fa-search"></i> Chercher</button>
                                    <button type="reset" class="btn btn-info" > <i class="fa fa-fw fa-sync"></i> Réinitialiser</button>
                                </div>
                                </div>
                        </form>
           
        </div>
</div>


<div class="form-material" style="margin-top: 20px;margin-bottom: 20px">
		<div class="" style="margin-bottom: 20px;">
			
        <div class="text-right"> 
            <a class="btn btn-primary " href="home" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
        </div> 

		</div> <!--/.container-->


        <div class="col  justify-content-center ">
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
        <h5 class="m-b-20" >Sélectionner un chantier pour afficher ses commandes</h5>
        <div class="row " style="margin-left: 10px;" >
            <div class="col-6">
                <div class="form-group form-primary form-static-label">
                    <select class="form-control" id="chantiers" type="dropdown-toggle" class="form-control" name="chantiers" onchange="top.location.href = this.options[this.selectedIndex].value" >
                        <option value="" selected disabled>Choisir chantier</option>
                        @foreach($chantiers as $chantier)
                            <option class="chantiers" value="{{  route('commandes.listeCommandes',$chantier->id) }}">{{$chantier->intitule_chantier}}</option>
                        @endforeach
                    </select>
                </div>                
                <span class="form-bar"></span>
                     
            </div>
        </div>


</div>
	

      
@endsection