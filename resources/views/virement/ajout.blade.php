
@extends('layouts.back')
 
 @section('content')

  
<?php 	
use App\Http\Controllers\HomeController ;
 $user = auth()->user();  
   
// $beneficiaires=HomeController::beneficiaires($user['client_id'],$user['lg'] );
   $beneficiaires=DB::table('beneficiaire')->where('cl_ident',$user['client_id'])->orderBy('bene_cl_ident')->get();
  $metals=DB::table('METAL')->get();
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
    <li class="breadcrumb-item"><a href="{{route('ajout')}}">{{__('msg.Add a transfer')}}</a></li>
	</ol>
 </nav>

 <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-10 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">{{__('msg.Add a transfer')}}</h6>
                                </div>
                            <div class="card-body"  style="width:100%;min-height:600px">
							


<!-- MultiStep Form -->
<div class="row"  style="width:100%;min-height:450px">
         <form id="msform"   style="width:100%"  method="post" action="{{ route('ajoutvirement') }}"  >
         @honeypot
		 	 {{ csrf_field() }}

            <!-- progressbar -->
            <ul id="progressbar" style="width:100%;text-align: center;" >
                <li  style="color:#5a5c69;text-align: center; " class="active">{{__('msg.Transfer details')}}</li>
                 <li style="color:#5a5c69;text-align: center; ">{{__('msg.Confirmation')}}</li>
            </ul>
            <!-- fieldsets -->
            <fieldset style="width:80%">
                <h2 class="fs-title text-center">{{__('msg.Transfer details')}}</h2>
                <h3 class="fs-subtitle"> </h3>
				
                <div class="row mb-10">
				 <div class="col-md-3">{{__('msg.Beneficiary')}}:</div>
				 <div class="col-md-8">
				 <select class="form-control"    required name="beneficiaire"  id="beneficiaire"  onchange="tooltip();check()" style="font-size:12px;max-width:350px"  >
				 <option value=""></option>
				 <?php foreach($beneficiaires as $ben){
					 if($ben->etat=='validé'){
				 echo '<option title="'.$ben->commentaire.'" value="'.$ben->bene_ident.'">'.$ben->Nom.', '.$ben->Ville .' '. __('msg.In').': '.$et[$ben->etablissement_ident].' '. __('msg.Account').': '.$ben->compte.' </option>';		
					}
					 
				 } //<Nom>, <ville> chez <établissement> compte <compte>
				 ?>
				 
				 </select>
				 
				 <button  disabled type="button" data-toggle="modal" data-target="#commentModal"  onmouseover="tooltip()" id="help" class="btn btn-sm btn-circle btn-primary " style="margin-left:6px;margin-top:4px " data-toggle="tooltip" data-placement="top" title=" "><i class="fas fa-comment"></i></button>

				 </div>
				</div><div class="row mb-10">
                <div class="col-md-3">{{__('msg.Metal')}}:</div><div class="col-md-8"> <select class="form-control" style="max-width:170px" required name="metal" id="metal"  onchange="check()"  >
                <option value="" ></option> 
                <?php foreach($metals as $metal)
                { if($metal->metal_ident<9){
                echo '<option value="'.$metal->metal_ident.'" >'.$metal->metal_lib.'</option>';    
                }
				}
				
                ?>

				</select></div>
                </div><div class="row mb-10">
				<div class="col-md-3">{{__('msg.Weight')}}:</div><div class="col-md-8"> <input type="number" step="0.01" min="0.01" class="form-control" style="width:130px"  required name="poids"  id="poids" onchange="check()"  /></input>g</div>
                </div><div class="row mb-10">
				<div class="col-md-3">{{__('msg.Date')}}:</div><div class="col-md-8"> <input autocomplete="off" class="form-control datepicker" style="width:130px"  required name="date"  onchange="check()"  id="date"  value="<?php echo date('Y-m-d');?>" /></input></div>
                </div><div class="row mb-10">
				<div class="col-md-3">{{__('msg.Comment')}}:</div><div class="col-md-8"> <textarea class="form-control" cols="20" rows="2"   name="commentaire" id="commentaire" onchange="check()" maxlength="15" ></textarea></div>
				</div> 
				<a   class="action-button-previous" href="{{route('virement')}}" style="float:left;text-align:center">{{__('msg.Cancel')}}</a>                <input  id="submit" type="button" name="next" class="next action-button" value="{{__('msg.Next')}}" disabled style="float:right"/> 
             </fieldset>
            <fieldset style="width:80%;font-size:12px;" id="field-confirmation">
                <h2 class="fs-title text-center">{{__('msg.Confirmation')}}</h2>
                <h3 class="fs-subtitle"> </h3>
					<div class="row mb-10"><div class="col-lg-12"><span class="text-primary">{{__('msg.Beneficiary')}}:</span> <span class="infos mb-10" id="infos-beneficiaire"></span></div></div>
					<div class="row mb-10"><div class="col-lg-4 col-xs-12"><span class="text-primary">{{__('msg.Metal')}}:</span><span class="infos mb-10" id="infos-metal"></span></div><div class="col-lg-4 col-xs-12"><span class="text-primary">{{__('msg.Weight')}}:</span><span class="infos mb-10" id="infos-weight"></span></div></div>
					<div class="row mb-10"><div class="col-lg-12"><span class="text-primary">{{__('msg.Date')}}:</span><span class="infos mb-10" id="infos-date"></span></div></div>
					<div class="row mb-10"><div class="col-lg-12"><span class="text-primary">{{__('msg.Comment')}}:</span><span class="infos mb-30" id="infos-commentaire"></span></div></div><br>
 			   <input type="button" name="previous" class="previous action-button-previous" value="{{__('msg.Previous')}}"/>
                <input type="submit" name="submit" class="submit action-button" value="{{__('msg.Confirm')}}"  style="float:right"/>
             </fieldset>
        </form>
 
        <!-- /.link to designify.me code snippets -->
 </div>
<!-- /.MultiStep Form -->


<style>
.action-button-previous:hover {
  text-decoration: none;
}
.infos{padding:20px 20px 20px 20px;font-weight:bold; }
 :disabled{opacity:0.3;}
/*custom font*/
@import url(https://fonts.googleapis.com/css?family=Montserrat);
 

/*form styles*/
#msform {
    position: relative;
 }

#msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 0px;
    box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
    padding: 20px 30px;
    box-sizing: border-box;
    width: 80%;
    margin: 0 10%;

    /*stacking fieldsets above each other*/
    position: relative;
}

/*Hide all except first fieldset*/
#msform fieldset:not(:first-of-type) {
    display: none;
}

/*inputs
#msform input, #msform textarea, #msform select {
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 0px;
    margin-bottom: 10px;
    width: 100%;
    box-sizing: border-box;
    font-family: montserrat;
    color: #2C3E50;
    font-size: 13px;
}

#msform input:focus, #msform textarea:focus ,  #msform select:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #fcaf0a;
    outline-width: 0;
    transition: All 0.5s ease-in;
    -webkit-transition: All 0.5s ease-in;
    -moz-transition: All 0.5s ease-in;
    -o-transition: All 0.5s ease-in;
}

 buttons*/
#msform .action-button {
    width: 100px;
    background: #fcaf0a;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 25px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
}

#msform .action-button:hover, #msform .action-button:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #fcaf0a;
}

#msform .action-button-previous {
    width: 100px;
    background: #0054f3;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 25px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
}

#msform .action-button-previous:hover, #msform .action-button-previous:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #0054f3;
}

/*headings*/
.fs-title {
    font-size: 18px;
    text-transform: uppercase;
    color: #2C3E50;
    margin-bottom: 10px;
    letter-spacing: 2px;
    font-weight: bold;
}

.fs-subtitle {
    font-weight: normal;
    font-size: 13px;
    color: #666;
    margin-bottom: 20px;
}

/*progressbar*/
#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    /*CSS counters to number the steps*/
    counter-reset: step;
}

#progressbar li {
    list-style-type: none;
    color: white;
    text-transform: uppercase;
    font-size: 9px;
 /*   width: 33.33%;*/
    width: 50%;
    float: left;
    position: relative;
    letter-spacing: 1px;
}

#progressbar li:before {
    content: counter(step);
    counter-increment: step;
    width: 24px;
    height: 24px;
    line-height: 26px;
    display: inline;
    font-size: 12px;
    color: #333;
    background: white;
    border-radius: 25px;
	margin-right:20px;
	padding:6px 6px 6px 6px; }

/*progressbar connectors*/
#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: white;
    position: absolute;
    left: -50%;
    top: 9px;
    z-index: -1; /*put it behind the numbers*/
}

#progressbar li:first-child:after {
    /*connector not needed before the first step*/
    content: none;
}

/*marking active/completed steps green*/
/*The number of the step and the connector before it = green*/
#progressbar li.active:before, #progressbar li.active:after {
    background: #fcaf0a;
    color: white;
}


/* Not relevant to this form */
.dme_link {
    margin-top: 30px;
    text-align: center;
}
.dme_link a {
    background: #FFF;
    font-weight: bold;
    color: #fcaf0a;
    border: 0 none;
    border-radius: 25px;
    cursor: pointer;
    padding: 5px 25px;
    font-size: 12px;
}

.dme_link a:hover, .dme_link a:focus {
    background: #0054f3;
    text-decoration: none;
}
</style>

<script>
function tooltip()	
{ 
 var comment= $('#beneficiaire').find('option:selected').attr('title');
  
$('#help').prop('disabled', false);
$('#help').prop('title', comment);
$('#helptext').html(comment);

// $('#help').tooltip('show');


}

function check()
{
 var ben  = $('#beneficiaire').val() ;
 var beneficiaire = $('#beneficiaire').text() ;
 var date = $('#date').val() ;
 var metal = $('#metal').val() ;
 var poids =  $('#poids').val() ;
 var commentaire =  $('#commentaire').val() ;
 				
 	if( ben !='' && metal!='' && poids!='' && date!=''  ){
	$('#submit').prop('disabled', false);
	$('#infos-beneficiaire').html($('#beneficiaire option:selected').text());
	$('#infos-metal').html($('#metal option:selected').text())  ;
	$('#infos-weight').html( poids+'g');
	$('#infos-date').html(date);
	$('#infos-commentaire').html(commentaire);
	
	}else{
	$('#submit').prop('disabled', true);
		
	}
	
 	
}

//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	
	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({
        'transform': 'scale('+scale+')',
        'position': 'absolute'
      });
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});
/*
$(".submit").click(function(){
	return false;
})
*/





 
$(function () {
	
        $( ".datepicker" ).datepicker({

            altField: "#datepicker",
            closeText: 'Fermer',
            prevText: 'Précédent',
            nextText: 'Suivant',
            currentText: 'Aujourd\'hui',
            monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
            dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
            dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
            dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
            weekHeader: 'Sem.',
            buttonImage: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAATCAYAAAB2pebxAAABGUlEQVQ4jc2UP06EQBjFfyCN3ZR2yxHwBGBCYUIhN1hqGrWj03KsiM3Y7p7AI8CeQI/ATbBgiE+gMlvsS8jM+97jy5s/mQCFszFQAQN1c2AJZzMgA3rqpgcYx5FQDAb4Ah6AFmdfNxp0QAp0OJvMUii2BDDUzS3w7s2KOcGd5+UsRDhbAo+AWfyU4GwnPAYG4XucTYOPt1PkG2SsYTbq2iT2X3ZFkVeeTChyA9wDN5uNi/x62TzaMD5t1DTdy7rsbPfnJNan0i24ejOcHUPOgLM0CSTuyY+pzAH2wFG46jugupw9mZczSORl/BZ4Fq56ArTzPYn5vUA6h/XNVX03DZe0J59Maxsk7iCeBPgWrroB4sA/LiX/R/8DOHhi5y8Apx4AAAAASUVORK5CYII=",

            firstDay: 1,
          //  dateFormat: "dd/mm/yy"
             dateFormat: "yy-mm-dd",
			minDate:0
        });
         });
		 
		 
	  function changing( ) {
        var bene_ident = $('#beneficiaire').val();
        var val = document.getElementById('helptext').value;

             //if ( (val != '')) {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('updateben') }}",
                method: "POST",
                data: {bene_ident: bene_ident,  val: val, _token: _token},
                success: function (data) {
                    $('#helptext').animate({
                        opacity: '0.1',
                    });
                    $('#helptext').animate({
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
				 
		 
 </script>
							
 				 			
 		
								
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
					
					
					
 <!--   Modal-->
  <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{__('msg.Comment')}}</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"> <textarea id="helptext" style="width:100%" class="form-control" rows="3" ></textarea></div>
        <div class="modal-footer">
          <button class="btn btn-primary mr-20" type="button" id="update" onclick="changing()" style="margin-right:30px" ><i class="fa fa-edit"></i>    {{__('msg.Update')}}</button>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">{{__('msg.Close')}}</button>
         </div>
      </div>
    </div>
  </div>
								
					
@endsection
