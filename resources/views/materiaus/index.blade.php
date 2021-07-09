@extends('materiaus.layout')
 
@section('content')
<div class="col d-flex justify-content-center " > 
<div class="container" >
		<div class="card">
			<div class="card-body">
				<div >
					<h5 class="card-title"><i class="fa fa-fw fa-search"></i> Chercher matériau</h5>

                        <form class="form-material" type="get" action="{{ route('materiaus.search') }}" >
                        <div class="row justify-content-around">
                                <div class="col-4">
                                <div class="form-group" style="margin-right: 15px;" >
                                    <input class="form-control mr-ms-2" name="code_materiau"  type="search" placeholder="Code matériel" >
                                </div>
                                </div>
                                <div class="col-4">
                                <div class="form-group" style="margin-right: 15px;" >
                                    <input class="form-control mr-ms-2" name="intitule_materiau"  type="search" placeholder="Intitulé matériel" >
                                </div>
                                </div>
                                <div class="row pull-right" style="margin-right: 15px;">
                                <div class="form-group "  >
                                    <button class="btn btn-primary" type="submit" value="search" style="margin-right: 15px;" ><i class="fa fa-fw fa-search"></i> Chercher</button>
                                    <button type="reset" class="btn btn-info" > <i class="fa fa-fw fa-sync"></i> Réinitialiser</button>
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
            <a class="btn btn-primary text-right" href="{{ route('materiaus.create') }}"><i class="fa fa-fw fa-plus-circle"></i> Ajouter nouveau matériau</a> 
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

        <h5 style="margin-left: 30px; margin-bottom: 15px;" >Gestion des materiaux</h5>        

        <div class="row " style="margin-left: 30px;" >
            <div class="col-6">
                <div class="form-group form-primary form-static-label">
                    <select class="form-control" id="materiaus" type="dropdown-toggle" class="form-control" name="materiaus" onchange="top.location.href = this.options[this.selectedIndex].value" >
                        <option value="choisir" selected disabled>Choisir Matériau</option>
                        @foreach($materiaus as $materiau)
                            <option class="materiaus" value="{{  route('materiaus.show',$materiau->id) }}">{{$materiau->intitule_materiau}}</option>
                        @endforeach
                    </select>
                </div>                
                <span class="form-bar"></span>
                     
            </div>
        </div>


	

      
@endsection