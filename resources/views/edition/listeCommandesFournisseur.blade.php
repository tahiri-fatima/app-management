@extends('layouts.app')
 
@section('content')



<div class="container form-material" style="margin-top: 30px;margin-bottom: 20px">
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