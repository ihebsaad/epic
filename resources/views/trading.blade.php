
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


<?php
$provider = "netdania_fxa";
	$username = "saamp";
	$password = "1s3wAA8m9Pw";
	
	$dateTimeFormat = "dd HH:mm:ss"; //The format for returned timestamps
	$timezone = "CET"; //The timezone to which timestamps should be converted

	//Returns a full text-representation of the XML document
	//with the given URL.
	function getXMLSource($url)
	{
		$str = file_get_contents($url);
		return $str;
	}
	
	//Array of symbols	
	$arrSymbols = array("EURUSD");
	$arrSymbols2 = array("XPTUSDOCOMP.fx","XPDUSDOCOMP.fx","XAUUSDOCOMP.fx","XAGUSDOCOMP.fx");
	
	//Create a string representation of the symbols, seperated by "|"
	$strSymbols = "";
	$start = 0;
	
	foreach($arrSymbols as $symbol)
	{
		$strSymbols = $strSymbols.$symbol."|";
	}
	
	$source = getXMLSource("http://balancer.netdania.com/StreamingServer/StreamingServer?xml=price&group=".$username."&pass=".$password."&source=".$provider."&symbols=".$strSymbols."&fields=10|11|14|15|25|4|2|3|1&time=".$dateTimeFormat."&tzone=".$timezone);
	//Load XML data source
	$objXMLDom = new SimpleXMLElement($source);
	
?>
 
<style TYPE="text/css">  
.text{font-family:arial;font-size:9pt}
.textbold{font-family:arial;font-size:10pt;font-weight:BOLD}
</style>
  
 
<TABLE border="0" >
<TR>
	<TD class="textbold" align="left" nowrap width="105">Name:</TD>
	<TD class="textbold" align="right" nowrap width="60">Bid:</TD>
	<TD class="textbold" align="right" nowrap width="60">Ask:</TD>
	<TD class="textbold" align="right" nowrap width="70">Change:</TD>
	<TD class="textbold" align="right" nowrap width="70">% Change:</TD>
	<TD class="textbold" align="right" nowrap width="70">Open:</TD>
	<TD class="textbold" align="right" nowrap width="70">High:</TD>
	<TD class="textbold" align="right" nowrap width="70">Low:</TD>
	<TD class="textbold" align="right" nowrap width="70">Close:</TD>
	<TD class="textbold" align="right" nowrap width="80">Time:</TD>
</TR>
<?php


	//Loop through and display data for each instrument
	foreach ($objXMLDom->quote as $quote) {
//		$strName = $arrNames[$i];
//		$i++;
		$strName = $quote["f25"];
		$strBid = $quote["f10"];
		$strAsk = $quote["f11"];
		$strChange = $quote["f14"];
		$strPercChange = $quote["f15"];
		$strOpen = $quote["f4"];
		$strHigh = $quote["f2"];
		$strLow = $quote["f3"];
		$strClose = $quote["f1"];
		$strDateTime = $quote;
		
?>
<TR>
	<TD class="text" align="left" nowrap><?php print($strName);?></TD>
	<TD class="text" align="right"><?php print($strBid)?></TD>
	<TD class="text" align="right"><?php print($strAsk)?></TD>
	<TD class="text" align="right"><?php print($strChange)?></TD>
	<TD class="text" align="right"><?php print($strPercChange)?></TD>
	<TD class="text" align="right"><?php print($strOpen)?></TD>
	<TD class="text" align="right"><?php print($strHigh)?></TD>
	<TD class="text" align="right"><?php print($strLow)?></TD>
	<TD class="text" align="right"><?php print($strClose)?></TD>
	<TD class="text" align="right"><?php print($strDateTime)?></TD>
</TR>
<?php
	}
	$xml = null;

$provider = "ms_dla";
	//Create a string representation of the symbols, seperated by "|"
	$strSymbols = "";
	$start = 0;
	
	foreach($arrSymbols2 as $symbol)
	{
		$strSymbols = $strSymbols.$symbol."|";
	}
	
	$source = getXMLSource("http://balancer.netdania.com/StreamingServer/StreamingServer?xml=price&group=".$username."&pass=".$password."&source=".$provider."&symbols=".$strSymbols."&fields=10|11|14|15|25|4|2|3|1&time=".$dateTimeFormat."&tzone=".$timezone);
	//Load XML data source
	$objXMLDom = new SimpleXMLElement($source);
	//echo "http://balancer.netdania.com/StreamingServer/StreamingServer?xml=price&group=".$username."&pass=".$password."&source=".$provider."&symbols=".$strSymbols."&fields=10|11|14|15|25|4|2|3|1&time=".$dateTimeFormat."&tzone=".$timezone;
?>
<TABLE border="0" >

<?php


	//Loop through and display data for each instrument
	foreach ($objXMLDom->quote as $quote) {
//		$strName = $arrNames[$i];
//		$i++;
		$strName = $quote["f25"];
		$strBid = $quote["f10"];
		$strAsk = $quote["f11"];
		$strChange = $quote["f14"];
		$strPercChange = $quote["f15"];
		$strOpen = $quote["f4"];
		$strHigh = $quote["f2"];
		$strLow = $quote["f3"];
		$strClose = $quote["f1"];
		$strDateTime = $quote;
		
?>
<TR>
	<TD class="text" align="left" nowrap width="105"><?php print($strName);?></TD>
	<TD class="text" align="right" width="60"><?php print($strBid)?></TD>
	<TD class="text" align="right" width="60"><?php print($strAsk)?></TD>
	<TD class="text" align="right" width="70"><?php print($strChange)?></TD>
	<TD class="text" align="right" width="70"><?php print($strPercChange)?></TD>
	<TD class="text" align="right" width="70"><?php print($strOpen)?></TD>
	<TD class="text" align="right" width="70"><?php print($strHigh)?></TD>
	<TD class="text" align="right" width="70"><?php print($strLow)?></TD>
	<TD class="text" align="right" width="70"><?php print($strClose)?></TD>
	<TD class="text" align="right" width="80"><?php print($strDateTime)?></TD>
</TR>
<?php
	}
	$xml = null;


?>
</TABLE>





								
   
			</div>
		</div>
	</div>
</div>
@endsection
