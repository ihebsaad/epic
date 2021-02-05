
@extends('layouts.back')
 
 @section('content')

<?php
use App\Http\Controllers\HomeController ;
 $user = auth()->user();  

 $commandes=HomeController::commandes_ac($user['client_id'] );
  $modeles=HomeController::modeles_ac($user['client_id'] );
 $euro=HomeController::compte_euro($user['client_id'] );
 // $poids=HomeController::compte_poids($user['client_id'] );
 
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
<style>
/*#div0,#div1,#div2,#div3{max-height:300px;}*/
</style>
<b>{{__('msg.welcome to your saamp page')}}</b><br>

<br>

	<div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-9 mb-4">

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
                                <div id="div0" class="card-body collapse">
        <table   class="table table-striped mb-40"  style="width:100%">
            <thead>
            <tr id="headtable">
                <th class="text-center">{{__('msg.Date')}}</th>
                <th class="text-center">{{__('msg.Qty')}}</th>
                <th class="text-center">{{__('msg.Weight')}}</th>
                <th class="text-center">{{__('msg.Labour cost')}}</th>
                <th class="text-center">{{__('msg.Type')}}</th>
               </tr>
            </thead>
            <tbody>
            @foreach($commandes as $cmd)                                     
			<?php 
			$etat=(strtoupper($cmd->etat));
			if($etat=='ENCOURS' ||$etat=='EN COURS'  ){ ?>	
			<tr>
				<td class="text-center"><?php echo  date('d/m/Y', strtotime($cmd->date_cmde)); ?></td>	
				<td class="text-center"><?php echo $cmd->qte; ?></td>	
				<td class="text-center"><?php echo $cmd->poids; ?>g</td>	
				<td class="text-center"><?php if($cmd->facon>0){echo $cmd->facon.' €';} ?></td>	
				<td class="text-center"><?php echo $cmd->type_cmde; ?></td>	
			</tr>	
			<?php }  ?>	
			@endforeach
			</tbody>
			</table>
									 
                                </div>
								
								
                                <div class="  ">
                                    <a href="#div1" class="d-block card-header " data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
										<h6 class="m-0 font-weight-bold text-dark">{{__('msg.Finished')}}</h6>
									</a>
                                </div>
                                <div id="div1" class="card-body collapse">
   
        <table   class="table table-striped mb-40"  style="width:100%">
            <thead>
            <tr id="headtable">
                <th class="text-center">{{__('msg.Date')}}</th>
                <th class="text-center">{{__('msg.Qty')}}</th>
                <th class="text-center">{{__('msg.Weight')}}</th>
                <th class="text-center">{{__('msg.Labour cost')}}</th>
                <th class="text-center">{{__('msg.Type')}}</th>
               </tr>
            </thead>
            <tbody>
            @foreach($commandes as $cmd)                                     
			<?php 
			$etat=(strtoupper($cmd->etat));
			if($etat=='TERMINEE'    ){ ?>	
			<tr>
				<td class="text-center"><?php echo  date('d/m/Y', strtotime($cmd->date_cmde)); ?></td>	
				<td class="text-center"><?php echo $cmd->qte; ?></td>	
				<td class="text-center"><?php echo $cmd->poids; ?> g</td>	
				<td class="text-center"><?php if($cmd->facon>0){echo $cmd->facon.' €';} ?></td>	
				<td class="text-center"><?php echo $cmd->type_cmde; ?></td>	
			</tr>	
			<?php }  ?>	
			@endforeach
			</tbody>
			</table>

   
                                </div>								
                            </div>

                       
					   
                             <div class="card shadow mb-4">
                                <div class="  ">
                                    <a href="#div2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">								
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.My templates')}}</h6>
									</a>
                                </div>
                                <div id="div2" class="card-body">
 
         <table   class="table table-striped mb-40"  style="width:100%">
            <thead>
            <tr id="headtable">
                <th class="text-center">{{__('msg.Type')}}</th>
                <th class="text-center">{{__('msg.Name')}}</th>
                <th class="text-center"  >{{__('msg.Nature')}}</th>
                <th class="text-center">{{__('msg.Weight')}}</th>
                <th class="text-center"><small>{{__('msg.Gold')}}</small></th>
                <th class="text-center"><small>{{__('msg.Silver')}}</small></th>
                <th class="text-center"><small>{{__('msg.Platinum')}}</small></th>
                <th class="text-center"><small>{{__('msg.Palladium')}}</small></th>
               </tr>
            </thead>
            <tbody>
            @foreach($modeles as $modele)                                     
			<tr>
				<td class="text-center"><small><?php echo  $modele->metier ; ?></small></td>	
				<td class="text-center"><small><?php echo $modele->nom; ?></small></td>	
 				<td class="text-center"><small><?php   echo $Natures[$modele->nature]; ?></small></td>	
 				<td class="text-center"><small><?php echo  $modele->poids.'g' ; ?></small></td>	
 				<td class="text-center"><small><?php if($modele->AU>0) {echo  $modele->AU.'g';} ?></small></td>	
 				<td class="text-center"><small><?php if($modele->AG>0) {echo  $modele->AG.'g';} ?></small></td>	
 				<td class="text-center"><small><?php if($modele->PT>0) {echo  $modele->PT.'g';} ?></small></td>	
 				<td class="text-center"><small><?php if($modele->PD>0) {echo  $modele->PD.'g';} ?></small></td>	
			</tr>	
 			@endforeach
			</tbody>
			</table> 
                                </div>
                            </div>

                             <div class="card shadow mb-4">
                                <div class=" ">
                                    <a href="#div3" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
										<h6 class="m-0 font-weight-bold text-primary">{{__('msg.My Euros Account')}}</h6>
									</a>
                                </div>
                                <div id="div3" class="card-body">

								
                                </div>
                            </div>

							

                        </div>

                        <div class="col-lg-3 mb-4">


							
							
							
                             <div class="card shadow mb-4">
                                <div class=" ">
                                    <a href="#div4" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
										<h6 class="m-0 font-weight-bold text-primary">{{__('msg.My Metal Account')}}</h6>
									</a>
                                </div>
								<style>
								.metal{height:50px;padding-top:15px;margin-bottom:10px;color:white;}
								</style>
                                <div id="div4" class="card-body">
									<div style="width:150px;" class="metal text-center bg-gradient-warning"> OR </div>
									<div style="width:125px; " class="metal text-center bg-gradient-light"> ARGENT </div>
									<div style="width:80px;" class="metal text-center bg-gradient-secondary"> PLATINE </div>
									<div style="width:100px;" class="metal text-center bg-gray-500"> PALLADIUM </div>
								
                                </div>
                            </div>
							
							
							
                        </div>
						
                       <div class="col-lg-6 mb-4">
 

                        </div>						
   </div>

@endsection
