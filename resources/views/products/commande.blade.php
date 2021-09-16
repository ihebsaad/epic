
@extends('layouts.back')
 
 @section('content')

<?php
use App\Http\Controllers\ModelesController ;
 $user = auth()->user();  

  $natures=ModelesController::natures( );
 $Natures=array();
foreach($natures as $nature)
{
	$Natures[$nature->nature_lot]=$nature->libelle;
}
 
  $commande=ModelesController::detailscommandeprod($id);
  $commandes=ModelesController::detailscommandeprod($id);
 // dd($commandes);
  
/*  
 $img=''; $image=DB::table('photo')->where('photo_id',$commande[0]->photo_id)->first();
	 if(isset($image)){ $img=trim($image->url);}*/
?>
 
 <div class="row">
 <nav aria-label="breadcrumb" style="width:100%">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.Home')}}</a></li>
    <li class="breadcrumb-item"><a href="#">{{__('msg.order')}} <?php echo $id; ?></a></li>
	</ol>
 </nav>
  <style>label{font-weight:bold;color:black;}
 </style>
                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.Order details')}} </h6>
                                </div>
                                <div class="card-body " style="min-height:300px">
								
								
	 <table   class="table   mb-40"  style="width:100%">
            <thead>
            <tr id="headtable">
                <th class="text-center"  >{{__('msg.Image')}}</th>
                <th class="text-center"  >{{__('msg.Reference')}}</th>
                <th class="text-center"  >{{__('msg.Design')}}</th>
                <th class="text-center  hidemobile"   >{{__('msg.Measures')}}</th>
                <th class="text-center hidemobile" >{{__('msg.Alloy')}}</th>
                <th class="text-center  " >{{__('msg.Weight')}}</th>
                <th class="text-center  hidemobile"><small>{{__('msg.Ordered quantity')}}</small></th>
                <th class="text-center  "><small>{{__('msg.Delivered quantity')}}</small></th>
                <th class="text-center  hidemobile"><small>{{__('msg.Optional Labour')}}</small></th>
               </tr>
            </thead>
            <tbody>
            @foreach($commandes as $commande)
			<?php 
			$img=''; $image=DB::table('photo')->where('photo_id',$commande->photo_id)->first();
			if(isset($image)){ $img=trim($image->url);}
		 ?>	
			<tr>
				<td class="text-center"> <?php if($img!=''){?><center><img style="max-height:120px;max-width:120px;"  src="<?php echo URL::asset('images/'.$img);?>" class="img-fluid pt-20" alt=""></center><?php } ?></td>	
				<td class="text-center"><?php echo  $commande->ref ; ?></td>	
				<td class="text-center" style="font-size:12px"><?php echo  $commande->design ; ?></td>	
				<td class="text-center hidemobile" style="font-size:12px"><?php echo  $commande->mes1 .' '.$commande->mes2 ; ?></td>	
				<td class="text-center hidemobile" style="font-size:12px"><?php echo  $commande->alliage ; ?></td>	
				<td class="text-center"><?php echo  $commande->poids ; ?>g</td>	
				<td class="text-center hidemobile"><?php echo  $commande->qte_com ; ?></td>	
				<td class="text-center "><?php echo  $commande->qte_liv ; ?></td>	
				<td class="text-center hidemobile" style="font-size:12px" ><?php echo  $commande->compl ; ?></td>	
  				 
			</tr>	
 			@endforeach
			</tbody>
			</table>  							
								
								
								
								
						
								
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
