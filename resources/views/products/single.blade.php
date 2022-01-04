

@extends('layouts.back')
 
 @section('content')
<?php 

/*
   $typeid =101;
 	 $articleid =1;
 	 $alliageid =34;
	 $qte =100;
	 $poids =100;
	 $id_cl =10099;
  DB::select("SET @p0='$typeid' ;");
 	   DB::select("SET @p1='$articleid' ;");
 	   DB::select("SET @p2='$alliageid' ;");
	   DB::select("SET @p3='$qte'  ;");
	   DB::select("SET @p4='$poids'  ;");
	   DB::select("SET @p5='$id_cl'  ;");
 
 	  $result=  DB::select ("  CALL `sp_fiche_produit_prix`(@p0,@p1,@p2,@p3,@p4,@p5); ");
	  dd($result);*/
use App\Http\Controllers\HomeController ;
 if($type==101){$Type=  __('msg.Semi finished Products') ; $link=route('products');}
 if($type==102){$Type=  __('msg.Electroplating') ; $link=route('galvano');}
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
//$alliage_user=$user['alliage'];
 $alliageuser=HomeController::alliage_defaut($type,$famille1);
$alliage_user = $alliageuser[0]->id ;
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
 
 	//	if($count==1){$disabled='disabled';}
		// type produit, produit id, alliage id, complément id, complément valeur.
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


$compls=DB::select ("CALL `sp_referentiel_complement`();");
$comps=array();
foreach($compls as $c){
	$comps[$c->id]['mini']=$c->mini;
	$comps[$c->id]['maxi']=$c->maxi;
	$comps[$c->id]['pas']=$c->pas;
 }
 
 //dd($comps);
 ?>
 <script>
 
    function toggle(className, displayState){
            var elements = document.getElementsByClassName(className);
            for (var i = 0; i < elements.length; i++){
                elements[i].style.display = displayState;
				var index=elements[i].title;
             }
			 return   parseInt(elements[0].title) ;
        }
		
 	function showmesure2( ){
		if($("#mesure2").val()!='0.00'){

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
	}	
	</script>
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
 
                                      <select onchange="showmesure2();details();$('#infos').show('slow');"  id="mesure1" class="form-control ml-20" style="max-width:80px;"  >
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
                                      <select    id="mesure2" class="form-control ml-20" required style="max-width:80px;" onchange=" $('#infos').show('slow');details();" >
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
									  <script>showmesure2();</script>
									   <?php }else{ ?>
										<input id="mesure2"	type="hidden" class="mesure2" value="0.00"	title=""	/>						  
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
								if (isset($product[0]['complements'])){
								$complements= $product[0]['complements'];
								
									 //dd($complements[0]->complement_id);
									 if($complements[0]->complement_id!=null){ 
									 // echo json_encode($complements);

									 ?>
							        <div class="row mb-10 mt-20 pl-10 ">
										 <label class=" pt-10 pr-10">{{__('msg.Option')}} :</label>
										  <select class="form-control" id="comp_id"  disabled style="width:200px"  onchange="$('#option').show('slow');$('#infos').show('slow');checkComp();details();">
									<?php	
									foreach($complements as $comp)
										 { 
										 $Comp=DB::table('complement_dp')->where('COMPLEMENT_DP_IDENT',$comp->complement_id)->first();
											 echo ' <option value="'.$comp->complement_id.'">'.$Comp->COMPLEMENT_LIB.'</option>';
										 }
										?> </select>
									 <input onchange='$("#comp_id").prop("disabled", false);$("#option").show("slow") ;details()' type="number" min="<?php echo $comps[$complements[0]->complement_id]['mini']?>"  max="<?php echo $comps[$complements[0]->complement_id]['maxi']?>"  step="<?php echo $comps[$complements[0]->complement_id]['pas']?>" class="ml-10 form-control" id="comp_val" placeholder="mm" style="width:80px;float:right;margin-bottom:20px;" onchange='$("#comp_id").prop("disabled", false);'></input>
 											

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
							  <label class="  ">{{__('msg.Option price')}} :</label> <label class="ml-10 mr-10" id="tprix" style="font-weight:bold"></label><label class="ml-10 mr-10" id="tmodeid" style="font-weight:bold"></label><label class="ml-10 mr-10  ">Mini :</label><label class="ml-10 mr-10" id="tmini" style="font-weight:bold"></label> €
							  </div>
							  <div class="row pl-10   ">							  
 							  <label class="  ">{{__('msg.Optional Labour cost')}} :</label><label class="ml-10 mr-10" id="tmontant"  style="font-weight:bold"></label> €
							  </div>
							  </div>								 
								<?php 
								}else{ ?>
										<input type="hidden" id="comp_id" value="0" />
										<input type="hidden" id="comp_val" value="0" />
								<?php	
								}
								
								
								}
									else{ ?>
										<input type="hidden" id="comp_id" value="0" />
										<input type="hidden" id="comp_val" value="0" />
								<?php	
								}
								 

								?>
								<input id="fact_id" type="hidden" value="0"><input id="tarif" type="hidden" value="0">
								
<hr>
	
									 <div class="row mb-10 mt-10  ">
<div class="col-md-5">									 
									 <label class="  ">{{__('msg.Quantity')}}</label><br><input <?php if(isset($unite)&& $unite->UNIT_LIB_LONG=='METRE'){?>    step="0.01"  <?php }else{ ?>   step="1"  <?php  } ?> value="<?php if(isset ($product[0]['valeur_defaut'])){echo $product[0]['valeur_defaut'];} ?>" onchange="details()" id="qte" type="number"  style="width:95px" value="0"    class="form-control" placeholder=""   /></input>
									 <label class="  pr-10 pl-10"><b><?php if(isset( $unite)){ echo $unite->UNIT_LIB_LONG;} ?></b></label>
</div>

							  <div class="col-md-4    ">
							  <label class="  ">{{__('msg.Unit weight')}}</label><br>
							  <label class="pl-10 mr-10 " style="font-weight:bold" id="poids_u"> </label> 

							  </div>

<div class="col-md-3" >									 
  <label class="  ">{{__('msg.Total weight')}}</label><br><label class="ml-10 mr-10  " id='poidst' style="font-weight:bold;"></label> 
</div>
									</div>	
<hr>							
							  <div id="infos"  >		
 							  
							  <input type="hidden" id="article" value="0"></input>
							  <b id="priceb" class=" pl-20">{{__('msg.Price')}}</b>
							<div id="price" style="display:none"><label class="ml-10 mr-10">{{__('msg.Price')}} :</label><label class="ml-10 mr-10" id="prix" style="font-weight:bold"></label><label class="ml-10 mr-10 " id="modeid" style="font-weight:bold"></label><label class="ml-10 mr-10">MINI :</label><label  id="mini" class="ml-10 mr-10" style="font-weight:bold"></label> €</div>
							<div id="pricing"></div>
							  <div class="row pl-10  ">
							  <label class=" pl-20  " >{{__('msg.Total Labour cost')}}:</label><label class="ml-10 mr-10 " id="montant" style="font-weight:bold;min-width:20px"></label> €
							  </div>							
				   							 

							  <div class="row   "  >
 							  <div class="col-sm-8 " id="debits"><label id='labelm1' style="width:100px;display:none" class="metal text-center bg-gradient-warning">{{__('msg.Gold')}} : </label><span class="ml-10 mr-10 " style="font-weight:bold" id="debit_1"></span><label id='labelm2' style="width:100px;display:none" class="metal text-center bg-gradient-light"> {{__('msg.Silver')}} : </label><span class="ml-10 mr-10 " id="debit_2" style="font-weight:bold" ></span><label id='labelm3' style="width:100px;display:none" class="metal text-center bg-gradient-secondary"> {{__('msg.Platinum')}} : </label><span class="ml-10 mr-10 " id="debit_3" style="font-weight:bold" ></span><label id='labelm4' style="width:100px;display:none" class="metal text-center  bg-gray-500">  {{__('msg.Palladium')}} :  </label><span class="ml-10 mr-10 " id="debit_4" style="font-weight:bold"></span> </div>
							 

						      <div class="col-sm-4  " style=" height:60px">
								<button  id="cart"  type="button" style="position:absolute;right:30px " class="pull-right btn btn-primary btn-icon-split   ml-50   mb-20">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-shopping-cart"></i>
                                        </span>
                                        <span class="text" onclick="addproduct()">{{__('msg.Add to cart')}}</span>
                                    </button>
                                </div>

							 </div>
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
									<th class="pl-10 " >{{__('msg.Item')}}</th><th style="text-align:center"class="pl-10 pr-10" >{{__('msg.Qty')}}</th><th style="text-align:center" class="pl-10 pr-10">{{__('msg.Weight')}}</th><th class="pl-10 pr-10" style="text-align:center"><span class="fa fa-trash-alt"></th>
									<?php foreach($products as $product){
									echo '<tr><td class="pl-10" style="font-size:12px">'.$product->libelle.'</td><td style="text-align:center;font-size:13px">'.$product->qte.' '.$product->unite.'</td><td style="text-align:center;font-size:13px">'.number_format($product->poids, 2).' g</td><td class="text-black" style="text-align:center;font-size:13px">';?>
									<a  class="delete fm-close"  onclick="return confirm('Êtes-vous sûrs de vouloir supprimer ce produit ?')"  href="{{action('ProductsController@deleteproduct', $product->id)}}"><span class="fa  fa-times-circle"></i></a>
									<?php echo '
									</td></tr>	';
	
									}?>
 									 <tr style="height:40px"><td></td><td></td><td></td><td></td></tr>
									<tr style="border-top:1px solid lightgrey;border-bottom:1px solid lightgrey;"><td><b class="text-info pl-10">{{__('msg.Total weight')}}</b></td><td style="text-align:center"></td><td style="text-align:center" class=" " colspan="2"><b><?php echo  number_format($weight, 2) ;?> g</b></td>	</tr>
									<tr style="border-top:1px solid lightgrey;border-bottom:1px solid lightgrey;"><td><b class="text-info pl-10">{{__('msg.Optional Labour cost')}}</b></td><td style="text-align:center"></td><td colspan="2" style="text-align:center" class=" "><b> <?php echo number_format($comp_amount,2) .' € HT';?></b></td>	</tr>									
									<tr ><td><b class="pl-10 text-info">{{__('msg.Total Labour cost')}}</b></td><td style="text-align:center"></td><td style="text-align:center" class=" " colspan="2"><b><?php echo number_format($amount,2) ;?> € HT</b></td>	</tr>
									 									
									</table><br>
									<span class="mt-10 text-success " style="font-weight:bold" >{{__('msg.PURE METALS')}}</span><br>
									<table class="pt-20 pm-20 pl-20 pr-20" style="border:none">
								    <tr style="height:20px; "><td    style="height:20px">{{__('msg.Gold')}}: </span></td><td><span><?php echo floatval($gold ) ;?> g</span></td></tr>
									<tr style="height:20px"><td   style="height:20px">{{__('msg.Silver')}} : </span></td><td><span><?php echo floatval($silver) ;?> g</span></td></tr>
									<tr style="height:20px"><td   style="height:20px">{{__('msg.Palladium')}} : </span></td><td><span><?php echo floatval($palladium) ;?> g</span></td></tr>
									<tr style="height:20px"><td     style="height:20px">{{__('msg.Platinum')}} : </span></td><td><span><?php echo floatval($platine) ;?> g</span></td></tr>
									</table>									
                                </div>
								
								<center><a href="{{ route('panier') }}" style="color:white;text-decoration:none"> <button    type="button"   class="pull-right btn btn-primary btn-icon-split  mt-10 mb-20">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-shopping-cart"></i>
                                        </span>
                                        <span  style="width:200px" class="text" >{{__('msg.Go to cart')}}</span>
                                    </button> </a></center>								
								
                            </div>

           

                        </div>
  
   </div>

   <script>
   
function checkComp(){
	var comp=  $('#comp_id').val();
	 if(comp==6){
		 comp_val
		 $('#comp_val').prop('min',40.00);
		 $('#comp_val').prop('max',70.00);
		 $('#comp_val').prop('step',2.00);
	 }
	 else{
		 $('#comp_val').prop('min',1.00);
		 $('#comp_val').prop('max',99.00);
		 $('#comp_val').prop('step',1.00);		 
	 }
	 
	 
}

   
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
   

		

 	
 
 
function details()
{ 
	        var _token = $('input[name="_token"]').val();
	        var mesure1 = parseFloat($('#mesure1').val());
			mesure1 = mesure1 ? mesure1 : 0;
	        var mesure2 = parseFloat($('#mesure2').val());
			mesure2 = mesure2 ? mesure2 : 0;
			console.log(mesure1);
	        var alliage_id = parseInt($('#alliage_id').val());
	        var qte = parseFloat($('#qte').val());
	        var comp_id = parseInt($('#comp_id').val());
	        var comp_val = $('#comp_val').val() ;
	        var article = $('#article').val() ;
	        var etat_id = $('#etat_id').val() ;
	        var fact_id = $('#fact_id').val() ;
			var tarif=$('#tprix').text();
			var debit1=0;var debit2=0;var debit3=0;	var debit4=0;
			var mini=0;	var minit=0;
			var montant=0;var montantt=0;
			var poids=0;
			var prix=0;var prixt=0;
			if(comp_val==''){comp_val=0;comp_id=0;}
				if(comp_val==0   ){
					$('#option').hide();
				}
				
				/*data=  'type:'+<?php echo $type; ?>+',famille1:'+<?php echo $famille1;?> +',famille2:'+ <?php echo $famille2;?>+', famille3:'+ <?php echo $famille3;?>+',mesure1:'+ mesure1+',mesure2:'+ mesure2+',alliage_id:'+ alliage_id+',qte:'+ qte+',comp_id:'+ comp_id+',comp_val:'+ comp_val ;
				alert(data);*/
            $.ajax({
                url: "{{ route('details') }}",
                method: "POST",
                data: {type:<?php echo $type; ?>,famille1:<?php echo $famille1;?> ,famille2: <?php echo $famille2;?>, famille3: <?php echo $famille3;?>,
				mesure1: mesure1,mesure2: mesure2,alliage_id: alliage_id,qte: qte,comp_id: comp_id,comp_val: comp_val,etat_id:etat_id,fact_id:fact_id/*,tarif:tarif*/, _token: _token},
                success: function (data) {
				 var datass= {type:<?php echo $type; ?>,famille1:<?php echo $famille1;?> ,famille2: <?php echo $famille2;?>, famille3: <?php echo $famille3;?>,
				 				mesure1: mesure1,mesure2: mesure2,alliage_id: alliage_id,qte: qte,comp_id: comp_id,comp_val: comp_val,etat_id:etat_id,fact_id:fact_id/*,tarif:tarif*/, _token: _token};

 console.log(JSON.stringify(datass));
			//	console.log( 'poids_u : '+data.poids_u  +'produit :  '+data.produit+' prix : '+data.prix+'  '+' tarif : '+data.tarif+' tarif_prod : '+data.tarif_prod) ;
		 	console.log('success data : '+JSON.stringify(data));	
				
var datas='';var poidsx=0;var limite=0;

if(data.tarif_prod.length>1){
datas+='<table class="mb-10" style="border:none;text-align:center" border="0"><tr>';
for(i=0;i< data.tarif_prod.length-1;i++)
{
		  limite=parseFloat(data.tarif_prod[i].limitepds);

datas+='<td>Moins de '+ limite+'g</td>'
}
datas+='<td>Au-delà</td><td>Mini</td></tr>';

for(i=0;i< data.tarif_prod.length;i++)
{
	  poidsx=parseFloat(data.tarif_prod[i].prix);
datas+='<td>'+poidsx+' '+data.tarif_prod[i].MODE_FACT_LIBC+'</td>';
}
datas+='<td>'+ parseFloat(data.tarif_prod[0].mini)+' €</td>';

 $('#pricing').html(datas );

}else{
	
	$('#priceb').hide();
	$('#price').show();
}
// != 'undefined'				
				//comp_val
				poids=parseFloat(data.poids_u);
				
				poidst= poids * qte;
				poidst= poidst.toFixed(2);
				poidst= parseFloat(poidst);
				
				 if(comp_val!=0 && mesure2!=0 ){
					 poidst = ( poidst/ mesure2) * comp_val ;   
				     poids = ( poids/ mesure2) * comp_val ; 
				   }
				
				 $('#poids_u').html( poids+' g' );

				
				
 				$('#poidst').html(poidst +' g');
				 $('#article').val( parseInt(data.produit));
				 if( typeof (data.prix)   !== 'undefined' )
				 {  prix=parseFloat(data.prix[0].prix);
				 console.log('prix '+data.prix[0].prix);
			//	console.log('tarif '+data.prix[0].tarif);
				 $('#prix').html(  prix);
				 //$('#modeid').html( data.prix[0].modeid);
				 montant=parseFloat(data.prix[0].montant );
			 
				 montantt=parseFloat(data.tarif[0].montant );
				 minit=parseFloat(data.tarif[0].mini);
				 mini=parseFloat(data.prix[0].mini);
				 //added
				 //montantt= montantt * comp_val ;
				 
			     if(montantt< minit){montantt=minit;}				 
				 //
				 montant=montant ;
				  if(montant< mini){montant=mini;}

				 if(montantt>0){montant=montant+montantt;}
				 montant= montant.toFixed(2);
				 montantt= montantt.toFixed(2);
				 montant= parseFloat(montant);
		 
				 $('#montant').html(  montant.toFixed(2) );
				 $('#mini').html(mini.toFixed(2) );
				 debit1=(data.prix[0].debit_1 ).toFixed(2);
				 debit2=(data.prix[0].debit_2 ).toFixed(2);
				 debit3=(data.prix[0].debit_3 ).toFixed(2);
				 debit4=(data.prix[0].debit_4 ).toFixed(2);
				  $('#labelm1').hide(); $('#labelm2').hide(); $('#labelm3').hide(); $('#labelm4').hide();
				  $('#debit_1').html('');$('#debit_2').html('');$('#debit_3').html('');$('#debit_4').html('');
				  
				if(parseFloat(debit1)>0){ $('#labelm1').show(); $('#debit_1').html( debit1+'g');  } 
				if(parseFloat( debit2)>0){ $('#labelm2').show(); $('#debit_2').html( debit2+'g'); } 
				if(parseFloat( debit3)>0){ $('#labelm3').show(); $('#debit_3').html( debit3+'g'); } 
				if(parseFloat( debit4)>0){ $('#labelm4').show(); $('#debit_4').html( debit4+'g'); } 
 				 prixt=parseFloat(data.tarif[0].prix );
 				 prixt=prixt.toFixed(2);
 				 $('#tprix').html(prixt );
				// $('#tmodeid').html( data.tarif[0].modeid);
				
				 $('#tmontant').html(montantt );
				 $('#tmini').html(minit.toFixed(2));			
				 
				if(parseFloat(data.prix[0].modeid) > 0){
					$('#fact_id').val(data.prix[0].modeid);
				$.ajax({
                url: "{{ route('modelabel') }}",
                method: "POST",
                data: {id: data.prix[0].modeid  , _token: _token } ,
                success: function (data) {	
				$('#modeid').html( data);				 
                }
				});
				}
				

			
	
				} // prix defined
			
				$('#fact_id').val(data.prix[0].modeid);
				document.getElementById("fact_id").value=data.prix[0].modeid;
				alert(data.prix[0].modeid);
			// here
			////	checkproduct();
				 	


			
	
			}
		 });
}



function checkproduct()
{
   // vérifier si le produit existe
   
    var _token = $('input[name="_token"]').val();
 	        var alliage_id = parseInt($('#alliage_id').val());
 	        var comp_id = parseInt($('#comp_id').val());
	        var comp_val = $('#comp_val').val() ;
	        var article = $('#article').val() ;
				if(comp_val!=''){comp_val = parseFloat(comp_val);}else{comp_val=0;}
			if(comp_id!=''){comp_id = parseInt(comp_id);}else{comp_id=0;}
	//	alert(  "libelle : <?php echo $titre;?>"+'article : '+article+'alliage_id : '+alliage_id+'comp_id : '+comp_id+'comp_val : '+comp_val);
 
   $.ajax({
  url: "{{ route('checkproduct') }}",
  method: "POST",
  data: { label:"<?php echo $titre;?>", article:article , alliage_id : alliage_id, comp_id:comp_id, comp_val:comp_val   , _token: _token } ,
  success: function (data) {	
    if (parseInt(data)>0)
   {
 		$("#cart").prop("disabled", true);
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
			var fact_id =  $('#fact_id').val() ;
			var tarif =  $('#tarif').val() ;
			if(article!=''){article = parseInt(article);}else{article=0;}
			if(mesure1!=''){mesure1 = parseFloat(mesure1);}else{mesure1=0;}
			if(mesure2!=''){mesure2 = parseFloat(mesure2);}else{mesure2=0;}
			if(comp_val!=''){comp_val = parseFloat(comp_val);}else{comp_val=0;}
			if(comp_id!=''){comp_id = parseInt(comp_id);}else{comp_id=0;}
			if(fact_id!=''){fact_id = parseInt(fact_id);}else{fact_id=0;}
			if(tarif!=''){tarif = parseFloat(tarif);}else{tarif=0;}

	        var montant = parseFloat(  $('#montant').text()) ;
	        var montant_compl =   $('#tmontant').text()  ;
			 if(montant_compl!=''){montant_compl = parseFloat(montant_compl);}else{montant_compl=0;}

	        var poids = parseFloat(  $('#poidst').text()) ;
 			
	        var or=   $('#debit_1').text()  ; if(or!=''){or = parseFloat( or.slice(0 , or.length-2));}else{or =0;}
	        var argent=   $('#debit_2').text()  ; if(argent!=''){argent = parseFloat(  argent.slice(0 , argent.length-2));}else{argent =0;}
	        var platine=   $('#debit_3').text()  ; if(platine!=''){platine = parseFloat( platine.slice(0 , platine.length-2));}else{platine =0;}
	        var palladium=   $('#debit_4').text()  ; if(palladium!=''){palladium =parseFloat(  palladium.slice(0 , palladium.length-2));}else{palladium =0;}

	         
		 if(qte >0 && montant>0 ){
            $.ajax({
                url: "{{ route('addproduct') }}",
                method: "POST",
                data: {type:<?php echo $type; ?>,famille1:<?php echo $famille1;?> ,famille2: <?php echo $famille2;?>, famille3: <?php echo $famille3;?>,user:<?php echo $user->id; ?>, libelle: libelle,
				qte: qte,unite:unite,article: article,montant: montant,montant_compl: montant_compl,poids: poids,or: or,argent: argent,palladium: palladium
				,platine: platine,alliage:alliage ,mesure1:mesure1,mesure2:mesure2,comp_id:comp_id,comp_val:comp_val ,fact_id:fact_id,tarif:tarif, _token: _token},
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