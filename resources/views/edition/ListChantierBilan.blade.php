@extends('layouts.app')
 
@section('content')



       
<div class="form-material" style="margin-top: 30px;margin-bottom: 20px;margin-left: 50px;">
	


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
        
        <form  class="form-material" action="{{ route('chantiers.getBilan') }}" method="get">
            
        <div  style="margin-left: 150px;" >
        <div class="row ">
        <h6  >Sélectionner un chantier  </h6>

        </div>

            <div class="col-6">
                <div class="form-group form-primary form-static-label">
                    <select class="form-control" id="chantiers" type="dropdown-toggle" name="chantier_id" >
                        <option value="" selected disabled>Choisir chantier</option>
                        @foreach($chantiers as $chantier)
                            <option class="chantiers" value="{{$chantier->id}}">{{$chantier->intitule_chantier}}</option>
                        @endforeach
                    </select>
                </div>                
                <span class="form-bar"></span>
                     
            </div>
        </div>

        <div class=" text-right" style="margin-top: 10px;margin-right: 150px;">
                <button  class="btn btn-primary" type="submit" name="tableau"  > Tableau</button>
                <button  class="btn btn-info" type="submit" style="margin-left: 10px;" name="graphes"> Graphes</button>
        </div>
</form>
        
      

</div>
	

@endsection