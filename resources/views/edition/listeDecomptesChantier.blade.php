@extends('layouts.app')
 
@section('content')

<div class="container " style="margin-left: 50%; margin-top: 20px;">
       <form type="get" action="" >
           <div class="form-group " style="display: flex;">
                <div class="searchbar">
                    <input class="search_input" type="text" name="codechantier" placeholder="Chercher avec le code de chantier ">
                    <button class="btn search_icon" type="submit" value="search" style="border: none; background-color: #77d5fb;" ><i class="fas fa-search"></i> </button>
                </div>
                <div style="margin-left: 15px ;" >
                    <a class="btn btn-primary " href="home" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
                </div>
           </div>
        </form>   
</div>



       
<div class="form-material" style="margin-top: 20px;margin-bottom: 20px;margin-left: 50px;">
   

        <h6  >Sélectionner un chantier pour afficher les décomptes </h6>

        <div class="col  justify-content-center message">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif

        @if ($message = Session::get('warning'))
        <div class="alert alert-info">
            <p>{{ $message }}</p>
        </div>
        @endif
        </div>
        <div class="col  justify-content-center ">
        <div class="row " style="margin-left: 15px;" >
            <div class="col-6">
                <div class="form-group form-primary form-static-label">
                    <select class="form-control" id="chantiers" type="dropdown-toggle" class="form-control" name="chantiers" onchange="top.location.href = this.options[this.selectedIndex].value" >
                        <option value="choisir" selected disabled>Choisir chantier</option>
                        @foreach($chantiers as $chantier)
                            <option class="chantiers" value="{{ route('chantiers.getDecomptes',$chantier->id) }}">{{$chantier->intitule_chantier}}</option>
                        @endforeach
                    </select>
                </div>                
                <span class="form-bar"></span>
                     
            </div>
        </div>


</div>
	

@endsection