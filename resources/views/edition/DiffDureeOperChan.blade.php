@extends('layouts.app')
 
@section('content')

<div class="container " style="margin-left: 50%; margin-top: 50px;">
       
                <div  style="margin-right: 15px ;margin-left: 50% ;" >
                    <a class="btn btn-primary " href="home" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
                </div>
              
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
        <h5 class="m-b-20 m-l-30"  >Sélectionner un chantier </h5>

        <div class="row " style="margin-left: 30px;" >
            <div class="col-6">
                <div class="form-group form-primary form-static-label">
                    <select class="form-control" id="chantiers" type="dropdown-toggle" class="form-control" name="chantiers" onchange="top.location.href = this.options[this.selectedIndex].value" >
                        <option value="choisir" selected disabled>Choisir chantier</option>
                        @foreach($chantiers as $chantier)
                            <option class="chantiers" value="{{ route('chantierOperations.DiffEstimeReel',$chantier->id) }}">{{$chantier->intitule_chantier}}</option>
                        @endforeach
                    </select>
                </div>                
                <span class="form-bar"></span>
                     
            </div>
        </div>


</div>
	

@endsection