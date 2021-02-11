
@extends('layouts.back')
 
 @section('content')

<?php
use App\Http\Controllers\HomeController ;
 $user = auth()->user();  

 $commandes=HomeController::commandes_ac($user['client_id'] );
  $modeles=HomeController::modeles_ac($user['client_id'] );
 $euros=HomeController::compte_euro($user['client_id'] );
    $poids=HomeController::compte_poids($user['client_id'] );
   $natures=HomeController::natures2( );
 $Natures=array();
 $NaturesC=array();
foreach($natures as $nature)
{
	//if($nature->metier_CODE=='LAB'){
	$Natures[$nature->nature_lot_ident]=$nature->nature_lot_nom;
	$NaturesC[$nature->nature_lot_ident]=$nature->nature_lot_commentaire;
	//}
}
 
?>
<b>{{__('msg.welcome to your saamp page')}}</b><br>

<br>

	<div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-7 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
 
								 
								<div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.My Orders')}}</h6>
                                </div>
  

								
                                <div class="  ">
                                    <a href="#div0" class="d-block card-header " data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
										<h6 class="m-0 font-weight-bold text-dark">{{__('msg.In Progress')}}</h6>
									</a>
                                </div>
                                <div id="div0" class="card-body  ">
								
								<a style="float:right;right:20px;background-color:#e6d685;color:black;font-weight:bold;padding:5px 10px 5px 10px;margin-top:-8px"  href="#"  data-toggle="modal" data-target="#Modal1" >{{__('msg.Complete list')}}</a><div class="clearfix"></div>
								
				<?php $i=0; ?>
				@foreach($commandes as $cmd)                                     
			<?php  
			$etat=(strtoupper($cmd->etat));
			if($etat=='ENCOURS' ||$etat=='EN COURS'  ){  	
			$i++;
			if($i<4){
			?>	
			<span style="color:lightgrey;font-weight:bold;"><?php echo  date('d/m/Y', strtotime($cmd->date_cmde)); ?></span>
			<div class="row   pl-30" style="padding-bottom:3px;;margin-top:-4px">
			<div class="col-md-4" style="border-left:2px solid #e6d685">
			<b style="color:black;">{{__('msg.Type')}}:</b>  <?php echo $cmd->type_cmde; ?><div class="clearfix"></div>
			<b style="color:black;">{{__('msg.Qty')}}:</b>  <?php echo $cmd->qte; ?>
			</div>
			<div class="col-md-4" style="border-left:2px solid #e6d685">
			<b style="color:black;">{{__('msg.Weight')}}:</b>  <?php echo $cmd->poids; ?> g<div class="clearfix"></div>
			<b style="color:black;">{{__('msg.Labour cost')}}:</b>  <?php if($cmd->facon>0){echo $cmd->facon.' €';} ?>			
			</div>	
			<div class="col-md-2">
			<?php 
			if(trim(strtoupper($cmd->type_cmde))=='AFFINAGE'){  $lien=URL("commande/".$cmd->id) ;  }
			if(trim(strtoupper($cmd->type_cmde))=='PRODUIT'){  $lien=URL("commandeprod/".$cmd->id) ;  }
			if(trim(strtoupper($cmd->type_cmde))=='LABORATOIRE'){  $lien=URL("commandelab/".$cmd->id) ;  }
			if(trim(strtoupper($cmd->type_cmde))=='RACHAT METAUX'){  $lien=URL("commandermp/".$cmd->id) ;  }
			?>
			<small><a href="<?php echo $lien; ?>">{{__('msg.More details')}}</a></small>
			</div>	
			</div>
			 
	 
			<?php }
			}  ?>	
			@endforeach								
      								 
           </div>
								
								
                                <div class="  ">
                                    <a href="#div1" class="d-block card-header " data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
										<h6 class="m-0 font-weight-bold text-dark">{{__('msg.Finished')}}</h6>
									</a>
                                </div>
                                <div id="div1" class="card-body  ">
   								<a style="float:right;right:20px;background-color:#e6d685;color:black;font-weight:bold;padding:5px 10px 5px 10px;margin-top:-8px"  href="#"  data-toggle="modal" data-target="#Modal2" >{{__('msg.Complete list')}}</a><div class="clearfix"></div>

				<?php $i=0; ?>
				@foreach($commandes as $cmd)                                     
			<?php  
			$etat=(strtoupper($cmd->etat));
			if($etat=='TERMINEE'    ){  $i++;
			if($i<4){
			?>	
			<span style="color:lightgrey;font-weight:bold;margin-bottom:3px"><?php echo  date('d/m/Y', strtotime($cmd->date_cmde)); ?></span>
			<div class="row   pl-30" style="padding-bottom:3px;margin-top:-4px">
			<div class="col-md-4" style="border-left:2px solid #e6d685">
			<b style="color:black;">{{__('msg.Type')}}:</b>  <?php echo $cmd->type_cmde; ?><div class="clearfix"></div>
			<b style="color:black;">{{__('msg.Qty')}}:</b>  <?php echo $cmd->qte; ?>
			</div>
			<div class="col-md-4" style="border-left:2px solid #e6d685">
			<b style="color:black;">{{__('msg.Weight')}}:</b>  <?php echo $cmd->poids; ?> g<div class="clearfix"></div>
			<b style="color:black;">{{__('msg.Labour cost')}}:</b>  <?php if($cmd->facon>0){echo $cmd->facon.' €';} ?>			
			</div>	
			<div class="col-md-2">
			<?php 
			if(trim(strtoupper($cmd->type_cmde))=='AFFINAGE'){  $lien=URL("commande/".$cmd->id) ;  }
			if(trim(strtoupper($cmd->type_cmde))=='PRODUIT'){  $lien=URL("commandeprod/".$cmd->id) ;  }
			if(trim(strtoupper($cmd->type_cmde))=='LABORATOIRE'){  $lien=URL("commandelab/".$cmd->id) ;  }
			if(trim(strtoupper($cmd->type_cmde))=='RACHAT METAUX'){  $lien=URL("commandermp/".$cmd->id) ;  }
			?>
			<small><a href="<?php echo $lien; ?>">{{__('msg.More details')}}</a></small>
			</div>	
			</div>
			 
	 
			<?php }
			}  ?>	
			@endforeach
    
   
                                </div>								
                            </div>

                       
					   
  

                             <div class="card shadow mb-4">
                                <div class=" ">
                                    <a href="#div3" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls=" CardExample">
										<h6 class="m-0 font-weight-bold text-primary">{{__('msg.My Euros Account')}}</h6>
									</a>
                                </div>
                                <div id="div3" class="card-body  ">
							 <a style="float:right;right:20px;background-color:#e6d685;color:black;font-weight:bold;padding:5px 10px 5px 10px;margin-top:-8px"  href="#"  data-toggle="modal" data-target="#Modal4" >{{__('msg.Complete list')}}</a><div class="clearfix"></div>
							   
<h2 class=" " style="text-align:center;font-weight:bold;color:black;margin-top:-15px"><span style="letter-spacing:2px">{{__('msg.Balance')}}:</span> 1496.00 €</h2>
			<div class="pl-40">	
		 <?php $i=0;?>   
	  @foreach($euros as $euro)  
										
			<?php $i++;
			if($euro->solde >= 0){$style="color:#54ba1d;";}else{$style="color:#d03132";} ?>
			<?php if($i<5){?>							
			<span style="color:lightgrey;font-weight:bold; "><?php echo  date('d/m/Y', strtotime($euro->ecrit_date)); ?></span>
			<div class="row   ">
			<div class="col-md-6 pl-30" style="border-left:2px solid #e6d685">
			<?php echo $euro->libelle; ?><div class="clearfix"></div>
 			</div>
			<div class="col-md-4" style=""  >
			<span style="text-align:center;width:120px;float:right;font-weight:bold;;width:130px;padding:5px 10px 5px 10px;<?php echo $style;?>" ><?php echo $euro->solde.'€'; ?></span>
			</div>
	 
			</div>
			<?php } ?>							

	 @endforeach
			</div>					
                                </div>
                            </div>

							

                        </div>

                        <div class="col-lg-5 mb-4">


							
			                           <div class="card shadow mb-4">
                                <div class="  ">
                                    <a href="#div2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">								
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.My templates')}}</h6>
									</a>
                                </div>
                                <div id="div2" class="card-body ">
							 <a style="float:right;right:20px;background-color:#e6d685;color:black;font-weight:bold;padding:5px 10px 5px 10px;margin-top:-8px"  href="#"  data-toggle="modal" data-target="#Modal3" >{{__('msg.Complete list')}}</a><div class="clearfix"></div>


			<?php $i=0;?>
			  @foreach($modeles as $modele)          
			<?php $i++; if($i<5){ ?>
			  
			<div class="row " style="padding-bottom:5px;padding-top:5px;margin-bottom:10px;border-bottom:1px dotted #e6d685;border-left:2px solid #e6d685">
				<div class="col-lg-6 col-xs-12" style="color:black;"> <b style="color:black"><?php echo $modele->nom; ?></b><br>
				<small>{{__('msg.Nature')}}:  <?php echo $Natures[$modele->nature]; ?><br> {{__('msg.Weight')}}:  <?php echo  $modele->poids.'g' ; ?></small>
				</div>
				<div class="col-lg-6 col-xs-12"> 
  				 <?php if($modele->AU>0) {?><div id="gold" class="pb-10"> {{__('msg.Gold')}} </div><?php } ?>	
 				 <?php if($modele->AG>0) {?><div id="silver" class="pb-10"> {{__('msg.Silver')}} </div><?php } ?>	
 				 <?php if($modele->PT>0) {?><div id="platine" class="pb-10"> {{__('msg.Platinum')}} </div><?php } ?>		
 				 <?php if($modele->PD>0) {?><div id="pallad" class="pb-10"> {{__('msg.Palladium')}} </div><?php } ?>	
 
			</div>
			
			</div>
			<?php } ?>
 			@endforeach
			
			
			
                                </div>
                            </div>				
							
                             <div class="card shadow mb-4">
                                <div class=" ">
                                    <a href="#div4" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
										<h6 class="m-0 font-weight-bold text-primary">{{__('msg.My Metal Account')}}</h6>
									</a>
                                </div>
								<style>
								.metal{height:50px;padding-top:15px;margin-bottom:10px;color:white;max-width:100px;}
								</style>
                                 <div id="div4" class="card-body"> 
								 <?php   
							 	 if($poids[0]->solde_au >= 0){$style1="color:#54ba1d";}else{$style1="color:#d03132";}
								 if($poids[0]->solde_ag >= 0){$style2="color:#54ba1d";}else{$style2="color:#d03132";} 
								 if($poids[0]->solde_pt >= 0){$style3="color:#54ba1d";}else{$style3="color:#d03132";}   
								 if($poids[0]->solde_pd >= 0){$style4="color:#54ba1d";}else{$style4="color:#d03132";}   
								  ?>
									<div class="row pb-10"><div class="col-md-5 col-sm-5" style="max-width:200px;color:black;"> <a href="<?php echo URL('virement?metal=1') ;?>"  ><img src="{{ URL::asset('public/img/gold.png')}}" /></a>  </div><div class="col-md-5 col-sm-5 mt-10 pl-20" style="max-width:120px;"><a href="<?php echo URL('virement?metal=1') ;?>"  ><B style="color:black">{{__('msg.Gold')}}</B><br><b style="<?php  echo $style1;?>"><?php echo  $poids[0]->solde_au; ?> g</b></a></div></div>
									<div class="row pb-10"><div class="col-md-5 col-sm-5" style="max-width:200px;color:black;"> <a href="<?php echo URL('virement?metal=2') ;?>"  ><img src="{{ URL::asset('public/img/silver.png')}}" /></a></div><div class="col-md-5 col-sm-5 mt-10 pl-20" style="max-width:120px;"><a href="<?php echo URL('virement?metal=2') ;?>"  ><B style="color:black"> {{__('msg.Silver')}}</B><br><b style="<?php  echo $style2;?>"><?php echo  $poids[0]->solde_ag; ?> g</b></a></div></div>
									<div class="row pb-10"><div class="col-md-5 col-sm-5" style="max-width:200px;color:black;"> <a href="<?php echo URL('virement?metal=3') ;?>"  ><img src="{{ URL::asset('public/img/platin.png')}}" /></a></div><div class="col-md-5 col-sm-5 mt-10 pl-20" style="max-width:120px;"> <a href="<?php echo URL('virement?metal=3') ;?>"  ><B style="color:black"> {{__('msg.Platinum')}}</B><br><b style="<?php  echo $style3;?>"><?php echo  $poids[0]->solde_pt; ?> g</b></a></div></div>
									<div class="row pb-10"><div class="col-md-5 col-sm-5" style="max-width:200px;color:black;"> <a href="<?php echo URL('virement?metal=4') ;?>"  ><img src="{{ URL::asset('public/img/palla.png')}}" /> </a> </div><div class="col-md-5 col-sm-5 mt-10 pl-20" style="max-width:120px;"><a href="<?php echo URL('virement?metal=4') ;?>"  ><B style="color:black"> {{__('msg.Palladium')}}</B><br><b style="<?php  echo $style4;?>"><?php echo  $poids[0]->solde_pd; ?> g</b></a></div></div>
								 <?php   ?>
                                </div>
                            </div>
							
							
							
                        </div>
						
                       <div class="col-lg-6 mb-4">
 

                        </div>						
   </div>

   
   
   
 <!--   Modal 1 -->
  <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="">
    <div class="modal-dialog" role="document" style="width: 75%;margin: 0 auto;">
      <div class="modal-content"  style="">
        <div class="modal-header">
          <h5 class="modal-title text-center" ><center>{{__('msg.My Orders')}} - {{__('msg.In Progress')}}</center></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" style="">
 
        <table   class="table table-striped mb-40"  style="width:100%">
            <thead>
            <tr id="headtable">
                <th class="text-center">ID</th>
                <th class="text-center">{{__('msg.Date')}}</th>
                <th class="text-center">{{__('msg.Qty')}}</th>
                <th class="text-center">{{__('msg.Weight')}}</th>
                <th class="text-center hidemobile">{{__('msg.Labour cost')}}</th>
                <th class="text-center hidemobile">{{__('msg.Type')}}</th>
               </tr>
            </thead>
            <tbody>
            @foreach($commandes as $cmd)                                     
			<?php 
			$etat=(strtoupper($cmd->etat));
			if($etat=='ENCOURS' ||$etat=='EN COURS'  ){ ?>	
			<?php 
			if(trim(strtoupper($cmd->type_cmde))=='AFFINAGE'){  $lien=URL("commande/".$cmd->id) ;  }
			if(trim(strtoupper($cmd->type_cmde))=='PRODUIT'){  $lien=URL("commandeprod/".$cmd->id) ;  }
			if(trim(strtoupper($cmd->type_cmde))=='LABORATOIRE'){  $lien=URL("commandelab/".$cmd->id) ;  }
			if(trim(strtoupper($cmd->type_cmde))=='RACHAT METAUX'){  $lien=URL("commandermp/".$cmd->id) ;  }
			?>			
			<tr>
				<td class="text-center"><a href="<?php echo $lien;?>"><?php echo  $cmd->id ; ?></td>	
				<td class="text-center"><?php echo  date('d/m/Y', strtotime($cmd->date_cmde)); ?></td>	
				<td class="text-center"><?php echo $cmd->qte; ?></td>	
				<td class="text-center"><?php echo $cmd->poids; ?>g</td>	
				<td class="text-center  hidemobile"><?php if($cmd->facon>0){echo $cmd->facon.'€';} ?></td>	
				<td class="text-center  hidemobile"><?php echo $cmd->type_cmde; ?></td>	
			</tr>	
			<?php }  ?>	
			@endforeach
			</tbody>
			</table>
			
		</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">{{__('msg.Close')}}</button>
         </div>
		
		 </form>
      </div>
    </div>
  </div>	  
   
   
    
 <!--   Modal 2 -->
  <div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center"  ><center>{{__('msg.My Orders')}} - {{__('msg.Finished')}}</center></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" style="">
 
         <table   class="table table-striped mb-40"  style="width:100%">
            <thead>
            <tr id="headtable">
                <th class="text-center">ID</th>
                <th class="text-center">{{__('msg.Date')}}</th>
                <th class="text-center">{{__('msg.Qty')}}</th>
                <th class="text-center">{{__('msg.Weight')}}</th>
                <th class="text-center hidemobile">{{__('msg.Labour cost')}}</th>
                <th class="text-center hidemobile">{{__('msg.Type')}}</th>
               </tr>
            </thead>
            <tbody>
            @foreach($commandes as $cmd)                                     
			<?php 
			$etat=(strtoupper($cmd->etat));
			if($etat=='TERMINEE'    ){ ?>	
			<?php 
			if(trim(strtoupper($cmd->type_cmde))=='AFFINAGE'){  $lien=URL("commande/".$cmd->id) ;  }
			if(trim(strtoupper($cmd->type_cmde))=='PRODUIT'){  $lien=URL("commandeprod/".$cmd->id) ;  }
			if(trim(strtoupper($cmd->type_cmde))=='LABORATOIRE'){  $lien=URL("commandelab/".$cmd->id) ;  }
			if(trim(strtoupper($cmd->type_cmde))=='RACHAT METAUX'){  $lien=URL("commandermp/".$cmd->id) ;  }
			?>			
			<tr>
				<td class="text-center"><a href="<?php echo $lien;?>"><?php echo  $cmd->id ; ?></td>				
				<td class="text-center"><?php echo  date('d/m/Y', strtotime($cmd->date_cmde)); ?></td>	
				<td class="text-center"><?php echo $cmd->qte; ?></td>	
				<td class="text-center"><?php echo $cmd->poids; ?> g</td>	
				<td class="text-center  hidemobile"><?php if($cmd->facon>0){echo $cmd->facon.' €';} ?></td>	
				<td class="text-center  hidemobile"><?php echo $cmd->type_cmde; ?></td>	
			</tr>	
			<?php }  ?>	
			@endforeach
			</tbody>
			</table>

		</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">{{__('msg.Close')}}</button>
         </div>
		
		 </form>
      </div>
    </div>
  </div>	  
   
   
   
 <!--   Modal 3 -->
  <div class="modal fade" id="Modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" ><center>{{__('msg.My templates')}}</center></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" style="">
 
     <table   class="table table-striped mb-40"  style="width:100%">
            <thead>
            <tr id="headtable">
                <th class="text-center" style="font-size: 13px;">{{__('msg.Type')}}</th>
                <th class="text-center" style="font-size: 13px;">{{__('msg.Name')}}</th>
                <th class="text-center  hidemobile" style="font-size: 13px;" >{{__('msg.Nature')}}</th>
                <th class="text-center" style="font-size: 13px;">{{__('msg.Weight')}}</th>
                <th class="text-center  hidemobile"><small>{{__('msg.Gold')}}</small></th>
                <th class="text-center  hidemobile"><small>{{__('msg.Silver')}}</small></th>
                <th class="text-center  hidemobile"><small>{{__('msg.Platinum')}}</small></th>
                <th class="text-center  hidemobile"><small>{{__('msg.Palladium')}}</small></th>
               </tr>
            </thead>
            <tbody>
            @foreach($modeles as $modele)                                     
			<tr>
				<td class="text-center"><small><?php echo  $modele->metier ; ?></small></td>	
				<td class="text-center"><small><?php echo $modele->nom; ?></small></td>	
 				<td class="text-center hidemobile"><small><?php echo $Natures[$modele->nature]; ?></small></td>	
 				<td class="text-center"><small><?php echo  $modele->poids.'g' ; ?></small></td>	
 				<td class="text-center hidemobile"><small><?php if($modele->AU>0) {echo  $modele->AU.'g';} ?></small></td>	
 				<td class="text-center hidemobile"><small><?php if($modele->AG>0) {echo  $modele->AG.'g';} ?></small></td>	
 				<td class="text-center hidemobile"><small><?php if($modele->PT>0) {echo  $modele->PT.'g';} ?></small></td>	
 				<td class="text-center hidemobile"><small><?php if($modele->PD>0) {echo  $modele->PD.'g';} ?></small></td>	
			</tr>	
 			@endforeach
			</tbody>
			</table>  

		</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">{{__('msg.Close')}}</button>
         </div>
		
		 </form>
      </div>
    </div>
  </div>	  
   
      
      
 <!--   Modal 4 -->
  <div class="modal fade" id="Modal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center"  ><center>{{__('msg.My Euros Account')}}</center></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" style="">

        <table   class="table table-striped mb-40"  style="width:100%">
            <thead>
            <tr id="headtable">
                <th class="text-center " style="text-align:center;font-size: 13px;">{{__('msg.Date')}}</th>
                <th class="text-center   hidemobile" style="text-align:center;font-size: 13px;">{{__('msg.Piece')}}</th>
                <th class="text-center " style="text-align:center;font-size: 13px;">{{__('msg.Label')}}</th>
                <th class="text-center  hidemobile" style="text-align:center;font-size: 13px;">Lettrage</th>
				<th class="text-center " style="text-align:center;font-size: 13px;">Echéance</th>	
                <th class="text-center  hidemobile" style="text-align:center;font-size: 13px;">{{__('msg.Debit')}}</th>
                <th class="text-center  hidemobile" style="text-align:center;font-size: 13px;">{{__('msg.Credit')}}</th>
                <th class="text-center " style="text-align:center;font-size: 13px;">{{__('msg.Balance')}}</th>
               </tr>
            </thead>
            <tbody>
            @foreach($euros as $euro)                                     
			<tr style="font-size:12px;">
			<?php if($euro->solde >= 0){$style="color:#54ba1d";}else{$style="color:#d03132";} ?>
			
				<td class="text-center" style="text-align:center;"><small><?php echo  date('d/m/Y', strtotime($euro->ecrit_date)); ?></small></td>	
				<td class="text-center  hidemobile" style="text-align:center;"><small><?php echo $euro->num_piece; ?></small></td>	
				<td class="text-center" style="text-align:center;"><small ><?php echo $euro->libelle; ?></small></td>	
				<td class="text-center  hidemobile" style="text-align:center;"><small><?php echo $euro->lettrage; ?></small></td>				
				<td class="text-center" style="text-align:center;"><small><?php echo date('d/m/Y', strtotime($euro->echeance)); ?></small></td>	
				<td class="text-center  hidemobile" style="text-align:center;"><small><?php if($euro->debit > 0){ echo $euro->debit.'€'; }?></small></td>	
				<td class="text-center  hidemobile" style="text-align:center;"><small><?php  if($euro->credit > 0){ echo $euro->credit.'€';} ?></small></td>	
				<td class="text-center" style="text-align:center;<?php echo $style; ?>"><small><?php echo $euro->solde.'€'; ?></small></td>	
			</tr>	
 			@endforeach
			</tbody>
			</table>
					

		</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">{{__('msg.Close')}}</button>
         </div>
		
		 </form>
      </div>
    </div>
  </div>	  
   
 
<style>
.modal-header{
	background-color:#e6d685;color:black;font-weight:bold;
}
.modal-content{width: 750px;margin: 0 auto;left:-12%;}
.modal-body{height:400px;overflow-y:scroll;}
/*
#silver{
 outline: none;
 text-align: center;
 background-color: hsl(0,0%,90%);
 transition: color .2s;
 border:none;
  color:white;
  height: 40px;
 width: 100px;
 padding-top:8px;
 background-image: -webkit-repeating-linear-gradient(left, hsla(0,0%,100%,0) 0%, hsla(0,0%,100%,0)   6%, hsla(0,0%,100%, .1) 7.5%),
    -webkit-repeating-linear-gradient(left, hsla(0,0%,  0%,0) 0%, hsla(0,0%,  0%,0)   4%, hsla(0,0%,  0%,.03) 4.5%),
    -webkit-repeating-linear-gradient(left, hsla(0,0%,100%,0) 0%, hsla(0,0%,100%,0) 1.2%, hsla(0,0%,100%,.15) 2.2%),
    
    linear-gradient(180deg, hsl(0,0%,78%)  0%, 
    hsl(0,0%,90%) 47%, 
    hsl(0,0%,78%) 53%,
    hsl(0,0%,70%)100%);
}
*/

#gold {
float:left;margin-right:20px;
width:70px;
padding-top:8px;
height: 40px;
text-align:center;color:white;
    background: radial-gradient(ellipse farthest-corner at right bottom, #FEDB37 0%, #FDB931 8%, #9f7928 30%, #9f7928 40%, transparent 60%),
                radial-gradient(ellipse farthest-corner at left top, #FFFFFF 0%, #FFFFAC 8%, #D1B464 25%, #c49f4d 62.5%, #c49f4d 100%);
}


#silver {
float:left;margin-right:20px;
width:70px;
color:white;
text-align:center;
	padding-top:8px;
   height: 40px;
	background: #9f7c3c;
	
	/* Safari and Google Chrome */
	background: -webkit-repeating-linear-gradient(90deg, #8b8282 0%,#acacac 2%, #d5d5d5 23%, #c9c9c9 29%, #c9c9c9 33%, #c2c1c1 61%, #aca8a8 66%, #aca8a8 79%, #acacac 95%, #8b8282 100%);
	
	/* Firefox */
	background: -moz-repeating-linear-gradient(90deg, #8b8282 0%,#acacac 2%, #d5d5d5 23%, #c9c9c9 29%, #c9c9c9 33%, #c2c1c1 61%, #aca8a8 66%, #aca8a8 79%, #acacac 95%, #8b8282 100%);
	
	/* Opera */
	background: -o-repeating-linear-gradient(90deg, #8b8282 0%,#acacac 2%, #d5d5d5 23%, #c9c9c9 29%, #c9c9c9 33%, #c2c1c1 61%, #aca8a8 66%, #aca8a8 79%, #acacac 95%, #8b8282 100%);
	
	/* Internet Explorer */
	background: -ms-repeating-linear-gradient(90deg, #8b8282 0%,#acacac 2%, #d5d5d5 23%, #c9c9c9 29%, #c9c9c9 33%, #c2c1c1 61%, #aca8a8 66%, #aca8a8 79%, #acacac 95%, #8b8282 100%);
	
	/* W3C Standard */
	background: repeating-linear-gradient(90deg, #8b8282 0%,#acacac 2%, #d5d5d5 23%, #c9c9c9 29%, #c9c9c9 33%, #c2c1c1 61%, #aca8a8 66%, #aca8a8 79%, #acacac 95%, #8b8282 100%);
}

#platine {
float:left;margin-right:20px;
width:70px;
padding-top:8px;
height: 40px;
text-align:center;color:white;
    background: radial-gradient(ellipse farthest-corner at right bottom, #FFFFFF 0%, #e7e6e6 8%, #808080 30%, #acacac 40%, transparent 60%),
                radial-gradient(ellipse farthest-corner at left top, #FFFFFF 0%, #e7e6e6 8%, #808080 25%, #e7e6e6 62.5%, #e7e6e6 100%);
}
 
 
#pallad {
float:left;margin-right:20px;
width:70px;
color:white;
text-align:center;
	padding-top:8px;
   height: 40px;
	background: #9f7c3c;
	
	/* Safari and Google Chrome */
	background: -webkit-repeating-linear-gradient(90deg, #ffffff 0%,#ffffff 2%, #d5d5d5 23%, #c9c9c9 29%, #c9c9c9 33%, #c2c1c1 61%, #c9c7c7 66%, #c9c7c7 79%, #f0eeee 95%, #FFFFFF 100%);
	
	/* Firefox */
	background: -moz-repeating-linear-gradient(90deg, #ffffff 0%,#ffffff 2%, #d5d5d5 23%, #c9c9c9 29%, #c9c9c9 33%, #c2c1c1 61%, #c9c7c7 66%, #c9c7c7 79%, #f0eeee 95%, #FFFFFF 100%);
	
	/* Opera */
	background: -o-repeating-linear-gradient(90deg, #ffffff 0%,#ffffff 2%, #d5d5d5 23%, #c9c9c9 29%, #c9c9c9 33%, #c2c1c1 61%, #c9c7c7 66%, #c9c7c7 79%, #f0eeee 95%, #FFFFFF 100%);
	
	/* Internet Explorer */
	background: -ms-repeating-linear-gradient(90deg, #ffffff 0%,#ffffff 2%, #d5d5d5 23%, #c9c9c9 29%, #c9c9c9 33%, #c2c1c1 61%, #c9c7c7 66%, #c9c7c7 79%, #f0eeee 95%, #FFFFFF 100%);
	
	/* W3C Standard */
	background: repeating-linear-gradient(90deg, #ffffff 0%,#ffffff 2%, #d5d5d5 23%, #c9c9c9 29%, #c9c9c9 33%, #c2c1c1 61%, #c9c7c7 66%, #c9c7c7 79%, #f0eeee 95%, #FFFFFF 100%);
}
</style>  
   
@endsection
