
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

                        <!-- Content Column -->
                        <div class="col-lg-7 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Détails de la commande </h6>
                                </div>
                                <div class="card-body">
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-9">
											<label>Commande: </label>
										</div>
									    <div class="col-lg-9">
										<b><?php echo $commande[0]->cmde_aff_lg; ?></b>
										</div>
									</div>
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-9">
											<label>Nature du lot: </label>
										</div>
									    <div class="col-lg-9">
										<b><?php   echo $Natures[$commande[0]->nature_ident];?></b>
										</div>
									</div>
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-9">
											<label>Poids Annonce: </label>
										</div>
									    <div class="col-lg-9">
										<b><?php echo $commande[0]->poids_annonce; ?> g</b>
										</div>
									</div>
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-9">
											<label>Poids Reçu: </label>
										</div>
									    <div class="col-lg-9">
										<b><?php echo $commande[0]->poids_recu; ?> g</b>
										</div>
									</div>									
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-9">
											<label>Poids Après Fonte: </label>
										</div>
									    <div class="col-lg-9">
										<b><?php echo $commande[0]->poids_apres_fonte; ?> g</b>
										</div>
									</div>
									<?php   if($commande[0]->titre_or !='') { ?>									
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-9">
											<label>Titre Or: </label>
										</div>
									    <div class="col-lg-9">
										<b><?php echo $commande[0]->titre_or; ?></b>
										</div>
									</div>
									<?php } if($commande[0]->titre_ag !='') { ?>									
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-9">
											<label>Titre Argent: </label>
										</div>
									    <div class="col-lg-9">
										<b><?php echo $commande[0]->titre_ag; ?></b>
										</div>
									</div>
									<?php } if($commande[0]->titre_pt !='') { ?>									
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-9">
											<label>Titre Platine: </label>
										</div>
									    <div class="col-lg-9">
										<b><?php echo $commande[0]->titre_pt; ?></b>
										</div>
									</div>
									<?php } if($commande[0]->titre_pd !='') { ?>
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-9">
											<label>Titre Palladium: </label>
										</div>
									    <div class="col-lg-9">
										<b><?php echo $commande[0]->titre_pd; ?></b>
										</div>
									</div>
									<?php } ?>
									
									
								</div>
                              </div>

                       

                        </div>

                        <div class="col-lg-5 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">  </h6>
                                </div>
                                <div class="card-body">
 
 
                                </div>
                            </div>

               

                        </div>
                    </div>

@endsection
