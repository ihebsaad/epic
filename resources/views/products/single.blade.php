

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
  $titre=strtolower($titre);
  $img=''; $image=DB::table('photo')->where('photo_id',$produit->photo_id)->first();
	 if(isset($image)){ $img=$image->url;}
	 
$alliagesp=\App\Lien_alliage_produit::where(function ($query) use($type )   {
                      $query->where('type_id', $type);
                        
                  })->where(function ($query) use($famille1)  {
                      $query->where('fam1_id' , $famille1)
                          ->orWhere('fam1_id', 0);
   
                  })->pluck('ALLIAGE_IDENT');
				  
 	 			  
  //alliage1
  $alliages=HomeController::referentielalliage();
				  
 $user = auth()->user();  
$alliage_user=$user['alliage'];
if($produit->choix_etat>0){
$etats= HomeController::referentieletat();
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
                                    <center><img style="max-height:180px" src="<?php echo $img; ?>" class="img-fluid" alt=""></center>
								
									</div>
									<div class="col-md-7 col-xs-12">
									<h5 style="font-weight:bold;"><?php echo $titre;?></h5>
									<?php if($product!= 'error') {?>
									<?php $id_unite= $product[0]['UNIT_IDENT'];
									$unite=DB::table('unite')->where('UNIT_IDENT',$id_unite)->first();
									?>									
									<div class="row mb-10 mt-10">
										<div class="col-md-4">
											 </br><b><?php   echo $product[0]['NAT_MESURE1'] ; ?></b>
										</div>
										<div class="col-md-4">
											 </br><b><?php  echo $product[0]['NAT_MESURE2'] ; ?></b>
										</div>	
										<div class="col-md-4">
											{{__('msg.Unit')}} : </br><b><?php  echo $unite->UNIT_LIB_LONG; ?></b>
										</div>											
									</div>
									
							 
									<?php $mesures= $product[0]['mesures'];
									//dd($mesures[0]->MESURE1 );
									  if( $mesures[0]->MESURE1!='0.00' && $mesures[0]->MESURE2 !='0.00'    ){
										  
 									?>
									  
									 <div class="row pl-10">
									 <div class="col-md-4">

                                      <select onchange="showmesure2()"  id="mesure1" class="form-control">
  									   <?php
 									   foreach ($mesures as $mesure) {
									    //dd($mesure->MESURE2[0]->MESURE2 );
									   ?>
									  <option   value="<?php 	echo $mesure->MESURE1   ; ?>">   <?php 	echo $mesure->MESURE1  ; ?> </option>
									   <?php } ?>	
									   </select>

 									</div>	
									 <div class="col-md-4">

                                      <select disabled id="mesure2" class="form-control" required  >
									  <option></option>
  									   <?php
 									   foreach ($mesures as $mesure) {
 									   foreach ($mesure->MESURE2 as $m2) {
									    //dd($mesure->MESURE2[0]->MESURE2 );
									   ?>
									  <option class="mesure2 mesure-<?php echo $mesure->MESURE1; ?>" value="<?php 	echo  $m2->MESURE2  ; ?>">   <?php 	echo $m2->MESURE2  ; ?></option>
									   <?php } ?>	
									   <?php } ?>	
									  </select>

 									</div>									
 									</div>									
									  <?php }else{ ?>
										  
									<input type="hidden" id="mesure1" value="0.00" />	  
									<input type="hidden" id="mesure2" value="0.00" />	  
									 <?php } ?>
									  
									 <?php } 
									 ?>

 									<div class="row mt-10">
									 <div class="col-md-12">{{__('msg.Alloy')}}<br>
									 <select class="form-control" id="alliage_id">
									 <option value="0"></option>
										<?php
										
										

 								 		foreach ($alliages as $alliage)
										{
										foreach ($alliagesp as $alliagep)
										{
											if( $alliage->id ==  $alliagep ) 
										{
							 
									 if($alliage_user==$alliagep  ){$selected = 'selected="selected"';}else{$selected = '';} 
									echo '<option  '.$selected.' value="'.$alliage->id .'">'.$alliage->libelle. '</option>';
								
									}
									}
									}
									 
									?>
									 
									 </select>
									 </div> 
	 
									</div>
 									<div class="row mb-10 mt-20">
									<div class="col-md-4 pt-10">{{__('msg.Quantity')}}</div><div class="col-md-8"><input onchange="details()" id="qte" type="number"  value="0"  min="1" class="form-control" placeholder="" /></input></div>
									</div>
								    <?php if($produit->choix_etat>0){ ?>
									 <div class="row mb-10 mt-10">

									<div class="col-md-4 pt-10">{{__('msg.State')}}</div>
									<div class="col-md-8"><select id="etat_id" class="form-control" placeholder="Etat"><?php foreach($etats as $etat){?><option value="<?php echo $etat->id;?>"> <?php echo $etat->libelle;?> </option> <?php } ?>   </select></div> 
									</div>
									<?php }else{ ?><input id="etat_id" type="hidden"  value="0" ></input> <?php }  ?>
									<?php 
									$complements= $product[0]['complements'];
									 //dd($complements[0]->complement_id);
									 if($complements[0]->complement_id!=null){ 
									 // echo json_encode($complements);

									 ?>
									 <div class="row mb-10 mt-20">
										 <div class="col-md-4 pt-10">{{__('msg.Complement')}}</div>							  
										 <div class="col-md-8 "><select class="form-control" id="comp_id">
									<?php	
									foreach($complements as $comp)
										 { 
										 $Comp=DB::table('complement_dp')->where('COMPLEMENT_DP_IDENT',$comp->complement_id)->first();
											 echo ' <option value="'.$comp->complement_id.'">'.$Comp->COMPLEMENT_LIB.'</option>';
										 }
										?> </select>
										 </div>	
										 </div>	
									  <div class="row mb-10 mt-10">

									<div class="col-md-4 pt-10">{{__('msg.Value')}}</div>
									<div class="col-md-8"><input type="text" class="form-control" id="comp_val" placeholder="mm"></input></div>									
									</div>
									<?php }
									else{ ?>
										<input type="hidden" id="comp_id" value="0" />
										<input type="hidden" id="comp_val" value="0" />
								<?php	} ?>
									
							
							  <div class="row mb-10  ">
							  <div class="col-md-5  ">{{__('msg.Unit weight')}} :</div>
							  <div class="col-md-5" id="poids_u"></div>
							  </div>
							  <div class="row mb-10  ">
							  <div class="col-md-5  ">Article :</div>
							  <div class="col-md-5" id="produit"></div>
							  </div>
							  <div class="row mb-10  ">
							  <b>PRIX</b>
							  </div>
							  <div class="row mb-10  ">
							  <div class="col-md-5  ">Prix :</div>
							  <div class="col-md-5" id="prix"></div>
							  </div>							  
							  <div class="row mb-10  ">
							  <div class="col-md-5  ">Mode ID :</div>
							  <div class="col-md-5" id="modeid"></div>
							  </div>
							  <div class="row mb-10  ">
							  <div class="col-md-5  ">Montant :</div>
							  <div class="col-md-5" id="montant"></div>
							  </div>
							  <div class="row mb-10  ">
							  <div class="col-md-5  ">Mini :</div>
							  <div class="col-md-5" id="mini"></div>
							  </div>
							  <div class="row mb-10  ">
							  <div class="col-md-5  ">Debits :</div>
							  <div class="col-md-5" id="debits"><span id="debit_1"></span> | <span id="debit_2"></span> | <span id="debit_3"></span> | <span id="debit_4"></span> </div>
							  </div>
							  <div class="row mb-10  ">
							  <b>TARIF</b>
							  </div>
							  <div class="row mb-10  ">
							  <div class="col-md-5  ">Prix :</div>
							  <div class="col-md-5" id="tprix"></div>
							  </div>							  
							  <div class="row mb-10  ">
							  <div class="col-md-5  ">Mode ID :</div>
							  <div class="col-md-5" id="tmodeid"></div>
							  </div>
							  <div class="row mb-10  ">
							  <div class="col-md-5  ">Montant :</div>
							  <div class="col-md-5" id="tmontant"></div>
							  </div>
							  <div class="row mb-10  ">
							  <div class="col-md-5  ">Mini :</div>
							  <div class="col-md-5" id="tmini"></div>
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
                                <div id="div2" class="card-body">
 
 
                                </div>
                            </div>

           

                        </div>
						
 				
   </div>

   <script>
   function toggle(className, displayState){
            var elements = document.getElementsByClassName(className);
            for (var i = 0; i < elements.length; i++){
                elements[i].style.display = displayState;
             }
        }
		
	function showmesure2( ){
		 toggle('mesure2','none');
		  mesure=$("#mesure1").val();
         $("#mesure2").prop('disabled', false);
       //document.getElementsById('mesure2').disabled=false;
	 	toggle('mesure-'+mesure,'block');
	}	
 	
	var getKeys = function(obj){
   var keys = [];
   for(var key in obj){
      keys.push(key);
   }
   return keys;
}
 
function details()
{ 
	        var _token = $('input[name="_token"]').val();
	        var mesure1 = $('#mesure1').val();
	        var mesure2 = $('#mesure2').val();
	        var alliage_id = $('#alliage_id').val();
	        var qte = $('#qte').val();
	        var comp_id = $('#comp_id').val();
	        var comp_val = $('#comp_val').val();
			if(comp_val==''){comp_val=0;comp_id=0;}
            $.ajax({
                url: "{{ route('home.details') }}",
                method: "POST",
                data: {type:<?php echo $type; ?>,famille1:<?php echo $famille1;?> ,famille2: <?php echo $famille2;?>, famille3: <?php echo $famille3;?>,
				mesure1: mesure1,mesure2: mesure2,alliage_id: alliage_id,qte: qte,comp_id: comp_id,comp_val: comp_val, _token: _token},
                success: function (data) {
				alert( 'poids_u : '+data.poids_u  +'produit :  '+data.produit+' prix : '+data.prix+'  '+' tarif : '+data.tarif) ;
				alert(data.prix[0].prix);
				console.log(data);
				console.log(data.prix);
				$('#poids_u').html( data.poids_u);
				 $('#produit').html( data.produit);
				 $('#prix').html( data.prix[0].prix);
				 $('#modeid').html( data.prix[0].modeid);
				 $('#montant').html( data.prix[0].montant);
				 $('#mini').html( data.prix[0].mini);
				 $('#debit_1').html( data.prix[0].debit_1);
				 $('#debit_2').html( data.prix[0].debit_2);
				 $('#debit_3').html( data.prix[0].debit_3);
				 $('#debit_4').html( data.prix[0].debit_4);
				 $('#debit_4').html( data.prix[0].debit_4);
				 $('#debit_4').html( data.prix[0].debit_4);
				 
 				 $('#tprix').html( data.tarif[0].prix);
				 $('#tmodeid').html( data.tarif[0].modeid);
				 $('#tmontant').html( data.tarif[0].montant);
				 $('#tmini').html( data.tarif[0].mini);				 
                }
            });
	
	
}
//http://localhost/Epic/single/101/1003/2003/3004
	
   </script>
@endsection					