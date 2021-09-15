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
		
		
 
	//$provider = env('TRADING_provider');
	$provider = 'netdania_fxa';
	//$username = env('TRADING_username');
	$username = 'saamp';
	//$password = env('TRADING_password');
	$password = '1s3wAA8m9Pw';

	
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
		const $divnumber= 31.10348;
		const $coff_vente= 0.9975;
		const $coff_achat= 1.0025;
		const $gold_string='Gold';
		const $silver_string='Silver';
		const $plat_string='Platinum/USD';
		const $pall_string='Palladium/USD';
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
		
		if($strName==$gold_string){
			$goldbid=floatval($strBid); 
		    $goldask=floatval($strAsk);
			}
		if($strName==$silver_string){
			$silvbid=floatval($strBid); 
		    $silvask=floatval($strAsk);
			}
		if($strName==$plat_string){
			$platbid=floatval($strBid); 
		    $platask=floatval($strAsk);
			}
		if($strName==$pall_string){
			$pallbid=floatval($strBid); 
		    $pallask=floatval($strAsk);
			}			
			

			
		if($euroask > 0 && $goldbid > 0)
		{
		 $ventegold= (( floatval($goldbid) / floatval($euroask) ) / $divnumber )* $coff_vente ; 
		 $achatgold= (( floatval($goldask) / floatval($eurobid) ) / $divnumber )* $coff_achat ;
		 }
		if($euroask > 0 && $silvbid > 0)
		{
		 $ventesilv= (( floatval($silvbid) / floatval($euroask) ) / $divnumber )* $coff_vente ; 
		 $achatsilv= (( floatval($silvask) / floatval($eurobid) ) / $divnumber )* $coff_achat ;
		 }
		if($euroask > 0 && $platbid > 0)
		{
		 $venteplat= (( floatval($platbid) / floatval($euroask) ) / $divnumber )* $coff_vente ; 
		 $achatplat= (( floatval($platask) / floatval($eurobid) ) / $divnumber )* $coff_achat ;
		 }

		if($euroask > 0 && $pallbid > 0)
		{
		 $ventepall= (( floatval($pallbid) / floatval($euroask) ) / $divnumber )* $coff_vente ; 
		 $achatpall= (( floatval($pallask) / floatval($eurobid) ) / $divnumber )* $coff_achat ;
		 }		 
		 
$data.='
<TR>
	<TD class="text strname" align="left" nowrap width="105">'.$strName.'</TD>
	<TD class="text hidemobile" align="center" width="60">'.$strBid.'</TD>
	<TD class="text hidemobile" align="center" width="60">'.$strAsk.'</TD>
	<TD class="text" align="center" width="60">'; if($strName=='Gold'){$data.= number_format($achatgold,4);}if($strName==$silver_string){$data.= number_format($achatsilv,4);}if($strName==$plat_string){$data.= number_format($achatplat,4);}if($strName==$pall_string){$data.= number_format($achatpall,4);} $data.='</TD>
	<TD class="text" align="center" width="60">';  if($strName=='Gold'){$data.= number_format($ventegold,4);}if($strName==$silver_string){$data.= number_format($ventesilv,4);}if($strName==$plat_string){$data.= number_format($venteplat,4);}if($strName==$pall_string){$data.= number_format($ventepall,4);} $data.='</TD>
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
 
 
 $achatgold=$achatgold*1000;
 $achatsilv=$achatsilv*1000;
 $achatplat=$achatplat*1000;
 $achatpall=$achatpall*1000;
 $ventegold=$ventegold*1000;
 $ventesilv=$ventesilv*1000;
 $venteplat=$venteplat*1000;
 $ventepall=$ventepall*1000;
$data2=''; 
$data2.='
<h3 style="text-align:center">Cours des métaux</h3> 
 <table   id="tabmetal" border="0">
 <tr class="headmetal">
 <td class="tleft" > €/kg </td><td  ><center><div id="gold" class="pb-10">'. __("msg.Gold").'</div></center></td><td><center><div id="silver" class="pb-10">'. __("msg.Silver").' </div></center></td><td><center><div id="platine" class="pb-10">'. __("msg.Platinum").'</center></div></td><td><center><div id="pallad" class="pb-10">'.__("msg.Palladium").'</center></div></td>
 </tr>
 <tr  >
 <td class="tleft" >'.__("msg.Time").'</td><td>'.$strDateTime.'</td><td>'.$strDateTime.'</td><td>'.$strDateTime.'</td><td>'.$strDateTime.'</td>
 </tr>
  <tr  >
 <td class="tleft" >'.__("msg.Purchase").'</td><td>'.number_format($achatgold,0,'',' ').'</td><td>'.number_format($achatsilv,0,'',' ').'</td><td>'.number_format($achatplat,0,'',' ').'</td><td>'.number_format($achatpall,0,'',' ').'</td>
 </tr>
   <tr >
 <td class="tleft" >'.__("msg.Sale").'</td><td>'.number_format($ventegold,0,'',' ').'</td><td>'.number_format($ventesilv,0,'',' ').'</td><td>'.number_format($venteplat,0,'',' ').'</td><td>'.number_format($ventepall,0,'',' ').'</td>
 </tr>
 </table> ';
 	return $data2;	
		
		
		
		
		
		
	}
	 
	 
	 
	 
	 
}
