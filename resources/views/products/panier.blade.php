
@extends('layouts.back')
 
 @section('content')
<style>
.card-body{min-height:300px;}
</style>
<?php
 $user = auth()->user();  
 use App\Http\Controllers\HomeController ;
 $alliages=HomeController::referentielalliage();			  
  
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
  $pieces=count( $products);
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
 $pieces=0;
}

?>

						<div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-7 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.Cart')}}</h6>
                                </div>
                                <div class="card-body">
 
 <?php 
 $i=0;
 foreach($products as $product){ $i++; ?>
	  <div class="row pb-10 pt-10 " style="border-bottom:1px solid lightgrey">  
<?php
 $prod=app('App\Http\Controllers\HomeController')->produit($product->type,$product->famille1,$product->famille2,$product->famille3);
  $produit=  DB::table('type_famille')->where('type_id',$product->type)->where('fam1_id',$product->famille1)->where('fam2_id',$product->famille2)->where('fam3_id',$product->famille3)->first();

 $img=''; $image=DB::table('photo')->where('photo_id',$produit->photo_id )->first();
 
	 if(isset($image)){ $img=$image->url;}
	 
	 if($product->type==101){$Type=  __('msg.Semi finished Products') ; $link=route('products');}
 if($product->type==102){$Type=  __('msg.Electroplating') ; $link=route('galvano');}
 if($product->type==103){$Type=  __('msg.Findings') ; $link=route('findings');}
 if($product->type==104){$Type= __('msg.Jewelry') ; $link=route('jewelry');}

 $id_unite= $prod[0]['UNIT_IDENT'];
 $unite=DB::table('unite')->where('UNIT_IDENT',$id_unite)->first();
 
 $Product=app('App\Http\Controllers\HomeController')->produit($product->type,$product->famille1,$product->famille2,$product->famille3);

?>

<input type="hidden" value="<?php echo $product->id ;?>"  id="prod-<?php echo $i;?>">
<input type="hidden" value="<?php echo $product->type ;?>"  id="type-<?php echo $i;?>">
<input type="hidden" value="<?php echo $product->famille1 ;?>"  id="famille1-<?php echo $i;?>">
<input type="hidden" value="<?php echo $product->famille2 ;?>"  id="famille2-<?php echo $i;?>">
<input type="hidden" value="<?php echo $product->famille3 ;?>"  id="famille3-<?php echo $i;?>">
<input type="hidden" value="<?php echo $product->mesure1 ;?>"  id="mesure1-<?php echo $i;?>">
<input type="hidden" value="<?php echo $product->mesure2 ;?>"  id="mesure2-<?php echo $i;?>">
<input type="hidden" value="<?php echo $product->alliage ;?>"  id="alliage-<?php echo $i;?>">
<input type="hidden" value="<?php echo $product->comp_id ;?>"  id="comp_id-<?php echo $i;?>">
<input type="hidden" value="<?php echo $product->comp_val ;?>"  id="comp_val-<?php echo $i;?>">

<div class="col-md-3  pl-10">
 <center><img style="min-height:150px;max-height:180px" src="<?php echo URL::asset('images/'.$img);?>" class="img-fluid " alt=""></center>
</div>
<div class="col-md-5  pl-10 pb-10">
<!--<h5 ><a class="text-info"  title="<?php // echo __("msg.View product");?>" href="<?php // echo route("single",['type'=>$product->type,'fam1'=>$product->famille1,'fam2'=>$product->famille2,'fam3'=>$product->famille3]);?>"><?php // echo $product->libelle; ?></a></h5>-->
<h5 ><span class="text-info"   ><?php echo $product->libelle; ?></span></h5>
<span   ><?php echo  $produit->LIBFAM1; ?></span><br>
<?php
if($product->alliage >0){
 foreach ($alliages as $alliage)
	{
	 if( $alliage->id == $product->alliage  ) 
	 { echo $alliage->libelle;}
	}
 }
  	?>
	<div class="row pt-15"><input type="number"  onchange="details(<?php echo $i;?>)"  <?php if($unite->UNIT_LIB_LONG=='METRE'){?>    min="0.01"  step="0.01"  <?php }else{ ?> min="1"  step="1"  <?php  } ?>  id="qte-<?php echo $i;?>" value="<?php echo $product->qte;?>" class="ml-10 mr-10 form-control" style="width:80px"></input> <span class="pt-10"><?php echo $unite->UNIT_LIB_LONG ; ?></span> </div>
<?php if($product->mesure1 > 0){  ?> 	<div class="row pt-15">{{__('msg.Measures')}}: <b class="pl-10"><?php echo $product->mesure1 ;?><?php if(isset($Product[0]['unite1'])){ echo ' '.$Product[0]['unite1']; } ?> <?php if($product->mesure2 > 0){  ?> <?php echo ' , '. $product->mesure2 ;?><?php if(isset($Product[0]['unite1'])){ echo ' '.$Product[0]['unite1']; } ?><?php } ?></b></div><?php  } ?>
<?php if( $product->comp_id	> 0){
	
$Comp=DB::table('complement_dp')->where('COMPLEMENT_DP_IDENT',$product->comp_id)->first();
			 echo '<div class="row"><span class="weight-bold">'. __("msg.Labour cost") .': <b>'.$Comp->COMPLEMENT_LIB .'  ('. $product->comp_val.' mm)</b> </span></div>' ; 
}  ?>
</div>
<div class="col-md-4"  >
  <div class="pb-40  pl-10 pt-15" style="border-left:1px solid lightgrey">
   <b>{{__('msg.Total weight')}} :  <span id="poidst-<?php echo $i;?>"><?php echo number_format($product->poids,2) ; ?></span> g<br></b>
   <?php if($product->montant_compl!=0){?><b>{{__('msg.Optional Labour cost')}} : <span id="tmontant-<?php echo $i;?>"><?php   echo number_format($product->montant_compl,2) ; ?></span>  €</b><?php } ?>
   <br>
   <a  style="position:absolute;right:25px;bottom:25px" class="delete fm-close"  onclick="return confirm('Êtes-vous sûrs de vouloir supprimer ce produit ?')"  href="{{action('ProductsController@deleteproduct', $product->id)}}"><span class="fa  fa-times-circle"></i></a>
  </div>
</div>

</div><!-- row -->
<?php	 
 }
?>	
 								 
									 
                                </div>
                            </div>

                       

                        </div>

                        <div class="col-lg-5 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.My order')}}</h6>
                                </div>
                                <div class="card-body">
 
									<table class="mb-10">
								 
 									<tr style="border-top:1px solid lightgrey;border-bottom:1px solid lightgrey;"><td><b class="text-info pl-10">{{__('msg.Items')}}</b></td><td style="text-align:center"></td><td style="text-align:center" class=" " colspan="2"><b><?php echo  $pieces ;?></b></td>	</tr>
 									<tr style="border-top:1px solid lightgrey;border-bottom:1px solid lightgrey;"><td><b class="text-info pl-10">{{__('msg.Total weight')}}</b></td><td style="text-align:center"></td><td style="text-align:center" class=" " colspan="2"><b><?php echo  number_format($weight,2) ;?> g</b></td>	</tr>
									<?php if($comp_amount!=0){?><tr style="border-top:1px solid lightgrey;border-bottom:1px solid lightgrey;"><td><b class="text-info pl-10">{{__('msg.Optional Labour cost')}}</b></td><td style="text-align:center"></td><td colspan="2" style="text-align:center" class=" "><b> <?php echo number_format($comp_amount,2) .' € HT';?></b></td>	</tr><?php } ?>
									<tr ><td><b class="pl-10 text-info">{{__('msg.Total Labour cost')}}</b></td><td style="text-align:center"></td><td style="text-align:center" class=" " colspan="2"><b><?php echo number_format($amount,2) ;?> € HT</b></td>	</tr>
									 									
									</table><br>
									<span class="mt-10 text-success " style="font-weight:bold" >{{__('msg.PURE METALS')}}</span><br>
									<table class="pt-20 pm-20 pl-20 pr-20" style="border:none">
								    <tr style="height:20px; "><td    style="height:20px">{{__('msg.Gold')}}: </span></td><td><span><?php echo floatval($gold) ;?> g</span></td></tr>
									<tr style="height:20px"><td   style="height:20px">{{__('msg.Silver')}} : </span></td><td><span><?php echo floatval($silver) ;?> g</span></td></tr>
									<tr style="height:20px"><td   style="height:20px">{{__('msg.Palladium')}} : </span></td><td><span><?php echo floatval($palladium) ;?> g</span></td></tr>
									<tr style="height:20px"><td     style="height:20px">{{__('msg.Platinum')}} : </span></td><td><span><?php echo floatval($platine) ;?> g</span></td></tr>
									</table>	
 
 
 								<center><a href="{{ route('livraison') }}" style="color:white;text-decoration:none"> 
								<button    type="button"   class="pull-right btn btn-primary btn-icon-split  mt-30 mb-20">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-truck-moving"></i>
                                        </span>
                                        <span  style="width:200px" class="text" >{{__('msg.Confirm the order')}}</span>
                                    </button> </a>
									</center>	
									
									
                                </div>
                            </div>

 

                        </div>
                    </div>
					
					
<script>


function details(id)
{ 
	        var _token = $('input[name="_token"]').val();
	        var idprod = parseInt($('#prod-'+id).val());
	        var type = parseInt($('#type-'+id).val());
	        var famille1 = parseInt($('#famille1-'+id).val());
	        var famille2 = parseInt($('#famille2-'+id).val());
	        var famille3 = parseInt($('#famille3-'+id).val());
			var alliage_id = parseInt($('#alliage-'+id).val());
	        var qte = parseFloat($('#qte-'+id).val());
	      			
	        var mesure1 =  $('#mesure1-'+id).val() ;
	        var mesure2 =  $('#mesure2-'+id).val() ;
	         var comp_id = $('#comp_id-'+id).val();
	        var comp_val = $('#comp_val-'+id).val() ;
			
			if(mesure1!=''){mesure1 = parseFloat(mesure1);}else{mesure1=0;}
			if(mesure2!=''){mesure2 = parseFloat(mesure2);}else{mesure2=0;}
			if(comp_val!=''){comp_val = parseFloat(comp_val);}else{comp_val=0;}
			if(comp_id!=''){comp_id = parseInt(comp_id);}else{comp_id=0;}
	     
 			var mini=0;	var minit=0;
			var montant=0;var montantt=0;
			var poids=0;
			var prix=0;var prixt=0;
			if(comp_val==''){comp_val=0;comp_id=0;}
			 
            $.ajax({
                url: "{{ route('details') }}",
                method: "POST",
                data: {type: type ,famille1: famille1   ,famille2:  famille2 , famille3:  famille3 ,
				mesure1: mesure1,mesure2: mesure2,alliage_id: alliage_id,qte: qte,comp_id: comp_id,comp_val: comp_val, _token: _token},
                success: function (data) {
				console.log( 'poids_u : '+data.poids_u  +'produit :  '+data.produit+' prix : '+data.prix+'  '+' tarif : '+data.tarif) ;
				console.log(data);				
				
				poids=parseFloat(data.poids_u);
 				poidst= poids * qte;
				// poids total
 				$('#poidst-'+id).html(poidst );
 				 prix=parseFloat(data.prix[0].prix);
				 console.log(data.prix[0].prix);
				console.log(data.prix[0].tarif);
 
				 montant=parseFloat(data.prix[0].montant * qte);
				 montantt=parseFloat(data.tarif[0].montant);
				 minit=parseFloat(data.tarif[0].mini);
				 mini=parseFloat(data.prix[0].mini);

			     if(montantt< minit){montantt=minit;}				 
				 if(montant< mini){montant=mini;}
				 if(montantt>0){montant=montant+montantt;}
				 montant=montant.toFixed(2);
				 montant=parseFloat(montant);
				 // montant total
				 $('#montant-'+id).html(  montant);
 				  montantt=montant.toFixed(2);
				 montantt=parseFloat(montantt);
 				//facon
				 $('#tmontant-'+id).html(montantt );
  			
	
			setTimeout(function(){
 					   // update product: qte + poids total + montant | Order details loop on delete also
              $.ajax({
                url: "{{ route('updatecart') }}",
                method: "POST",
                data: {idprod:idprod,poids: poidst, montant: montant, qte: qte, _token: _token},
                success: function (data) {
                    $('#qte-'+id).animate({
                        opacity: '0.1',
                    });
                    $('#qte-'+id).animate({
                        opacity: '1',
                    });

                    $.notify({
                        message: 'Produit modifié avec succès',
                        icon: 'glyphicon glyphicon-check'
                    },{
                        type: 'success',
                        delay: 2000,
                        timer: 1000,
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                    });
				
				 location.reload();

                }
            });
					   
					   
					   
                    }, 3000);  //3 secds
	
	
			}
		 });
}

					
</script>					
					

@endsection
