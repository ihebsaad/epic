

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
	 
  //echo json_encode($product);
  //dd($product);
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
											Mesure 1: </br><b><?php   echo $product[0]['NAT_MESURE1'] ; ?></b>
										</div>
										<div class="col-md-4">
											Mesure 2: </br><b><?php  echo $product[0]['NAT_MESURE2'] ; ?></b>
										</div>	
										<div class="col-md-4">
											Unité : </br><b><?php  echo $unite->UNIT_LIB_LONG; ?></b>
										</div>											
									</div>
									
							 
									<?php $mesures= $product[0]['mesures'];
									//dd($mesures);
 									?>
									<div class="row pl-10">
									  Mesures :  <br> 
                                      <select class="form-control">
  									   <?php
 									   foreach ($mesures as $mesure) {
									    //dd($mesure->MESURE2[0]->MESURE2 );
									   ?>
									  <option value="<?php 	echo $mesure->MESURE1.' '.$mesure->MESURE2[0]->MESURE2  ; ?>"> Mesure 1 : <?php 	echo $mesure->MESURE1  ; ?>   Mesure 2 : <?php 	echo $mesure->MESURE2[0]->MESURE2 ; ?></option>
									   <?php } ?>	
									   		  </select>

 									</div>									
									  <?php } ?>										
									<div class="row mt-10">
									 <div class="col-md-4">{{__('msg.Metal')}}<br>
									 <select class="form-control">
									 <option value="or">{{__('msg.Gold')}}</option>
									 <option value="argent">{{__('msg.Silver')}}</option>
									 <option value="platine">{{__('msg.Platinum')}}</option>
									 </select>
									 </div> 
									 <div class="col-md-4">{{__('msg.Title')}}<br>
									 <select class="form-control">
									 </select>									 
									 </div> 
									 <div class="col-md-4">{{__('msg.Color')}}<br>
									 <select class="form-control">
									 </select>
									 </div> 
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

@endsection					