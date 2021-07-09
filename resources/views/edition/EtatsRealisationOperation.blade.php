@extends('layouts.app')
 
@section('content')

       <div class="container " style="margin-left: 50%; margin-top: 50px;">
       <form type="get" action="{{ route('operations.searchOperationEtat') }}" >
           <div class="form-group " style="display: flex;">
                <div class="searchbar">
                    <input class="search_input" type="text" name="codeoperation" placeholder="Chercher avec le code d'opération ">
                    <button class="btn search_icon" type="submit" value="search" style="border: none; background-color: #77d5fb;" ><i class="fas fa-search"></i> </button>
                </div>
                <div style="margin-left: 15px ;" >
                    <a class="btn btn-primary " href="{{route('home')}}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
                </div>
           </div>
        </form>   
</div>

       
<div style="margin-top: 20px;margin-bottom: 20px;margin-left: 50px;">
	

       

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
        <form class="form-material" type="get" action="{{ route('operations.getEtatsRealisation') }}" >
    
       
        <div class="row justify-content-around" style="margin-bottom: 20px; margin-left: 150px; margin-right: 150px;  ">
                <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                    <label class="pivot-label "style="font-weight:bold; font-size: 20px; font-family:serif" >Chantier  </label>
                        <div class="select">
                            <select class="form-control" id="chantier" name="chantier_id" >
                            <option value="">Choisir chantier</option>
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
                    <label class="pivot-label "style="font-weight:bold; font-size: 20px; font-family:serif" >Opération  </label>
                        <div class="select">
                            <select class="form-control" id="mySelect" name="operation_id" >
                            
                            </select>
                        </div>                
                        <span class="form-bar"></span>   
                    </div>
                </div>
     

              
            </div>

            <div class=" text-right" style="margin-top: 10px; margin-right: 160px;">
                <button type="submit" value="search" class="btn btn-primary" > Valider</button>
                <button type="reset" class="btn btn-info" style="margin-left: 10px;"> Annuler</button>
        </div>
        </form>

            
<script>
    $('#chantier').on('change', e => {
        //console.log($('#chantier').val());
        var id = $('#chantier').val();
        $('#mySelect').empty();
        $.ajax({
            url: "/getOperationsExecute/"+id,
            data:{id:this.value},
            success: data => {
                data.operations.forEach(operation =>
               // console.log(operation),
              
                    $('#mySelect').append(`<option value="${operation.id}">${operation.designation_operation}</option>`)
              

                )
            }
        })
    })
</script>

@endsection