
@extends('layouts.back')
 
 @section('content')
<style>
.card-body{min-height:300px;}
</style>
<?php
 $user = auth()->user();  
 use App\Http\Controllers\HomeController ;
    

$agences=DB::table('agence')->get();

//$details=HomeController::detailsclient($user['client_id']);
$liste=HomeController::listeclients2($user['client_id']);
	$adresses=HomeController::adresse2($user['client_id']);
	$contact=HomeController::liste_contact($user['client_id']);
	
$pays_code = $liste[0]->pays_code ;
$agence_defaut= $liste[0]->agence_defaut  ;
?>
<style>
.box{border:1px solid black; background-color:#f8f9fc;opacity:0.4;cursor:pointer;}
 .active{border:2px solid black;font-weight:bold;background-color:#f0f0f0;color:black;opacity:1;}
</style>
						<div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-7 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.Delivery')}}</h6>
                                </div>
                                <div class="card-body">
 							 <h5>{{__('msg.Choose your delivery mode')}}</h5>
							 <div class="row pt-10 pb-20">
							 <div class="col-md-4 box pt-20 pl-20 pb-20 pr-20 ml-10 active"  onclick="$('#agency1').show('slow');$('#agency2').hide('slow');details();mode='collect'">
								<center>  {{__('msg.Self-Delivery')}} 
								<img src="{{ URL::asset('public/img/box.png')}}" style="width:80px" class="mt-20"/></center>
							 </div>
							 <div class="col-md-4 box pt-20 pl-20 pb-20 pr-20 ml-10" onclick="$('#agency1').hide('slow');$('#agency2').show('slow');mode='trans'">
								<center>  {{__('msg.Transporter')}} 
								<img src="{{ URL::asset('public/img/truck.png')}}" style="width:100px"/></center>
								
							 </div>
							 </div>
							 <div id="agency1">
 							 <h5>{{__('msg.Delivery address')}}</h5>
							 <div class="row pt-10 pb-20">
							 
							 <div class="col-md-8">
							 
							 <select class="form-control mb-20" style="" id="agence_id" onchange="details();changing(this)">
							 <option></option>
							 <?php
							 foreach($agences as $agence)
							 {
								  if($agence->pays_code ==  $pays_code ){
								 if($agence->agence_ident ==  $agence_defaut ){$selected="selected='selected'" ;}else{ $selected="";}
								 echo '<option '.$selected.' value="'.$agence->agence_ident.'" >'.$agence->agence_lib .'   |    <small>'.$agence->adresse1 .'</small></option>';
														}
							 }
							 ?>
							 
							 </select>
							 
							 <div class="pl-10 pr-10 pt-10 pt-10" style="min-height:120px" >
 							 <b>{{__('msg.Agency')}} :</b>  <span id="lib"></span><br>
							 <b>{{__('msg.Address')}} :</b> <span id="adresse"></span><br>
							  <span id="zip"></span> <span id="ville"></span><br>
							 <b>{{__('msg.Country')}} :</b> <span id="country"></span>
							 </div>
							 
							 </div>	

							 </div>	
							 
							 </div>		<!-- agency 1-->					 

							 <div id="agency2"  style="display:none"  >
 							 <h5>{{__('msg.Removal of address')}}</h5>
							 <div class="row pt-10 pb-20">
							 
							 <div class="col-md-8">
							 
							 <select class="form-control mb-20"  id="adresse_id" onchange="setadresse();changing(this)">
							 <option></option>
							 <?php $i=0;
							  foreach($adresses as $adresse)
							 { $i++; if($i==1){$selected="selected='selected'";}else{$selected='';}
								 echo '<option  '.$selected.'  value="'.$adresse->id.'" >'.$adresse->nom .'   |    <small>'.$adresse->adresse1 .'</small></option>';
								 
							 } 
							 ?>
							 
							 </select>
							 <div style="min-height:120px">
							<?php  
							foreach($adresses as $adresse)
							 { ?>
							 <div class="pl-10 pr-10 pt-10 pt-10 adresses" style="display:none" id="adresse-<?php echo $adresse->id;?>" >
 							 <b>{{__('msg.Agency')}} :</b>  <span  ><?php echo $adresse->nom; ?></span><br>
							 <b>{{__('msg.Address')}} :</b> <span  ><?php echo $adresse->adresse1; ?> <?php echo $adresse->adresse2; ?></span><br>
							  <span  ><?php echo $adresse->zip; ?></span> <span id="ville"><?php echo $adresse->ville; ?></span><br>
							 <b>{{__('msg.Country')}} :</b> <span  >
							 <?php 
							 if($adresse->pays_code=='FR'){echo 'France';}   
							 if($adresse->pays_code=='PL'){echo 'Pologne';}   
							 if($adresse->pays_code=='GF'){echo 'Guyane française';}   
							 
							 ?>
							 </span>
							 </div>
							 
							 
							 </div>
							
							<?php } ?>
							 </div>	
							
							<div  class="col-md-8 pl-20 pt-10">
							<label><b> {{__('msg.Gross weight')}}</b></label>
							<input type="number" step="0.01" min="0.01" class="form-control" style="width:110px" ></input> g
							</div>
							 
							 </div>		

							 
							 </div>							 

								<button   onclick="valider()"  type="button"   class="pull-right btn btn-primary btn-icon-split ml-20 mt-10 mb-20" >
                                        <span class="icon text-white-50">
                                            <i class="fas fa-save"></i>
                                        </span>
                                        <span  style="width:120px" class="text" >{{__('msg.Validate')}}</span>
                                    </button> 

									
                                </div>
                            </div>

                       

                        </div>

						
<?php

$E_CmdesAff=DB::table('cmde_aff_e')->where('cl_ident',$user['client_id'])->where('statut','panier')->get();
$E_CmdesLab=DB::table('cmde_lab_e')->where('cl_ident',$user['client_id'])->where('statut','panier')->get();
$E_CmdesRMP=DB::table('cmde_rmp_e')->where('cl_ident',$user['client_id'])->where('statut','panier')->get();

$count_aff =count($E_CmdesAff);
$count_lab =count($E_CmdesLab);
$count_rmp =count($E_CmdesRMP);
$count= $count_aff + $count_lab + $count_rmp;
?>
                        <div class="col-lg-5 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.My Models')}} <?php echo '('.$count.')'; ?></h6>
                                </div>
                                <div class="card-body" style="min-height:200px">
 
								<?php  if($count>0) { ?> 
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
								<?php } //count total ?>
								
                                </div><!-- card body -->
                            </div>

 

                        </div>
                    </div>
					
					
<script>

 $(document).ready(function () {
    $('.box').click(function(e) {

        $('.box').removeClass('active');

        var $parent = $(this) ;
        $parent.addClass('active');
        e.preventDefault();
    });
});

function details()
	{ 
	var agence = $('#agence_id').val() ;
	var _token = $('input[name="_token"]').val();
		 $('#lib').html( '');
		 $('#adresse').html( '');
		 $('#ville').html( '');
		 $('#zip').html( '');
		 $('#country').html('');
	$.ajax({
       url: "{{ route('agence') }}",
       method: "POST",
       data: {id: agence  , _token: _token } ,
       success: function (data) {
		data=JSON.parse(data);
		 $('#lib').html( data.agence_lib);
		 $('#adresse').html( data.adresse1);
		 $('#ville').html( data.ville);
		 $('#zip').html( data.zip);
		 var pays="";
		 if(data.pays_code=='GF'){pays="Guyane française";}
		 if(data.pays_code=='PL'){pays="Pologne";}
		 if(data.pays_code=='FR'){pays="France";}
		 $('#country').html(  pays );

       }
	  });
	  
	  
	}			
	   function toggle(className, displayState){
            var elements = document.getElementsByClassName(className);
            for (var i = 0; i < elements.length; i++){
                elements[i].style.display = displayState;
				var index=elements[i].title;
             }
			 return   parseInt(elements[0].title) ;
        }
		
function setadresse	(){
 var adresse = $('#adresse_id').val() ;
 toggle('adresses','none');
 $('#adresse-'+adresse).show( );
	
	
}

/*
  function changing(elm) {
            var champ = elm.id;
            var val = document.getElementById(champ).value;
             //if ( (val != '')) {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('orders.updating') }}",
                method: "POST",
                data: {order: <?php // echo $orderid; ?>, champ: champ, val: val, _token: _token},
                success: function (data) {
   
                }
            });

        }
*/

var mode="collect";
  function valider() {
             var _token = $('input[name="_token"]').val();
			 var agence =null;
			 var adresse =null;
			 if(mode=='collect'){
			  agence = $('#agence_id').val();
			 }else{
			  adresse = $('#adresse_id').val();	 
			 }
	 
              var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('validatemodels') }}",
                method: "POST",
                data: { agence:agence,adresse:adresse,  _token: _token},
                success: function (data) {
				
				
				
	                    $.notify({
                        message: 'Commande passée avec succès',
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
				location.href="{{ route('home')}}";
							   }, 3000);  //3 secds				
				
                }
            });

        }


<?php if($agence_defaut>0){?>
//init default
details();
<?php }?>
</script>					
					

@endsection
