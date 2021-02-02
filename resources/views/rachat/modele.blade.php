
@extends('layouts.back')
 
 @section('content')

<?php
use App\Http\Controllers\HomeController ;
 $user = auth()->user();  

$natures=HomeController::natures2( );
//dd($natures );
$Natures=array();
foreach($natures as $nature)
{
	if($nature->metier_CODE=='RMP'){
	$Natures[$nature->nature_lot_ident]=$nature->nature_lot_nom;
	}
}
$covers=DB::table('choix_couv')->where('langue','like',$user['lg'].'%')->get();

?>
 
 
<div class="row">
 <nav aria-label="breadcrumb" style="width:100%">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('rachat')}}">{{__('msg.Buyback of precious metals')}}</a></li>
    <li class="breadcrumb-item"><a href="#">{{__('msg.New Template')}}</a></li>
	</ol>
 </nav>
                        <!-- Content Column -->
                        <div class="col-lg-7 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.Add a new Model')}}</h6>
                                </div>
                                <div class="card-body">
								   <form method="post" action="{{ route('addmodelermp') }}"  enctype="multipart/form-data">
										{{ csrf_field() }}
									  <input  class="form-control"  id="cl_ident"  type="hidden"  name="cl_ident" value="<?php echo $user['client_id']; ?>" />

                                     <div class="row pl-20 pr-20 mb-10">
										 
											<label style="width:130px" class="ml-10 mt-10 mr-10">{{__('msg.Name')}}: </label>
										 
									   
											 <input  class="form-control"  id="nom"  type="text" required name="modele_nom" style="width:350px" />
											  
									    
									   
									 </div>	
									 
                                     <div class="row pl-20 pr-20 mb-10">
 											<label style="width:130px" class="ml-10 mt-10 mr-10">{{__('msg.Nature of the batch')}}: </label>
 											<select id="nature" class="form-control" data-toggle="tooltip" data-placement="bottom" name="nature_lot_ident" required style="width:350px" >
											<option></option>
												<?php foreach($natures as $nature)
												{ 
													if($nature->metier_CODE=='RMP'){												
												echo '<option     data-toggle="tooltip" data-placement="bottom" value="'.$nature->nature_lot_ident.'" title="'.$nature->nature_lot_commentaire.'" >'.$nature->nature_lot_nom.'</option>';
									 
														}  
												}  ?>
											</select>
 									  
									 </div>
  
                                     <div class="row pl-20 pr-20 mb-10">
 											<label style="width:130px" class="ml-10 mt-10 mr-10">{{__('msg.Weight')}} <small>{{__('msg.in grams')}}</small>: </label>
 											 <input  class="form-control"  id="poids"  type="number" step="0.01" min="0.01" style="width:130px" name="pds_lot" required />
											  
 									   
									 </div>		
									 
                                     <div class="row pl-20 pr-20 mb-10">
										<div class="col-lg-12">
											<label for="assiste">
												<input type="checkbox" name="assiste" id="assiste" /> {{__('msg.I wish to attend preparation operations (melting)')}}
											</label>
										</div>									 
									 </div>									 

                                     <div class="row pl-20 pr-20 mb-10">
										<div class="col-lg-12">
											<label for="acompte">
												<input type="checkbox" name="acompte" id="acompte" onchange="check()" /> {{__('msg.I want to receive a deposit as soon as possible')}}
											</label>
										</div>									 
									 </div>	
									 
                                     <div class="row pl-20 pr-20 mb-10">
										<div class="col-lg-12">
											<label style="width:130px" for="">
											{{__('msg.Hedge')}}:
 											</label>
											  <select  class="form-control" name="choix_couv_ident" id="choix_couv_ident" style="width:300px" required onchange="check2()" > 
											  <option></option>
											<?php  foreach( $covers as $cover)
											  {
												echo ' <option value="'.$cover->choix_couv_ident.'">'.$cover->choix_ident_lib.'</option> ';
											  }
											?>
												</select>

										</div>									 
									 </div>		
									 

									 
                                     <div class="row pl-20 pr-20 mb-10">
										<div class="col-lg-12">
											<label>{{__('msg.My estimates in thousandths')}}: </label>
										</div>
									    <div class="col-lg-3"  >
											 <input class="form-control"  id="or" type="number" step="0.01" min="0" name="estim_titre_au" onchange="checkt(this)" value="0" /> <span class="ml-20 mt-10 btn text-center text-white bg-gradient-warning btn-circle btn-sm">Or</span>
									    </div>
									    <div class="col-lg-3"  >
											 <input class="form-control"  id="argent" type="number" step="0.01" min="0" name="estim_titre_ag" onchange="checkt(this)" value="0" /> <span class="ml-20 mt-10 btn text-center text-dark bg-gradient-light btn-circle btn-sm">Arg</span>
									    </div>
									    <div class="col-lg-3"  >
											 <input class="form-control"  id="platine" type="number" step="0.01" min="0" name="estim_titre_pt" onchange="checkt(this)" value="0" /> <span class="ml-20 mt-10 btn text-center text-white bg-gradient-secondary btn-circle btn-sm">Plat</span>
									    </div>
									    <div class="col-lg-3"  >
											 <input class="form-control"  id="palladium" type="number" step="0.01" min="0" name="estim_titre_pd" onchange="checkt(this)" value="0" /> <span class="ml-20 mt-10 btn text-center text-white bg-gray-500 btn-circle btn-sm">Pall</span>
									    </div>										
									      
									 </div>										 
									 

						      <div class="row  " style=" ">
								<button    type="submit"   class="pull-right btn btn-primary btn-icon-split   ml-50 mt-15 mb-20">
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

		 function check(){
		  var  acompte=0;
         if ($('#acompte').is(':checked'))
         {
			 acompte=1;
         }
		 
		 if(acompte==1){
			 $("#choix_couv_ident").val(1);
		 }
		 else{
			 $("#choix_couv_ident").val('');
		 }
		}
	
		 function check2(){
		  var couv = $("#choix_couv_ident").val();
		  if (couv != 1)
		  {$('#acompte').prop('checked', false);
			}
			else{
			  $('#acompte').prop('checked', true);
			}
 
		 }

	 function checkt(elm)
 { 	 var id =elm.id;         
			var estim_or =  parseFloat($('#or').val()) ;
	        var estim_ag =  parseFloat($('#argent').val()) ;
	        var estim_pt =  parseFloat($('#platine').val()) ;
	        var estim_pd =  parseFloat($('#palladium').val()) ;
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
