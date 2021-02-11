
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
 
  $commande=HomeController::detailscommandeprod($id);
  
  
 $img=''; $image=DB::table('photo')->where('photo_id',$commande[0]->photo_id)->first();
	 if(isset($image)){ $img=trim($image->url);}
?>
 
						<div class="row">
 <nav aria-label="breadcrumb" style="width:100%">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.Home')}}</a></li>
    <li class="breadcrumb-item"><a href="#">{{__('msg.order')}} <?php echo $id; ?></a></li>
	</ol>
 </nav>
                        <!-- Content Column -->
                        <div class="col-lg-10 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.Order details')}} </h6>
                                </div>
                                <div class="card-body">
								<div class="row">
								<div class="col-lg-8 col-sm-12">


								<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-4">
											<label>{{__('msg.order')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php echo $id; ?></b>
										</div>
									</div>
									<?php if($commande[0]->ref!=''){?>
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-4">
											<label>{{__('msg.Reference')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php   echo  $commande[0]->ref;?></b>
										</div>
									</div>
									<?php } ?>
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-4">
											<label>{{__('msg.Design')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php echo $commande[0]->design; ?></b>
										</div>
									</div>
 									
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-4">
											<label>{{__('msg.Measures')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php echo $commande[0]->mes1; ?> </b><br>
										<b><?php echo $commande[0]->mes2; ?> </b>
										</div>
									</div>	
 									
									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-4">
											<label>{{__('msg.Alloy')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php echo $commande[0]->alliage; ?></b>
										</div>
									</div>
 									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-4">
											<label>{{__('msg.Ordered quantity')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php echo $commande[0]->qte_com; ?></b>
										</div>
									</div>
 									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-4">
											<label>{{__('msg.Delivered quantity')}}</label>
										</div>
									    <div class="col-lg-6">
										<b><?php echo $commande[0]->qte_liv; ?></b>
										</div>
									</div>
									<?php  if(strlen($commande[0]->compl) >1) {   ?>
									
 									<div class="row pl-20 pr-20 pb-10">
										<div class="col-lg-4">
											<label>{{__('msg.Optional Labour')}}: </label>
										</div>
									    <div class="col-lg-6">
										<b><?php echo $commande[0]->compl; ?></b>
										</div>
									</div>
									<?php }  ?>
						 								
								
								</div>
								 
 								<div class="col-lg-4 col-sm-12">
								 <?php if($img!=''){?><center><img style="max-height:180px;"  src="<?php echo URL::asset('images/'.$img);?>" class="img-fluid pt-20" alt=""></center><?php } ?>
								</div>
 									
								</div>
								
								
                              </div>

                       

                        </div>
<!--
                        <div class="col-lg-5 mb-4">

                             <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Image  </h6>
                                </div>
                                <div class="card-body">
								<?php if($img!=''){?><center><img style="max-height:180px"  src="<?php echo URL::asset('images/'.$img);?>" class="img-fluid pt-20" alt=""></center><?php } ?>
 
                                </div>
                            </div>
 
                        </div> 
						-->
						
						
                    </div>

@endsection
