
@extends('layouts.back')
 
 @section('content')
 <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Trading</h6>
                                </div>
                                <div class="card-body">
<style>	
table{border:none;
color:black;font-weight:bold;}
td {padding:8px 8px 8px 8px;} 
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
</style>								
								
<!--
 <style TYPE="text/css">  

#gradient-style2 {font-family:"Lucida Sans Unicode", "Lucida Grande", Sans-Serif;font-size:11px;width:480px;text-align:left;border-collapse:collapse;margin:20px;}
#gradient-style2 th{font-size:13px;font-weight:normal;background_:#b9c9fe url("gradhead.png") repeat-x;border-top:2px solid #d3ddff;border-bottom:1px solid #fff;color:#039;padding:8px;}
#gradient-style2 td{border-bottom:1px solid #fff;color:#669;border-top:1px solid #fff;background:#e8edff url("gradback.png") repeat-x;padding:8px;}
#gradient-style2 tfoot tr td{background:#e8edff;font-size:12px;color:#99c;}
#gradient-style2 tbody tr:hover td{background_:#d0dafd url("gradhover.png") repeat-x;color:#339;}



.bijouxpieces {
 text-align:left;
 color:#FFF;
 background-color:#000000;
 background_: url("lingot.jpg");
}




.libelles2 {
 font-size:9px;
 font-weight:normal;
 text-align:center;
 background-color:#E4D186;
 border:#000 1px solid;
}

.libelles_ {
 font-weight:bold;
 background-color:#E5AA39;
 border:#000 1px solid;
}


.libelles2_ {
 font-size:12px;
 font-weight:normal;
 text-align:center;
 background-color:#E5AA39;
 border:#000 1px solid;
}

.separation {
 white-space: nowrap;
 PADDING-left:5px;
 PADDING-right:5px;
 border-bottom:#000 2px dashed;
 border-right:#000 2px dashed;
 background-color:#FFF;
}

.separationTime {
 font-size:20px;
 white-space: nowrap;
 PADDING-left:5px;
 PADDING-right:5px;
 border-bottom:#000 2px dashed;
 border-right:#000 2px dashed;
 background-color:#FFF;
}

.separation0 {
 border-bottom:#000 2px dashed;
 background-color:#FFF;
}

.form {
 
 opacitydd:0.9;
 font-family:"Arial","Lucida Sans Unicode", "Lucida Grande", Sans-Serif;font-size:30px;width:100%;text-align:left;
}

/* Easy Slider */

#slider ,#slider2{
text-align: center;
}

	#slider ul, #slider li{
		margin:0;
		padding:0;
		list-style:none;
		}
	#slider, #slider li{ 
		/* 
			define width and height of container element and list item (slide)
			list items must be the same size as the slider area
		*/ 
		width:940px;
		height:500px;
		overflow:hidden; 
		}
	#slider span#prevBtn{}
	#slider span#nextBtn{}		
  
  /* numeric controls */	

	ol#controls{
		margin:1em 0;
		padding:0;
		height:28px;	
		}
	ol#controls li{
		margin:0 10px 0 0; 
		padding:0;
		float:left;
		list-style:none;
		height:28px;
		line-height:28px;
		}
	ol#controls li a{
		float:left;
		height:28px;
		line-height:28px;
		border:1px solid #ccc;
		background:#DAF3F8;
		color:#555;
		padding:0 10px;
		text-decoration:none;
		}
	ol#controls li.current a{
		background:#5DC9E1;
		color:#fff;
		}
	ol#controls li a:focus, #prevBtn a:focus, #nextBtn a:focus{outline:none;}
	
  						

/* // Easy Slider */

h1,h2,h3,h4,h5,h6 {
	font-weight:800;
	float:left;
	color:#FFF;
	background:#0F0F0F;
	font-family:"Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
}

.txtHint { 
width: 900px; 
height: 125px; 

white-space:nowrap; 
overflow-y: hidden; 
} 




</style>-->
  
<script type="text/javascript">

devise = "Euro__";
poids = "kilogram";
counter = 0;

Gold_bid_old=0;
Gold_ask_old=0;
Silver_bid_old=0;
Silver_ask_old=0;
XPT_USD_bid_old=0;
XPT_USD_ask_old=0;
XPTG_USD_bid_old=0;
XPTG_USD_ask_old=0;

function changeVar (d, p) { devise = d; poids =p; showNetDania();}

function showNetDania()
{

//alert (devise + ' - ' + poids);
if (devise=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  } 

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else if (window.ActiveXObject) {
try { 
xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); 
} 
catch (e) { 
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); 
} 
}
/*
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  } 
*/  
//xmlhttp = ( window.ActiveXObject ? new ActiveXObject("Microsoft.XMLHTTP") : new XMLHttpRequest( ) );


counter++; 
xmlhttp.open("GET","http://mysaamp.com/devises.php?q="+devise+"&p="+poids+"&counter="+counter, true);



xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    //alert ('ancienne val : ' + document.getElementById("XAU/USD_bid_old").value +' *** Nouvelle val : ' + document.getElementById("XAU/USD_bid").value); 
    
    /*
Gold_bid_old=0;
Gold_ask_old=0;
Silver_bid_old=0;
Silver_ask_old=0;
XPT_USD_bid_old=0;
XPT_USD_ask_old=0;    
    */
    //Gold_bid_old
    if (document.getElementById("Gold_bid").value > Gold_bid_old)
      {
          $("#Gold_bid_div").effect( "highlight", {color:"green"}, 3000 );
          for (i=2;i<=9;i++)
            {
              $("#Gold_bid_div"+i).effect( "highlight", {color:"green"}, 3000 );
            }
          Gold_bid_old = document.getElementById("Gold_bid").value;
          //document.getElementById("Gold_bid_old").value = Gold_bid_old
      }
    else if (document.getElementById("Gold_bid").value < Gold_bid_old)
      {
          $("#Gold_bid_div").effect( "highlight", {color:"red"}, 3000 );
          for (i=2;i<=9;i++)
            {
              $("#Gold_bid_div"+i).effect( "highlight", {color:"red"}, 3000 );
            }
          Gold_bid_old = document.getElementById("Gold_bid").value;
          //document.getElementById("Gold_bid_old").value = Gold_bid_old
      }
    //Gold_ask_old
    if (document.getElementById("Gold_ask").value > Gold_ask_old)
      {
          $("#Gold_ask_div").effect( "highlight", {color:"green"}, 3000 );
          for (i=2;i<=9;i++)
            {
              $("#Gold_ask_div"+i).effect( "highlight", {color:"green"}, 3000 );
            }
          Gold_ask_old = document.getElementById("Gold_ask").value;
          //document.getElementById("Gold_ask_old").value = Gold_ask_old
      }
    else if (document.getElementById("Gold_ask").value < Gold_ask_old)
      {
          $("#Gold_ask_div").effect( "highlight", {color:"red"}, 3000 );
          for (i=2;i<=9;i++)
            {
              $("#Gold_ask_div"+i).effect( "highlight", {color:"red"}, 3000 );
            }
          Gold_ask_old = document.getElementById("Gold_ask").value;
          //document.getElementById("Gold_ask_old").value = Gold_ask_old
      }
    //Silver_bid_old
    if (document.getElementById("Silver_bid").value > Silver_bid_old)
      {
          $("#Silver_bid_div").effect( "highlight", {color:"green"}, 3000 );
          for (i=2;i<=9;i++)
            {
              $("#Silver_bid_div"+i).effect( "highlight", {color:"green"}, 3000 );
            }
          Silver_bid_old = document.getElementById("Silver_bid").value;
          //document.getElementById("Silver_bid_old").value = Silver_bid_old
      }
    else if (document.getElementById("Silver_bid").value < Silver_bid_old)
      {
          $("#Silver_bid_div").effect( "highlight", {color:"red"}, 3000 );
          for (i=2;i<=9;i++)
            {
              $("#Silver_bid_div"+i).effect( "highlight", {color:"red"}, 3000 );
            }
          Silver_bid_old = document.getElementById("Silver_bid").value;
          //document.getElementById("Silver_bid_old").value = Silver_bid_old
      }
    //Silver_ask_old
    if (document.getElementById("Silver_ask").value > Silver_ask_old)
      {
          $("#Silver_ask_div").effect( "highlight", {color:"green"}, 3000 );
          for (i=2;i<=9;i++)
            {
              $("#Silver_ask_div"+i).effect( "highlight", {color:"green"}, 3000 );
            }
          Silver_ask_old = document.getElementById("Silver_ask").value;
      }
    else if (document.getElementById("Silver_ask").value < Silver_ask_old)
      {
          $("#Silver_ask_div").effect( "highlight", {color:"red"}, 3000 );
          for (i=2;i<=9;i++)
            {
              $("#Silver_ask_div"+i).effect( "highlight", {color:"red"}, 3000 );
            }
          Silver_ask_old = document.getElementById("Silver_ask").value;
      }
    //XPT_USD_bid_old
    if (document.getElementById("XPT_USD_bid").value > XPT_USD_bid_old)
      {
          $("#XPT_USD_bid_div").effect( "highlight", {color:"green"}, 3000 );
          for (i=2;i<=9;i++)
            {
              $("#XPT_USD_bid_div"+i).effect( "highlight", {color:"green"}, 3000 );
            }
          XPT_USD_bid_old = document.getElementById("XPT_USD_bid").value;
      }
    else if (document.getElementById("XPT_USD_bid").value < XPT_USD_bid_old)
      {
          $("#XPT_USD_bid_div").effect( "highlight", {color:"red"}, 3000 );
          for (i=2;i<=9;i++)
            {
              $("#XPT_USD_bid_div"+i).effect( "highlight", {color:"red"}, 3000 );
            }
          XPT_USD_bid_old = document.getElementById("XPT_USD_bid").value;
      }
    //XPT_USD_ask_old
    if (document.getElementById("XPT_USD_ask").value > XPT_USD_ask_old)
      {
          $("#XPT_USD_ask_div").effect( "highlight", {color:"green"}, 3000 );
          for (i=2;i<=9;i++)
            {
              $("#XPT_USD_ask_div"+i).effect( "highlight", {color:"green"}, 3000 );
            }
          XPT_USD_ask_old = document.getElementById("XPT_USD_ask").value;
      }
    else if (document.getElementById("XPT_USD_ask").value < XPT_USD_ask_old)
      {
          $("#XPT_USD_ask_div").effect( "highlight", {color:"red"}, 3000 );
          for (i=2;i<=9;i++)
            {
              $("#XPT_USD_ask_div"+i).effect( "highlight", {color:"red"}, 3000 );
            }
          XPT_USD_ask_old = document.getElementById("XPT_USD_ask").value;
      }
    //XPTG_USD_ask_old
    if (document.getElementById("XPTG_USD_ask").value > XPTG_USD_ask_old)
      {
          $("#XPTG_USD_ask_div").effect( "highlight", {color:"green"}, 3000 );
          for (i=2;i<=9;i++)
            {
              $("#XPTG_USD_ask_div"+i).effect( "highlight", {color:"green"}, 3000 );
            }
          XPTG_USD_ask_old = document.getElementById("XPTG_USD_ask").value;
      }
    else if (document.getElementById("XPTG_USD_ask").value < XPTG_USD_ask_old)
      {
          $("#XPTG_USD_ask_div").effect( "highlight", {color:"red"}, 3000 );
          for (i=2;i<=9;i++)
            {
              $("#XPTG_USD_ask_div"+i).effect( "highlight", {color:"red"}, 3000 );
            }
          XPTG_USD_ask_old = document.getElementById("XPTG_USD_ask").value;
      }
    //XPTG_USD_bid_old
    if (document.getElementById("XPTG_USD_bid").value > XPTG_USD_bid_old)
      {
          $("#XPTG_USD_bid_div").effect( "highlight", {color:"green"}, 3000 );
          for (i=2;i<=9;i++)
            {
              $("#XPTG_USD_bid_div"+i).effect( "highlight", {color:"green"}, 3000 );
            }
          XPTG_USD_bid_old = document.getElementById("XPTG_USD_bid").value;
      }
    else if (document.getElementById("XPTG_USD_bid").value < XPTG_USD_bid_old)
      {
          $("#XPTG_USD_bid_div").effect( "highlight", {color:"red"}, 3000 );
          for (i=2;i<=9;i++)
            {
              $("#XPTG_USD_bid_div"+i).effect( "highlight", {color:"red"}, 3000 );
            }
          XPTG_USD_bid_old = document.getElementById("XPTG_USD_bid").value;
      }
      
    }
  }

xmlhttp.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded" );
xmlhttp.send();



setTimeout("showNetDania()",5000);

//alert (document.getElementById("test_ok").value)
   

}






</script>
<!--
<script src="../js/jquery-1.7.1.js">
</script>
<script src="../js/jquery.effects.core.js"></script>
	<script src="../js/jquery.effects.blind.js"></script>
	<script src="../js/jquery.effects.bounce.js"></script>
	<script src="../js/jquery.effects.clip.js"></script>
	<script src="../js/jquery.effects.drop.js"></script>
	<script src="../js/jquery.effects.explode.js"></script>
	<script src="../js/jquery.effects.fade.js"></script>
	<script src="../js/jquery.effects.fold.js"></script>
	<script src="../js/jquery.effects.highlight.js"></script>
	<script src="../js/jquery.effects.pulsate.js"></script>
	<script src="../js/jquery.effects.scale.js"></script>
	<script src="../js/jquery.effects.shake.js"></script>
	<script src="../js/jquery.effects.slide.js"></script>
	<script src="../js/jquery.effects.transfer.js"></script>
	<script src="../js/easySlider1.7.js"></script>
	 -->

  </HEAD>
  <div id="txtHint" name="txtHint">
  <table align='center' width='600px' height="50%">
  <tr><td align='center' valign="middle">
  <img height="50px"  src="{{ URL::asset('public/img/loader.gif')}}" ><br>
  </td>
  </tr>
  <tr><td align='center' >
  <b>chargement des cours saamp.com ... merci de patienter</b> </td></tr></table>
  </div>
   
  <div style="display:none;">
<form class="entryform" method="post" action=""  enctype="multipart/form-data">
  <!-- XAU/USD_bid --><input type="hidden" name="Gold_bid" id="Gold_bid" value="0" />
  <!-- XAU/USD_ask --> <input type="hidden" name="Gold_ask" id="Gold_ask" value="0" /><br>
  <!-- XAG/USD_bid  --><input type="hidden" name="Silver_bid" id="Silver_bid" value="0" />
  <!-- XAG/USD_ask  --><input type="hidden" name="Silver_ask" id="Silver_ask" value="0" /><br>
  <!-- XPT/USD_bid  --><input type="hidden" name="XPT_USD_bid" id="XPT_USD_bid" value="0" />
  <!-- XPT/USD_ask  --><input type="hidden" name="XPT_USD_ask" id="XPT_USD_ask" value="0" /><br>  
  <!-- XPTG/USD_bid --><input type="hidden" name="XPTG_USD_bid" id="XPTG_USD_bid" value="0" />
  <!-- XPTG/USD_ask --><input type="hidden" name="XPTG_USD_ask" id="XPTG_USD_ask" value="0" /><br>
</form>
</div>
  <script>
  //"EURUSD|XAUUSD|XAGUSD"
  
  showNetDania();
 //  setTimeout("showNetDania()",4000);
  
  
  
  </script>
  

					<!--	<div class="row">

                         <div class="col-lg-6 mb-4">

                             <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                                </div>
                                <div class="card-body">
                                     
                                </div>
                            </div>

                       

                        </div>

                        <div class="col-lg-6 mb-4">

                             <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                                </div>
                                <div class="card-body">
 
 
                                </div>
                            </div>

               

                        </div>
                    </div>---->
			</div>
		</div>
	</div>
</div>
@endsection
