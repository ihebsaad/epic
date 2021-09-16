
@extends('layouts.back')
 
 @section('content')

<?php
use App\Http\Controllers\ModelesController ;
 $user = auth()->user();  

  $natures=ModelesController::natures3( );
 $Natures=array();
foreach($natures as $nature)
{
	$Natures[$nature->nature_lot]=$nature->libelle;
}
 
  $commande=ModelesController::detailscommandermp($id);
   

?>
 
 <div class="row">
 <nav aria-label="breadcrumb" style="width:100%">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('rachat')}}">{{__('msg.Buyback of precious metals')}}</a></li>
    <li class="breadcrumb-item"><a href="#">{{__('msg.order')}} <?php echo $commande[0]->ident; ?></a></li>
	</ol>
 </nav>
  <style>label{font-weight:bold;color:black;}
 </style>
                        <!-- Content Column -->
                        <div class="col-lg-7 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.Order details')}} </h6>
                                </div>
                                <div class="card-body">
									<div class="row pl-20 pr-20 pb-10" style="border-left:2px solid #e6d685;margin-bottom:6px;">
										<div class="col-lg-4">
											<label>{{__('msg.order')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php echo $commande[0]->ident; ?></b>
										</div>
									</div>
									<div class="row pl-20 pr-20 pb-10" style="border-left:2px solid #e6d685;margin-bottom:6px;">
										<div class="col-lg-4">
											<label>{{__('msg.Nature of the batch')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php   echo $Natures[$commande[0]->nature_ident];?></b>
										</div>
									</div>
									<div class="row pl-20 pr-20 pb-10" style="border-left:2px solid #e6d685;margin-bottom:6px;">
										<div class="col-lg-4">
											<label>{{__('msg.Claimed weight')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php echo $commande[0]->poids_annonce; ?> g</b>
										</div>
									</div>
								<?php if (floatval($commande[0]->poids_recu)>0){?>
								<div class="row pl-20 pr-20 pb-10" style="border-left:2px solid #e6d685;margin-bottom:6px;">
										<div class="col-lg-4">
											<label>{{__('msg.Received weight')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php echo $commande[0]->poids_recu; ?> g</b>
										</div>
									</div>	
								<?php } ?>	
								<?php if (floatval($commande[0]->poids_apres_fonte)>0){?>								
									<div class="row pl-20 pr-20 pb-10" style="border-left:2px solid #e6d685;margin-bottom:6px;">
										<div class="col-lg-4">
											<label>{{__('msg.Weight after casting')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php echo $commande[0]->poids_apres_fonte; ?> g</b>
										</div>
									</div>
								<?php } ?>	
									
									<?php   if(strlen($commande[0]->titre_or)>1) { ?>									
									<div class="row pl-20 pr-20 pb-10" style="border-left:2px solid #e6d685;margin-bottom:6px;">
										<div class="col-lg-4">
											<label>{{__('msg.Content')}} {{__('msg.Gold')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php echo $commande[0]->titre_or; ?></b>
										</div>
									</div>
									<?php } if(strlen($commande[0]->titre_ag )>1) { ?>									
									<div class="row pl-20 pr-20 pb-10" style="border-left:2px solid #e6d685;margin-bottom:6px;">
										<div class="col-lg-4">
											<label>{{__('msg.Content')}} {{__('msg.Silver')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php echo $commande[0]->titre_ag; ?></b>
										</div>
									</div>
									<?php } if(strlen($commande[0]->titre_pt )>1) { ?>									
									<div class="row pl-20 pr-20 pb-10" style="border-left:2px solid #e6d685;margin-bottom:6px;">
										<div class="col-lg-4">
											<label>{{__('msg.Content')}} {{__('msg.Platinum')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php echo $commande[0]->titre_pt; ?></b>
										</div>
									</div>
									<?php } if(strlen($commande[0]->titre_pd) >1) { ?>
									<div class="row pl-20 pr-20 pb-10" style="border-left:2px solid #e6d685;margin-bottom:6px;">
										<div class="col-lg-4">
											<label>{{__('msg.Content')}} {{__('msg.Palladium')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php echo $commande[0]->titre_pd; ?></b>
										</div>
									</div>
									<?php } ?>
									
									
								</div>
                              </div>

                       

                        </div>

                        <!--<div class="col-lg-5 mb-4">

                             <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">  </h6>
                                </div>
                                <div class="card-body">
 
 
                                </div>
                            </div>
 
                        </div>-->
						
						
						
                    </div>

@endsection
