
@extends('layouts.back')
 
 @section('content')

<?php
use App\Http\Controllers\HomeController ;
 $user = auth()->user();  

  $natures=HomeController::natures( );
 $Natures=array();
foreach($natures as $nature)
{
	$Natures[$nature->nature_lot]=$nature->libelle;
}

?>
<script src="{{ URL::asset('public/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>

<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$('#nature').tooltip();


</script>

						<div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-7 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Nouveau modèle</h6>
                                </div>
                                <div class="card-body">
                                     <div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-9">
											<label>Nature du lot: </label>
										</div>
									    <div class="col-lg-9">
											<select id="nature" class="form-control" data-toggle="tooltip" data-placement="bottom" >
											<option></option>
												<?php foreach($natures as $nature)
												{  
												echo '<option     data-toggle="tooltip" data-placement="bottom" value="'.$nature->nature_lot.'" title="'.$nature->commentaire.'" >'.$nature->libelle.'</option>';
									 
												}  ?>
											</select>
									   </div>
									  
									 </div>
									 
                                     <div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-12">
											<label>Poids en grammes: </label>
										</div>
									    <div class="col-lg-12  " style="display:inline!important">
											 <input  class="form-control"  type="number" step="0.01" min="0.01" style="width:130px" />
											  
									   </div>
									   
									 </div>									 
									 
									 
                                     <div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-12">
											<label>Mes estimations en millièmes: </label>
										</div>
									    <div class="col-lg-3"  >
											 <input class="form-control"  type="number" step="0.01" min="0.01" /> <span class="ml-20 mt-10 btn text-center text-white bg-gradient-warning btn-circle btn-sm">Or</span>
									    </div>
									    <div class="col-lg-3"  >
											 <input class="form-control"  type="number" step="0.01" min="0.01" /> <span class="ml-20 mt-10 btn text-center text-dark bg-gradient-light btn-circle btn-sm">Arg</span>
									    </div>
									    <div class="col-lg-3"  >
											 <input class="form-control"  type="number" step="0.01" min="0.01" /> <span class="ml-20 mt-10 btn text-center text-white bg-gradient-secondary btn-circle btn-sm">Plat</span>
									    </div>
									    <div class="col-lg-3"  >
											 <input class="form-control"  type="number" step="0.01" min="0.01" /> <span class="ml-20 mt-10 btn text-center text-white bg-gray-500 btn-circle btn-sm">Pall</span>
									    </div>										
									   
  
									   
									 </div>										 
									 
									 
									 
									</div>
                              </div>

                       

                        </div>

                        <div class="col-lg-5 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Estimation </h6>
                                </div>
                                <div class="card-body">
 
 
                                </div>
                            </div>

               

                        </div>
                    </div>

@endsection
