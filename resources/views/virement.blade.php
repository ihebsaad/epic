
@extends('layouts.back')
 
 @section('content')

 <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<?php

use App\Http\Controllers\HomeController ;
 $user = auth()->user();  
 //$virements=HomeController::virements($user['client_id'],'fr_FR',1,date('Y-m-01'),date('Y-m-d'));
   if (isset($debut) && isset($fin)) {
	   $debut=$_GET['debut'];
		$fin=$_GET['fin'];
		$metal=$_GET['metal'];
		
 $virements=HomeController::virements($user['client_id'],'fr_FR',$metal,$debut,$fin);
		
	  }else{
	 	$metal=1;
   $debut='2020-08-01';
	 $fin='2020-10-01';
 $virements=HomeController::virements($user['client_id'],'fr_FR',1,'2020-08-01','2020-10-01');
		  
	  }
 
	  
 ?>
	

						<div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-10 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Mes virements</h6>
                                </div>
                            <div class="card-body">
							 <form    action="{{action('PagesController@virement')}}" >
							
							 <div class="row" style="max-width:650px">
								
								<div class="col-sm-5 pt-10">					
								<span>Période</span>
								<input style="width:230px" type="text"   value="<?php echo $debut.' - '.$fin; ?>" class="form-control" />
								</div>
								<input  type="hidden" name="debut" id="debut">
								<input  type="hidden" name="fin" id="fin"  >
								<div class="col-sm-4 pt-10">													
								<span>Métal</span>
								<select style="width:150px" id="metal" name="metal" class="form-control">
									<option value="1" <?php if($metal==1){echo 'selected="selected"';}?>  >Or</option>
									<option value="2" <?php if($metal==2){echo 'selected="selected"';}?>  >Argent</option>
									<option value="3" <?php if($metal==3){echo 'selected="selected"';}?> >Platine</option>
									<option value="4" <?php if($metal==4){echo 'selected="selected"';}?> >Palladium</option>
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

                  <!--      <div class="col-lg-4 mb-4">

                             <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Dates</h6>
                                </div>
                                <div class="card-body">

							    
									
                                </div>
                            </div>

               

                        </div>-->
                    </div>
<script>
$('input[name="dates"]').daterangepicker({
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

},
       function(start, end) {
        console.log("Callback has been called!");
     //   $('#reportrange span').html(start.format('D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'));
		$('#debut').val(start.format('YYYY-MM-DD'));
		$('#fin').val(end.format('YYYY-MM-DD'));

       }

)
 ;
</script>

@endsection
