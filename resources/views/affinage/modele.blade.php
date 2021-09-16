
@extends('layouts.back')
 
 @section('content')

<?php
use App\Http\Controllers\ModelesController ;
 $user = auth()->user();  

  $natures=ModelesController::natures( );
 $Natures=array();
foreach($natures as $nature)
{
	$Natures[$nature->nature_lot]=$nature->libelle;
}

?>
 

						<div class="row">
 <nav aria-label="breadcrumb" style="width:100%">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('affinage')}}">{{__('msg.Industrial refining')}}</a></li>
    <li class="breadcrumb-item"><a href="#">{{__('msg.New Template')}}</a></li>
	</ol>
 </nav>
                        <!-- Content Column -->
                        <div class="col-lg-7 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.New Template')}}</h6>
                                </div>
                                <div class="card-body">
								   <form method="post" action="{{ route('addmodele') }}"  enctype="multipart/form-data">
										{{ csrf_field() }}
									  <input  class="form-control"  id="cl_ident"  type="hidden"  name="cl_ident" value="<?php echo $user['client_id']; ?>" />

                                     <div class="row pl-20 pr-20 mb-10">
 											<label style="width:160px" class="ml-10 mt-10 mr-10">{{__('msg.Name')}}: </label>
										 	 <input  class="form-control"  id="nom"  type="text" required name="modele_nom" style="max-width:350px" />
											  
 									   
									 </div>	
									 
                                     <div class="row pl-20 pr-20 mb-10">
 											<label style="width:160px" class="ml-10 mt-10 mr-10">{{__('msg.Nature of the batch')}}: </label>
 											<select id="nature" class="form-control"  onchange="check()" name="nature_lot_ident" required style="max-width:350px" />
											<option></option>
												<?php foreach($natures as $nature)
												{  
												echo '<option     data-toggle="tooltip" data-placement="bottom" value="'.$nature->nature_lot.'" title="'.$nature->commentaire.'" >'.$nature->libelle.'</option>';
									 
												}  ?>
											</select>
 									  
									 </div>
  
                                     <div class="row pl-20 pr-20 mb-10">
 											<label style="width:160px" class="ml-10 mt-10 mr-10" >{{__('msg.Weight')}} <small>{{__('msg.in grams')}}</small>: </label>
										  <input  class="form-control"  id="poids"  type="number" step="0.01" min="0.01" style="width:130px" name="pds_lot" required />
											  
 									   
									 </div>		
									 
									   <div class="col-sm-6 col-lg-6 " style="display:none" id="cendre" >
										  <!-- <label>{{__('msg.Weight')}} Cendre <small>{{__('msg.in grams')}}</small>: </label>
	  									    <input  onchange="prix()"  class="form-control"   id="pds_cdr" name="pds_cdr"  type="number" step="0.01" min="0" style="width:130px" value="0"   />-->

									   </div>
									 
                                     <div class="row pl-20 pr-20 mb-10" id="divassiste" style="display:none" >
										<div class="col-lg-12">
											<label for="assiste">
 												<input type="checkbox" name="assiste" id="assiste"  onchange="prix()" /> <span id="assistetxt"></span>
											</label>
										</div>									 
									 </div>							 
									 
                                     <div class="row pl-20 pr-20 mb-10">
										<div class="col-lg-12">
											<label>{{__('msg.My estimates in thousandths')}}: </label>
										</div>
									    <div class="col-lg-3"  >
											 <input class="form-control"  id="or" type="number" step="0.01" min="0" name="estim_titre_au"  onchange="checkt(this)"  value="0" /> <span class="ml-20 mt-10 btn text-center text-white bg-gradient-warning btn-circle btn-sm">Or</span>
									    </div>
									    <div class="col-lg-3"  >
											 <input class="form-control"  id="argent" type="number" step="0.01" min="0" name="estim_titre_ag"  onchange="checkt(this)" value="0"  /> <span class="ml-20 mt-10 btn text-center text-dark bg-gradient-light btn-circle btn-sm">Arg</span>
									    </div>
									    <div class="col-lg-3"  >
											 <input class="form-control"  id="platine" type="number" step="0.01" min="0" name="estim_titre_pt" onchange="checkt(this)" value="0" /> <span class="ml-20 mt-10 btn text-center text-white bg-gradient-secondary btn-circle btn-sm">Plat</span>
									    </div>
									    <div class="col-lg-3"  >
											 <input class="form-control"  id="palladium" type="number" step="0.01" min="0" name="estim_titre_pd" onchange="checkt(this)"  value="0"  /> <span class="ml-20 mt-10 btn text-center text-white bg-gray-500 btn-circle btn-sm">Pall</span>
									    </div>										
									      
									 </div>										 
									 

						      <div class="row mt-30" style=" height:60px">
								<button    type="submit" style="position:absolute;right:5% " class="pull-right btn btn-primary btn-icon-split   ml-50 mt-10 mb-20">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text"  >{{__('msg.Add the Template')}}</span>
                                    </button>
                                </div>									 
									 
								</form>	 
									 
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
							/* setTimeout(function(){
							location.reload();
							   }, 3000);  //3 secds*/
                 } 
				
				});
			
			
			}else{
				alert('Compléter les détails de votre modèle');
			}
			
			
			
			}	

function check()	
{
   var nature =  parseInt($('#nature').val()) ;
 	if (nature == 1 || nature == 2 || nature == 3 || nature ==4 || nature == 5 || nature ==6 || nature == 7 || nature == 8 || nature == 12 || nature ==16 || nature ==30 || nature ==31 || nature ==32 || nature == 33 )
	{
		$('#assistetxt').html("{{__('msg.I wish to attend preparation operations (melting)')}}") ;
		$('#divassiste').show('slow');
		$('#assiste').prop('checked', true);

	}else{
		
		if (nature == 34 || nature == 36  )
		{
			$('#assistetxt').html("{{__('msg.I wish to attend the burning')}}") ;
		    $('#divassiste').show('slow');
		    $('#cendre').show('slow');			
			$('#assiste').prop('checked', true);


		}else{
			$('#divassiste').hide('slow');
			$('#assiste').prop('checked', false);

		}
	
	}
 	
  
}
	


 function checkt(elm)
 { 	 var id =elm.id;         
			var estim_or =  parseFloat($('#or').val()) ;
	        var estim_ag =  parseFloat($('#argent').val()) ;
	        var estim_pt =  parseFloat($('#palladium').val()) ;
	        var estim_pd =  parseFloat($('#platine').val()) ;
			var total = estim_or + estim_ag+ estim_pt +estim_pd;
		if(total >1000)	{
  $.notify({
   message: 'le total ne doit pas dépasser 1000',
   icon: 'glyphicon glyphicon-remove-circle'
   },{
    type: 'danger',
    delay: 3000,
     timer: 1000,
     placement: {
      from: "bottom",
        align: "right"
      },
         });
	
	$('#'+id).val(0);
	$('#'+id).focus();
	
	}	

 }	
</script>					
					
@endsection
