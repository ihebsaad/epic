
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

$modele=DB::table('modele_affinage')->where('modele_affinage_ident',$id)->first();
?>
 

<div class="row">
 <nav aria-label="breadcrumb" style="width:100%">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.Home')}}</a></li>
    <li class="breadcrumb-item"><a href="{{route('affinage')}}">{{__('msg.Industrial refining')}}</a></li>
    <li class="breadcrumb-item"><a href="#">{{__('msg.Model')}} <?php echo $modele->modele_nom; ?></a></li>
	</ol>
 </nav>
                        <!-- Content Column -->
                        <div class="col-lg-7 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.Model details')}}</h6>
                                </div>
                                <div class="card-body">
								   <form method="post" action="{{ route('updatemodele') }}"  enctype="multipart/form-data">
										{{ csrf_field() }}
									  <input  class="form-control"  id="cl_ident"  type="hidden"  name="cl_ident" value="<?php echo $user['client_id']; ?>" />
									  <input  class="form-control"  id="id"  type="hidden"  name="id" value="<?php echo $modele->modele_affinage_ident; ?>" />

                                     <div class="row pl-20 pr-20 mb-10">
										<div class="col-lg-12">
											<label>{{__('msg.Model name')}}: </label>
										</div>
									    <div class="col-lg-9  " style="display:inline!important">
											 <input  class="form-control"  id="modele_nom"  name="modele_nom"  type="text"   value="<?php echo $modele->modele_nom; ?>"  />
											  
									   </div>
									   
									 </div>	
									 
                                     <div class="row pl-20 pr-20 mb-10">
										<div class="col-lg-9">
											<label>{{__('msg.Nature of the lot')}}: </label>
										</div>
									    <div class="col-lg-9">
											<select id="nature_lot_ident"  name="nature_lot_ident" class="form-control" onchange="check()" >
											<option></option>
												<?php foreach($natures as $nature)
												{  
												if(  $modele->nature_lot_ident== $nature->nature_lot ){$selected='selected="selected"';}else{$selected=''; }
												echo '<option  '.$selected.'     value="'.$nature->nature_lot.'" title="'.$nature->commentaire.'" >'.$nature->libelle.'</option>';
									 
												}  ?>
											</select>
									   </div>
									  
									 </div>
  
                                     <div class="row pl-20 pr-20 mb-10">
										<div class="col-sm-6 col-lg-6">
											<label>{{__('msg.Weight')}} <small>{{__('msg.in grams')}}</small>: </label>
										    <input  onchange="prix()"  class="form-control"   id="pds_lot" name="pds_lot"  type="number" step="0.01" min="0" style="width:130px" value="<?php echo $modele->pds_lot; ?>"   />

										</div>
	
									    <div class="col-sm-6 col-lg-6 " style="display:none" id="cendre" >
										   <label>{{__('msg.Weight')}} Cendre <small>{{__('msg.in grams')}}</small>: </label>
	  									    <input  onchange="prix()"  class="form-control"   id="pds_cdr" name="pds_cdr"  type="number" step="0.01" min="0" style="width:130px" value="0"   />

									   </div>
									 
									   
									 </div>		
									  	 									 
									 
                                     <div class="row pl-20 pr-20 mb-10" id="divassiste" style="display:none" >
										<div class="col-lg-12">
											<label for="assiste">
											<?php $check='' ; if($modele->assiste==1){$check='checked';} ?>
												<input type="checkbox" name="assiste" id="assiste" <?php echo $check; ?> onchange="prix()" /> <span id="assistetxt"></span>
											</label>
										</div>									 
									 </div>

									 <div class="row pl-20 pr-20 mb-10">
										<div class="col-lg-4">
											<label for="affinage" onclick="prix()" >
											 
												<input type="radio" name="refining" id="affinage"   checked >   {{__('msg.Full refining')}}
										</div>
										<div class="col-lg-4">
											<label for="melting" onclick="prix()">
											 
												<input type="radio" name="refining" id="melting"    >  {{__('msg.Melting only')}} 
											</label>
										</div>										
										<div class="col-lg-4">
											<label for="analyse" onclick="prix()" >
											 
												<input type="radio" name="refining" id="analyse"    />  {{__('msg.Analysis only')}} 
											</label>
										</div>	
											
									 </div>	
									 
									  
									 
		 	 						 
                                     <div class="row pl-20 pr-20 mb-10">
										<div class="col-lg-12">
											<label>{{__('msg.My estimates in thousandths')}}: </label>
										</div>
									    <div class="col-lg-3"  >
											 <input class="form-control" onchange="prix()"  value="<?php echo $modele->estim_titre_au; ?>" id="estim_titre_au" name="estim_titre_au"  type="number" step="0.01" min="0" /> <span class="ml-20 mt-10 btn text-center text-white bg-gradient-warning btn-circle btn-sm">Or</span>
									    </div>
									    <div class="col-lg-3"  >
											 <input class="form-control"  onchange="prix()"   value="<?php echo $modele->estim_titre_ag; ?>" id="estim_titre_ag" name="estim_titre_ag" type="number" step="0.01" min="0" /> <span class="ml-20 mt-10 btn text-center text-dark bg-gradient-light btn-circle btn-sm">Arg</span>
									    </div>
									    <div class="col-lg-3"  >
											 <input class="form-control"  onchange="prix()"  value="<?php echo $modele->estim_titre_pt; ?>" id="estim_titre_pt" name="estim_titre_pt" type="number" step="0.01" min="0" /> <span class="ml-20 mt-10 btn text-center text-white bg-gradient-secondary btn-circle btn-sm">Plat</span>
									    </div>
									    <div class="col-lg-3"  >
											 <input class="form-control" onchange="prix()"  value="<?php echo $modele->estim_titre_pd; ?>" id="estim_titre_pd" name="estim_titre_pd" type="number" step="0.01" min="0" /> <span class="ml-20 mt-10 btn text-center text-white bg-gray-500 btn-circle btn-sm">Pall</span>
									    </div>										
									      
									 </div>										 
									 
<br><br>
				 	      <div class="row mt-30" style=" height:60px">
								<button    type="submit" style="position:absolute;right:5% " class="pull-right btn btn-primary btn-icon-split   ml-50 mt-10 mb-20">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-save"></i>
                                        </span>
                                        <span class="text" >{{__('msg.Update Model')}}</span>
                                    </button>
                                </div>
 
				 	      <div class="row mt-30" style=" height:60px">
								<button  disabled  type="submit" style="position:absolute;right:5% " class="pull-right btn btn-primary btn-icon-split   ml-50 mt-10 mb-20">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-save"></i>
                                        </span>
                                        <span class="text" >{{__('msg.Save as an order')}}</span>
                                    </button>
                                </div>		 					 
									 
</form>									 
									 
									</div>
                              </div>

                       

                        </div>

   <div class="col-lg-5 mb-4">

    <div class="card shadow mb-4">
     <div class="card-header py-3">
       <h6 class="m-0 font-weight-bold text-primary"> {{__('msg.Estimation')}} </h6>
    </div>
    <div class="card-body  ">
	
 <div class="row pl-10" id="divmont" style="display:none" >
	{{__('msg.Amount')}}:  <b><span class="ml-10  " style=" min-width:30px" id="amount"></span> €</b> 
 </div>
  <div class="row  mb-20">
  
   <div class="col-md-4" id="divfonte" style="display:none">
	Fonte: <b><span class="   " style=" " id="fonteval"></span> €</b>
   </div>
   <div class="col-md-4"  id="divanalyse"  style="display:none">
	Analyse: <b><span class="  " style=" " id="analyseval"></span> €</b>
   </div>
  <!-- <div class="col-md-4"  id="divaffinage"  style="display:none">
	Affinage: <b><span class="   " style=" " id="affinageval"></span> €</b>
 </div>-->
 
 </div>
 {{__('Credit on weight account')}}
  <div class="row mb-30">
  <div class="col-sm-5" id="divor"  style="display:none">
	{{__('msg.Gold')}}:  <b><span class="ml-10  " style="min-width:30px" id="gold"></span> g</b>
 </div>
  <div class="col-sm-5" id="divsilv"  style="display:none">
	{{__('msg.Silver')}}:  <b><span class="ml-10  "style=" min-width:30px" id="silver"></span> g</b>
 </div>
 <div class="col-sm-5"  id="divplat"  style="display:none">
	Plat:  <b><span class="ml-10  "style=" min-width:30px" id="platinum"></span> g</b>
 </div>
  <div class="col-sm-5"  id="divpall"   style="display:none">
	Pall :  <b><span class="ml-10  "  style=" min-width:30px" id="palladium"></span> g</b>
 </div>
 </div>
 
 
  </div>
    </div>

               

    </div> 
	
	
	
	 
	 
	 
	 
	 
	 
 </div>


					
<script>

	function updatemodele (){
			var _token = $('input[name="_token"]').val();
 	        var nom = $('#nom').text() ;
 	        var nature = $('#nature').val() ;
			var poids =  $('#poids').val() ;
 			var or =  $('#or').val() ;
			var argent =  $('#argent').val() ;
			var platine =  $('#platine').val() ;
			var palladium =  $('#palladium').val() ;
 	 
	     var  assite=0;
         if ($('#assiste').is(':checked'))
         {
			 assiste=1;
         }
		 
		 if(poids >0 && nature>0 ){
			 
			 
				$.ajax({
                url: "{{ route('updatemodele') }}",
                method: "POST",
                data: {id:<?php echo $id; ?>, nom:nom, nature: nature,assiste: assiste, poids: poids,or: or,argent: argent,palladium: palladium,platine: platine  , _token: _token},
                success: function (data) {
					
	                    $.notify({
                        message: 'Modèle Modifié avec succès',
                        icon: 'glyphicon glyphicon-check'
                    },{
                        type: 'success',
                        delay: 3000,
                        timer: 1000,
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                    });
							setTimeout(function(){
							location.reload();
							   }, 3000);  //3 secds
							}
				
				});
			
			
			}else{
				alert('Compléter les détails de votre modèle');
			}
			
			
			
			}	


  function changing(elm) {
            var champ = elm.id;

            var val = document.getElementById(champ).value;

             //if ( (val != '')) {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('updatemodele') }}",
                method: "POST",
                data: {modele: <?php echo $id; ?>, champ: champ, val: val, _token: _token},
                success: function (data) {
                    $('#' + champ).animate({
                        opacity: '0.1',
                    });
                    $('#' + champ).animate({
                        opacity: '1',
                    });

                    $.notify({
                        message: 'Modifié avec succès',
                        icon: 'glyphicon glyphicon-check'
                    },{
                        type: 'success',
                        delay: 3000,
                        timer: 1000,
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                    });

                }
            });

        }
			
			
			
		
			
function prix()
{ 
	        var _token = $('input[name="_token"]').val();
	        var nature =  $('#nature_lot_ident').val() ;
	        var estim_or =  $('#estim_titre_au').val() ;
	        var estim_ag =  $('#estim_titre_ag').val() ;
	        var estim_pt =  $('#estim_titre_pt').val() ;
	        var estim_pd =  $('#estim_titre_pd').val() ;
	        var poids =  $('#pds_lot').val() ;
			
				 $('#divor').hide();
				 $('#divsilv').hide();
				 $('#divplat').hide();
				 $('#divpall').hide();
 				 $('#divfonte').hide();
 				 $('#divanalyse').hide();
	    var affinage=0;
   	      
         if ($('#affinage').is(':checked'))
         {
			 affinage=1; $('#divanalyse').hide();  $('#divfonte').hide();   $('#divmont').show();
         }	
		 var analyse=0;
         if ($('#analyse').is(':checked'))
         {
			 analyse=1;	 $('#divanalyse').show();	$('#divfonte').hide(); $('#divmont').hide();

         }	
		  var fonte=0;  
		 if ($('#melting').is(':checked'))
         {
			 fonte=1;  $('#divfonte').show();	$('#divanalyse').hide();  $('#divmont').hide();

         }	
 		 if( affinage ==1 ) {
  				$.ajax({
                url: "{{ route('forfait') }}",
                method: "POST",
                data: {  nature: nature,estim_or: estim_or,estim_ag: estim_ag, estim_pt: estim_pt,estim_pd: estim_pd,poids:poids, _token: _token},
                success: function (data) {
				 $('#amount').html('' );
				 $('#gold').html( '');
				 $('#silver').html( '');
				 $('#platinum').html( '');
				 $('#fonteval').html( '');
				 $('#analyseval').html( '');
				 $('#affinageval').html( '');
		
 				 
				 if( parseFloat(data[0].credit_au)>0)$('#divor').show();
				 if( parseFloat(data[0].credit_ag)>0)$('#divsilv').show();
				 if( parseFloat(data[0].credit_pt)>0)$('#divplat').show();
				 if( parseFloat(data[0].credit_pd)>0)$('#divpall').show();
				  
 
				 $('#amount').html(data[0].montant  );
				 $('#gold').html( data[0].credit_au );
				 $('#silver').html( data[0].credit_ag );
				 $('#platinum').html( data[0].credit_pt );
				 $('#palladium').html( data[0].credit_pd );
				 
				 
			 	}
						});
						
		 }else{
 			//	if( parseFloat(poids_cdr)  >0){
	         var poids_cdr =  $('#pds_cdr').val() ;
				
				$.ajax({
                url: "{{ route('tarifcmd') }}",
                method: "POST",
                data: {  nature: nature,estim_or: estim_or,estim_ag: estim_ag, estim_pt: estim_pt,estim_pd: estim_pd,poids:poids,poids_cdr:poids_cdr , _token: _token},
                success: function (data) {
				 console.log(data);
				 $('#amount').html('' );
				 $('#gold').html( '');
				 $('#silver').html( '');
				 $('#platinum').html( '');
				 $('#fonteval').html( '');
				 $('#analyseval').html( '');
				 $('#affinageval').html( '');	
			 
							  
				 if( parseFloat(data[0].credit_au)>0)$('#divor').show();
				 if( parseFloat(data[0].credit_ag)>0)$('#divsilv').show();
				 if( parseFloat(data[0].credit_pt)>0)$('#divplat').show();
				 if( parseFloat(data[0].credit_pd)>0)$('#divpall').show();
				  							  
				 $('#amount').html(data[0].Affinage +data[0].Analyse +data[0].Fonte );
				 $('#gold').html( data[0].credit_au.toFixed(2));
				 $('#silver').html( data[0].credit_ag.toFixed(2));
				 $('#platinum').html( data[0].credit_pt.toFixed(2));
				 $('#palladium').html( data[0].credit_pd.toFixed(2));
				 $('#affinageval').html( data[0].Affinage);
				 $('#fonteval').html( data[0].Fonte);
				 $('#analyseval').html( data[0].Analyse);
				 
			 	}
						});		 
			 
			/* }else{
				 alert("insérez le poids de cendre");
				 } */
			 
		 }			
						
 }			
			
			
function check()	
{
  var nature =  parseInt($('#nature_lot_ident').val()) ;
 	if (nature == 1 || nature == 2 || nature == 3 || nature ==4 || nature == 5 || nature ==6 || nature == 7 || nature == 8 || nature == 12 || nature ==16 || nature ==30 || nature ==31 || nature ==32 || nature == 33 )
	{
		$('#assistetxt').html("{{__('msg.I wish to attend preparation operations (melting)')}}") ;
		$('#divassiste').show('slow');
		$('#assiste').prop('checked', true);

	}else{
		
		if (nature == 34 || nature == 36  )
		{
			$('#assistetxt').html("{{__('msg.I wish to attend the burning')}}") ;
		    $('#divassiste').show('slow');
		    $('#cendre').show('slow');
			$('#assiste').prop('checked', true);


		}else{
			$('#divassiste').hide('slow');
			$('#assiste').prop('checked', false);

		}
	
	}
 	
  
}		
							
prix();				
</script>					
					
@endsection
