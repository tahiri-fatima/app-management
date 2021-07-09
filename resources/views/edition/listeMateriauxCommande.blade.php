@extends('layouts.app')
 
@section('content')


<div class="container " style="margin-left: 50%; margin-top: 50px;">
       <form type="get" action="{{ route('commandeMateriaus.search') }}" >
           <div class="form-group " style="display: flex; ">
                <div class="searchbar">
                    <input class="search_input" type="text" name="code_commande" placeholder="Chercher avec le code de commande ">
                    <button class="btn search_icon" type="submit" value="search" style="border: none; background-color: #77d5fb;" ><i class="fas fa-search"></i> </button>
                </div>
                <div style="margin-left: 15px ;" >
                    <a class="btn btn-primary " href="home" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
                </div>
           </div>
        </form>   
</div>

<div class="form-material" style="margin-top: 20px;margin-bottom: 20px;margin-left: 50px;">
		


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
        <h5 class="m-b-20" >Sélectionner une commande pour afficher ses matériaux</h5>

        <div class="row " style="margin-left: 15px;" >
            <div class="col-6">
                <div class="form-group form-primary form-static-label">
                    <select class="form-control" id="commandes" type="dropdown-toggle" class="form-control" name="commandes" onchange="top.location.href = this.options[this.selectedIndex].value" >
                        <option value="choisir" selected disabled>Choisir Commande</option>
                        @foreach($commandes as $commande)
                            <option class="commandes" value="{{  route('commandes.getMateriaux',$commande->id) }}">{{$commande->code_commande}}</option>
                        @endforeach
                    </select>
                </div>                
                <span class="form-bar"></span>
                     
            </div>
        </div>


</div>
	

    
      
@endsection