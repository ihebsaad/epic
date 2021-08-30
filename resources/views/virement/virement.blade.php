
@extends('layouts.back')
 
 @section('content')

 <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
 </style>
<?php

use App\Http\Controllers\HomeController ;
 $user = auth()->user();  
 
 $userid=$user['client_id'];
   DB::select ("SET @p0='$userid'; ");
 $movements=  DB::select ("CALL `sp_vir_liste_vir`(@p0) ");
 
 //$virements=HomeController::virements($user['client_id'],'fr_FR',1,date('Y-m-01'),date('Y-m-d'));
 $virements=array();
   $etablissements=DB::table('etablissement')->get();

   $beneficiaires=DB::table('beneficiaire')->where('cl_ident',$user['client_id'])->orderBy('bene_cl_ident')->get();
	$et=array(); 
	


  foreach( $etablissements as $e)
{	 
	$et[$e->etablissement_ident]=$e->etablissement_nom.'('.$e->etablissement_pays.')' ;
}
if (! isset($metal)  ) {
	$metal=1;
}
	
 
    if (isset($debut) && isset($fin)) {
	 
	 
 ////$virements=HomeController::virements($user['client_id'],'fr_FR',$metal,$debut,$fin);
		
	  }else{
   // $debut='2020-08-01';
   $debut=date('Y-m-01');
   
   	$date1 = DB::table('mouvement_cp')->where('cl_origine',$user['client_id'])->max('date_doc') ;
	$date1= date_format($date1, 'Y-m-d H:i:s');

// dd($date1);
	
if (isset($date1) && ($date1> $debut) ) 
{ 
	
  }else{
$debut=$date1;

 $mv= DB::table('mouvement_cp')->where('cl_origine',$user['client_id'])->where('date_doc',$date1)->first();
 if (! isset($metal)  ) {
$metal=intval($mv->metal_id);
 } 
 }
   
   
	// $fin='2020-10-01';
	 $fin=date('Y-m-d');
 ////$virements=HomeController::virements($user['client_id'],'fr_FR',$metal,$debut,$fin);
		  
	  }
 
	//  dd( $virements);
 ?>
	
 <nav aria-label="breadcrumb" style="width:100%">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('virement')}}">{{__('msg.Metal transfer')}}</a></li>
	</ol>
 </nav>
						<div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                               <!-- <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.My transfers')}}</h6>
                                </div>-->
  <div class="card-body" style="min-height:400px;padding-top:0px;padding-right:0px;padding-left:0px">
							
<ul class="nav nav-tabs card-header" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="weight-tab" data-toggle="tab" href="#weight" role="tab" aria-controls="weight" aria-selected="true" style="color:#4e73df;width:250px;text-align:center"><i class="fas fa-balance-scale-left "></i>  {{__('msg.My Metal Account')}}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="transfer-tab" data-toggle="tab" href="#transfer" role="tab" aria-controls="transfer" aria-selected="false" style="color:#4e73df;width:250px;text-align:center"><i class="fas fa-donate "></i>  {{__('msg.My transfers')}}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="beneficiaries-tab" data-toggle="tab" href="#beneficiaries" role="tab" aria-controls="beneficiaries" aria-selected="false" style="color:#4e73df;width:250px;text-align:center"><i class="fas fa-users "></i>   {{__('msg.My beneficiaries')}}</a>
  </li>
 
</ul>

 
<div class="tab-content" style="padding-left:15px;padding-right:15px">

  <div class="tab-pane active" id="weight" role="tabpanel" aria-labelledby="weight-tab">
							 <form    action="{{action('PagesController@virement')}}" >
							
							 <div class="row" style="max-width:650px">
								
								<div class="col-lg-5 col-sm-12 pt-10">					
								<span>{{__('msg.Period')}}</span>
								<input style="width:230px" type="text" id="periode"  value="<?php echo $debut.' - '.$fin; ?>" class="form-control" />
								</div>
								<input  type="hidden" name="debut" id="debut" value="<?php echo $debut;?>"  >
								<input  type="hidden" name="fin" id="fin"  value="<?php echo $fin;?>"  >
								<div class="col-lg-4 col-sm-12 pt-10">													
								<span>{{__('msg.Metal')}}</span>
								<select style="width:150px" id="metal" name="metal" class="form-control">
									<option value="1" <?php if($metal==1){echo 'selected="selected"';}?>  >{{__('msg.Gold')}}</option>
									<option value="2" <?php if($metal==2){echo 'selected="selected"';}?>  >{{__('msg.Silver')}}</option>
									<option value="3" <?php if($metal==3){echo 'selected="selected"';}?> >{{__('msg.Platinum')}}</option>
									<option value="4" <?php if($metal==4){echo 'selected="selected"';}?> >{{__('msg.Palladium')}}</option>
								</select>        
                               </div> 
				 
								<div class="col-lg-3 col-sm-12">													
		                     	<button     type="submit"   class="pull-right btn btn-primary btn-icon-split ml-20 mt-30  mb-20">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                        <span class="text" style="width:90px" >{{__('msg.View')}}</span>
                                    </button>
                                </div> 
                             </div><!--row-->
						</form>		
								
								
		  <table id="mytable" class="table table-striped mb-40"  style="width:100%">
            <thead>
            <tr id="headtable">
                <th style="text-align:center;width:15%">{{__('msg.Date')}}</th>
                <th style="text-align:center;width:15%" class="hidemobile">{{__('msg.Piece')}}</th>
                 <th style="text-align:center;width:15%">{{__('msg.Label')}}</th>
                <th style="text-align:center;width:15%;" class="hidemobile">{{__('msg.Debit')}}</th>
                <th style="text-align:center;width:15%;" class="hidemobile">{{__('msg.Credit')}}</th>
                <th style="text-align:center;width:15%;">{{__('msg.Balance')}}</th>
               </tr>
            </thead>
            <tbody>
            @foreach($virements as $virement)
			<?php if($virement->solde >= 0){$style="color:#54ba1d";}else{$style="color:#d03132";} ?>
				<tr>
				<td style=" text-align:center "><?php echo date('d/m/Y', strtotime( $virement->ecriture_date )) ;?></td>						
				<td style=" text-align:center " class="hidemobile"><?php echo $virement->num_piece  ;?></td>						
				<td style=" text-align:center "><?php echo $virement->libelle  ;?></td>						
				<td style=" text-align:center " class="hidemobile"><?php if($virement->debit > 0){echo $virement->debit.'g';}?></td>						
				<td style=" text-align:center " class="hidemobile"><?php if($virement->credit > 0){echo $virement->credit.'g';}  ;?></td>						
				<td class="font-weight-bold" style="<?php echo $style;?> ;text-align:center "><?php echo $virement->solde. 'g'; ?></td>						

				</tr>				
			@endforeach
            </tbody>
			</table>	  
  
  
  
  </div>
  
  <div class="tab-pane" id="transfer" role="tabpanel" aria-labelledby="transfer-tab">
  
      <a   class="btn btn-md btn-success mb-10"  style="width:210px;float:right;right:50px;margin-top:20px;margin-bottom:20px"   href="{{route('ajout')}}"  ><b><i class="fas fa-plus"></i>  {{__('msg.Add a transfer')}}</b></a>
<div class="clearfix"></div>
	  
	  <?php if( count($movements)==0){?>
		 <center><span class="  mt-40 mb-20 font-weight-bold">{{__('msg.You have no pending transfer')}}</span></center> 
	 <?php  }
	  else { ?>
  		  <table id="mytable" class="table table-striped mb-40"  style="width:100%">
            <thead>
            <tr id="headtable">
                <th style="text-align:center;width:7%;">{{__('msg.Date')}}</th>
                <th style="text-align:center;width:7%;">{{__('msg.Weight')}}</th>
                <th style="text-align:center;width:7%;"  >{{__('msg.Metal')}}</th>
                <th style="text-align:center;width:10%; " class="hidemobile">{{__('msg.Name')}}</th>
                <th style="text-align:center;width:10%" class="hidemobile">{{__('msg.In')}}</th>
                <th style="text-align:center;width:10%;" class="hidemobile">{{__('msg.City')}}</th>								
                 <th style="text-align:center;width:10%;font-size:13px" class="hidemobile">{{__('msg.Account num')}}</th>
                <th style="text-align:center;width:13%;" class="hidemobile">{{__('msg.Comment')}}</th>				 
                <th style="text-align:center;width:10%;"  >{{__('msg.State')}}</th>
               </tr>
            </thead>
            <tbody>
			<?php  if (is_array($movements) || is_object($movements)){ 	?>
            @foreach($movements as $mv)
 				<tr>
				<?php if(trim($mv->etat)=='validé'){$style="color:#54ba1d";}else{$style='';} ?>
				<td style=" text-align:center "><?php echo  date('d/m/Y', strtotime( $mv->datevir ))  ;?></td>	
				<td style=" text-align:center "><?php echo  $mv->poids   ;?>g</td>	
				<td style=" text-align:center "><?php echo  $mv->metal   ;?></td>	
				<td style=" text-align:center " class="hidemobile"><?php echo $mv->nom  ;?></td>	
				<td style=" text-align:center " class="hidemobile"><?php echo   $mv->etablissement   ;?></td>						
				<td style=" text-align:center " class="hidemobile"><?php echo $mv->ville.' <small>('. $mv->pays.')</small>'  ;?></td>				
				<td style=" text-align:center " class="hidemobile"><?php echo $mv->compte  ;?></td>						
				<td class="hidemobile"><?php echo $mv->commentaire  ;?></td>	
				<td style=" text-align:center;<?php echo $style;?> "><?php echo $mv->etat  ;?></td>						
				

				</tr>				
			@endforeach
			<?php } ?>
            </tbody>
			</table> 
  
	  <?php } ?>
  
  </div>
  
  
  <div class="tab-pane" id="beneficiaries" role="tabpanel" aria-labelledby="beneficiaries-tab">
    <a   class="btn btn-md btn-success mb-10"  style="width:210px;float:right;right:50px;margin-top:20px;margin-bottom:20px"   href="#"  data-toggle="modal" data-target="#addModal" ><b><i class="fas fa-plus"></i>  {{__('msg.Add a beneficiary')}}</b></a>
<div class="clearfix"></div>


		  <table id="mytable" class="table table-striped mb-40"  style="width:100%">
            <thead>
            <tr id="headtable">
                <th style="text-align:center;width:6%;" class="hidemobile">{{__('msg.Ranking')}}</th>
                <th style="text-align:center;width:15%;">{{__('msg.Name')}}</th>
                <th style="text-align:center;width:10%;">{{__('msg.City')}}</th>				
                <th style="text-align:center;width:15%" class="hidemobile">{{__('msg.In')}}</th>
                 <th style="text-align:center;width:14%;" class="hidemobile">{{__('msg.Account num')}}</th>
                <th style="text-align:center;width:18%;" class="hidemobile">{{__('msg.Comment')}}</th>				 
                <th style="text-align:center;width:12%;">{{__('msg.State')}}</th>
               </tr>
            </thead>
            <tbody>
			<?php  if (is_array($beneficiaires) || is_object($beneficiaires)){ 	?>
            @foreach($beneficiaires as $ben)
 				<tr>
				<?php if(trim($ben->etat)=='validé'){$style="color:#54ba1d";}else{$style='';} ?>
				<td style=" text-align:center " class="hidemobile"><?php echo  $ben->bene_cl_ident   ;?></td>	
				<td style=" text-align:center "><a href="<?php echo URL("beneficiaire/".$ben->bene_ident);?>"><?php echo $ben->Nom  ;?></a></td>						
				<td style=" text-align:center "><?php echo $ben->Ville  ;?></td>				
				<td style=" text-align:center " class="hidemobile"><?php echo $et[$ben->etablissement_ident]  ;?></td>						
				<td style=" text-align:center " class="hidemobile"><?php echo $ben->compte  ;?></td>						
				<td class="hidemobile"><?php echo $ben->commentaire  ;?></td>	
				<td style=" text-align:center;<?php echo $style;?> "><?php echo $ben->etat  ;?></td>						
				

				</tr>				
			@endforeach
			<?php } ?>
            </tbody>
			</table>  
  
  
  </div>
 </div>

<script>
/*  $(function () {
    $('#myTab li:last-child a').tab('show')
  })*/
</script>							 
							
		
								
                            </div><!--card body-->
							
							
                            </div>

                       

                        </div>

                 <!--    <div class="col-lg-3 mb-4">

                             <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.Links')}}</h6>
                                </div>
                                <div class="card-body">

							  <a   class="btn btn-md btn-success mb-10"  style="width:210px"   href="{{route('ajout')}}" ><b><i class="fas fa-plus"></i>  {{__('msg.Add a transfer')}}</b></a>
							  <a   class="btn btn-md btn-primary mb-10"  style="width:210px"    href="{{route('beneficiaires')}}" ><b><i class="fas fa-user"></i>  {{__('msg.List of beneficiaries')}}</b></a>


									
                                </div>
                            </div>

               

                        </div> -->
                    </div>
					
					
  <!--   Modal-->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel"><center>{{__('msg.Add a beneficiary')}}</center></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" style="">

<form action="{{ route('ajoutbenefic') }}" method="post"  >
{{ csrf_field() }}
<div class="row mb-10">
<div class="col-md-4">{{__('msg.Sequence number in my lists')}}</div><div class="col-md-8"><input class="form-control" type="number" step="1" min="0" value="0" max="20" style="width:80px"  name="ordre" /></div>
</div>
<div class="row mb-10">
<div class="col-md-4">{{__('msg.Bank of metal')}} *</div><div class="col-md-8"><select class="form-control"  style="width:250px"  name="etabliss" required>
<option value=""></option>
<?php foreach ($etablissements as $etab)
{
echo '<option value="'.$etab->etablissement_ident.'">'.$etab->etablissement_nom .' | '.$etab->etablissement_pays.'</option>	';
}
?>
</select>
</div>
</div>
<div class="row mb-10">
<div class="col-md-4">{{__('msg.Account number')}}</div><div class="col-md-8"><input class="form-control" type="text"  style="width:250px" name="compte" /></div>
</div>
<div class="row mb-10">
<div class="col-md-4">{{__('msg.Name')}} *</div><div class="col-md-8"><input class="form-control" type="text"  style="width:250px" name="nom" required /></div>
</div>
<div class="row mb-10">
<div class="col-md-4">{{__('msg.City')}} *</div><div class="col-md-8"><input class="form-control" type="text"  style="width:250px" name="ville" required /></div>
</div>
<div class="row mb-10">
<div class="col-md-4">{{__('msg.Comment to report on transfers')}}</div><div class="col-md-8"><textarea  class="form-control" style="width:250px" rows="3" name="commentaire" ></textarea></div>
</div>

<small><span class="text-danger">*  {{__('msg.Required fields')}}</span></small>



		</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">{{__('msg.Cancel')}}</button>
          <button class="btn btn-primary" type="submit" >{{__('msg.Add')}}</button>
        </div>
		
		 </form>
      </div>
    </div>
  </div>					
					
<script>
$('#periode').daterangepicker({
"locale": {
    //    "format": "DD/MM/YYYY",
        "format": "YYYY-MM-DD",
        "separator": " - ",
        "applyLabel": "Appliquer",
        "cancelLabel": "Annuler",
        "fromLabel": "De",
        "toLabel": "A",
        "customRangeLabel": "Modifier",
        "daysOfWeek": [
            "Di",
            "Lu",
            "Ma",
            "Me",
            "Je",
            "Ve",
            "Sa"
        ],
        "monthNames": [
            "Janvier",
            "Février",
            "Mars",
            "Avril",
            "Mai",
            "Juin",
            "Juillet",
            "Août",
            "Septembre",
            "Octobre",
            "Novembre",
            "Décembre"
        ],
        "firstDay": 1
    },
	<?php if (isset($debut)){ ?>
	startDate: '<?php echo $debut;?>', 
  endDate: '<?php echo $fin;?>'
  		
		
<?php	} else{ ?>
	startDate: '<?php echo date('01/m/Y');?>', 
  endDate: '<?php echo date('d/m/Y');?>'
  
	<?php } ?>

} ,
       function(start, end) {
        console.log("Callback has been called!");
     //   $('#reportrange span').html(start.format('D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'));
		$('#debut').val(start.format('YYYY-MM-DD'));
		$('#fin').val(end.format('YYYY-MM-DD'));

       }
 
);
</script>

@endsection
