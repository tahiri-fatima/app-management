
@extends('layouts.app')
  
  @section('content')
    
  <div class=" text-right" style="margin-bottom: 30px;margin-top: 20px;margin-right: 100px;"> 

      <a class="btn btn-primary" href="{{ route('chantiers.BilanChantier') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 
      <button class="btn btn-primary" type="button" onclick="PrintPage()" value="Imprimer" ><i class="fa fa-print" aria-hidden="true"></i>Imprimer</button>
  </div> 
  



  
  <div class="col d-flex justify-content-center" id="printableArea"> 


  
  
  <div style="width:80%" >
      <div class="container text-center">
  
        
  
   <div class="card"> {!! $chart->container() !!} </div>   
   <div class="card"> {!! $chartPie->container() !!} </div>  
   <div class="card"> {!! $chartBar->container() !!} </div> 



        <script src="{{ $chart->cdn() }}"></script>
        {!! $chart->script() !!}
       

        <script src="{{ $chartPie->cdn() }}"></script>
        {!! $chartPie->script() !!}

        <script src="{{ $chartBar->cdn() }}"></script>
        {!! $chartBar->script() !!}

        
           
      </div>
  </div>
  
  
  
  @endsection


 