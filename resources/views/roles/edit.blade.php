@extends('roles.layout')


  
@section('content')

<div class="container " style="margin-left: 70%;" > 
            <a class="btn btn-primary" href="{{ route('roles.show', $role->id) }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
</div> 

<div class="col d-flex justify-content-center" > 


@if ($errors->any())
    <div class="alert alert-danger message">
        <strong>Whoops!</strong> Il y'a un problème avec les information que vous avez entrées.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Alert si le code est dupliqué !-->
    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
        <div class="alert alert-danger message">
         <p>   <strong>Whoops!</strong> Il y a dejà un rôle avec ce code.<br><br> </p>
            
        </div>
    @endif



</div>




<!-- start Formulaire -->

<div class="col d-flex justify-content-center" > 
    <div class="card" style="width:80%">  
        <div class="card-header">
            <h5><i class="fa fa-fw fa-plus-circle"></i>  Modifier le rôle {{ $role->name }}</h5>
        </div>
        <div class="card-block">
        <p style="font-weight:bold; margin-bottom : 30px;">Les champs avec <span class="text-danger">*</span> sont obligatoire.</p>

            
        <form class="form-material" action="{{ route('roles.update',$role->id) }}" method="POST">
    @csrf
   @method('PUT')

            <div class="row justify-content-around">
               
                 <div class="col-6">
                    <div class="form-group form-primary form-static-label">
                        <input type="text" name="name" value="{{ $role->name }}" class="form-control" placeholder="Entrer le nom du role">
                        <span class="form-bar"></span>
                        <label class="float-label">Nom du rôle<span class="text-danger">*</span> </label>
                    </div>
                 </div>
            </div>

           
                <div class="row justify-content-around">
                <div class="col-6">
                <div class="multi-select form-group form-primary form-static-label" >
                        <label  >Permissions <span class="text-danger">*</span> </label>
                        <div class="select" >
                            <select id="mySelect" class="select2-multiple" name="permissions[]" multiple size="5" style="width: 100%;" >
                                @foreach($permissions as $permission)
                                @if(in_array($permission->id , $rolePermissions))
                                        <option value="{{ $permission->id }}" selected="true"> {{ $permission->name }}  </option>
                                @else
                                    <option  value="{{$permission->id}}" >   
                                        {{ $permission->name }}
                                    </option>
                                @endif
                                @endforeach
                            </select>
                        </div>                                                                   
                    </div>
                </div>

                   

                     
                </div>


                <div class=" text-right" style="margin-top: 10px;">
                <button type="submit" class="btn btn-primary"> <i class="fa fa-fw fa-edit"></i> Modifier</button>
                 </div>
                                                 
            </form>
         </div>
    </div>

<!-- end Formulaire -->

@endsection