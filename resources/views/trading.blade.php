
@extends('layouts.back')
 
 @section('content')
 <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Trading</h6>
							        {{ csrf_field() }}

                                </div>
                                <div class="card-body">
								<div class="row" >
									<div class="col-sm-12 col-lg-6" >
									
<h3 style="text-align:center">Mes encours</h3> 
									
 <table id="tabencours" class="mb-20"  border="0">
 <tr class="headmetal">
 <td> </td><td><center><div id="gold" class="pb-10">{{__("msg.Gold")}}</div></center></td><td><center><div id="silver" class="pb-10">{{ __("msg.Silver")}}</div></center></td><td><center><div id="platine" class="pb-10">{{ __("msg.Platinum")}}</center></div></td><td><center><div id="pallad" class="pb-10">{{__("msg.Palladium")}}</center></div></td>
 </tr>
 <tr  >
 <td class="tleft2"  >Solde antérieur</td><td>1 000</td><td>1 000</td><td>1 000</td><td>1 000</td>
 </tr>
  <tr  >
 <td class="tleft2"  >Mes disponibilités</td><td>1 000</td><td>1 000</td><td>1 000</td><td>1 000</td>
 </tr>
   <tr >
 <td class="tleft2"  >A venir</td><td>1 000</td><td>1 000</td><td>1 000</td><td>1 000</td>
 </tr>
    <tr >
 <td  class="tleft2" >Trading en cours</td><td>1 000</td><td>1 000</td><td>1 000</td><td>1 000</td>
 </tr>
     <tr >
 <td  class="tleft2" >Solde position</td><td>1 000</td><td>1 000</td><td>1 000</td><td>1 000</td>
 </tr>
 </table>

 
									</div>
									<div class="col-sm-12 col-lg-6"   style="width:100%;min-height:300px;">
									<h3 style="text-align:center">Cours des métaux</h3>
									
									<table   id="tabmetal" border="0">
									<thead class="headmetal"  >
									<td class="tleft" > €/kg </td><td  ><center><div id="gold" class="pb-10">{{ __("msg.Gold")}}</div></center></td><td><center><div id="silver" class="pb-10">{{ __("msg.Silver")}}</div></center></td><td><center><div id="platine" class="pb-10">{{ __("msg.Platinum") }}</center></div></td><td><center><div id="pallad" class="pb-10">{{__("msg.Palladium") }}</center></div></td>
									</thead>
									<tbody id="trading">
									<tr >
 									<td colspan="5"> <center>	<img height="50px"  src="{{ URL::asset('public/img/loader.gif')}}" ><br>
									<b>chargement des cours saamp.com ... merci de patienter</b> 
									</center>
 									</td></tr>
									</tbody>
									
													
									</table>
									
									</div>
								
								</div>
</div>								
</div>								
	

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Opérations</h6>
							        {{ csrf_field() }}

                                </div>
                                <div class="card-body">	
<div class="row">

<ul class="nav nav-tabs card-header" id="myTab" role="tablist"  style="border :1px solid lightgrey">
  <li class="nav-item">
    <a class="nav-link active" id="spot-tab" data-toggle="tab" href="#spot" role="tab" aria-controls="spot" aria-selected="true" style="color:#4e73df;width:250px;text-align:center"><i class="fas fa-calendar "></i> Demande d'opération spot</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="fixing-tab" data-toggle="tab" href="#fixing" role="tab" aria-controls="fixing" aria-selected="false" style="color:#4e73df;width:250px;text-align:center"><i class="fa  fa-calendar-alt"></i>  Demande d'opération sur fixing</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="limite-tab" data-toggle="tab" href="#limite" role="tab" aria-controls="limite" aria-selected="false" style="color:#4e73df;width:250px;text-align:center"><i class="fas fa-cart-arrow-down "></i> Demande d'ordre limite</a>
  </li>
 
   <li class="nav-item">
    <a class="nav-link" id="actif-tab" data-toggle="tab" href="#actif" role="tab" aria-controls="actif" aria-selected="false" style="color:#4e73df;width:250px;text-align:center"><i class="fas fa-list-alt "></i> Demandes d'ordres actifs</a>
  </li>
</ul>

 
</div>								
								
								
	
<div class="row">
<div class="tab-content" style="padding-left:15px;padding-right:15px;padding-top:20px;min-height:350px;">



	<div class="tab-pane active" id="spot" role="tabpanel" aria-labelledby="spot-tab" style="">								
		
		
		        <div class="row pl-20 pr-20 mb-10">
 				<label style="width:160px" class="ml-10 mt-10 mr-10">{{__('msg.Date')}}: </label>
				<input  class="form-control datepicker"  id="date"  type="text" required name="date"  autocomplete="off"   style="max-width:200px" />				   
				</div>	
				
		        <div class="row pl-20 pr-20 mb-10">
 				<label style="width:160px" class="ml-10 mt-10 mr-10">Heure: </label>
				<input  class="form-control"  id="heure"  type="time" required name="heure"  autocomplete="off"   style="max-width:200px" />				   
				</div>					
 
		        <div class="row pl-20 pr-20 mb-10">
 				<label style="width:160px" class="ml-10 mt-10 mr-10">{{__('msg.Cell phone')}}: </label>
				<input  class="form-control"  id="tel"  type="number" required name="tel"  autocomplete="off"   style="max-width:200px" />				   
				</div>	 
				
	</div>

	<div class="tab-pane" id="fixing" role="tabpanel" aria-labelledby="fixing-tab">								

	<div class="row pl-20 pr-20 mb-10">
	<label style="width:160px" class="ml-10 mt-10 mr-10">Je Souhaite: </label>
	<input type="radio" id="Choice1"  class="ml-10 mt-15 mr-10"      name="type" value="vendre">
    <label for="Choice1"  class="ml-10 mt-10 mr-10">Vendre</label>

    <input type="radio" id="Choice2"  class="ml-10 mt-15 mr-10"      name="type" value="acheter">
    <label for="Choice2" class="ml-10 mt-10 mr-10">Acherter</label>

				</div>	

		        <div class="row pl-20 pr-20 mb-10">
 				<label style="width:160px" class="ml-10 mt-10 mr-10">{{__('msg.Metal')}}: </label>
					<select style="width:200px" id="metal" name="metal" class="form-control">
						<option value="gold"    >{{__('msg.Gold')}}</option>
						<option value="silver"   >{{__('msg.Silver')}}</option>
						<option value="platinum"   >{{__('msg.Platinum')}}</option>
						<option value="palladium"   >{{__('msg.Palladium')}}</option>
					</select>

				</div>								
								
		        <div class="row pl-20 pr-20 mb-10">
				<label style="width:160px" class="ml-10 mt-10 mr-10">{{__('msg.Quantity')}} <small>{{__('msg.in grams')}}</small>: </label>
				<input  class="form-control"   type="number" step="0.1" min="0.1" required name="qty"    style="max-width:150px" />				   
				</div>
				
		        <div class="row pl-20 pr-20 mb-10">
 				<label style="width:160px" class="ml-10 mt-10 mr-10">{{__('msg.Date')}}: </label>
				<input  class="form-control datepicker"   type="text" required name="date"  autocomplete="off"   style="max-width:200px" />				   
				</div>	
				
		        <div class="row pl-20 pr-20 mb-10">
 				<label style="width:160px" class="ml-10 mt-10 mr-10">Heure: </label>
				<input  class="form-control"   type="time" required name="heure"  autocomplete="off"   style="max-width:200px" />				   
				</div>					
 
		        <div class="row pl-20 pr-20 mb-10">
 				<label style="width:160px" class="ml-10 mt-10 mr-10">{{__('msg.Email')}}: </label>
				<input  class="form-control"  id="email"  type="number" required name="tel"  autocomplete="off"   style="max-width:200px" />				   
				</div>	

				<div class="row pl-20 pr-20 mb-10">
				<label><input type="checkbox"  required > J'accepte les conditions générales de ventes.</input>

  				</div>
				
	</div>

	<div class="tab-pane" id="limite" role="tabpanel" aria-labelledby="limite-tab">								

	<div class="row pl-20 pr-20 mb-10">
	<label style="width:160px" class="ml-10 mt-10 mr-10">Je Souhaite: </label>
	<input type="radio" id="Choice1"  class="ml-10 mt-15 mr-10"      name="type" value="vendre">
    <label for="Choice1"  class="ml-10 mt-10 mr-10">Vendre</label>

    <input type="radio" id="Choice2"  class="ml-10 mt-15 mr-10"      name="type" value="acheter">
    <label for="Choice2" class="ml-10 mt-10 mr-10">Acherter</label>

				</div>	

		        <div class="row pl-20 pr-20 mb-10">
 				<label style="width:160px" class="ml-10 mt-10 mr-10">{{__('msg.Metal')}}: </label>
					<select style="width:200px" id="metal" name="metal" class="form-control">
						<option value="gold"    >{{__('msg.Gold')}}</option>
						<option value="silver"   >{{__('msg.Silver')}}</option>
						<option value="platinum"   >{{__('msg.Platinum')}}</option>
						<option value="palladium"   >{{__('msg.Palladium')}}</option>
					</select>

				</div>								
								
		        <div class="row pl-20 pr-20 mb-10">
				<label style="width:160px" class="ml-10 mt-10 mr-10">{{__('msg.Quantity')}} <small>{{__('msg.in grams')}}</small>: </label>
				<input  class="form-control"   type="number" step="0.1" min="0.1" required name="qty"    style="max-width:150px" />				   
				</div>

		        <div class="row pl-20 pr-20 mb-10">
				<label style="width:160px" class="ml-10 mt-10 mr-10">Cours limite </label>
				<input  class="form-control"   type="number" step="0.1" min="0.1" required name="cours"    style="max-width:150px" />				   
				</div>
				
		        <div class="row pl-20 pr-20 mb-10">
 				<label style="width:160px" class="ml-10 mt-10 mr-10">{{__('msg.Date')}}: </label>
				<input  class="form-control datepicker"   type="text" required name="date"  autocomplete="off"   style="max-width:200px" />				   
				</div>	
				
		        <div class="row pl-20 pr-20 mb-10">
 				<label style="width:160px" class="ml-10 mt-10 mr-10">Heure: </label>
				<input  class="form-control"   type="time" required name="heure"  autocomplete="off"   style="max-width:200px" />				   
				</div>					
 
		        <div class="row pl-20 pr-20 mb-10">
 				<label style="width:160px" class="ml-10 mt-10 mr-10">{{__('msg.Email')}}: </label>
				<input  class="form-control"  id="email"  type="number" required name="tel"  autocomplete="off"   style="max-width:200px" />				   
				</div>	

				<div class="row pl-20 pr-20 mb-10">
				<label><input type="checkbox"  required > J'accepte les conditions générales de ventes.</input>

  				</div>

				
	</div>

	<div class="tab-pane" id="actif" role="tabpanel" aria-labelledby="actif-tab">								

	
	</div>	

</div>								
</div>								
								
</div>								
</div>									
								
								
<style>	

#tabmetal td , #tabmetal th{width:100px!important;}
	 .nav-link.active {font-weight:bold!important;color:#354f9b!important;}	

 label{color:black;font-weight:bold;}
table{border:none;
color:black; }
.strname{font-weight:bold;color:#c6a85b;}
.text{border:#000 1px dashed;}
.trade{border:#000 1px solid;}
 .time{font-size:11px;}
td {padding:3px 3px 3px 3px;border:1px dotted lightgrey;} 
/*.contentmetal{border:1px solid black;}
.headmetal{border:1px solid black;}*/
.headmetal{padding-top:6px!important;padding-top:6px!important;} 
#tabmetal, #tabencours{font-weight:bold; text-align:center;border:1px solid lightgrey;}
.tleft{width:100px;color:#c6a85b;font-weight:800;font-size:20px;}
.tleft2{ color:#c6a85b;font-weight:800; }
/*
.libelles {
 
 font-weight:bold;
 background-color:#E4D186;
 border:#000 1px solid;
}				

.separationTime ,.separation, .separation0{
 border-bottom:#000 2px dashed;
 border-right:#000 2px dashed;
 border-left:#000 2px dashed;
} 
.separation0{background-color:darkgrey;color:white;}
 .separation{font-size:18px;}
 */
 
 
#gold {
border-radius:20px;
width:70px;
padding-top:8px;
height: 40px;
text-align:center;color:white;
    background: radial-gradient(ellipse farthest-corner at right bottom, #FEDB37 0%, #FDB931 8%, #9f7928 30%, #9f7928 40%, transparent 60%),
                radial-gradient(ellipse farthest-corner at left top, #FFFFFF 0%, #FFFFAC 8%, #D1B464 25%, #c49f4d 62.5%, #c49f4d 100%);
}


#silver {
border-radius:20px;
width:70px;
color:white;
text-align:center;
	padding-top:8px;
   height: 40px;
	background: #9f7c3c;
	
	/* Safari and Google Chrome */
	background: -webkit-repeating-linear-gradient(90deg, #8b8282 0%,#acacac 2%, #d5d5d5 23%, #c9c9c9 29%, #c9c9c9 33%, #c2c1c1 61%, #aca8a8 66%, #aca8a8 79%, #acacac 95%, #8b8282 100%);
	
	/* Firefox */
	background: -moz-repeating-linear-gradient(90deg, #8b8282 0%,#acacac 2%, #d5d5d5 23%, #c9c9c9 29%, #c9c9c9 33%, #c2c1c1 61%, #aca8a8 66%, #aca8a8 79%, #acacac 95%, #8b8282 100%);
	
	/* Opera */
	background: -o-repeating-linear-gradient(90deg, #8b8282 0%,#acacac 2%, #d5d5d5 23%, #c9c9c9 29%, #c9c9c9 33%, #c2c1c1 61%, #aca8a8 66%, #aca8a8 79%, #acacac 95%, #8b8282 100%);
	
	/* Internet Explorer */
	background: -ms-repeating-linear-gradient(90deg, #8b8282 0%,#acacac 2%, #d5d5d5 23%, #c9c9c9 29%, #c9c9c9 33%, #c2c1c1 61%, #aca8a8 66%, #aca8a8 79%, #acacac 95%, #8b8282 100%);
	
	/* W3C Standard */
	background: repeating-linear-gradient(90deg, #8b8282 0%,#acacac 2%, #d5d5d5 23%, #c9c9c9 29%, #c9c9c9 33%, #c2c1c1 61%, #aca8a8 66%, #aca8a8 79%, #acacac 95%, #8b8282 100%);
}

#platine {
border-radius:20px;	

width:70px;
padding-top:8px;
height: 40px;
text-align:center;color:white;
    background: radial-gradient(ellipse farthest-corner at right bottom, #FFFFFF 0%, #e7e6e6 8%, #808080 30%, #acacac 40%, transparent 60%),
                radial-gradient(ellipse farthest-corner at left top, #FFFFFF 0%, #e7e6e6 8%, #808080 25%, #e7e6e6 62.5%, #e7e6e6 100%);
}
 
 
#pallad {
border-radius:20px;
font-size:13px;
width:70px;
color:white;
text-align:center;
	padding-top:10px;
	text-shadow:1px 1px lightgrey;
   height: 40px;
	background: #9f7c3c;
	
	/* Safari and Google Chrome */
	background: -webkit-repeating-linear-gradient(90deg, #ffffff 0%,#ffffff 2%, #d5d5d5 23%, #f0eded 29%, #f0eded 33%, #c2c1c1 61%, #c9c7c7 66%, #c9c7c7 79%, #f0eeee 95%, #FFFFFF 100%);
	
	/* Firefox */
	background: -moz-repeating-linear-gradient(90deg, #ffffff 0%,#ffffff 2%, #d5d5d5 23%, #f0eded 29%, #f0eded 33%, #c2c1c1 61%, #c9c7c7 66%, #c9c7c7 79%, #f0eeee 95%, #FFFFFF 100%);
	
	/* Opera */
	background: -o-repeating-linear-gradient(90deg, #ffffff 0%,#ffffff 2%, #d5d5d5 23%, #f0eded 29%, #f0eded 33%, #c2c1c1 61%, #c9c7c7 66%, #c9c7c7 79%, #f0eeee 95%, #FFFFFF 100%);
	
	/* Internet Explorer */
	background: -ms-repeating-linear-gradient(90deg, #ffffff 0%,#ffffff 2%, #d5d5d5 23%, #f0eded 29%, #f0eded 33%, #c2c1c1 61%, #c9c7c7 66%, #c9c7c7 79%, #f0eeee 95%, #FFFFFF 100%);
	
	/* W3C Standard */
	background: repeating-linear-gradient(90deg, #ffffff 0%,#ffffff 2%, #d5d5d5 23%, #f0eded 29%, #f0eded 33%, #c2c1c1 61%, #c9c7c7 66%, #c9c7c7 79%, #f0eeee 95%, #FFFFFF 100%);
}
</style>

	 
      

 
<script>

$(function () {
	 $('.datepicker').datepicker({
                  //  locale: 'fr',
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
            dateFormat: "dd/mm/yy"


                });
				
});


 $( "#tel" ).keypress(function( evt ) {
		
     var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
            return false; 
        return true; 
		});
		
		
//
function load_data()
{
	 var _token = $('input[name="_token"]').val();

	  $.ajax({
                url: "{{ route('listetrading') }}",
                method: "POST",
                data: {  _token: _token},
                success:function(data){
 
                        $("#trading").html(data);
                  
                }
            });

}

//setTimeout(load_data(),10000);

 function load_data(){
  var _token = $('input[name="_token"]').val();
alert(_token);
			$.ajax({
                url: "{{ route('listetrading') }}",
                method: "POST",
                data: {  _token: _token},
                success:function(data){
 				
                   $("#trading").html(data);
					  setTimeout(function(){
					     $("#trading").animate({
                        opacity: '0.5',
                    });
					 $("#trading").animate({
                        opacity: '1',
                    });	  
                        load_data(); 
                    }, 10000);  //10 secds
                  
                }
            });
 
  }
  
  load_data();
</script>

								
   
			</div>
		</div>
	</div>
</div>
@endsection



      