
@extends('layouts.back')
 
 @section('content')

<?php
use App\Http\Controllers\HomeController ;
 $user = auth()->user();  

  $natures=HomeController::natures( );
 $Natures=array();
foreach($natures as $nature)
{
	$Natures[$nature->nature_lot]=$nature->libelle;
}
 
  $commande=HomeController::detailscommande($id);
  

?>
 
						<div class="row">
 <nav aria-label="breadcrumb" style="width:100%">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('affinage')}}">{{__('msg.Buyback of precious metals')}}</a></li>
    <li class="breadcrumb-item"><a href="#">{{__('msg.order')}} <?php echo $commande[0]->cmde_aff_lg; ?></a></li>
	</ol>
 </nav>
                        <!-- Content Column -->
                        <div class="col-lg-7 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.Order details')}} </h6>
                                </div>
                                <div class="card-body">
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-9">
											<label>{{__('msg.order')}}: </label>
										</div>
									    <div class="col-lg-9">
										<b><?php echo $commande[0]->cmde_aff_lg; ?></b>
										</div>
									</div>
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-9">
											<label>{{__('msg.Nature of the lot')}}: </label>
										</div>
									    <div class="col-lg-9">
										<b><?php   echo $Natures[$commande[0]->nature_ident];?></b>
										</div>
									</div>
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-9">
											<label>{{__('msg.Announcement weight')}}: </label>
										</div>
									    <div class="col-lg-9">
										<b><?php echo $commande[0]->poids_annonce; ?> g</b>
										</div>
									</div>
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-9">
											<label>{{__('msg.Weight received')}}: </label>
										</div>
									    <div class="col-lg-9">
										<b><?php echo $commande[0]->poids_recu; ?> g</b>
										</div>
									</div>									
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-9">
											<label>{{__('msg.Weight after casting')}}: </label>
										</div>
									    <div class="col-lg-9">
										<b><?php echo $commande[0]->poids_apres_fonte; ?> g</b>
										</div>
									</div>
									<?php   if($commande[0]->titre_or !='') { ?>									
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-9">
											<label>{{__('msg.Title')}} {{__('msg.Gold')}}: </label>
										</div>
									    <div class="col-lg-9">
										<b><?php echo $commande[0]->titre_or; ?></b>
										</div>
									</div>
									<?php } if($commande[0]->titre_ag !='') { ?>									
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-9">
											<label>{{__('msg.Title')}} {{__('msg.Silver')}}: </label>
										</div>
									    <div class="col-lg-9">
										<b><?php echo $commande[0]->titre_ag; ?></b>
										</div>
									</div>
									<?php } if($commande[0]->titre_pt !='') { ?>									
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-9">
											<label>{{__('msg.Title')}} {{__('msg.Platinum')}}: </label>
										</div>
									    <div class="col-lg-9">
										<b><?php echo $commande[0]->titre_pt; ?></b>
										</div>
									</div>
									<?php } if($commande[0]->titre_pd !='') { ?>
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-9">
											<label>{{__('msg.Title')}} {{__('msg.Palladium')}}: </label>
										</div>
									    <div class="col-lg-9">
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
