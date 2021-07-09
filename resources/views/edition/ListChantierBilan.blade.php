@extends('layouts.app')
 
@section('content')


<div class="container  " style="margin-left: 190px;" >
		<div class="card">
			<div class="card-body">
				
				<div >
					<h5 class="card-title"><i class="fa fa-fw fa-search"></i> Chercher chantier</h5>

                        <form class="form-material" type="get" action="{{ route('chantiers.search') }}" >
                            <div class="row justify-content-around">
                                <div class="col-4">
                                    <div class="form-group">
                                        <input class="form-control mr-ms-2" name="codechantier"  type="search" placeholder="Code du chantier " >
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <input class="form-control mr-ms-2" name="intitulechantier"  type="search" placeholder="Intitulé du chantier " >
                                    </div>
                                </div>
                                <div class="row pull-right" style="margin-right: 15px;">
                                    <div class="form-group " >
                                        <button class="btn btn-primary" type="submit" value="search"  ><i class="fa fa-fw fa-search"></i> Chercher</button>
                                        <button type="reset" class="btn btn-info" > <i class="fa fa-fw fa-sync"></i> Réinitialiser</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
       </div>


       
<div class="form-material" style="margin-top: 20px;margin-bottom: 20px;margin-left: 50px;">
	


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