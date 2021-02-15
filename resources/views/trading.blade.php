
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
								<div id="trading" style="width:100%;min-height:300px;">
								<center>	<img height="50px"  src="{{ URL::asset('public/img/loader.gif')}}" ><br>
									<b>chargement des cours saamp.com ... merci de patienter</b> 
								<center>	
								</div>
								
<style>	
 
table{border:none;
color:black; }
.strname{font-weight:bold;color:#c6a85b;}
.text{border:#000 1px dashed;}
.trade{border:#000 1px solid;}
 .time{font-size:11px;}
td {padding:3px 3px 3px 3px;} 
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



      