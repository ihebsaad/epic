
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
									<div class="col-sm-12 col-lg-6" id="trading" style="width:100%;min-height:300px;">
									<center>	<img height="50px"  src="{{ URL::asset('public/img/loader.gif')}}" ><br>
									<b>chargement des cours saamp.com ... merci de patienter</b> 
									<center>	
									</div>
								
								</div>
								
<style>	
 
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



      