
@extends('layouts.back')
 
 @section('content')

 
<?php

use App\Http\Controllers\HomeController ;
 $user = auth()->user();  
 
 $beneficiaires=DB::table('beneficiaire')->where('cl_ident',$user['client_id'])->orderBy('bene_cl_ident')->get();
 $etablissements=DB::table('etablissement')->get();
$et=array(); 
  foreach( $etablissements as $e)
{	 
	$et[$e->etablissement_ident]=$e->etablissement_nom.'('.$e->etablissement_pays.')' ;
}
	  
 ?>
	
 <nav aria-label="breadcrumb" style="width:100%">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('virement')}}">{{__('msg.Metal transfer')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('beneficiaires')}}">{{__('msg.List of beneficiaries')}}</a></li>
	</ol>
 </nav>
						<div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-9 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.List of beneficiaries')}}</h6>
                                </div>
                            <div class="card-body">
							
							 
					 	
								
		  <table id="mytable" class="table table-striped mb-40"  style="width:100%">
            <thead>
            <tr id="headtable">
                <th style="text-align:center;width:8%">Num</th>
                <th style="text-align:center;width:15%">{{__('msg.Establishment')}}</th>
                 <th style="text-align:center;width:15%">{{__('msg.Account')}}</th>
                <th style="text-align:center;width:15%;">{{__('msg.Name')}}</th>
                <th style="text-align:center;width:10%;">{{__('msg.City')}}</th>
                <th style="text-align:center;width:10%;">{{__('msg.State')}}</th>
                <th style="text-align:center;width:20%;">{{__('msg.Comment')}}</th>
               </tr>
            </thead>
            <tbody>
            @foreach($beneficiaires as $ben)
 				<tr>
				<td style=" text-align:center "><?php echo  $ben->bene_cl_ident   ;?></td>						
				<td style=" text-align:center "><?php echo $et[$ben->etablissement_ident]  ;?></td>						
				<td style=" text-align:center "><?php echo $ben->compte  ;?></td>						
				<td style=" text-align:center "><?php echo $ben->Nom  ;?></td>						
				<td style=" text-align:center "><?php echo $ben->Ville  ;?></td>						
				<td class=" text-align:center "><?php echo $ben->etat  ;?></td>						
				<td class="   "><?php echo $ben->commentaire  ;?></td>						

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
							  <a   class="btn btn-md btn-primary mb-10" style="width:210px"   href="{{route('virement')}}" ><b><i class="fas fa-coins"></i>   {{__('msg.Metal transfer')}}</b></a>
							  <a   class="btn btn-md btn-success mb-10" style="width:210px"    href="{{route('ajout')}} " ><b><i class="fas fa-plus"></i>  {{__('msg.Add a transfer')}}</b></a>
							  <a   class="btn btn-md btn-success mb-10" style="width:210px"    href="#"  data-toggle="modal" data-target="#addModal" ><b><i class="fas fa-plus"></i>  {{__('msg.Add a beneficiary')}}</b></a>


									
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
