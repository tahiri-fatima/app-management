@extends('layouts.app')
 
@section('content')

<div class="text-right" style=" margin-right: 30px; margin-top: 50px;"> 
            <a class="btn btn-primary text-right" href="home" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
        </div> 

<div class="container form-material" >
		


        <div class="col d-flex justify-content-center message">
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
        <h5 class=" row m-b-25 m-l-10" >Sélectionner un chantier et/ou une catégorie des frais pour afficher ses frais</h5>

        <form class="form-material" type="post" action="{{ route('chantiers.getFrais') }}" >
        @csrf
        <div class="row d-flex justify-content-center" style="margin-left: 15px;" >
            <div class="col-6">
                <div class="form-group form-primary form-static-label">
                    <div class="select">
                        <select class="form-control" name="chantier_id" type="search">
                        <option value="choisir" selected disabled>Selectionner Chantier</option>
                            @foreach($chantiers as $chantier)
                                <option value="{{ $chantier->id }}">{{ $chantier->intitule_chantier }}</option>
                            @endforeach
                        </select>
                    </div>                
                    <span class="form-bar"></span> 
                </div>
            </div>
            <div class="col-6">
                <div class="form-group form-primary form-static-label">
                    <div class="select">
                        <select class="form-control" name="nature_frais_id" type="search">
                        <option value="choisir" selected disabled>Selectionner Nature de frais</option>
                            @foreach($natureFrais as $natureFrai)
                                <option value="{{ $natureFrai->id }}">{{ $natureFrai->nature_frais }}</option>
                            @endforeach
                        </select>
                    </div>                
                    <span class="form-bar"></span> 
                </div>
            </div>
        </div>

        <div class=" text-right" style="margin-top: 10px;">
                <button type="submit" class="btn btn-primary" value="search"> Valider</button>
                <button type="reset" class="btn btn-info" style="margin-left: 10px;"> Annuler</button>
        </div>
        </form>

</div>
@endsection