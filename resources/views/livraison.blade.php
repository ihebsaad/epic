
@extends('layouts.back')
 
 @section('content')
<style>
.card-body{min-height:300px;}
</style>
<?php
 $user = auth()->user();  
 use App\Http\Controllers\HomeController ;
   
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
									 <div class="col-md-4 box pt-20 pl-20 pb-20 pr-20 ml-10 active"  onclick="$('#agency1').show('slow');$('#agency2').hide('slow');details()">
										<center>  Click & Collect <div class="clearfix"></div>
										<img src="{{ URL::asset('public/img/box.png')}}" style="width:80px" class="mt-20"/></center>
									 </div>
									 <div class="col-md-4 box pt-20 pl-20 pb-20 pr-20 ml-10" onclick="$('#agency1').hide('slow');$('#agency2').show('slow');">
										<center>  {{__('msg.Carrier')}} <div class="clearfix"></div>
										<img src="{{ URL::asset('public/img/truck.png')}}" style="width:100px"/></center>
										
									 </div>
								 </div>
								 <div id="agency1">
									 <h5>{{__('msg.Pick up address')}}</h5>
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
											 <b style="color:black">{{__('msg.Sales office')}} :</b>  <span id="lib"></span><br>
											 <b style="color:black">{{__('msg.Address')}} :</b> <span id="adresse"></span><br>
											  <span id="zip"></span> <span id="ville"></span><br>
											 <b style="color:black">{{__('msg.Country')}} :</b> <span id="country"></span>
										 </div>
										 
										 </div>	

									 </div>	
									 
								 </div>		<!-- agency 1-->					 

								 <div id="agency2"  style="display:none"  >
								 <h5>{{__('msg.Delivery address')}}</h5>
								 <div class="row pt-10 pb-20">
								 
								 <div class="col-md-8">
								 
								 <select class="form-control mb-20"  id="adresse_id" onchange="setadresse();changing(this)">
								 <option></option>
								 <?php
								 $i=0;
								 foreach($adresses as $adresse)
								 {$i++;
									if($i==1){$selected="selected='selected'" ;}else{ $selected="";}
									 echo '<option '.$selected.' value="'.$adresse->id.'" >'.$adresse->nom .'   |    <small>'.$adresse->adresse1 .'</small></option>';
									 
								 } 
								 ?>
								 
								 </select>
								 <div style="min-height:120px">
									<?php  
									foreach($adresses as $adresse)
									 { ?>
										 <div class="pl-10 pr-10 pt-10 pt-10 adresses" style="display:none" id="adresse-<?php echo $adresse->id;?>" >
										 <b style="color:black">{{__('msg.Sales office')}} :</b>  <span  ><?php echo $adresse->adresse_nom; ?></span><br>
										 <b style="color:black">{{__('msg.Address')}} :</b> <span  ><?php echo $adresse->adresse1; ?> <?php echo $adresse->adresse2; ?></span><br>
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

								 
								 </div>							 


	<!--
								<div  class="col-md-8 pl-20 pt-10">
								<label><b> {{__('msg.Gross weight')}}</b></label>
								<input type="number" step="0.01" min="<?php echo number_format($weight,2) ;?>"  value="<?php echo number_format($weight,2) ;?>" class="form-control" style="width:110px"  id="gross" ></input> g
								</div>
	-->
								
									<button   onclick="valider()"  type="button"   class="pull-right btn btn-primary btn-icon-split ml-20 mt-20 mb-20" >
											<span class="icon text-white-50">
												<i class="fas fa-save"></i>
											</span>
											<span  style="width:120px" class="text" >{{__('msg.Validate')}}</span>
									</button> 
										
							</div><!--card body -->
                        </div><!--card  -->

                       

                        </div><!--c ol -->

                        <div class="col-lg-5 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.My order')}}</h6>
                                </div>
                                <div class="card-body">
 
									<table class="mb-10">
								 
 									<tr style="border-top:1px solid lightgrey;border-bottom:1px solid lightgrey;"><td><b class="text-info pl-10">{{__('msg.Items')}}</b></td><td style="text-align:center"></td><td style="text-align:center" class=" " colspan="2"><b><?php echo  $pieces ;?></b></td>	</tr>
 									<tr style="border-top:1px solid lightgrey;border-bottom:1px solid lightgrey;"><td><b class="text-info pl-10">{{__('msg.Total weight')}}</b></td><td style="text-align:center"></td><td style="text-align:center" class=" " colspan="2"><b><?php echo number_format($weight,2) ;?> g</b></td>	</tr>
									<tr style="border-top:1px solid lightgrey;border-bottom:1px solid lightgrey;"><td><b class="text-info pl-10">{{__('msg.Optional Labour cost')}}</b></td><td style="text-align:center"></td><td colspan="2" style="text-align:center" class=" "><b> <?php echo $comp_amount .' € HT';?></b></td>	</tr>
									<tr ><td><b class="pl-10 text-info">{{__('msg.Total Labour cost')}}</b></td><td style="text-align:center"></td><td style="text-align:center" class=" " colspan="2"><b><?php echo $amount ;?> € HT</b></td>	</tr>
									 									
									</table><br>
									<span class="mt-10 text-success " style="font-weight:bold" >{{__('msg.PURE METALS')}}</span><br>
									<table class="pt-20 pm-20 pl-20 pr-20" style="border:none">
								    <tr style="height:20px; "><td    style="height:20px">{{__('msg.Gold')}}: </span></td><td><span><?php echo floatval($gold) ;?> g</span></td></tr>
									<tr style="height:20px"><td   style="height:20px">{{__('msg.Silver')}} : </span></td><td><span><?php echo floatval($silver) ;?> g</span></td></tr>
									<tr style="height:20px"><td   style="height:20px">{{__('msg.Palladium')}} : </span></td><td><span><?php echo floatval($palladium) ;?> g</span></td></tr>
									<tr style="height:20px"><td     style="height:20px">{{__('msg.Platinum')}} : </span></td><td><span><?php echo floatval($platine) ;?> g</span></td></tr>
									</table>	
 
                                </div>
                            </div>

 

                        </div>
                    </div>
					
					
<script>
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


  function changing(elm) {
            var champ = elm.id;
            var val = document.getElementById(champ).value;
             //if ( (val != '')) {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('orders.updating') }}",
                method: "POST",
                data: {order: <?php echo $orderid; ?>, champ: champ, val: val, _token: _token},
                success: function (data) {
   
                }
            });

        }



		
		
var mode="collect";
  function valider() {
             var _token = $('input[name="_token"]').val();
			 var agence =null;
			 var adresse =null;
			  var gross = 0; //$('#gross').val();
			 
			 if(mode=='collect'){
			  agence = $('#agence_id').val();
			 }else{
			  adresse = $('#adresse_id').val();	 
			 }
	 
              var _token = $('input[name="_token"]').val();
            $.ajax({
                 url: "{{ route('validateproducts') }}",
                method: "POST",
                data: { agence:agence,adresse:adresse,mode:mode,gross:gross,amount:<?php echo $amount;?> , _token: _token},
                success: function (data) {
				
				
				
				//$('#successModal').modal('show') ;

			  
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
