@extends('acomptes.layout')
  
@section('content')
<div class="col d-flex justify-content-center" > 
<div class="container" >
		<div class="card">
			<div class="card-body">
				
				<div >
					<h5 class="card-title"><i class="fa fa-fw fa-search"></i> Chercher Acompte</h5>

                    <form class="form-material" type="get" action="{{ route('acomptes.search') }}" >
                                <div class="row" >
                                    <div class="col-6">
                                        <div class="form-group" style="margin-right: 15px;" >
                                        <input class="form-control" name="codeacompte"  type="search" placeholder="Code d'acompte" >
                                        </div>
                                    </div>
                                    <div class="col-6">
                                            <div class="form-group pull-right" style="margin-right: 15px;" >
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
			
        <div style="margin-left:50%"> 
            <a class="btn btn-primary " href="{{ route('acomptes.create') }}"><i class="fa fa-fw fa-plus-circle"></i> Ajouter nouveau acompte</a> 
            <a class="btn btn-primary " href="home" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
        </div> 

		</div> <!--/.container-->


        <div class="col d-flex justify-content-center " > 
            @if ($message = Session::get('success'))
            <div class="alert alert-success message">
                <p>{{ $message }}</p>
            </div>
            @endif
            
            @if ($message = Session::get('error'))
            <div class="alert alert-danger message">
                <p>{{ $message }}</p>
            </div>
            @endif

            @if ($message = Session::get('warning'))
            <div class="alert alert-info message">
                <p>{{ $message }}</p>
            </div>
            @endif
        </div>
        
        <h5 style="margin-left: 30px; margin-bottom: 15px;" >Gestion des acomptes</h5>

        <div class="row " style="margin-left: 30px;" >
            <div class="col-6">
                <div class="form-group form-primary form-static-label">
                    <select class="form-control" id="acomptes" type="dropdown-toggle" class="form-control" name="acomptes" onchange="top.location.href = this.options[this.selectedIndex].value" >
                        <option value="choisir" selected disabled>Choisir Acompte</option>
                        @foreach($acomptes as $acompte)
                            <option class="acomptes" value="{{  route('acomptes.show',$acompte->id) }}">{{$acompte->code_acompte}}</option>
                        @endforeach
                    </select>
                </div>                
                <span class="form-bar"></span>
                     
            </div>
        </div>


</div>
	

      
@endsection