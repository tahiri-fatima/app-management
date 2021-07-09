@extends('chantierOperations.layout')
  
@section('content')


<div class="container " style="margin-left: 15%;" > 
        <a class="btn btn-outline-primary text-right" href="{{ route('chantierOperations.create') }}"><i class="fa fa-fw fa-plus-circle"></i> Ajouter nouveau chantier-opérations</a> 
        @can('edit')
        <a class="btn btn-outline-primary"  href="{{  route('chantierOperations.editOperations',$chantier->id) }}" ><i class="fa fa-fw fa-edit"></i> Modifier</a>
        @endcan
        @can('delete')
        <button type="submit" class="btn btn-outline-primary" onclick="$('#modal').modal('show');" ><i class="fa fa-fw fa-trash"></i> Supprimer</button>
        @endcan
       <a class="btn btn-outline-primary" href="{{ route('chantierOperations.index') }}" ><i class="fa fa-fw fa-arrow-circle-left"></i> Retour</a> 

</div> 

<!-- modal pour confirmer la supression !-->
<div   class="modal" tabindex="-1" role="dialog" id="modal" >
  <div class="modal-dialog" role="document" >
  <form class="modal-content"action="{{ route('chantierOperations.destroyChantierOperations',$chantier->id) }}" method="POST">
      <div class="modal-header" >
        <h5 class="modal-title" style="color:red;" > Confirmation de la supprission</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">
          <strong >
            
            <p>Voulez vous supprimer cette enregistrement ?</p>
        </strong>
      </div>
      <div class="modal-footer">
     
        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary" > Annuler</button>
        @csrf
        @method('DELETE')
        <button type="submit"  class="btn btn-outline-danger"> Supprimer</button>
      </div>
  </form>
    </div>
  </div>


<div class="col d-flex justify-content-center"> 

    @if ($message = Session::get('success'))
        <div class="alert alert-success message">
            <p>{{ $message }}</p>
        </div>
    @endif
</div>
<div class="col d-flex justify-content-center">
<div style="width: 90%;" >
    <div class="card " >

         <div class="card-header">
            <h5>Détails des opérations du chantier </h5>
                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li><i class="fa fa fa-wrench open-card-option"></i></li>
                        <li><i class="fa fa-window-maximize full-card"></i></li>
                        <li><i class="fa fa-minus minimize-card"></i></li>
                     </ul>
                </div>
            </div>
            
            <div class="card-block">
                <div class="table-responsive">
                    <table class="table  m-b-0 without-header">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6> <span style="font: size 16px; color:#0d46a1;">Code du chantier : </span>  {{ $chantier->code_chantier }}</h6>
                                        </div>
                                    </div>
                                </td>
                             
                                <td>
                                    <div class="d-inline-block align-middle">
                                        <div class="d-inline-block">
                                            <h6><span style="font: size 16px; color:#0d46a1;">Désignation du chantier : </span>  {{ $chantier->intitule_chantier }} </h6>
                                        </div>
                                    </div>
                                </td>
                                
                            </tr>
                          
                            <table class="table table-hover m-b-0 text-center">
                                <thead >
                                    <tr style="font: size 16px; color:#0d46a1;">
                                        <th >Code d'opération</th>
                                        <th >Désignation d'opération</th>
                                        <th >Date début d'opération</th>
                                        <th >Date fin d'opération</th>
                                        <th >Prix unitaire d'opération</th>
                                        <th >Quantité d'opération </th>
                                        <th >Prix de vente</th>
                                       
                                        <th >Taux d'ajustement</th>
                                        <th >Montant net </th>
                                    </tr>
                                </thead>
                            
                            @foreach($chantier->operations as $operation)
                                <tr>
                                    <td ><h6>{{ $operation->code_operation }} </h6></td>
                                    <td ><h6>{{ $operation->designation_operation }} </h6></td>
                                    <td ><h6>{{ $operation->date_deb_operation }} </h6></td>
                                    <td ><h6>{{ $operation->date_fin_operation }} </h6></td>
                                    <td ><h6>{{ $operation->prix_unitaire_revient }} </h6></td>
                                    <td ><h6>{{ $operation->quantite_operation }} </h6></td>
                                    <td ><h6>{{ $operation->prix_unitaire_vente }} </h6></td>
                                    <td ><h6>{{ $operation->taux_ajustement }} </h6></td>
                                    <td ><h6>{{ $operation->montant_estimee }} </h6></td>
                                </tr>
                                
                              
                    
                            @endforeach
                            <tr>
                                  <td colspan="8"><h6>Montant net total </h6></td>
                                  <td><h6>{{ $chantier->total }} </h6></td>
                              </tr>
                            </table>
                         
                            
                           
                            
                        </tbody>
                    </table>
                 </div>
            </div>
        </div>
    </div>
</div>  














@endsection