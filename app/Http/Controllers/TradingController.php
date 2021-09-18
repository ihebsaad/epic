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
	$provider = config('trading.provider');
	$username = config('trading.username');
	$password = config('trading.password');
	
	$dateTimeFormat = "HH:mm:ss"; //The format for returned timestamps
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
		
		if($strName==config('trading.gold_string')){
			$goldbid=floatval($strBid); 
		    $goldask=floatval($strAsk);
			}
		if($strName==config('trading.silver_string')){
			$silvbid=floatval($strBid); 
		    $silvask=floatval($strAsk);
			}
		if($strName==config('trading.platine_string')){
			$platbid=floatval($strBid); 
		    $platask=floatval($strAsk);
			}
		if($strName==config('trading.pallad_string')){
			$pallbid=floatval($strBid); 
		    $pallask=floatval($strAsk);
			}			
			

			
		if($euroask > 0 && $goldbid > 0)
		{
		 $ventegold= (( floatval($goldbid) / floatval($euroask) ) / config('trading.div_number') )* config('trading.coeff_vente');  
		 $achatgold= (( floatval($goldask) / floatval($eurobid) ) / config('trading.div_number') )* config('trading.coeff_achat');
		 }
		if($euroask > 0 && $silvbid > 0)
		{
		 $ventesilv= (( floatval($silvbid) / floatval($euroask) ) / config('trading.div_number') )*  config('trading.coeff_vente') ; 
		 $achatsilv= (( floatval($silvask) / floatval($eurobid) ) / config('trading.div_number') )*  config('trading.coeff_achat');
		 }
		if($euroask > 0 && $platbid > 0)
		{
		 $venteplat= (( floatval($platbid) / floatval($euroask) ) / config('trading.div_number') )*  config('trading.coeff_vente') ; 
		 $achatplat= (( floatval($platask) / floatval($eurobid) ) / config('trading.div_number') )*  config('trading.coeff_achat');
		 }

		if($euroask > 0 && $pallbid > 0)
		{
		 $ventepall= (( floatval($pallbid) / floatval($euroask) ) / config('trading.div_number') )*  config('trading.coeff_vente') ; 
		 $achatpall= (( floatval($pallask) / floatval($eurobid) ) / config('trading.div_number') )*  config('trading.coeff_achat');
		 }		 
 
	}
	$xml = null;

 $data2='';
 $achatgold=$achatgold*1000;
 $achatsilv=$achatsilv*1000;
 $achatplat=$achatplat*1000;
 $achatpall=$achatpall*1000;
 $ventegold=$ventegold*1000;
 $ventesilv=$ventesilv*1000;
 $venteplat=$venteplat*1000;
 $ventepall=$ventepall*1000;
 
$data2.='
<tr ><td class="tleft" >'.__("msg.Time").'</td><td>'.$strDateTime.'</td><td>'.$strDateTime.'</td><td>'.$strDateTime.'</td><td>'.$strDateTime.'</td> </tr>
 <tr><td class="tleft" >'.__("msg.Purchase").'</td><td>'.number_format($achatgold,0,'',' ').'</td><td>'.number_format($achatsilv,0,'',' ').'</td><td>'.number_format($achatplat,0,'',' ').'</td><td>'.number_format($achatpall,0,'',' ').'</td></tr> 
 <tr><td class="tleft" >'.__("msg.Sale").'</td><td>'.number_format($ventegold,0,'',' ').'</td><td>'.number_format($ventesilv,0,'',' ').'</td><td>'.number_format($venteplat,0,'',' ').'</td><td>'.number_format($ventepall,0,'',' ').'</td></tr>';
 	return $data2;	
		
		
	}
	 
	 
	 
	 
	 
}
