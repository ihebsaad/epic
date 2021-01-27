
@extends('layouts.back')
 
 @section('content')

 <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<?php

use App\Http\Controllers\HomeController ;
 $user = auth()->user();  
 //$virements=HomeController::virements($user['client_id'],'fr_FR',1,date('Y-m-01'),date('Y-m-d'));
   $etablissements=DB::table('etablissement')->get();

   if (isset($debut) && isset($fin)) {
	 
	 
 $virements=HomeController::virements($user['client_id'],'fr_FR',$metal,$debut,$fin);
		
	  }else{
	 	$metal=1;
  // $debut='2020-08-01';
   $debut=date('Y-m-01');
	// $fin='2020-10-01';
	 $fin=date('Y-m-d');
 $virements=HomeController::virements($user['client_id'],'fr_FR',1,$debut,$fin);
		  
	  }
 
	  
 ?>
	
 <nav aria-label="breadcrumb" style="width:100%">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('virement')}}">{{__('msg.Metal transfer')}}</a></li>
	</ol>
 </nav>
						<div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-9 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.My transfers')}}</h6>
                                </div>
                            <div class="card-body">
							
							 
							
							 <form    action="{{action('PagesController@virement')}}" >
							
							 <div class="row" style="max-width:650px">
								
								<div class="col-sm-5 pt-10">					
								<span>{{__('msg.Period')}}</span>
								<input style="width:230px" type="text" id="periode"  value="<?php echo $debut.' - '.$fin; ?>" class="form-control" />
								</div>
								<input  type="hidden" name="debut" id="debut"   >
								<input  type="hidden" name="fin" id="fin"  >
								<div class="col-sm-4 pt-10">													
								<span>{{__('msg.Metal')}}</span>
								<select style="width:150px" id="metal" name="metal" class="form-control">
									<option value="1" <?php if($metal==1){echo 'selected="selected"';}?>  >{{__('msg.Gold')}}</option>
									<option value="2" <?php if($metal==2){echo 'selected="selected"';}?>  >{{__('msg.Silver')}}</option>
									<option value="3" <?php if($metal==3){echo 'selected="selected"';}?> >{{__('msg.Platinum')}}</option>
									<option value="4" <?php if($metal==4){echo 'selected="selected"';}?> >{{__('msg.Palladium')}}</option>
								</select>        
                               </div> 
				 
								<div class="col-sm-3">													
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
                <th style="text-align:center;width:15%">{{__('msg.Piece')}}</th>
                 <th style="text-align:center;width:15%">{{__('msg.Label')}}</th>
                <th style="text-align:center;width:15%;">{{__('msg.Debit')}}</th>
                <th style="text-align:center;width:15%;">{{__('msg.Credit')}}</th>
                <th style="text-align:center;width:15%;">{{__('msg.Balance')}}</th>
               </tr>
            </thead>
            <tbody>
            @foreach($virements as $virement)
			<?php if($virement->solde >= 0){$style="color:#54ba1d";}else{$style="color:#d03132";} ?>
				<tr>
				<td style=" text-align:center "><?php echo date('d/m/Y', strtotime( $virement->ecriture_date )) ;?></td>						
				<td style=" text-align:center "><?php echo $virement->num_piece  ;?></td>						
				<td style=" text-align:center "><?php echo $virement->libelle  ;?></td>						
				<td style=" text-align:center "><?php echo $virement->debit  ;?>€</td>						
				<td style=" text-align:center "><?php echo $virement->credit  ;?>€</td>						
				<td class="font-weight-bold" style="<?php echo $style;?> ;text-align:center "><?php echo $virement->solde  ;?>€</td>						

				</tr>				
			@endforeach
            </tbody>
			</table>			
								
                            </div><!--card body-->
							
							
                            </div>

                       

                        </div>

                     <div class="col-lg-3 mb-4">

                             <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.Links')}}</h6>
                                </div>
                                <div class="card-body">

							  <a   class="btn btn-md btn-success mb-10"    href="{{route('ajout')}} " ><b><i class="fas fa-plus"></i>  {{__('msg.Add a transfer')}}</b></a>
							  <a   class="btn btn-md btn-success mb-10"    href="#"  data-toggle="modal" data-target="#addModal" ><b><i class="fas fa-plus"></i>  {{__('msg.Add a beneficiary')}}</b></a>
							  <a   class="btn btn-md btn-primary mb-10"    href="#" ><b><i class="fas fa-user"></i>  {{__('msg.List of beneficiaries')}}</b></a>


									
                                </div>
                            </div>

               

                        </div> 
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
<div class="col-md-4">{{__('msg.Order number')}}</div><div class="col-md-8"><input class="form-control" type="number" step="1" min="0" value="0" max="20" style="width:80px"  name="ordre" /></div>
</div>
<div class="row mb-10">
<div class="col-md-4">{{__('msg.Establishment')}} *</div><div class="col-md-8"><select class="form-control"  style="width:250px"  name="etabliss" required>
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
<div class="col-md-4">{{__('msg.Account')}}</div><div class="col-md-8"><input class="form-control" type="text"  style="width:250px" name="compte" /></div>
</div>
<div class="row mb-10">
<div class="col-md-4">{{__('msg.Name')}} *</div><div class="col-md-8"><input class="form-control" type="text"  style="width:250px" name="nom" required /></div>
</div>
<div class="row mb-10">
<div class="col-md-4">{{__('msg.City')}} *</div><div class="col-md-8"><input class="form-control" type="text"  style="width:250px" name="ville" required /></div>
</div>
<div class="row mb-10">
<div class="col-md-4">{{__('msg.Comment')}}</div><div class="col-md-8"><textarea  class="form-control" style="width:250px" rows="3" name="commentaire" ></textarea></div>
</div>





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
