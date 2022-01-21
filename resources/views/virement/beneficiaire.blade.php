
@extends('layouts.back')
 
 @section('content')

 
<?php

use App\Http\Controllers\HomeController ;
 $user = auth()->user();  
 
 $beneficiaires=DB::table('beneficiaire')->where('cl_ident',$user['client_id'])->orderBy('bene_cl_ident')->get();
 $beneficiaire=DB::table('beneficiaire')->where('bene_ident',$id)->first();
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
    <li class="breadcrumb-item"><a href="#">{{__('msg.Beneficiary')}}</a></li>
	</ol>
 </nav>
						<div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-10 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.Beneficiary')}}</h6>
                                </div>
                            <div class="card-body">
							
						<!--	  <a   class="btn btn-md btn-success mb-10" style="width:210px"    href="#"  data-toggle="modal" data-target="#addModal" ><b><i class="fas fa-plus"></i>  {{__('msg.Add a beneficiary')}}</b></a>-->


	   <form method="post" action="{{ route('updatebenif') }}"    >
     @honeypot
		 {{ csrf_field() }}
		 <input type="hidden" name="id" value="<?php echo $id; ?>" />
<div class="row mb-10">
<div class="col-md-4">{{__('msg.Sequence number in my lists')}}</div><div class="col-md-8"><input readonly class="form-control" type="number" step="1" min="0" name="bene_cl_ident" value="<?php echo  $beneficiaire->bene_cl_ident; ?>" max="20" style="width:80px"  name="ordre" /></div>
</div>
<div class="row mb-10">
<div class="col-md-4">{{__('msg.Bank of metal')}}</div><div class="col-md-8"><select readonly class="form-control"  style="width:250px"  name="etabliss" required>
<option value=""></option>
<?php foreach ($etablissements as $etab)
{ if($beneficiaire->etablissement_ident==$etab->etablissement_ident){$selected='selected="selected"';}else{$selected='';}
echo '<option   '.$selected.' value="'.$etab->etablissement_ident.'">'.$etab->etablissement_nom .' | '.$etab->etablissement_pays.'</option>	';
}
?>
</select>
</div>
</div>
<div class="row mb-10">
<div class="col-md-4">{{__('msg.Account number')}}</div><div class="col-md-8"><input class="form-control" type="text"  style="width:250px" name="compte" value="<?php echo  $beneficiaire->compte; ?>" /></div>
</div>
<div class="row mb-10">
<div class="col-md-4">{{__('msg.Name')}} </div><div class="col-md-8"><input readonly class="form-control" type="text"  style="width:250px" name="nom" required value="<?php echo  $beneficiaire->Nom; ?>" /></div>
</div>
<div class="row mb-10">
<div class="col-md-4">{{__('msg.City')}} </div><div class="col-md-8"><input class="form-control" type="text"  style="width:250px" name="ville" required  value="<?php echo  $beneficiaire->Ville; ?>" /></div>
</div>
<div class="row mb-10">
<div class="col-md-4">{{__('msg.Comment to report on transfers')}}</div><div class="col-md-8"><textarea  class="form-control" style="width:250px" rows="3" name="commentaire" ><?php echo  $beneficiaire->commentaire; ?></textarea></div>
</div>

 					 	      <div class="row " style=" ">
				 	      <div class="col-xs-12 col-md-4 " style=" ">
						  </div>
				 	      <div class="col-xs-12 col-md-8 " style=" ">
								<button  name="update" value="update"  type="submit"  class="pull-right btn btn-success btn-icon-split     mt-10 mb-20" >
                                        <span class="icon text-white-50">
                                            <i class="fas fa-save"></i>
                                        </span>
                                        <span class="text"  style="width:120px">{{__('msg.Update')}}</span>
                                    </button>
                                </div>	
 			
									 
</form>									 
						  </div>				 	
 			
						

						
                            </div><!--card body-->
							
							
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
@honeypot
{{ csrf_field() }}
<div class="row mb-10">
<div class="col-md-4">{{__('msg.Sequence number')}}</div><div class="col-md-8"><input class="form-control" type="number" step="1" min="0" value="0" max="20" style="width:80px"  name="ordre" /></div>
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
