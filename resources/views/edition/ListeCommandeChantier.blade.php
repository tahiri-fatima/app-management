@extends('layouts.app')
 
@section('content')


<div class=" container form-material" style="margin-top: 20px;margin-bottom: 20px">
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