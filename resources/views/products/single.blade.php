

@extends('layouts.back')
 
 @section('content')
<?php 
use App\Http\Controllers\HomeController ;
 if($type==101){$Type=  __('msg.Half Products') ; $link=route('products');}
 if($type==102){$Type=  __('msg.Galvano') ; $link=route('galvano');}
 if($type==103){$Type=  __('msg.Findings') ; $link=route('findings');}
 if($type==104){$Type= __('msg.Jewelry') ; $link=route('jewelry');}
  $Fam1 =DB::table('type_famille')->where('fam1_id',$famille1)->where('type_id',$type)->first();
 $libelle=$Fam1->LIBFAM1;
 //dd($produit);
  $titre= $produit->LIBFAM1.' '.$produit->LIBFAM2 .' '.$produit->LIBFAM3;
  
  $img=''; $image=DB::table('photo')->where('photo_id',$produit->photo_id)->first();
	 if(isset($image)){ $img=trim($image->url);}
  
 	$alliagesp= HomeController::alliage1($type,$famille1);			  
  //alliage1
  $alliages=HomeController::referentielalliage();
				  
 $user = auth()->user();  
$alliage_user=$user['alliage'];
if($produit->choix_etat>0){
$etats= HomeController::referentieletat();
}
$disabled='';
$order = DB::table('orders')->where('status','cart')->where('user',$user->id)->first();
if ($order!=null){
 $orderid=$order->id;
$amount=$order->amount   ;
$comp_amount=$order->comp_amount   ;
$weight=$order->weight   ;
 $gold=$order->gold   ;
 $silver=$order->silver   ;
$palladium=$order->palladium   ;
$platine=$order->platine   ;
	
 $products= DB::table('products')->where('orderid',$orderid)->orderBy('id','asc')->get();
		$count=DB::table('products')->where('orderid',$orderid)->where('libelle',trim($titre))->count();
		if($count==1){$disabled='disabled';}
}else{
$orderid=0;
$amount=0;
$comp_amount=0;
$weight=0;
 $gold=0;
$silver=0;
$palladium=0;
$platine =0;
$products=array();
}
 ?>
 <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.Home')}}</a></li>
    <li class="breadcrumb-item"><a href="<?php echo $link;?>"><?php echo $Type;?></a></li>
    <li class="breadcrumb-item "  ><a href="<?php echo route('catalog',['type'=>$type,'famille1'=>$famille1]);?>"  ><?php echo $libelle;?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $titre;?></li>
  </ol>
</nav>
<h2> {{__('msg.Product Page')}}</h2> 

 
	<div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-7 mb-4">

						 <div class="card shadow mb-4">
                                <div class="  ">
                                    <a href="#div01" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">								
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.Product details')}}</h6>
									</a>
                                </div>
                                <div id="div01" class="card-body">
								
								<div class="row">
									<div class="col-md-5  col-xs-12">
                                    <center><img style="max-height:180px"  src="<?php echo URL::asset('images/'.$img);?>" class="img-fluid pt-20" alt=""></center>
								
									</div>
									<div class="col-md-7 col-xs-12">
									<h5 id="title" class="pt-20 pl-10 pr-10 pb-20 text-info" style="font-weight:bold;"><?php echo $titre;?></h5>
									<?php if($product!= 'error') {?>
									<?php $id_unite= $product[0]['UNIT_IDENT'];
									$unite=DB::table('unite')->where('UNIT_IDENT',$id_unite)->first();
									
									?>									
							 		 <input type="hidden" id="unite" value="<?php echo $unite->UNIT_LIB_COURT; ?>"   >

									
							 
									<?php $mesures= $product[0]['mesures'];
 									  if( $mesures[0]->MESURE1!='0.00' && $mesures[0]->MESURE2 !='0.00'    ){
										  
 									?>
									  
									 <div class="row pl-10 pb-10">
									 <label style="width:120px" class=" pt-10"><b><?php   echo $product[0]['NAT_MESURE1'] ; ?></b></label>
 
                                      <select onchange=";details();showmesure2();$('#infos').show('slow');"  id="mesure1" class="form-control ml-20" style="max-width:80px;"  >
  									   <?php
 									   foreach ($mesures as $mesure) {
									    //dd($mesure->MESURE2[0]->MESURE2 );
									   ?>
									  <option   value="<?php 	echo $mesure->MESURE1   ; ?>">   <?php 	echo $mesure->MESURE1  ; ?> </option>
									   <?php } ?>	
									   </select>  <span class="pt-10 pl-10"><?php if(isset($product[0]['unite1'])){ echo $product[0]['unite1']; } ?></span>

  									</div>	
									 <div class="row pl-10">									
									 <label style="width:120px" class="  pt-10"><b><?php   echo $product[0]['NAT_MESURE2'] ; ?></b></label>
 									<?php if($product[0]['NAT_MESURE2']!=''){?>
                                      <select onmouseover="showmesure2()"  id="mesure2" class="form-control ml-20" required style="max-width:80px;" onchange=" $('#infos').show('slow');details();" >
									  <option></option>
  									   <?php $i=0; $selected='';$j=-1;
 									   foreach ($mesures as $mesure) {
										   $i++; if($i==1){$selected='selected ="selected"';}else{$selected='';}
										   
 									   foreach ($mesure->MESURE2 as $m2) {
									   $j++; //dd($mesure->MESURE2[0]->MESURE2 ); 
									   ?>
									  <option  title="<?php echo $j; ?>"     <?php echo $selected ;?> class="mesure2 mesure-<?php echo $mesure->MESURE1; ?>" value="<?php 	echo  $m2->MESURE2  ; ?>">   <?php 	echo $m2->MESURE2  ; ?></option>
									   <?php } ?>	
									   <?php } ?>	
									  </select> <span class="pt-10 pl-10"><?php if(isset($product[0]['unite2'])){ echo $product[0]['unite2'];}  ?></span>
									   <?php }else{ ?>
										<input id="mesure2"	type="hidden" value="0.00"		/>						  
										<?php } ?>
  									</div>									
									  <?php }else{ ?>
										  
									<input type="hidden" id="mesure1" value="0.00" />	  
									<input type="hidden" id="mesure2" value="0.00" />	  
									 <?php } ?>
									  
									 <?php } 
									 ?>

 									<div class="row pl-10 mt-10">
									 <label class="mr-10 pt-10">{{__('msg.Alloy')}} :</label>
									 <select class="form-control" id="alliage_id" style="max-width:270px;" onchange="changing();$('#option').show('slow');$('#infos').show('slow');details();">
 										<?php
										
										

 								 		foreach ($alliages as $alliage)
										{
										foreach ($alliagesp as $alliagep)
										{
											if( $alliage->id ==  $alliagep->id ) 
										{
							 
									 if($alliage_user==$alliagep->id  ){$selected = 'selected="selected"';}else{$selected = '';} 
									echo '<option  '.$selected.' value="'.$alliage->id .'">'.$alliage->libelle. '</option>';
								
									}
									}
									}
									 
									?>
									 
									 </select>
 	 
									</div>

							
		
 							 </div>	<!---- colonne 2----->								
							 </div>
								
					
								
								<?php 
									$complements= $product[0]['complements'];
									 //dd($complements[0]->complement_id);
									 if($complements[0]->complement_id!=null){ 
									 // echo json_encode($complements);

									 ?>
							        <div class="row mb-10 mt-20 pl-10 ">
										 <label class=" pt-10 pr-10">OPTION :</label>
										  <select class="form-control" id="comp_id"  disabled style="width:200px"  onchange="$('#option').show('slow');$('#infos').show('slow');details();">
									<?php	
									foreach($complements as $comp)
										 { 
										 $Comp=DB::table('complement_dp')->where('COMPLEMENT_DP_IDENT',$comp->complement_id)->first();
											 echo ' <option value="'.$comp->complement_id.'">'.$Comp->COMPLEMENT_LIB.'</option>';
										 }
										?> </select>
										 <input onchange='$("#comp_id").prop("disabled", false);$("#option").show("slow") ;details()' type="number" min="0" class="ml-10 form-control" id="comp_val" placeholder="mm" style="width:80px;float:right;margin-bottom:20px;" onchange='$("#comp_id").prop("disabled", false);'></input>
 											

                                    <?php if($produit->choix_etat>0){ ?>
 
                                     
                                    <select id="etat_id" class="form-control ml-10" placeholder="Etat"  style="width:120px;margin-left:80px">
                                    <?php foreach($etats as $etat){?><option value="<?php echo $etat->id;?>">
                                    <?php echo $etat->libelle;?> </option> <?php } ?> 
                                    </select>
                                      
                                 
                                    <?php }else{ ?>
                                    <input id="etat_id" type="hidden"  value="0" ></input>
                                    <?php }  ?>



											
										 </div>	
							 <div id="option" style="display:none;">
 							  <div class="row pl-10   ">
							  <label class="  ">Prix option :</label> <label class="ml-10 mr-10" id="tprix" style="font-weight:bold"></label><label class="ml-10 mr-10" id="tmodeid" style="font-weight:bold"></label><label class="ml-10 mr-10  ">Mini :</label><label class="ml-10 mr-10" id="tmini" style="font-weight:bold"></label> €
							  </div>
							  <div class="row pl-10   ">							  
 							  <label class="  ">Façon option :</label><label class="ml-10 mr-10" id="tmontant"  style="font-weight:bold"></label> €
							  </div>
							  </div>								 
								<?php }
									else{ ?>
										<input type="hidden" id="comp_id" value="0" />
										<input type="hidden" id="comp_val" value="0" />
								<?php	} ?>
								
<hr>
	
									 <div class="row mb-10 mt-20 pl-10">
									 <label class="pt-10 pr-10">{{__('msg.Quantity')}} :</label><input <?php if($unite->UNIT_LIB_LONG=='METRE'){?>    step="0.01"  <?php }else{ ?>   step="1"  <?php  } ?> value="<?php echo $product[0]['valeur_defaut']; ?>" onchange="details()" id="qte" type="number"  style="width:95px" value="0"    class="form-control" placeholder=""   /></input><label class="pt-10 pr-10 pl-10"><b><?php  echo $unite->UNIT_LIB_LONG; ?></b></label><label class="  ml-50 pt-10">Poids Total :</label><label class="ml-10 mr-10 pt-10" id='poidst' style="font-weight:bold;"></label> 

									</div>	
<hr>							
							  <div id="infos"  >		

							  <div class="row pl-10   ">
							  <label class=" ">{{__('msg.Unit weight')}} :</label>
							  <label class="pl-10 mr-10 " style="font-weight:bold" id="poids_u"> </label> <label class="ml-10 mr-10">Prix :</label><label class="ml-10 mr-10" id="prix" style="font-weight:bold"></label><label class="ml-10 mr-10 " id="modeid" style="font-weight:bold"></label><label class="ml-10 mr-10">MINI :</label><label  id="mini" class="ml-10 mr-10" style="font-weight:bold"></label> €
							  <div class="col-md-2" id="prix"></div>
							  <input type="hidden" id="article" ></input>
							  </div>
							  
							  
							  <div class="row pl-10  ">
							  <label class="   " >Façon totale:</label><label class="ml-10 mr-10 " id="montant" style="font-weight:bold;min-width:20px"></label> €
							  </div>							
				   							 

							  <div class="row   "  >
 							  <div class=" " id="debits"><label id='labelm1' style="width:100px;display:none" class="metal text-center bg-gradient-warning">{{__('msg.Gold')}} : </label><span class="ml-10 mr-10 " style="font-weight:bold" id="debit_1"></span><label id='labelm2' style="width:100px;display:none" class="metal text-center bg-gradient-light"> {{__('msg.Silver')}} : </label><span class="ml-10 mr-10 " id="debit_2" style="font-weight:bold" ></span><label id='labelm3' style="width:100px;display:none" class="metal text-center bg-gradient-secondary"> {{__('msg.Platinum')}} : </label><span class="ml-10 mr-10 " id="debit_3" style="font-weight:bold" ></span><label id='labelm4' style="width:100px;display:none" class="metal text-center  bg-gray-500">  {{__('msg.Palladium')}} :  </label><span class="ml-10 mr-10 " id="debit_4" style="font-weight:bold"></span> </div>
							  </div>
							  	 </div>						 
					 
						      <div class="row mt-30" style=" height:60px">
								<button <?php echo $disabled ;?>  type="button" style="position:absolute;right:50px " class="pull-right btn btn-primary btn-icon-split   ml-50 mt-10 mb-20">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-shopping-cart"></i>
                                        </span>
                                        <span class="text" onclick="addproduct()">{{__('msg.Add to cart')}}</span>
                                    </button>
                                </div>
								
								
								
                                </div>
                            </div>
 

                       

                        </div>

                        <div class="col-lg-5 mb-4">

                             <div class="card shadow mb-4">
                                <div class="  ">
                                    <a href="#div2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">								
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.My order')}}</h6>
									</a>
                                </div>
								<style>
								th{border:1px solid lightgrey;}
								</style>
                                <div id="div2" class="card-body">
									<table class="mb-10">
									<tr class="bg-info text-white mb-20  " style="height:40px;border:1px solid lightgrey;">
									<th class="pl-10 " >Article</th><th style="text-align:center"class="pl-10 pr-10" >Qté</th><th style="text-align:center" class="pl-10 pr-10">Poids</th><th class="pl-10 pr-10" style="text-align:center"><span class="fa fa-trash-alt"></th>
									<?php foreach($products as $product){
									echo '<tr><td class="pl-10" style="font-size:12px">'.$product->libelle.'</td><td style="text-align:center;font-size:13px">'.$product->qte.' '.$product->unite.'</td><td style="text-align:center;font-size:13px">'.number_format($product->poids, 2).' g</td><td class="text-black" style="text-align:center;font-size:13px">';?>
									<a  class="delete fm-close"  onclick="return confirm('Êtes-vous sûrs de vouloir supprimer ce produit ?')"  href="{{action('ProductsController@deleteproduct', $product->id)}}"><span class="fa  fa-times-circle"></i></a>
									<?php echo '
									</td></tr>	';
	
									}?>
 									 <tr style="height:40px"><td></td><td></td><td></td><td></td></tr>
									<tr style="border-top:1px solid lightgrey;border-bottom:1px solid lightgrey;"><td><b class="text-info pl-10">Façon option</b></td><td style="text-align:center"></td><td colspan="2" style="text-align:center" class=" "><b> <?php echo $comp_amount .' € HT';?></b></td>	</tr>
									<tr style="border-top:1px solid lightgrey;border-bottom:1px solid lightgrey;"><td><b class="text-info pl-10">Poids total</b></td><td style="text-align:center"></td><td style="text-align:center" class=" " colspan="2"><b><?php echo  number_format($weight, 2) ;?> g</b></td>	</tr>
									<tr ><td><b class="pl-10 text-info">Façon totale</b></td><td style="text-align:center"></td><td style="text-align:center" class=" " colspan="2"><b><?php echo $amount ;?> € HT</b></td>	</tr>
									 									
									</table><br>
									<span class="mt-10 text-success " style="font-weight:bold" >METAUX FINS</span><br>
									<table class="pt-20 pm-20 pl-20 pr-20" style="border:none">
								    <tr style="height:20px; "><td    style="height:20px">{{__('msg.Gold')}}: </span></td><td><span><?php echo floatval($gold ) ;?> g</span></td></tr>
									<tr style="height:20px"><td   style="height:20px">{{__('msg.Silver')}} : </span></td><td><span><?php echo floatval($silver) ;?> g</span></td></tr>
									<tr style="height:20px"><td   style="height:20px">{{__('msg.Palladium')}} : </span></td><td><span><?php echo floatval($palladium) ;?> g</span></td></tr>
									<tr style="height:20px"><td     style="height:20px">{{__('msg.Platinum')}} : </span></td><td><span><?php echo floatval($platine) ;?> g</span></td></tr>
									</table>									
                                </div>
                            </div>

           

                        </div>
						
 				
   </div>

   <script>
   

   function changing() {
           val=$('#alliage_id').val();
             //if ( (val != '')) {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('users.updating') }}",
                method: "POST",
                data: {user: <?php echo $user->id; ?>, champ: 'alliage', val: val, _token: _token},
                success: function (data) {
        


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
		
	function showmesure2( ){
		 toggle('mesure2','none');
		  mesure=$("#mesure1").val();
         $("#mesure2").prop('disabled', false);
       //document.getElementsById('mesure2').disabled=false;
	 	var index=toggle('mesure-'+mesure,'block');
		console.log(index);
		//alert(index);
		//$("#mesure2").prop('selectedIndex', index) ;
		 //document.getElementById("mesure2").selectedIndex = index;
		 document.getElementById("mesure2").selectedIndex = index+1;
 
	}	
 	
 
 
function details()
{ 
	        var _token = $('input[name="_token"]').val();
	        var mesure1 = parseFloat($('#mesure1').val());
	        var mesure2 = parseFloat($('#mesure2').val());
	        var alliage_id = parseInt($('#alliage_id').val());
	        var qte = parseFloat($('#qte').val());
	        var comp_id = parseInt($('#comp_id').val());
	        var comp_val = $('#comp_val').val() ;
			var debit1=0;var debit2=0;var debit3=0;	var debit4=0;
			var mini=0;	var minit=0;
			var montant=0;var montantt=0;
			var poids=0;
			var prix=0;var prixt=0;
			if(comp_val==''){comp_val=0;comp_id=0;}
				if(comp_val==0   ){
					$('#option').hide();
				}
            $.ajax({
                url: "{{ route('details') }}",
                method: "POST",
                data: {type:<?php echo $type; ?>,famille1:<?php echo $famille1;?> ,famille2: <?php echo $famille2;?>, famille3: <?php echo $famille3;?>,
				mesure1: mesure1,mesure2: mesure2,alliage_id: alliage_id,qte: qte,comp_id: comp_id,comp_val: comp_val, _token: _token},
                success: function (data) {
				console.log( 'poids_u : '+data.poids_u  +'produit :  '+data.produit+' prix : '+data.prix+'  '+' tarif : '+data.tarif) ;
				console.log(data);				
				
				poids=parseFloat(data.poids_u);
 				$('#poids_u').html( poids+' g' );
				poidst= poids * qte;
				poidst= poidst.toFixed(2);
				poidst= parseFloat(poidst);
 				$('#poidst').html(poidst +' g');
				 $('#produit').html( data.produit);
				 prix=parseFloat(data.prix[0].prix);
				 console.log(data.prix[0].prix);
				console.log(data.prix[0].tarif);
				 $('#prix').html(  prix);
				 //$('#modeid').html( data.prix[0].modeid);
				 montant=parseFloat(data.prix[0].montant *qte);
				 montantt=parseFloat(data.tarif[0].montant);
				 minit=parseFloat(data.tarif[0].mini);
				 mini=parseFloat(data.prix[0].mini);

			     if(montantt< minit){montantt=minit;}				 
				 if(montant< mini){montant=mini;}
				 if(montantt>0){montant=montant+montantt;}
				 montant= montant.toFixed(2);
				 montant= parseFloat(montant);
				 $('#montant').html(  montant);
				 $('#mini').html(mini );
				 debit1=data.prix[0].debit_1;
				 debit2=data.prix[0].debit_2;
				 debit3=data.prix[0].debit_3;
				 debit4=data.prix[0].debit_4;
				  $('#labelm1').hide(); $('#labelm2').hide(); $('#labelm3').hide(); $('#labelm4').hide();
				  $('#debit_1').html('');$('#debit_2').html('');$('#debit_3').html('');$('#debit_4').html('');
				  
				if(parseFloat(debit1)>0){ $('#labelm1').show(); $('#debit_1').html( debit1+' g');  } 
				if(parseFloat( debit2)>0){ $('#labelm2').show(); $('#debit_2').html( debit2+' g'); } 
				if(parseFloat( debit3)>0){ $('#labelm3').show(); $('#debit_3').html( debit3+' g'); } 
				if(parseFloat( debit4)>0){ $('#labelm4').show(); $('#debit_4').html( debit4+' g'); } 
 				 prixt=parseFloat(data.tarif[0].prix);
 				 $('#tprix').html(prixt );
				// $('#tmodeid').html( data.tarif[0].modeid);
				
				 $('#tmontant').html(montantt );
				 $('#tmini').html(minit);			

				if(parseFloat(data.prix[0].modeid) > 0){
				$.ajax({
                url: "{{ route('modelabel') }}",
                method: "POST",
                data: {id: data.prix[0].modeid  , _token: _token } ,
                success: function (data) {	
				$('#modeid').html( data);				 
                }
				});
				}
				
				if(parseFloat(data.tarif[0].modeid) > 0){
				$.ajax({
                url: "{{ route('modelabel') }}",
                method: "POST",
                data: {id: data.tarif[0].modeid  , _token: _token } ,
                success: function (data) {	
				$('#tmodeid').html( data);				 
                }
				});	
				}				
	
			
	
	
			}
		 });
}

		function addproduct (){
			var _token = $('input[name="_token"]').val();
	        var alliage = parseInt(  $('#alliage_id').val()) ;
	        var libelle = $('#title').text() ;
			var qte = parseFloat($('#qte').val());
			var unite =  $('#unite').val() ;
			var article =  $('#article').val() ;
			var mesure1 =  $('#mesure1').val() ;
			var mesure2 =  $('#mesure2').val() ;
			var comp_id =  $('#comp_id').val() ;
			var comp_val =  $('#comp_val').val() ;
			if(article!=''){article = parseInt(article);}else{article=0;}
			if(mesure1!=''){mesure1 = parseFloat(mesure1);}else{mesure1=0;}
			if(mesure2!=''){mesure2 = parseFloat(mesure2);}else{mesure2=0;}
			if(comp_val!=''){comp_val = parseFloat(comp_val);}else{comp_val=0;}
			if(comp_id!=''){comp_id = parseInt(comp_id);}else{comp_id=0;}
	        var montant = parseFloat(  $('#montant').text()) ;
	        var montant_compl =   $('#tmontant').text()  ;
			 if(montant_compl!=''){montant_compl = parseFloat(montant_compl);}else{montant_compl=0;}

	        var poids = parseFloat(  $('#poidst').text()) ;
 			
	        var or=   $('#debit_1').text()  ; if(or!=''){or = parseFloat( or.slice(0 , or.length-2));}else{or =0;}
	        var argent=   $('#debit_2').text()  ; if(argent!=''){argent = parseFloat(  argent.slice(0 , argent.length-2));}else{argent =0;}
	        var palladium=   $('#debit_3').text()  ; if(palladium!=''){palladium =parseFloat(  palladium.slice(0 , palladium.length-2));}else{palladium =0;}
	        var platine=   $('#debit_4').text()  ; if(platine!=''){platine = parseFloat( platine.slice(0 , platine.length-2));}else{platine =0;}

	         
		 if(qte >0 && montant>0 ){
            $.ajax({
                url: "{{ route('addproduct') }}",
                method: "POST",
                data: {type:<?php echo $type; ?>,famille1:<?php echo $famille1;?> ,famille2: <?php echo $famille2;?>, famille3: <?php echo $famille3;?>,user:<?php echo $user->id; ?>, libelle: libelle,
				qte: qte,unite:unite,article: article,montant: montant,montant_compl: montant_compl,poids: poids,or: or,argent: argent,palladium: palladium
				,platine: platine,alliage:alliage ,mesure1:mesure1,mesure2:mesure2,comp_id:comp_id,comp_val:comp_val , _token: _token},
                success: function (data) {
					location.reload();
				}
			});
			}else{
				alert('Modifier les données pour obtenir votre produit');
			}
			}
//http://localhost/Epic/single/101/1003/2003/3004
	details();
   </script>
@endsection					