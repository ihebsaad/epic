
@extends('layouts.back')
 
 @section('content')

<?php
use App\Http\Controllers\HomeController ;
  $user = auth()->user();  
 
$prestations=HomeController::listeprestations($user['client_id'] );
$PrestLibs=array();
$PrestTypes=array();
$PrestTypes2=array();
 foreach($prestations as $prest)
{
	$PrestLibs[$prest->id]=$prest->lib;
	$PrestTypes2[$prest->id]=$prest->type_lib;
	$PrestTypes[$prest->type_id]=$prest->type_lib;
 }
// dd($PrestLibs);
  $natures=HomeController::natures2( );
 $Natures=array();
 $NaturesC=array();
foreach($natures as $nature)
{
	if($nature->metier_CODE=='LAB'){
	$Natures[$nature->nature_lot_ident]=$nature->nature_lot_nom;
	$NaturesC[$nature->nature_lot_ident]=$nature->nature_lot_commentaire;
	}
}
 
$modele=DB::table('modele_lab')->where('modele_lab_ident',$id)->first();


$E_CmdesAff=DB::table('cmde_aff_e')->where('cl_ident',$user['client_id'])->where('statut','panier')->get();
$E_CmdesLab=DB::table('cmde_lab_e')->where('cl_ident',$user['client_id'])->where('statut','panier')->get();
$E_CmdesRMP=DB::table('cmde_rmp_e')->where('cl_ident',$user['client_id'])->where('statut','panier')->get();

$count_aff =count($E_CmdesAff);
$count_lab =count($E_CmdesLab);
$count_rmp =count($E_CmdesRMP);
$count= $count_aff + $count_lab + $count_rmp;
/* $tarif=HomeController::tariflabo(10099,2,100,0,0,0);
 dd($tarif);*/
 ?>
 

 <div class="row">
 <nav aria-label="breadcrumb" style="width:100%">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('laboratoire')}}">{{__('msg.Laboratory')}}</a></li>
    <li class="breadcrumb-item"><a href="#">{{__('msg.Model')}} <?php echo $modele->modele_nom; ?></a></li>
	</ol>
 </nav>
                        <!-- Content Column -->
                        <div class="col-lg-8 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.Details')}}</h6>
                                </div>
                                <div class="card-body">
								   <form method="post" action="{{ route('updatemodelelab') }}"    >
										{{ csrf_field() }}
									  <input  class="form-control"  id="cl_ident"  type="hidden"  name="cl_ident" value="<?php echo $user['client_id']; ?>" />
									  <input  class="form-control"  id="id"  type="hidden"  name="id" value="<?php echo $id; ?>" />

                                     <div class="row pl-20 pr-20 mb-10">
 											<label style="width:160px" class="ml-10 mt-10 mr-10">{{__('msg.Name')}}: </label>
									 
											 <input  class="form-control"  id="modele_nom"  name="modele_nom"  type="text"   value="<?php echo $modele->modele_nom; ?>" style="width:350px" onchange="prix()"  required/>
											  
 									   
									 </div>	
 
                                   <div class="row pl-20 pr-20 mb-10">
 											<label style="width:160px" class="ml-10 mt-10 mr-10">{{__('msg.Type of service')}}: </label>
									 
											<select id="choix_lab_ident"  name="choix_lab_ident" class="form-control" data-toggle="tooltip" data-placement="bottom" onchange="types();prix()" style="width:350px"  required />
											<option></option>
												<?php $i=0; foreach($PrestTypes as $key => $val)
												{ $i++; 
										if( $modele->choix_lab_ident== $key ){$selected='selected="selected"';}else{$selected=''; }											 
												echo '<option   '.$selected.'      value="'.($key).'"   >'.$val.'</option>';
									 
												}  ?>
											</select>
 									  
								    </div>
									
                                     <div class="row pl-20 pr-20 mb-10">
 											<label style="width:160px" class="ml-10 mt-10 mr-10">{{__('msg.Nature of work')}}: </label>
										 
											<select id="type_lab_ident"  name="type_lab_ident" class="form-control" style="width:350px"  onchange="prix()" required />
											<option></option>
												<?php $i=0; foreach($PrestLibs   as $key => $val)
												{ $i++; 
										if( $modele->type_lab_ident== $key ){$selected='selected="selected"';}else{$selected=''; }
												echo '<option   '.$selected.'   value="'.($key).'" class="types type-'.$PrestTypes2[$i].'" >'.$val.'</option>';
									 
												}  ?>
											</select>
 									  
								    </div>	
									
                                     <div class="row pl-20 pr-20 mb-10">
 											<label style="width:160px" class="ml-10 mt-10 mr-10">{{__('msg.Nature of products')}}: </label>
										 
											<select   id="nature_lot_ident"  name="nature_lot_ident" class="form-control" style="width:350px" onchange="tooltip();prix()" required />
											<option></option>
												<?php foreach($Natures as $key => $val)
												{  
										 	if(  intval($modele->nature_lot_ident)== intval($key) ){$selected='selected="selected"';}else{$selected=''; }
												echo '<option '.$selected.' value="'.$key.'" title="'.$NaturesC[$key].'"  >'.$val.'</option>';
									 
												}  ?>
											</select>
											<span data-toggle="modal" data-target="#natureModal"  onmouseover="tooltip()" id="help" class="btn btn-sm btn-circle btn-primary " style="margin-left:6px;margin-top:4px " data-toggle="tooltip" data-placement="top" title="Tooltip on top"><i class="fas fa-question"></i></span> 									  
									 </div>								 
									
                                      <div class="row pl-20 pr-20 mb-10">
										<div class="col-lg-4">
											<label >{{__('msg.Quantity')}}: </label>
 											 <input  class="form-control"   id="qte" name="qte"  type="number" step="1" min="1" style="width:120px" value="1"  required  value="<?php echo $modele->qte;?>" onchange="prix()" />
										 </div>
  
										<div class="col-lg-4">
											<label>{{__('msg.Weight')}}   </label>
									        <input  class="form-control"   id="poids" name="poids"  type="number" step="0.01" min="0" style="width:120px"  required  value="<?php echo $modele->poids;?>" onchange="prix()"     /> g

										</div>
									  <div class="col-lg-4">
											<label>{{__('msg.Value')}}: </label>
										     <input  class="form-control"   id="valeur" name="valeur"  type="number" step="0.01" min="0" style="width:120px"  value="<?php echo $modele->valeur;?>"  onchange="prix()"    />

									   </div>
											  
 									   
									 </div>	
									 
									 
                                     <div class="row pl-20 pr-20 mb-10">
										<div class="col-lg-12">
											<label>{{__('msg.Metals to be analyzed')}}: </label>
										</div>
									    <div class="col-lg-3"  >
											 <label for="titrage_au"  onclick="prix()"  ><input class="form-control"     id="titrage_au" name="titrage_au"  type="checkbox"  style="width:25px" value="1" <?php if($modele->titrage_au==1){?> checked <?php } ?>  /> <span class="  mt-10 btn text-center text-white bg-gradient-warning btn-circle btn-sm">Or</span></label>
									    </div>
									    <div class="col-lg-3"  >
											 <label for="titrage_ag" onclick="prix()"><input class="form-control"      id="titrage_ag" name="titrage_ag" type="checkbox" style="width:25px" value="1" <?php if($modele->titrage_ag==1){?> checked <?php } ?> /> <span class="  mt-10 btn text-center text-dark bg-gradient-light btn-circle btn-sm">Arg</span></label>
									    </div>
									    <div class="col-lg-3"  >
											 <label for="titrage_pt" onclick="prix()"><input class="form-control"    id="titrage_pt" name="titrage_pt" type="checkbox"  style="width:25px"  value="1" <?php if($modele->titrage_pt==1){?> checked <?php } ?> /> <span class="  mt-10 btn text-center text-white bg-gradient-secondary btn-circle btn-sm">Plat</span></label>
									    </div>
									    <div class="col-lg-3"  >
											 <label for="titrage_pd"  onclick="prix()" ><input class="form-control"    id="titrage_pd" name="titrage_pd" type="checkbox"  style="width:25px" value="1" <?php if($modele->titrage_pd==1){?> checked <?php } ?> /> <span class="  mt-10 btn text-center text-white bg-gray-500 btn-circle btn-sm">Pall</span></label>
									    </div>										
									      
									 </div>	
									 
 
		 
				 	      <div class="row " style=" ">
				 	      <div class="col-xs-12 col-sm-5 " style=" ">
								<button  name="update" value="update"  type="submit"  class="pull-right btn btn-success btn-icon-split   ml-50 mt-10 mb-20">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-save"></i>
                                        </span>
                                        <span class="text" >{{__('msg.Update Model')}}</span>
                                    </button>
                                </div>	


				 	          <div class="col-xs-12 col-sm-6" style=" " >
								<button name="order"  value="order"   type="submit"   class="pull-right btn btn-primary btn-icon-split   mt-10 mb-20">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-shopping-cart"></i>
                                        </span>
                                        <span class="text" >{{__('msg.Add to cart')}}</span>
                                    </button>
                                </div>									
									 
</form>									 
									 
						 </div>
									
									
									</div>
                              </div>

                       

                        </div>

                       <div class="col-lg-4 mb-4">

          

               
                             <div class="card shadow mb-4" style="margin-bottom:0px!important">
                                <div class="  ">
                                    <a href="#div2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">								
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.Valuation - Results')}}</h6>
									</a>
                                </div>
                                <div id="div2" class="card-body"  style="padding-bottom:0px">
 								<span style="font-size:11px" class="mb-10" >{{__('msg.Estimation of the results of the service following my titration')}}</span>
								<div class="pl-20">{{__('msg.Amount')}} : <span style="font-weight:bold" id="amount"></span></div><br>
 								
 
                                </div>
                            </div>

                             <div class="card shadow mb-4">
                                <div class=" ">
                                    <a href="#div3" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
										<h6 class="m-0 font-weight-bold text-primary">{{__('msg.Service Cart')}}</h6>
									</a>
                                </div>
                                <div id="div3" class="card-body">

								<?php  if($count>0) {?> 
								<b class="mb-10" style="font-size:20px">Modèles dans le panier <?php echo '('.$count.')'; ?></b><br>
								<div class="pl-40">
								
								<?php	if($count_aff>0) {?>
								<b>Affinage: <?php echo '('.$count_aff.')'; ?> </b><br>
								<div class="pl-30" >
								<?php foreach ($E_CmdesAff as $cmd)
								{								
								$cmdid=$cmd->cmde_aff_ident;
								$lignes=DB::table('cmde_aff_l')->where('cmde_aff_e_ident',$cmdid)->where('statut','panier')->get();
								$poidsAff= $or= $argent= $platine= $palladium = 0;
								foreach ($lignes as $ligne)
								{
									$poidsAff=$poidsAff+$ligne->cmde_aff_poids_lot;	
									$or=$or+$ligne->cmde_estim_titre_au;	
									$argent=$argent+$ligne->cmde_estim_titre_ag;	
									$platine=$platine+$ligne->cmde_estim_titre_pt;	
									$palladium=$palladium+$ligne->cmde_estim_titre_pd;	
								}
								} 
 								?>
								Poids : <?php echo $poidsAff; ?> g<br>
 								Total Métaux :<br>
								<?php if ($or>0){echo 'Or : '.$or .' g<br>'; }?> 
								<?php if ($argent>0){echo 'Argent : '.$argent.' g<br>'; }?>
								<?php if ($platine>0){echo 'Platine : '.$platine.' g<br>'; }?>
								<?php if ($palladium>0){echo 'Palladium : '.$palladium.' g<br>'; }?>		
								</div>
								<hr>
								<?php  
								 }
								 
								if($count_lab>0) {?>
								<b>Laboratoire: <?php echo '('.$count_lab.')'; ?></b><br>
								<div class="pl-30" >
								<?php $poids=0; $qte=0; ?>
								<?php foreach ($E_CmdesLab as $cmd) 
								{
								$cmdid=$cmd->cmde_lab_ident;
								$poids=$poids+$cmd->cmde_lab_poids;
								$qte=$qte+$cmd->cmde_lab_qte;
 								$lignes=DB::table('cmde_lab_l')->where('cmde_lab_e_ident',$cmdid)->where('statut','panier')->get();
								 $or= $argent= $platine= $palladium = 0;
								foreach ($lignes as $ligne)
								{  
 									$or=$or+$ligne->titrage_au;	
									$argent=$argent+$ligne->titrage_ag;	
									$platine=$platine+$ligne->titrage_pt;	
									$palladium=$palladium+$ligne->titrage_pd;	
								}
								}
								?>
 								Qté totale : <?php echo $qte; ?><br>
								Poids total : <?php echo $poids; ?> g<br>
								Métaux :<br>
								<?php if ($or>0){echo 'Or<br>'; }?> 
								<?php if ($argent>0){echo 'Argent<br>'; }?> 
								<?php if ($platine>0){echo 'Platine<br> '; }?>
								<?php if ($palladium>0){echo 'Palladium<br>'; }?> 
								</div>
								<hr>
								<?php }
								
								
								if($count_rmp>0) {?>								
								<b>Rachat Métaux Précieux: <?php echo '('.$count_rmp.')'; ?></b><br>
								<div class="pl-30" >
								<?php foreach ($E_CmdesRMP as $cmd) 
								{
 								$poids=$cmd->cmde_rmp_poids_lot;
  								 $or= $argent= $platine= $palladium = 0;
 								 $or=$or+$cmd->estim_au;	
								 $argent=$argent+$cmd->estim_ag;	
								 $platine=$platine+$cmd->estim_pt;	
								 $palladium=$palladium+$cmd->estim_pd;	
								 }
								?>
 								Poids : <?php echo $poids ; ?> g<br>
								Total Métaux :<br>
								<?php if ($or>0){echo 'Or : '.$or .' g<br>'; }?> 
								<?php if ($argent>0){echo 'Argent : '.$argent.' g<br>'; }?>
								<?php if ($platine>0){echo 'Platine : '.$platine.' g<br>'; }?>
								<?php if ($palladium>0){echo 'Palladium : '.$palladium.' g<br>'; }?>								
								</div>
								<hr>
								<?php } ?>
								
								</div>
								
								<center><a href="{{ route('livraisonmod') }}" style="color:white;text-decoration:none"> <button    type="button"   class="pull-right btn btn-primary btn-icon-split  mt-10 mb-20">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-truck-moving"></i>
                                        </span>
                                        <span style="width:120px"  class="text" >{{__('msg.Delivery')}}</span>
                                    </button> </a></center>								
								<?php } //count total ?>
								
								
                                </div>
                            </div>
							
							
							
							
                        </div> 
                    </div>

					
					
 <!--   Modal-->
  <div class="modal fade" id="natureModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{__('msg.Nature of the lot')}}</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"> <span id="helptext"></span></div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">OK</button>
         </div>
      </div>
    </div>
  </div>
					
<script>
function tooltip()	
{ 
 var comment= $('#nature_lot_ident').find('option:selected').attr('title');
  
$('#help').prop('title', comment);
$('#helptext').html(comment);
 
}

	   function toggle(className, displayState){
            var elements = document.getElementsByClassName(className);
            for (var i = 0; i < elements.length; i++){
                elements[i].style.display = displayState;
              }
			  
        }
 
 function types(){
 	var type= $( "#choix_lab_ident option:selected" ).text();
 	  toggle('types','none');
	 toggle('type-'+type,'block');
	//  $( "#type_lab_ident").val('');
 }
 
  
 	
function prix()
{ 
	        var _token = $('input[name="_token"]').val();
	          var client =  $('#cl_ident').val() ;
	        var choix =  $('#type_lab_ident').val() ; 
	     var  estim_or=0;
         if ($('#titrage_au').is(':checked'))
         {
			 estim_or=1;
         }
		  var  estim_ag=0;
         if ($('#titrage_ag').is(':checked'))
         {
			 estim_ag=1;
         } 
		  var  estim_pt=0;
         if ($('#titrage_pt').is(':checked'))
         {
			 estim_pt=1;
         }
		  var  estim_pd=0;
         if ($('#titrage_pd').is(':checked'))
         {
			 estim_pd=1;
         }
	        var qte = parseFloat(  $('#qte').val()) ;
 			  $('#amount').html('');

		     var    submitData= { client:client, choix: choix,estim_or: estim_or,estim_ag: estim_ag, estim_pt: estim_pt,estim_pd: estim_pd,poids:poids, _token: _token}

   				$.ajax({
                url: "{{ route('tariflabo') }}",
                method: "POST",
				 //  "async": true,
              //  data: { client:client, choix: choix,estim_or: estim_or,estim_ag: estim_ag, estim_pt: estim_pt,estim_pd: estim_pd,poids:poids, _token: _token},
                data: JSON.stringify(submitData), // stringyfy before passing
			//	dataType: 'json', // payload is json
			//	contentType : 'application/json',
			 headers: {
			'X-CSRF-TOKEN': _token,
			"content-type": "application/json"
			},
				success: function (data) {
					console.log(data[0].prix);
					//alert(data[0].prix);
					var prix=parseFloat(data[0].prix);
				 if(   prix  > 0 ) 
					 {
					 $('#amount').html(prix*qte +' €');
					 }
			 	  

				  }
					
			     });
						
 				
 }			
  types();
   prix();
 
</script>					
					
@endsection
