
@extends('layouts.back')
 
 @section('content')

<?php
use App\Http\Controllers\HomeController ;
 $user = auth()->user();  

$commandes=HomeController::listecommandeslabo($user['client_id'] );
$modeles=HomeController::listemodeleslabo($user['client_id'] );
$prestations=HomeController::listeprestations($user['client_id'] );
//dd($natures );
$PrestLibs=array();
$PrestTypes=array();
 foreach($prestations as $prest)
{
	$PrestLibs[$prest->id]=$prest->lib;
	$PrestTypes[$prest->type_id]=$prest->type_lib;
 }
//sp_accueil_liste_nature_lot
$natures=HomeController::natures2( );
//dd($natures );
$Natures=array();
foreach($natures as $nature)
{
	$Natures[$nature->nature_lot_ident]=$nature->nature_lot_nom;
}
 
  $commande=HomeController::detailscommandelabo($id);
  

?>
  <nav aria-label="breadcrumb" style="width:100%">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('laboratoire')}}">{{__('msg.Laboratory')}}</a></li>
    <li class="breadcrumb-item"><a href="#">{{__('msg.order')}} <?php echo $commande[0]->id; ?></a></li>
	</ol>
 </nav>
						<div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-7 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.Order details')}} </h6>
                                </div>
                                <div class="card-body">
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-4">
											<label>{{__('msg.order')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php echo $commande[0]->id; ?></b>
										</div>
									</div>
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-4">
											<label>{{__('msg.Nature of the lot')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php   echo $Natures[$commande[0]->nature_ident];?></b>
										</div>
									</div>
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-4">
											<label>{{__('msg.Weight')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php echo $commande[0]->poids; ?> g</b>
										</div>
									</div>
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-4">
											<label>{{__('msg.Type of laboratory')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php echo $commande[0]->type_lab_lib; ?> </b>
										</div>
									</div>									
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-4">
											<label>{{__('msg.Choice of laboratory')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php echo $commande[0]->choix_lab_lib; ?> </b>
										</div>
									</div>
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-4">
											<label>{{__('msg.Amount')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php echo $commande[0]->montant; ?> €</b>
										</div>
									</div>									
									<?php    ?>									
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-4">
											<label>{{__('msg.Title')}} {{__('msg.Gold')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php echo $commande[0]->titrage_or; ?></b>
										</div>
									</div>
									<?php    ?>									
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-4">
											<label>{{__('msg.Title')}} {{__('msg.Silver')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php echo $commande[0]->titrage_argent; ?></b>
										</div>
									</div>
									<?php   ?>									
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-4">
											<label>{{__('msg.Title')}} {{__('msg.Platinum')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php echo $commande[0]->titrage_platine; ?></b>
										</div>
									</div>
									<?php    ?>
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-4">
											<label>{{__('msg.Title')}} {{__('msg.Palladium')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php echo $commande[0]->titrage_palladium; ?></b>
										</div>
									</div>
									<?php if(strlen($commande[0]->cmde_lab_comment) >1) {  ?>
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-4">
											<label>{{__('msg.Comment')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php echo $commande[0]->cmde_lab_comment; ?></b>
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
