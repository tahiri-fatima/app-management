@extends('commandeMateriaus.layout')
 
@section('content')
<div class="col d-flex justify-content-center">

<div class="container" >
		<div class="card">
			<div class="card-body">
				
				<div >
					<h5 class="card-title"><i class="fa fa-fw fa-search"></i> Chercher commande-mtériau</h5>

                        <form class="form-material" type="get" action="{{ route('commandeMateriaus.searchMateriauxByCommande') }}" >
                            <div class="row justify-content-around">
                                <div class="col-6">
                                    <div class="form-group">
                                        <input class="form-control mr-ms-2" name="code_commande"  type="search" placeholder="Code de la commande " >
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row pull-right" style="margin-right: 20px;">
                                        <div class="form-group " >
                                            <button class="btn btn-primary" type="submit" value="search"  ><i class="fa fa-fw fa-search"></i> Chercher</button>
                                            <button type="reset" class="btn btn-info" > <i class="fa fa-fw fa-sync"></i> Réinitialiser</button>
                                        </div>
                                    </div>
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
			
        <div style="margin-left: 40%;"> 
        <a class="btn btn-primary text-right" href="{{ route('commandeMateriaus.create') }}"><i class="fa fa-fw fa-plus-circle"></i> Ajouter nouveau commande-matériau</a> 
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

        <h5 style="margin-left: 25px; margin-bottom: 15px;" >Gestion des matériaux des commandes</h5>

        <div class="col  justify-content-center">
    
        <div class="row " style="margin-left: 30px;" >
            <div class="col-6">
                <div class="form-group form-primary form-static-label">
                    <select class="form-control" id="commandes" type="dropdown-toggle" class="form-control" name="commandes" onchange="top.location.href = this.options[this.selectedIndex].value" >
                        <option value="choisir" selected disabled>Choisir Commande</option>
                        @foreach($commandes as $commande)
                        <option class="commandes" value="{{  route('commandeMateriaus.showMateriaux',$commande->id) }}">{{$commande->code_commande}}</option>
                        @endforeach
                    </select>
                </div>                
                <span class="form-bar"></span>
                     
            </div>
        </div>


</div>
      
@endsection