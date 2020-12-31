
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
                                    <h6 class="m-0 font-weight-bold text-primary">Livraison</h6>
                                </div>
                                <div class="card-body">
 							 <h5>Choisir un mode de livraison</h5>
							 <div class="row pt-10 pb-20">
							 <div class="col-md-4 box pt-20 pl-20 pb-20 pr-20 ml-10 active"  onclick="$('#agency1').show('slow');$('#agency2').hide('slow');details()">
								<center>  Click & Collect 
								<img src="{{ URL::asset('public/img/box.png')}}" style="width:80px" class="mt-20"/></center>
							 </div>
							 <div class="col-md-4 box pt-20 pl-20 pb-20 pr-20 ml-10" onclick="$('#agency1').hide('slow');$('#agency2').show('slow');">
								<center>  Transporteur 
								<img src="{{ URL::asset('public/img/truck.png')}}" style="width:100px"/></center>
								
							 </div>
							 </div>
							 <div id="agency1">
 							 <h5>Adresse de prélèvement</h5>
							 <div class="row pt-10 pb-20">
							 
							 <div class="col-md-8">
							 
							 <select class="form-control" style="" id="agence" onchange="details()">
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
							 
							 <div class="pl-10 pr-10 pt-10 pt-10" >
 							 <b>Agence :</b>  <span id="lib"></span><br>
							 <b>Adresse :</b> <span id="adresse"></span><br>
							  <span id="zip"></span> <span id="ville"></span><br>
							 <b>Pays :</b> <span id="country"></span>
							 </div>
							 
							 </div>	

							 </div>	
							 
							 </div>		<!-- agency 1-->					 

							 <div id="agency2"  style="display:none">
 							 <h5>Adresse de livraison</h5>
							 <div class="row pt-10 pb-20">
							 
							 <div class="col-md-8">
							 
							 <select class="form-control" style="" id="livraison" onchange="setadresse()">
							 <option></option>
							 <?php
							  foreach($adresses as $adresse)
							 {
								 echo '<option value="'.$adresse->id.'" >'.$adresse->nom .'   |    <small>'.$adresse->adresse1 .'</small></option>';
								 
							 } 
							 ?>
							 
							 </select>
							<?php  
							foreach($adresses as $adresse)
							 { ?>
							 <div class="pl-10 pr-10 pt-10 pt-10" style="display:none" id="adresse-<?php echo $adresse->id;?>" >
 							 <b>Agence :</b>  <span  ><?php echo $adresse->nom; ?></span><br>
							 <b>Adresse :</b> <span  ><?php echo $adresse->adresse1; ?> <?php echo $adresse->adresse2; ?></span><br>
							  <span  ><?php echo $adresse->zip; ?></span> <span id="ville"><?php echo $adresse->ville; ?></span><br>
							 <b>Pays :</b> <span  >
							 <?php 
							 if($adresse->pays_code=='FR'){echo 'France';}   
							 if($adresse->pays_code=='PL'){echo 'Pologne';}   
							 if($adresse->pays_code=='GF'){echo 'Guyane française';}   
							 
							 ?>
							 </span>
							 </div>
							
							<?php } ?>
							 </div>	

							 
							 </div>		

							 
							 </div>							 



									
                                </div>
                            </div>

                       

                        </div>

                        <div class="col-lg-5 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cumul de la commande</h6>
                                </div>
                                <div class="card-body">
 
									<table class="mb-10">
								 
 									<tr style="border-top:1px solid lightgrey;border-bottom:1px solid lightgrey;"><td><b class="text-info pl-10">Pièces</b></td><td style="text-align:center"></td><td style="text-align:center" class=" " colspan="2"><b><?php echo  $pieces ;?></b></td>	</tr>
 									<tr style="border-top:1px solid lightgrey;border-bottom:1px solid lightgrey;"><td><b class="text-info pl-10">Poids total</b></td><td style="text-align:center"></td><td style="text-align:center" class=" " colspan="2"><b><?php echo  $weight ;?> g</b></td>	</tr>
									<tr style="border-top:1px solid lightgrey;border-bottom:1px solid lightgrey;"><td><b class="text-info pl-10">Façon option</b></td><td style="text-align:center"></td><td colspan="2" style="text-align:center" class=" "><b> <?php echo $comp_amount .' € HT';?></b></td>	</tr>
									<tr ><td><b class="pl-10 text-info">Façon totale</b></td><td style="text-align:center"></td><td style="text-align:center" class=" " colspan="2"><b><?php echo $amount ;?> € HT</b></td>	</tr>
									 									
									</table><br>
									<span class="mt-10 text-success " style="font-weight:bold" >METAUX FINS</span><br>
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
	var agence = $('#agence').val() ;
	var _token = $('input[name="_token"]').val();
	
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
	
function setadresse	(){
 var adresse = $('#livraison').val() ;
 
 $('#adresse-'+adresse).show( );
	
	
}

<?php if($agence_defaut>0){?>
//init default
details();
<?php }?>
</script>					
					

@endsection
