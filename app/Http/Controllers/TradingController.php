<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

 
class TradingController extends Controller
{
	
	  public function __construct()
    {
        $this->middleware('auth');
    } 
	 
	 
	 
	 
	 public	function getXMLSource($url)
	{
		$str = file_get_contents($url);
		return $str;
	}
	
	public function listetrading()
	{
		
		
 
	$provider = "netdania_fxa";
	$username = "saamp";
	$password = "1s3wAA8m9Pw";
	
	$dateTimeFormat = "dd HH:mm:ss"; //The format for returned timestamps
	$timezone = "CET"; //The timezone to which timestamps should be converted

 

	//Returns a full text-representation of the XML document
	//with the given URL.

	
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
	
	$source = $this->getXMLSource("http://balancer.netdania.com/StreamingServer/StreamingServer?xml=price&group=".$username."&pass=".$password."&source=".$provider."&symbols=".$strSymbols."&fields=10|11|14|15|25|4|2|3|1&time=".$dateTimeFormat."&tzone=".$timezone);
	//Load XML data source
	$objXMLDom = new \SimpleXMLElement($source);
	
 
 
 $data='';
 $data.='
<TABLE border="0" >
<TR>
	<TD class="font-weight-bold trade" align="left" nowrap width="80">Name</TD>
	<TD class="font-weight-bold trade hidemobile" align="center" nowrap width="60">Bid</TD>
	<TD class="font-weight-bold trade hidemobile" align="center" nowrap width="60">Ask</TD>
	<TD class="font-weight-bold trade" align="center" nowrap width="60">Purchase</TD>
	<TD class="font-weight-bold trade" align="center" nowrap width="60">Sale</TD>
	<TD class="font-weight-bold trade hidemobile" align="center" nowrap width="70">Change</TD>
	<TD class="font-weight-bold trade hidemobile" align="center" nowrap width="85">% Change</TD>
	<TD class="font-weight-bold trade hidemobile" align="center" nowrap width="70">Open</TD>
	<TD class="font-weight-bold trade hidemobile" align="center" nowrap width="70">High</TD>
	<TD class="font-weight-bold trade hidemobile" align="center" nowrap width="70">Low</TD>
	<TD class="font-weight-bold trade hidemobile" align="center" nowrap width="70">Close</TD>
	<TD class="font-weight-bold trade hidemobile" align="center" nowrap width="80">Time</TD>
</TR>
';

$euroask= $eurobid=0;
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
				if($strName=='EUR/USD'){
					$euroask=floatval($strAsk);
					$eurobid=floatval($strBid);
				}

$data.=' 
<TR>
	<TD class="text strname" align="left" nowrap>'.$strName.'</TD>
	<TD class="text hidemobile" align="center">'.$strBid.'</TD>
	<TD class="text hidemobile" align="center">'.$strAsk.'</TD>
	<td></td>
	<td></td>
	<TD class="text hidemobile" align="center">'.$strChange.'</TD>
	<TD class="text hidemobile" align="center">'.$strPercChange.'</TD>
	<TD class="text hidemobile" align="center">'.$strOpen.'</TD>
	<TD class="text hidemobile" align="center">'.$strHigh.'</TD>
	<TD class="text hidemobile" align="center">'.$strLow.'</TD>
	<TD class="text hidemobile" align="center">'.$strClose.'</TD>
	<TD class="text hidemobile time" align="center">'.$strDateTime.'</TD>
</TR>';
 
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
	
	$source = $this->getXMLSource("http://balancer.netdania.com/StreamingServer/StreamingServer?xml=price&group=".$username."&pass=".$password."&source=".$provider."&symbols=".$strSymbols."&fields=10|11|14|15|25|4|2|3|1&time=".$dateTimeFormat."&tzone=".$timezone);
	//Load XML data source
	$objXMLDom = new \SimpleXMLElement($source);
	//echo "http://balancer.netdania.com/StreamingServer/StreamingServer?xml=price&group=".$username."&pass=".$password."&source=".$provider."&symbols=".$strSymbols."&fields=10|11|14|15|25|4|2|3|1&time=".$dateTimeFormat."&tzone=".$timezone;
 
 

 

$goldbid=$silvbid=$platbid=$pallbid= $ventegold= $ventesilv= $venteplat= $ventepall= $achatgold=$achatsilv=$achatplat=$achatpall= 0; 
	//Loop through and display data for each instrument
	foreach ($objXMLDom->quote as $quote) { 
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
		
		if($strName=='Gold'){
			$goldbid=floatval($strBid); 
		    $goldask=floatval($strAsk);
			}
		if($strName=='Silver'){
			$silvbid=floatval($strBid); 
		    $silvask=floatval($strAsk);
			}
		if($strName=='Platinum/USD'){
			$platbid=floatval($strBid); 
		    $platask=floatval($strAsk);
			}
		if($strName=='Palladium/USD'){
			$pallbid=floatval($strBid); 
		    $pallask=floatval($strAsk);
			}			
		if($euroask > 0 && $goldbid > 0)
		{
		 $ventegold= (( floatval($goldbid) / floatval($euroask) ) / 31.10348 )* (0.9975) ; 
		 $achatgold= (( floatval($goldask) / floatval($eurobid) ) / 31.10348 )* (1.0025) ;
		 }
		if($euroask > 0 && $silvbid > 0)
		{
		 $ventesilv= (( floatval($silvbid) / floatval($euroask) ) / 31.10348 )* (0.9975) ; 
		 $achatsilv= (( floatval($silvask) / floatval($eurobid) ) / 31.10348 )* (1.0025) ;
		 }
		if($euroask > 0 && $platbid > 0)
		{
		 $venteplat= (( floatval($platbid) / floatval($euroask) ) / 31.10348 )* (0.9975) ; 
		 $achatplat= (( floatval($platask) / floatval($eurobid) ) / 31.10348 )* (1.0025) ;
		 }

		if($euroask > 0 && $pallbid > 0)
		{
		 $ventepall= (( floatval($pallbid) / floatval($euroask) ) / 31.10348 )* (0.9975) ; 
		 $achatpall= (( floatval($pallask) / floatval($eurobid) ) / 31.10348 )* (1.0025) ;
		 }		 
		 
$data.='
<TR>
	<TD class="text strname" align="left" nowrap width="105">'.$strName.'</TD>
	<TD class="text hidemobile" align="center" width="60">'.$strBid.'</TD>
	<TD class="text hidemobile" align="center" width="60">'.$strAsk.'</TD>
	<TD class="text" align="center" width="60">'; if($strName=='Gold'){$data.= number_format($achatgold,4);}if($strName=='Silver'){$data.= number_format($achatsilv,4);}if($strName=='Platinum/USD'){$data.= number_format($achatplat,4);}if($strName=='Palladium/USD'){$data.= number_format($achatpall,4);} $data.='</TD>
	<TD class="text" align="center" width="60">';  if($strName=='Gold'){$data.= number_format($ventegold,4);}if($strName=='Silver'){$data.= number_format($ventesilv,4);}if($strName=='Platinum/USD'){$data.= number_format($venteplat,4);}if($strName=='Palladium/USD'){$data.= number_format($ventepall,4);} $data.='</TD>
	<TD class="text hidemobile" align="center" width="70">'.$strChange.'</TD>
	<TD class="text hidemobile" align="center" width="70">'.$strPercChange.'</TD>
	<TD class="text hidemobile" align="center" width="70">'.$strOpen.'</TD>
	<TD class="text hidemobile" align="center" width="70">'.$strHigh.'</TD>
	<TD class="text hidemobile" align="center" width="70">'.$strLow.'</TD>
	<TD class="text hidemobile" align="center" width="70">'.$strClose.'</TD>
	<TD class="text hidemobile time" align="center" width="80">'.$strDateTime.'</TD>
</TR>';
	}
	$xml = null;


$data.='
</TABLE>';
 
 
 	return $data;	
		
		
		
		
		
		
	}
	 
	 
	 
	 
	 
}
