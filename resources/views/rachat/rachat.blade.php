
@extends('layouts.back')
 
 @section('content')

<?php
use App\Http\Controllers\HomeController ;
 $user = auth()->user();  

$commandes=HomeController::listecommandesrmp($user['client_id'],'');
$modeles=HomeController::listemodelesrmp($user['client_id'],'');
$natures=HomeController::natures2( );
//dd($natures );
$Natures=array();
foreach($natures as $nature)
{
	if($nature->metier_CODE=='RMP'){
	$Natures[$nature->nature_lot_ident]=$nature->nature_lot_nom;
	}
}

$covers=DB::table('choix_couv')->where('langue','like',$user['lg'].'%')->get();

?>
 <style>
 th,td{height:45px;}
 
  select::-ms-expand {
    display: none!important;
}
select{
    -webkit-appearance: none;
    appearance: none;
}
</style>
 <nav aria-label="breadcrumb" style="width:100%">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('rachat')}}">{{__('msg.Buyback of precious metals')}}</a></li>
	</ol>
 </nav>
						<div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-8 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.My saved buyback models')}}</h6>
                                </div>
                                <div class="card-body">
			<div class="row mb-15">
                <div class="col-lg-8"></div>
                <div class="col-lg-4">
                    <a   class="btn btn-md btn-success"    href="{{route('modelermp')}} " ><b><i class="fas fa-plus"></i>  {{__('msg.New Model')}}</b></a>
                </div>
            </div>                                      

			
        <table id="mytable" class="table table-striped mb-40"  style="width:100%">
            <thead>
            <tr id="headtable">
                <th style="width:15%">{{__('msg.Name')}}</th>
                 <th style="width:17%">{{__('msg.Nature of the lot')}}</th>
                 <th style="width:22%">{{__('msg.Metals')}}</th>
                <th style="width:8%; ;padding-right:5px;">{{__('msg.Deposit')}}</th>				 
				<th style="width:14%;font-size:10px;padding-right:5px;padding-bottom:15px">{{__('msg.Melting in my presence')}}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($modeles as $modele)
				<tr>
				<td style="font-size:14px;"><a href="<?php echo URL("viewmodelermp/".$modele->modele_rmp);?>"><?php echo $modele->nom; ?></a></td>
				<td style="font-size:12px;"><?php echo $Natures[$modele->nature_lot_ident];?></td>
                 <td style="font-size:12px;">
				<?php echo $modele->poids;?> g  
                <?php $w1=0; if ($modele->or > 0){ $w1=intval($modele->or / 10 ) ;?>
                <span class="mr-10 btn text-center text-white bg-gradient-warning   btn-sm" style="width:<?php echo $w1;?>px;max-width:100px!important" >
                  Or 
                 </span>
				<?php }$w2=0;  if ($modele->argent > 0){ $w2=intval($modele->argent / 10 ) ;   ?>
                <span class="mr-10 btn text-center text-dark bg-gradient-light   btn-sm" style="width:<?php echo $w2;?>px;max-width:100px!important" >
                  Arg 
                 </span>
                <?php }  
				$w3=0;  if ($modele->platine > 0){ $w3=intval($modele->platine / 10 );   ?>                 
                 <span class="mr-10 btn text-center text-white bg-gradient-secondary btn-sm" style="width:<?php echo $w3;?>px;max-width:100px!important" >
                  Plat
                 </span>
				<?php } $w4=0;  if ($modele->palladium > 0){  $w4=intval($modele->palladium  / 10 ) ;  ?>                                  
                <span class="mr-10 btn text-center text-white bg-gray-500  btn-sm"  style="width:<?php echo $w4;?>px;max-width:100px!important" >
                  Pall
                 </span>
                 <?php }   ?>    
                </td>
				<td style=" text-align:center"><?php if($modele->acompte){echo __('msg.Yes') ;}else{echo __('msg.No') ;}?></td>
				<td style=" text-align:center"><?php if($modele->assiste){echo __('msg.Yes') ;}else{echo __('msg.No') ;}?></td>
				
				<!--<td style="font-size:13px;">  										
			    <small><select     style="background-color:transparent;border:none;color:black; "  > 
											  <option></option> 
											<?php  
										/*	foreach( $covers as $cover)
											  {  if($modele->choix_couv_id==$cover->choix_couv_ident) {//$check="selected='selected'"; 
											   echo ' <option   selected="selected" value="'.$cover->choix_couv_ident.'">'.$cover->choix_ident_lib.'</option> ';

											  }
 											  } */
											?>
			     </select></small>											 
				</td>-->

  				</tr>
			@endforeach
            </tbody>
        </table><br>
		
                                </div>
                            </div>

                       

                        </div>

                         <!-- Content Column -->
                        <div class="col-lg-4 mb-4">

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
                                <div id="div0" class="card-body">
                                 <?php $i=0;?>    
								
                                @foreach($commandes as $commande)
								<?php $i++;
								if ($i <6){    
								if ($commande->etat!='Passée'){   ?>
								<div class="row pb-10">
								
								<div class="col-md-6">
								{{__('msg.Date')}}:<br><b><?php echo  date('d/m/Y', strtotime($commande->date ));?></b>
								</div>
								<div class="col-md-6">
								{{__('msg.Total weight')}}: <b><?php echo $commande->poids  ;?> g</b>
								</div>								
								
								</div>
								
								<div class="row pb-15" >
								
								<div class="col-md-6">
								{{__('msg.order')}}: <b><a href="<?php echo URL("commandermp/".$commande->id);?>"><?php echo   $commande->id ;?></a></b><br>																
								</div>
								<div class="col-md-6">
								{{__('msg.Net value')}}: <b><?php echo $commande->valeur_nette  ;?> </b>								
								</div>								
								
								</div>								
								<hr>
								<?php } ?>
								<?php } ?>
								@endforeach

                                </div>
								
								
                                <div class="  ">
                                    <a href="#div1" class="d-block card-header " data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
										<h6 class="m-0 font-weight-bold text-dark">{{__('msg.Finished')}}</h6>
									</a>
                                </div>
                                <div id="div1" class="card-body">
                                 <?php $i=0;?>    
                                @foreach($commandes as $commande)
								<?php $i++;
								if ($i <6){    
								if ($commande->etat=='Passée'){   ?>
								<div class="row pb-10 ">
								
								<div class="col-md-6">
								{{__('msg.Date')}}:<br><b><?php echo  date('d/m/Y', strtotime($commande->date ));?></b>
								</div>
								<div class="col-md-6">
								{{__('msg.Total weight')}}: <b><?php echo $commande->poids  ;?> g</b>
								</div>								
								
								</div>
								
								<div class="row pb-15">
								
								<div class="col-md-6">
								{{__('msg.order')}}: <b><a href="<?php echo URL("commandermp/".$commande->id);?>"><?php echo   $commande->id ;?></a></b><br>																
								</div>
								<div class="col-md-6">
								{{__('msg.Net value')}}: <b><?php echo $commande->valeur_nette  ;?> €</b>
								
								</div>								
								
								</div>								
								<hr>
								<?php } ?>
								<?php } ?>
								@endforeach
									 
                                </div>								
                            </div>

                       

                        </div>
                    </div>

@endsection

 