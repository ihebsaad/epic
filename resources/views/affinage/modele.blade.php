
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
                                    <h6 class="m-0 font-weight-bold text-primary">Ajouter un nouveau modèle</h6>
                                </div>
                                <div class="card-body">
								
                                     <div class="row pl-20 pr-20 mb-10">
										<div class="col-lg-12">
											<label>Nom du modèle: </label>
										</div>
									    <div class="col-lg-9  " style="display:inline!important">
											 <input  class="form-control"  id="nom"  type="text"    />
											  
									   </div>
									   
									 </div>	
									 
                                     <div class="row pl-20 pr-20 mb-10">
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
  
                                     <div class="row pl-20 pr-20 mb-10">
										<div class="col-lg-12">
											<label>Poids en grammes: </label>
										</div>
									    <div class="col-lg-12  " style="display:inline!important">
											 <input  class="form-control"  id="poids"  type="number" step="0.01" min="0.01" style="width:130px" />
											  
									   </div>
									   
									 </div>		
									 
                                     <div class="row pl-20 pr-20 mb-10">
										<div class="col-lg-12">
											<label for="assiste">
												<input type="checkbox" name="assiste" id="assiste" /> Je souhaite assisiter aux opération de préparation (fonte)
											</label>
										</div>									 
									 </div>									 
									 
                                     <div class="row pl-20 pr-20 mb-10">
										<div class="col-lg-12">
											<label>Mes estimations en millièmes: </label>
										</div>
									    <div class="col-lg-3"  >
											 <input class="form-control"  id="or" type="number" step="0.01" min="0.01" /> <span class="ml-20 mt-10 btn text-center text-white bg-gradient-warning btn-circle btn-sm">Or</span>
									    </div>
									    <div class="col-lg-3"  >
											 <input class="form-control"  id="argent" type="number" step="0.01" min="0.01" /> <span class="ml-20 mt-10 btn text-center text-dark bg-gradient-light btn-circle btn-sm">Arg</span>
									    </div>
									    <div class="col-lg-3"  >
											 <input class="form-control"  id="platine" type="number" step="0.01" min="0.01" /> <span class="ml-20 mt-10 btn text-center text-white bg-gradient-secondary btn-circle btn-sm">Plat</span>
									    </div>
									    <div class="col-lg-3"  >
											 <input class="form-control"  id="palladium" type="number" step="0.01" min="0.01" /> <span class="ml-20 mt-10 btn text-center text-white bg-gray-500 btn-circle btn-sm">Pall</span>
									    </div>										
									      
									 </div>										 
									 

						      <div class="row mt-30" style=" height:60px">
								<button    type="button" style="position:absolute;right:50px " class="pull-right btn btn-primary btn-icon-split   ml-50 mt-10 mb-20">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text" onclick="addmodele()">{{__('msg.Add Model')}}</span>
                                    </button>
                                </div>									 
									 
									 
									 
									</div>
                              </div>

                       

                        </div>

                    <!--    <div class="col-lg-5 mb-4">

                             <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">  </h6>
                                </div>
                                <div class="card-body">
 
 
                                </div>
                            </div>

               

                        </div>-->
                    </div>

					
<script>

	function addmodele (){
			var _token = $('input[name="_token"]').val();
 	        var nom = $('#nom').text() ;
 	        var nature = $('#nature').val() ;
			var poids =  $('#poids').val() ;
 			var or =  $('#or').val() ;
			var argent =  $('#argent').val() ;
			var platine =  $('#platine').val() ;
			var palladium =  $('#palladium').val() ;
 	 
	     var  assite=0;
         if ($('#assiste').is(':checked'))
         {
			 assiste=1;
         }
		 
		 if(poids >0 && nature>0 ){
			 
			 
				$.ajax({
                url: "{{ route('addmodele') }}",
                method: "POST",
                data: {client:<?php echo $user['client_id']; ?>, nom:nom, nature: nature,assiste: assiste, poids: poids,or: or,argent: argent,palladium: palladium,platine: platine  , _token: _token},
                success: function (data) {
					alert(data);
	                    $.notify({
                        message: 'Modèle ajouté avec succès',
                        icon: 'glyphicon glyphicon-check'
                    },{
                        type: 'success',
                        delay: 3000,
                        timer: 1000,
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                    });
							/*setTimeout(function(){
							location.reload();
							   }, 3000);  //3 secds
							}*/
				
				});
			
			
			}else{
				alert('Compléter les détails de votre modèle');
			}
			
			
			
			}					
</script>					
					
@endsection
