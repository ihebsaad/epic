
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

$modele=DB::table('modele_rmp')->where('modele_rmp_ident',$id)->first();

$covers=DB::table('choix_couv')->where('langue','like',$user['lg'].'%')->get();

?>
 

 <div class="row">
 <nav aria-label="breadcrumb" style="width:100%">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('rachat')}}">{{__('msg.Buyback of precious metals')}}</a></li>
    <li class="breadcrumb-item"><a href="#">{{__('msg.Model')}} <?php echo $modele->modele_nom; ?></a></li>
	</ol>
 </nav>
                        <!-- Content Column -->
                        <div class="col-lg-7 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.Model details')}}</h6>
                                </div>
                                <div class="card-body">
								   <form method="post" action="{{ route('updatemodelermp') }}"  enctype="multipart/form-data">
										{{ csrf_field() }}
									  <input  class="form-control"  id="cl_ident"  type="hidden"  name="cl_ident" value="<?php echo $user['client_id']; ?>" />
									  <input  class="form-control"  id="id"  type="hidden"  name="id" value="<?php echo $modele->modele_rmp_ident; ?>" />

                                     <div class="row pl-20 pr-20 mb-10">
 											<label style="width:130px" class="ml-10 mt-10 mr-10" >{{__('msg.Model name')}}: </label>
 											 <input  class="form-control"  id="modele_nom"  name="modele_nom"  type="text"   value="<?php echo $modele->modele_nom; ?>"  style="width:350px" />
											  
 									   
									 </div>	
									 
                                     <div class="row pl-20 pr-20 mb-10">
 											<label style="width:130px" class="ml-10 mt-10 mr-10" >{{__('msg.Nature of the lot')}}: </label>
 											<select id="nature_lot_ident"  name="nature_lot_ident" class="form-control" data-toggle="tooltip" data-placement="bottom" style="width:350px" >
											<option></option>
												<?php foreach($natures as $nature)
												{  
												if(  $modele->nature_lot_ident== $nature->nature_lot_ident ){$selected='selected="selected"';}else{$selected=''; }
												echo '<option  '.$selected.'   data-toggle="tooltip" data-placement="bottom" value="'.$nature->nature_lot_ident.'" title="'.$nature->nature_lot_commentaire.'" >'.$nature->nature_lot_nom.'</option>';
									 
												}  ?>
											</select>
 									  
									 </div>
  
                                     <div class="row pl-20 pr-20 mb-10">
 											<label style="width:130px" class="ml-10 mt-10 mr-10">{{__('msg.Weight')}} <small>{{__('msg.in grams')}}</small>: </label>
										 	 <input  class="form-control"   id="pds_lot" name="pds_lot"  type="number" step="0.01" min="0" style="width:130px" value="<?php echo $modele->pds_lot; ?>"   />
											  
 									   
									 </div>		
									 
                                     <div class="row pl-20 pr-20 mb-10">
										<div class="col-lg-12">
											<label for="assiste">
											<?php $check='' ; if($modele->assiste==1){$check='checked';} ?>
												<input type="checkbox" name="assiste" id="assiste" <?php echo $check; ?> /> {{__('msg.I wish to attend preparation operations (melting)')}}
											</label>
										</div>									 
									 </div>									 

                                     <div class="row pl-20 pr-20 mb-10">
										<div class="col-lg-12">
											<label for="acompte">
											<?php $checked='' ; if($modele->demande_acompte==1){$checked='checked';} ?>											
												<input type="checkbox" name="acompte" id="acompte" <?php echo $checked; ?> onchange="check()" /> {{__('msg.I want to receive a deposit as soon as possible')}}
											</label>
										</div>									 
									 </div>	

                                     <div class="row pl-20 pr-20 mb-10">
 											<label style="width:130px" class="ml-10 mt-10 mr-10" >
											{{__('msg.Cover')}}:
 											</label>
											  <select  class="form-control" name="choix_couv_ident" id="choix_couv_ident" style="width:300px" required > 
											  <option></option>
											<?php $check='';
											foreach( $covers as $cover)
											  {  if($modele->choix_couv_ident==$cover->choix_couv_ident) {$check="selected='selected'"; }
												echo ' <option  '.$check.'  value="'.$cover->choix_couv_ident.'">'.$cover->choix_ident_lib.'</option> ';
											  }
											?>
												</select>

 									 </div>		
									  
                                     <div class="row pl-20 pr-20 mb-10">
										<div class="col-lg-12">
											<label>{{__('msg.My estimates in thousandths')}}: </label>
										</div>
									    <div class="col-lg-3"  >
											 <input class="form-control"   value="<?php echo $modele->estim_titre_au; ?>" id="estim_titre_au" name="estim_titre_au"  type="number" step="0.01" min="0" /> <span class="ml-20 mt-10 btn text-center text-white bg-gradient-warning btn-circle btn-sm">Or</span>
									    </div>
									    <div class="col-lg-3"  >
											 <input class="form-control"    value="<?php echo $modele->estim_titre_ag; ?>" id="estim_titre_ag" name="estim_titre_ag" type="number" step="0.01" min="0" /> <span class="ml-20 mt-10 btn text-center text-dark bg-gradient-light btn-circle btn-sm">Arg</span>
									    </div>
									    <div class="col-lg-3"  >
											 <input class="form-control"   value="<?php echo $modele->estim_titre_pt; ?>" id="estim_titre_pt" name="estim_titre_pt" type="number" step="0.01" min="0" /> <span class="ml-20 mt-10 btn text-center text-white bg-gradient-secondary btn-circle btn-sm">Plat</span>
									    </div>
									    <div class="col-lg-3"  >
											 <input class="form-control"  value="<?php echo $modele->estim_titre_pd; ?>" id="estim_titre_pd" name="estim_titre_pd" type="number" step="0.01" min="0" /> <span class="ml-20 mt-10 btn text-center text-white bg-gray-500 btn-circle btn-sm">Pall</span>
									    </div>										
									      
									 </div>										 
									 
<br><br>
				 	      <div class="row  "  >
								<button    type="submit"   class="pull-right btn btn-primary btn-icon-split   ml-50   mb-20">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-save"></i>
                                        </span>
                                        <span class="text" >{{__('msg.Update Model')}}</span>
                                    </button>
                                </div>		 					 
									 
</form>									 
									 
									</div>
                              </div>

                       

                        </div>

                     <!--   <div class="col-lg-5 mb-4">

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

	function updatemodele (){
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
                url: "{{ route('updatemodele') }}",
                method: "POST",
                data: {id:<?php echo $id; ?>, nom:nom, nature: nature,assiste: assiste, poids: poids,or: or,argent: argent,palladium: palladium,platine: platine  , _token: _token},
                success: function (data) {
					
	                    $.notify({
                        message: 'Modèle Modifié avec succès',
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
							setTimeout(function(){
							location.reload();
							   }, 3000);  //3 secds
							}
				
				});
			
			
			}else{
				alert('Compléter les détails de votre modèle');
			}
			
			
			
			}	


  function changing(elm) {
            var champ = elm.id;

            var val = document.getElementById(champ).value;

             //if ( (val != '')) {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('updatemodele') }}",
                method: "POST",
                data: {modele: <?php echo $id; ?>, champ: champ, val: val, _token: _token},
                success: function (data) {
                    $('#' + champ).animate({
                        opacity: '0.1',
                    });
                    $('#' + champ).animate({
                        opacity: '1',
                    });

                    $.notify({
                        message: 'Modifié avec succès',
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

                }
            });

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

}
</script>					
					
@endsection
