
@extends('layouts.back')
 
 @section('content')

<?php
 
use App\Http\Controllers\HomeController ;

//$referentiels=  HomeController::referentiel1() ;
$referentiels=  DB::table('type_famille')->where('type_id',$type)->where('fam1_id','<>',0)->get();
 $referentiels= $referentiels->unique('LIBFAM1');
//  dd($referentiels) ;
//HomeController::referentiel1() ;

 $Fam1 =DB::table('type_famille')->where('fam1_id',$famille1)->where('type_id',$type)->first();
 $libelle=$Fam1->LIBFAM1;
 if($type==101){$Type=  __('msg.Half Products') ;}
 if($type==102){$Type=  __('msg.Galvano') ;}
 if($type==103){$Type=  __('msg.Findings') ;}
 if($type==104){$Type= __('msg.Jewelry') ;}

$familles2=  HomeController::req_referentiel2() ;
 $fams2=array();
 $fams3=array();
foreach ($familles2 as $fam2)
    {
         $parents=  (array) json_decode (json_encode($fam2['parents'])) ;

          if(in_array($famille1,$parents)){
            array_push($fams2,$fam2['famille2']);
         }
    }

 
 $alliagesp= HomeController::alliage1($type,$famille1);			  
  //alliage1
  $alliages=HomeController::referentielalliage();			  
 $user = auth()->user();  
$alliage_user=$user['alliage'];
/*
$data=  DB::select ("CALL `sp_referentiel2`(); ");

if ($data!= null){

$result=array();
 foreach($data as $d)
{
$famille=$d->id;
//$libelle=$d->libelle;
 $parents=array();
 $familles2=array();

// 	   DB::select("SET @p0='$famille' ;");

//   $data2=  DB::select ("CALL `sp_referentiel2_parent`(@p0)");
$data2=  DB::table("type_famille")->where('fam2_id',$famille)->distinct('fam1_id')->pluck('fam1_id');
 $parents=array($data2);
 /*
 if(in_array($famille1,$parents)){
     array_push($familles2,$famille);
 }

 foreach ($parents as $p)
     {if ($p==$famille1){
         echo 'Famille : '.$famille;
     }}
 }

 }

 echo json_encode($familles2);
*/


?>
  <style>
  .form-check-label , .form-check-input{cursor:pointer;}
  </style>
					
    <div class="filtres mb-10">
	
    <div class="row pt-4">

            <!-- Sidebar -->
            <div class="col-lg-3    ">
				

                <div class="">
                    <!-- Grid row -->
                    <div class="row card pl-30 pt-20">
                      <div class="col-md-6 col-lg-12 mb-5">
				        <h5 class="font-weight-bold  text-primary"> <?php echo $Type;?></strong></h3>
						<hr style="width:120px" class="ml-20 mb-30 mt-20">
						<h5 class="font-weight-bold dark-grey-text"><strong>{{__('msg.Category')}} </strong></h3>
 						<div class="pl-30">
						<?php  
						 	foreach($referentiels as $fam) 
							{
								if($fam->fam1_id==$famille1){$selected="checked";}else{ $selected="";}
							// echo '<option value="'.$fam->fam1_id.'" '.$selected.'  > '.$fam->LIBFAM1.' </option>'	;
							  echo '
								<div class="form-group "  onclick="reset('.$fam->fam1_id.')"   >
                                <input class="form-check-input" name="groupfam2" type="radio" id="radio'.$fam->fam1_id.'"   '.$selected.' >
                                <label for="radio'.$fam->fam1_id.'" class="form-check-label dark-grey-text">'.$fam->LIBFAM1.'</label>
                                </div>		';					 
							}
						?>	
						</div>
 						<hr style="width:120px" class="ml-20 mb-30">
 
                            <h5 class="font-weight-bold dark-grey-text"><strong>{{__('msg.Sub category')}} </strong></h3>
                                 <div class="pl-30">
					 
								
                                <?php
                                foreach ($fams2 as $fam2)
                                {
                                $Fam=  DB::table('type_famille')->where('fam2_id',$fam2)->first();
                               // echo $Fam->LIBFAM2 .'<br>';
							   $referentiel3= HomeController::referentiel3();
								foreach($referentiel3 as $fam3 ){
									if($fam3->famille_id == $fam2){
									 array_push($fams3,$fam3->id);
	
									}
								}
                               echo 
							   '<div class="form-group "  onclick="Famille2('.$fam2.')">
                                <input class="form-check-input" name="groupfam2" type="radio" id="radio'.$fam2.'"   >
                                <label for="radio'.$fam2.'" class="form-check-label dark-grey-text">'.$Fam->LIBFAM2.'</label>
                                </div>';
								}?>
                                <!--Radio group-->
								</div>


                      <!--
						<hr style="width:120px" class="ml-20 mb-30 mt-20">

                              <h5 class="font-weight-bold dark-grey-text"><strong>{{__('msg.Family')}} 3</strong></h3>
                                <div class="divider"></div>
                              <div class="pl-30">
							  <div class="form-group ">
                                    <input class="form-check-input" name="groupfam3" type="radio" id="radiofam3" onclick="Famille3(null)" checked > 
                                    <label for="radiofam3" class="form-check-label dark-grey-text">{{__('msg.All')}}</label>
                                </div>	
								<?php /*
								foreach ($fams3 as $fam3)
                                {  
								  $Fam3=  DB::table('type_famille')->where('fam3_id',$fam3)->first();
								echo '<div class="form-group "  onclick="Famille3('.$fam3.')">
                                <input class="form-check-input" name="groupfam3" type="radio" id="radio'.$fam3.'">
                                <label for="radio'.$fam3.'" class="form-check-label dark-grey-text">'.$fam3.' - '.$Fam3->LIBFAM3.'</label>
                                </div>';
								}
 								*/
								?>
                        
                              </div>
								--->
                                
                         <!-- /Filter by category-->
						<hr style="width:120px" class="ml-20 mb-30 mt-20">

                             <h5 class="font-weight-bold dark-grey-text"><strong>{{__('msg.Metal')}}</strong></h3>
                                <div class="divider"></div>
                                 <div class="pl-30">

                                <!--Radio group 
                                <div class="form-group ">
                                    <input class="form-check-input" name="group100" type="radio" id="radioalliages" onclick="Metal(null)" checked > 
                                    <label for="radioalliages" class="form-check-label dark-grey-text">{{__('msg.None')}}</label>
                                </div>	-->							
                                <?php 
								
 								 		foreach ($alliages as $alliage)
										{
										foreach ($alliagesp as $alliagep)
										{
											if( $alliage->id ==  $alliagep->id ) 
										{
							 
								 ?>
									<div class="form-group " onclick="changing(<?php echo  $alliage->id ;?>)">
                                    <input class="form-check-input" name="group100" type="radio" id="radioa-<?php echo $alliage->id ;?>"   <?php if($alliage_user==$alliagep->id  ){echo 'checked';}  ?> > 
                                    <label for="radioa-<?php echo $alliage->id ;?>" class="form-check-label dark-grey-text"><?php echo $alliage->libelle ;?></label>
                                </div>	<?php
								
								
									}
									}
									}
									  ?>
								 
								<!--			
								<div class="form-group ">
                                    <input class="form-check-input" name="group100" type="radio" id="radio100" onclick="Metal(1)"  > 
                                    <label for="radio100" class="form-check-label dark-grey-text">{{__('msg.Gold')}}</label>
                                </div>
								
                                <div class="form-group">
                                    <input class="form-check-input" name="group100" type="radio" id="radiom1" onclick="Metal(2)"  >
                                    <label for="radiom1" class="form-check-label dark-grey-text">{{__('msg.Silver')}}</label>
                                </div>

                                <div class="form-group">
                                    <input class="form-check-input" name="group100" type="radio" id="radiom2"  onclick="Metal(3)" >
                                    <label for="radiom2" class="form-check-label dark-grey-text">{{__('msg.Platinum')}}</label>
                                </div>

                                <div class="form-group">
                                    <input class="form-check-input" name="group100" type="radio" id="radiom3"  onclick="Metal(4)" >
                                    <label for="radiom3" class="form-check-label dark-grey-text">{{__('msg.Palladium')}}</label>
                                </div>

                                <div class="form-group">
                                    <input class="form-check-input" name="group100" type="radio" id="radiom4"  onclick="Metal(5)" >
                                    <label for="radiom4" class="form-check-label dark-grey-text">{{__('msg.Rhodium')}}</label>
                                </div>
								
                                <div class="form-group">
                                    <input class="form-check-input" name="group100" type="radio" id="radiom5"  onclick="Metal(9)" >
                                    <label for="radiom5" class="form-check-label dark-grey-text">{{__('msg.Rhodium')}}</label>
                                </div>-->							
                                 </div>
								 
                     </div>
                    <!-- /Grid row -->
					</div>
                    <!-- Grid row -->
                    <div class="row">

                        <!-- Filter by price  -- 
                        <div class="col-md-6 col-lg-12 mb-5">
                            <h5 class="font-weight-bold dark-grey-text"><strong>Price</strong></h3>
                                <div class="divider"></div>

                                <form class="range-field mt-3">
                                    <input id="calculatorSlider" class="no-border" type="range" value="0" min="0" max="30" />
                                </form>

                                <!-- Grid row -- 
                                <div class="row justify-content-center">

                                    <!-- Grid column -- 
                                    <div class="col-md-6 text-left">
                                        <p class="dark-grey-text"><strong id="resellerEarnings">0$</strong></p>
                                    </div>
 
                                     <div class="col-md-6 text-right">
                                        <p class="dark-grey-text"><strong id="clientPrice">319$</strong></p>
                                    </div>
                                    <!-- Grid column -- 
                                </div>
                                <!-- Grid row -- 

                        </div>-->
                        <!-- /Filter by price -->

         
                     </div>
                    <!-- /Grid row -->
                </div>

            </div>
            <!-- /.Sidebar -->

            <!-- Content -->
            <div class="col-lg-9">

                <!-- Filter Area -->
              <!--  <div class="row">

                    <div class="col-md-4 mt-3">
                    </div>
                    <div class="col-md-8 text-right">

                    </div>

                </div>-->
                <!-- /.Filter Area -->

                <!-- Products Grid -->
                <section class="section ">

                    <!-- Grid row -->
                    <div class="row"   id="data-products">

                     <?php 
					 $products = DB::table('type_famille')->where('fam1_id',$famille1)->limit(16)->get();
					 
					 
					 foreach($products as $prod)
					 { 
					 $titre= $prod->LIBFAM1.' '.$prod->LIBFAM2 .' '.$prod->LIBFAM3;
					 $titre=strtolower($titre);
					 $img=''; $image=DB::table('photo')->where('photo_id',$prod->photo_id)->first();
					 if(isset($image)){ $img=$image->url;}
					// $img=(substr($img,32,strlen($img)));
					 
						 echo
						 '
                         <div class="col-lg-4 col-md-12 mb-4">

                            <!--Card-->
                            <div class="card card-ecommerce">

                                <!--Card image-->
                                <div class="view overlay" style="min-height:180px">
                                    <center><a href="'.route("single",['type'=>$type,'fam1'=>$famille1,'fam2'=>$prod->fam2_id,'fam3'=>$prod->fam3_id]).'"><img style="max-height:180px" src="'.$img.'" class="img-fluid" alt=""></a></center>
                                    <a>
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>
                                <!--Card image-->

                                <!--Card content-->
                                <div class="card-body">
                                    <!--Category & Title-->

                                    <h5 class="card-title mb-1" style="min-height:72px"><strong><a href="'.route("single",['type'=>$type,'fam1'=>$famille1,'fam2'=>$prod->fam2_id,'fam3'=>$prod->fam3_id]).'" class="dark-grey-text">'.$titre.'</a></strong></h5>
									<!--<span class="badge badge-danger mb-2">famille2</span>-->
 

                                    <!--Card footer-->
                                    <div class="card-footer pb-4 bg-primary mt-20 mb-10" style="color:white;height:40px;padding-bottom:4px">
                                        <div class="row mb-0">
                                          <!--  <span class="float-left"><strong>1439$</strong></span>-->
                                            <span class="float-right">

                                        <center><a style="color:white" href="'.route("single",['type'=>$type,'fam1'=>$famille1,'fam2'=>$prod->fam2_id,'fam3'=>$prod->fam3_id]).'" class="pb-5" data-toggle="tooltip" data-placement="top" title="'.__("msg.View product").'"><i class="fas fa-eye ml-3"></i> '.__("msg.View product").'</a></center>
                                        </span>
                                        </div>
                                    </div>
                       
                                </div>
                                <!--Card content-->

                            </div>
                            <!--Card-->

                        </div>
												  
						 
						 
						 ';
					 }
					 ?>   
						
						
                    </div>
                    <!--Grid row-->

    
            
                    <div class="row justify-content-center mb-4">

                     
                    </div>
                    <!--Grid row-->
                </section>
                <!-- /.Products Grid -->

            </div>
            <!-- /.Content -->

        </div>

    </div>
    <!-- /.Main Container -->
					
<style>
#loading
{
	text-align:center; 
	background: url('loader.gif') no-repeat center; 
	height: 150px;
}
</style>		
<?php
// $urlapp="//$_SERVER[HTTP_HOST]/epic"; 
 $urlapp=env('APP_URL');

?>
			
<script>
var metal='';					
var famille2='';					
var famille3='';		

function Famille2(fam2)
{
	famille2=fam2;
	filter();
}
function Famille3(fam3)
{
	famille3=fam3;
    filter();

}
function Metal(metal)
{
	metal=metal;
	filter();

}	

function filter()
{
	        $('#data-products').html('<div id="loading" style="" ></div>');

	        var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('home.data') }}",
                method: "POST",
                data: {type:<?php echo $type; ?>,famille1:<?php echo $famille1;?> ,famille2: famille2, famille3: famille3, metal: metal, _token: _token},
                success: function (data) {
                $('#data-products').html(data);
				
                }
            });
	
	
}		


   function changing(val) {
           
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
		
	function reset(fam1){
		// var fam1 = $('#fam1').val();
		//var url="{{ route('catalog',['type'=>,'<?php echo $type;?>'famille1'=>"+fam1+"]) }}";
		//url= document.location.hostname+'/epic' 
		document.location.href='<?php echo $urlapp;?>'+'/catalog/'+<?php echo $type;?>+'/'+fam1;
	}	
 </script>					
					
@endsection
