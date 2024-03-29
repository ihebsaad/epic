<script async src="//book.timify.com/widget/widget.min.js" id="timify-widget" data-position="flexible" >
</script>
@extends('layouts.back')
 
 @section('content')
<style>
.card-body{min-height:300px;}
.timify-button{
	text-align:center;
	background-color:#cb3b43;
	color:white;
	font-weight:600;
	width:120px;
	height:40px;
	line-height:40px;
	border-radius:10px;
	cursor:pointer;
 }
 .timify-button:hover{
 background-color:#b1343b;
  
  border:1px solid black;

 }
 
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
 							 <h5 style="color:black">{{__('msg.Choose your delivery mode')}}</h5>
							 <div class="row pt-10 pb-20">
							 <div class="col-md-4 box pt-20 pl-20 pb-20 pr-20 ml-10 mb-10 active"  onclick="$('#agency1').show('slow');$('#agency2').hide('slow');$('#valid1').show();$('#valid2').hide();details();mode='collect'">
								<center>  {{__('msg.Self-Delivery')}} <div class="clearfix"></div>
								<img src="{{ URL::asset('public/img/box.png')}}" style="width:80px" class="mt-20"/></center>
							 </div>
							 <div class="col-md-4 box pt-20 pl-20 pb-20 pr-20 ml-10 mb-10" onclick="$('#agency1').hide('slow');$('#agency2').show('slow');$('#valid1').hide();$('#valid2').show();mode='trans'">
								<center>  {{__('msg.Carrier')}} <div class="clearfix"></div>
								<img src="{{ URL::asset('public/img/truck.png')}}" style="width:100px"/></center>
								
							 </div>
							 </div>
							 <div id="agency1">
								 <h5 style="color:black">{{__('msg.Delivery address')}}</h5>
								 <div class="row pt-10 pb-10">
									 
									 <div class="col-md-8">
										 
										 <select class="form-control mb-10" style="" id="agence_id" onchange="details();/*changing(this)*/">
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
										 
										 <div class="pl-10 pr-10 pt-10 pt-10" style="min-height:100px" >
											 <b style="color:black">{{__('msg.Sales office')}} :</b>  <span id="lib"></span><br>
											 <b style="color:black">{{__('msg.Address')}} :</b> <span id="adresse"></span><br>
											  <span id="zip"></span> <span id="ville"></span><br>
											 <b style="color:black">{{__('msg.Country')}} :</b> <span id="country"></span>
										 </div>
										 
									 </div>	

								 </div>	
								 
							 </div>		<!-- agency 1-->					 

							 <div id="agency2"  style="display:none"  >
								 <h5 style="color:black">{{__('msg.Pick-up address')}}</h5>
								 <div class="row pt-10 pb-10">
									 
									 <div class="col-md-8">
									 
										 <select class="form-control mb-10"  id="adresse_id" onchange="setadresse();/*changing(this)*/">
										 <option></option>
										 <?php $i=0;
										 
										  foreach($adresses as $adresse)
										 {
											 $i++; if($i==1){$selected="selected='selected'";}else{$selected='';}
											 echo '<option  '.$selected.'  value="'.$adresse->id.'" >'.$adresse->adresse_nom .'   |    <small>'.$adresse->adresse1 .'</small></option>';
											 
										 } 
										 ?>
										 
										 </select>
										 <div style="min-height:100px">
											<?php  
											foreach($adresses as $adresse)
											 { ?>
											 <div class="pl-10 pr-10 pt-10 pt-10 adresses" style="display:none" id="adresse-<?php echo $adresse->id;?>" >
												 <b style="color:black">{{__('msg.Sales office')}} :</b>  <span   ><?php echo $adresse->adresse_nom; ?></span><br>
												 <b style="color:black">{{__('msg.Address')}} :</b> <span   ><?php echo $adresse->adresse1; ?> <?php echo $adresse->adresse2; ?></span><br>
												  <span  ><?php echo $adresse->zip; ?></span> <span id="ville"><?php echo $adresse->ville; ?></span><br>
												 <b style="color:black">{{__('msg.Country')}} :</b> <span  >
												 <?php 
												 if($adresse->pays_code=='F'){echo 'France';}   
												 if($adresse->pays_code=='PL'){echo 'Pologne';}   
												 if($adresse->pays_code=='FO'){echo 'Guyane française';}   
												 
												 ?>
												 </span>
											 </div>
											 
											<?php } ?>

										 </div>
										
									 </div>	
									
		 
								 </div>		

								<div  class="col-md-8 pl-20 pt-10">
								<label><b> {{__('msg.Recipient Phone')}}*</b></label>
								<input type="number"   class="form-control" style="width:250px" pattern=".{10,10}" value="{{ $user->mobile }}"  id="phone" onchange="verif2();" ></input>
								</div>
								
								<div  class="col-md-8 pl-20 pt-10">
								<label><b> {{__('msg.Recipient Email')}}*</b></label>
								<input type="email"   class="form-control" style="width:250px"   value="{{ $user->email }}" id="email" onchange="verif2();"  ></input>
								</div>								 
								 
								 <div  class="col-md-8 pl-20 pt-10">
								<label><b> {{__('msg.Number of packages')}}</b></label>
								<input type="number" step="1" min="1" class="form-control" style="width:110px" value="1" id="colis" name="colis" onchange="verif2();" ></input> 
								</div>						 

								 <div  class="col-md-8 pl-20 pt-10">
								<label onclick="showsize()" > 
								<input type="checkbox"   checked  id="size" name="size" ></input>  {{__('msg.Standard size package')}} <small>(L + l + H < 100cm)</small> </label>
								</div>	
								<div class="row col-md-10"  id="sizes"  style="display:none">
								
								<div class="col-md-4">
								<label>Longeur en cm*</label>
								<input type="number" step="1" min="1" class="form-control" style="width:90px" value="10" id="longeur" name="longeur" onchange="verif2();" ></input> 
								</div>
								<div class="col-md-4">
								<label>Largeur  en cm*</label>
								<input type="number" step="1" min="1" class="form-control" style="width:90px" value="10" id="largeur" name="largeur" onchange="verif2();" ></input> 							
								</div>
								<div class="col-md-4">
								<label>Hauteur  en cm*</label>
								<input type="number" step="1" min="1" class="form-control" style="width:90px" value="10" id="hauteur" name="hauteur" onchange="verif2();" ></input> 
															
								</div>
								
								</div>							 
								 
							 
							 </div>							 
 

							<div  class="col-md-8 pl-20 pt-10">
							<label><b> {{__('msg.Gross weight')}}*</b></label>
							<input onchange="verif1();verif2();" onmouseleave="verif1();verif2();" type="number" step="0.01" min="0.01" class="form-control" style="width:110px" value="0" id="poids" ></input> g
							</div>

						
							<div  class="col-md-8 pl-20 pt-10 mb-20">
								<div class="timify-button" data-account-id="5ec78f0496771d12228df890"   >Réserver</div> 			
							</div>
						
							
								<button  id="valid1" onclick="valider()" disabled type="button"   class="pull-right btn btn-primary btn-icon-split ml-20 mt-20 mb-20" >
                                        <span class="icon text-white-50">
                                            <i class="fas fa-save"></i>
                                        </span>
                                        <span  style="width:120px" class="text" >{{__('msg.Validate')}}</span>
                                    </button> 


								<button  id="valid2" onclick="validerliv()" disabled style="display:none" type="button"   class="pull-right btn btn-primary btn-icon-split ml-20 mt-20 mb-20" >
                                        <span class="icon text-white-50">
                                            <i class="fas fa-save"></i>
                                        </span>
                                        <span  style="width:120px" class="text" >{{__('msg.Validate')}}</span>
                                    </button> 									
                                </div>
                            </div>

                       

                        </div>

						
<?php

$E_CmdesAff=\App\Cmde_aff_e::where('cl_ident',$user['client_id'])->where('statut','panier')->get();
$E_CmdesLab=\App\Cmde_lab_e::where('cl_ident',$user['client_id'])->where('statut','panier')->get();
$E_CmdesRMP=\App\Cmde_rmp_e::where('cl_ident',$user['client_id'])->where('statut','panier')->get();

$count_aff =count($E_CmdesAff);
$count_lab =count($E_CmdesLab);
$count_rmp =count($E_CmdesRMP);
$count= $count_aff + $count_lab + $count_rmp;
?>
                        <div class="col-lg-5 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.My Cart')}}</h6>
                                </div>
                                <div class="card-body" style="min-height:200px" id="panier">
 
 								<?php  if($count>0) {?> 
  								
								<?php	if($count_aff>0) {?>
								<b >{{__('msg.Refining')}}: <?php echo '('.$count_aff.')'; ?> </b> 
 								<div class="mt-10" style="font-size:12px;list-style-type: none; ">
								<?php foreach ($E_CmdesAff as $cmd)
								{								
								$cmdid=$cmd->cmde_aff_ident;
								$lignes=\App\Cmde_aff_l::where('cmde_aff_e_ident',$cmdid)->where('statut','panier')->get();
								$poids = $or= $argent= $platine= $palladium = 0;
								
								foreach ($lignes as $ligne)
								{
									$poids=$ligne->cmde_aff_poids_lot.'g';	
									$or=$or+$ligne->cmde_estim_titre_au;	
									$argent= $ligne->cmde_estim_titre_ag;	
									$platine= $ligne->cmde_estim_titre_pt;	
									$palladium= $ligne->cmde_estim_titre_pd;	
									$nom_modele= $ligne->nom_modele;	
									$estimation_prix= $ligne->estimation_prix;	
									if($or >0){$or=  __('msg.Gold') .': '. number_format ( $or , 2).'g';}else{$or='';}
									if($argent >0){$argent= __('msg.Silver') .': '.  number_format ( $argent , 2).'g';}else{$argent='';}
									if($platine >0){$platine= __('msg.Platinum') .': '. number_format ( $platine , 2).'g';}else{$platine='';}
									if($palladium >0){$palladium= __('msg.Palladium') .': '.  number_format ( $palladium , 2).'g';}else{$palladium='';}
								echo '<li>'.$nom_modele.'      '.$poids.'      '.number_format($estimation_prix,2,'.',',').'€  ';?>  <a  style="margin-left:20px" class="delete fm-close"  onclick="return confirm('Êtes-vous sûrs de vouloir supprimer ce modèle ?')"  href="<?php echo url('/deletemodel/'.$cmdid);?>"><span class="fa  fa-times-circle"></i></a> <?php echo '</li>';
								echo '<li> '.$or.'      '.$argent.'      '.$platine.'      '.$palladium.'</li>';
								echo ' <hr style=" margin-bottom:10px;margin-top:10px"> ';
								}
								
								}
  								?>
								</div>
								 
								 	
 								
								<?php  
								 }
								 
								if($count_lab>0) {?>
								<b>{{__('msg.Laboratory')}}: <?php echo '('.$count_lab.')'; ?></b><br>
 								<div class="mt-10" style="font-size:12px;list-style-type: none;   ">
								<?php $poids=0; $qte=0; ?>
								<?php foreach ($E_CmdesLab as $cmd) 
								{
								$cmdid=$cmd->cmde_lab_ident;						 
 								$lignes=\App\Cmde_lab_l::where('cmde_lab_e_ident',$cmdid)->where('statut','panier')->get();
								 $or= $argent= $platine= $palladium = 0;
								foreach ($lignes as $ligne)
								{  
 									$or=$or+$ligne->titrage_au;	
									$argent=$argent+$ligne->titrage_ag;	
									$platine=$platine+$ligne->titrage_pt;	
									$palladium=$palladium+$ligne->titrage_pd;	
									$nom_modele= $ligne->nom_modele;	
									$qte= $ligne->qte;	
									$poids= $ligne->poids;	
									$estimation_prix= $ligne->estimation_prix;	
									
									if($or >0){$or=  __('msg.Gold');}else{$or='';}
									if($argent >0){$argent= __('msg.Silver')  ;}else{$argent='';}
									if($platine >0){$platine= __('msg.Platinum') ;}else{$platine='';}
									if($palladium >0){$palladium= __('msg.Palladium') ;}else{$palladium='';}
								echo '<li>'.$nom_modele.'        '.$qte.'p        '.number_format($estimation_prix,2,'.',',').'€  ';?>  <a  style="margin-left:20px" class="delete fm-close"  onclick="return confirm('Êtes-vous sûrs de vouloir supprimer ce modèle ?')"  href="<?php echo url('/deletemodellab/'.$cmdid);?>"><span class="fa  fa-times-circle"></i></a> <?php echo '</li>';
								//echo '<li> '.$or.'      '.$argent.'      '.$platine.'      '.$palladium.'</li>';
								echo '<hr style=" margin-bottom:10px;margin-top:10px">';
									
								}
								}
								?>
 					 
								</div>
 								<?php }
								
								
								if($count_rmp>0) {?>								
								<b>{{__('msg.Buyback of precious metals')}}: <?php echo '('.$count_rmp.')'; ?></b><br>
 								<div class="mt-10" style="font-size:12px;    list-style-type: none;">
								<?php foreach ($E_CmdesRMP as $cmd) 
								{
								$cmdid=$cmd->cmde_rmp_ident;						 									
 								$lignes=\App\Cmde_rmp_l::where('cmde_rmp_e_ident',$cmdid)->where('statut','panier')->get();
								foreach ($lignes as $ligne)
								{  									
 								 $poids=$ligne->cmde_rmp_poids;
								 $estimation_prix= $ligne->estimation_prix;	
  								  	
								 $nom_modele= $ligne->nom_modele;	
								 echo '<li>'.$nom_modele.'         '.$poids.'g ';?>  <a  style="margin-left:20px" class="delete fm-close"  onclick="return confirm('Êtes-vous sûrs de vouloir supprimer ce modèle ?')"  href="<?php echo url('/deletemodelrmp/'.$cmdid);?>"><span class="fa  fa-times-circle"></i></a> <?php echo '</li>';
								echo '<li> '.__('msg.Estimation').':  '.number_format($estimation_prix,2,'.',',').'€  </li>';
								echo '<hr style=" margin-bottom:10px;margin-top:10px">';

								 }
								 
								 }
								?>
 								 							
								</div>
 								<?php } ?>
								
 
								<?php } //count total ?>
 
								
                                </div><!-- card body -->
                            </div>

 

                        </div>
                    </div>
	

 <!--   Modal-->
  <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color:#0054f3">{{__('msg.Order submitted successfully')}}</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"  id="result">
		<b>Votre demande à bien était transmise.<br>Un email de confirmation sera envoyé dans les plus brefs délais.</b>
		</div>
        <div class="modal-footer">
          <button   class="btn btn-secondary" type="button" data-dismiss="modal">{{__('msg.Close')}}</button>
          <a href="{{route('home')}}" class="btn btn-success" type="button"  >{{__('msg.Home')}}</a>
         </div>
      </div>
    </div>
  </div>	
<style>
</style>
<script>
var mode="collect";

function verif1()
{
  var poids = $('#poids').val();
	if(poids>0   ){
	  $("#valid1").prop('disabled', false);
	
	}else{
	   $("#valid1").prop('disabled', true);

	}
}

function verif2()
{
	var poids = $('#poids').val();
    var phone = $('#phone').val();
	var email = $('#email').val();
	var longeur = $('#longeur').val();
	var largeur = $('#largeur').val();
	var hauteur = $('#hauteur').val();
	
	if(poids>0 && phone.length==10  && email!= '' && longeur!= 0 && largeur!= 0 && hauteur!=0 ){
	  $("#valid2").prop('disabled', false);
	
	}else{
	   $("#valid2").prop('disabled', true);

	}
}
function showsize(){
   if ($('#size').is(':checked'))
	{ 
	$('#sizes').hide('slow') ;  
	}
	else{
	$('#sizes').show('slow') ;
	}
	 
}
setadresse();
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
	
	/* var tel= $('#agence_id').find('option:selected').attr('title');
	 var email= $('#agence_id').find('option:selected').attr('target');
		$('#phone').val(tel);
		$('#email').val(email);*/
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
		 if(data.pays_code=='FO'){pays="Guyane française";}
		 if(data.pays_code=='PL'){pays="Pologne";}
		 if(data.pays_code=='F'){pays="France";}
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

  function valider() {
             var _token = $('input[name="_token"]').val();
			 var agence =0;
			 var adresse =0;
			 if(mode=='collect'){
			  agence = $('#agence_id').val();
			 }else{
			  adresse = $('#adresse_id').val();	 
			 }
	 
              var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('validatemodels') }}",
                method: "POST",
                data: { agence:agence,adresse:adresse,mode:mode,  _token: _token},
                success: function (data) {
				
				
				
				$('#successModal').modal('show') ;
			 	$('#counter').html('') ;
			 	$('#panier').modal('show') ;

				/*
				
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
				*/
                }
            });

        }

  function validerliv() {
             var _token = $('input[name="_token"]').val();
			 var agence =0;
			 var adresse =0;


	 
			 if(mode=='collect'){
			  agence = $('#agence_id').val();
			 }else{
			  adresse = $('#adresse_id').val();	 
			 }
              var _token = $('input[name="_token"]').val();
			  
			  var poids = $('#poids').val();
			  var phone = $('#phone').val();
			  var email = $('#email').val();
			  var longeur = $('#longeur').val();
			  var largeur = $('#largeur').val();
			  var hauteur = $('#hauteur').val();
 
	console.log('agence:'+agence+' adresse:'+adresse+' poids:'+poids+' mode:'+mode+ ' phone:'+phone+ ' email:'+email+' longeur:'+longeur+' largeur:'+largeur+ ' hauteur:'+hauteur);
           $.ajax({
                url: "{{ route('validatemodelsliv') }}",
                method: "POST",
                data: { agence:agence,adresse:adresse,poids:poids ,mode:mode,  phone:phone, email:email, longeur:longeur, largeur:largeur, hauteur:hauteur, _token: _token},
                success: function (data) {
				  data=JSON.parse(data);
 		 		 if(data.truck_number!=0){
				//	if(parseInt(data)>0){
				$('#result').html('<b>Votre demande à bien était transmise.<br>Un email de confirmation sera envoyé dans les plus brefs délais.</b><br> Vous pouvez suivre votre colis DHL Express avec la référence:<b style="color:#36b9cc;margin-left:20px;">'+data.truck_number+'</b>');
				$('#successModal').modal('show') ;	
				}else{
			    $('#result').html("<b>Problème lors de la demande de Livraison.</b><br><small>'+data.errors+'</small>");
			    $('#successModal').modal('show') ;	

				}
 

				/*
				
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
				*/
                }
            });

        }
<?php if($agence_defaut>0){?>
//init default
details();
<?php }?>
</script>					
					

@endsection
