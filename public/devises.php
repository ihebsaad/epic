<?php
 // include("../../configuration.inc.php");
error_reporting(0);

	$provider = "netdania_fxa";
	$username = "saamp";
	$password = "1s3wAA8m9Pw";
	$devise = $_GET["q"];filter_input(INPUT_GET, 'q', FILTER_SANITIZE_MAGIC_QUOTES);
	//$poids = $_GET["p"];filter_input(INPUT_GET, 'p', FILTER_SANITIZE_MAGIC_QUOTES);
  $poids = "gram";
	$poidsconversion = "1";
	//devises
  $eur = "1";
	$czk = "24.585";
	$dkk = "7.4348";
	$pln = "4.1243";
	$huf = "294.37";
	$rub = "38.48";
	$byr = "11482.00";
	$lvl = "0.6966";
	$uah = "102786";

	
	switch ($poids) {
		  case "gram" :   $poidsconversion = "0.0321507431265056" ; break;
		  case "kilogram" :       $poidsconversion = "32.15074312650557"; break;
		  case "once" :     $poidsconversion = "1"; break;
		  }
	
	$dev = "";
	$change = "1";
	if ($devise!='Euro') 
    $dev="$";
  else
    $dev="eur";
	
	//echo "devise=".$devise;
	
	//$dateTimeFormat = "dd HH:mm:ss"; //The format for returned timestamps
	$dateTimeFormat = "HH:mm:ss"; //The format for returned timestamps
  //$dateTimeFormat = "d/m/Y"; //The format for returned timestamps
	$timezone = "Europe/paris"; //The timezone to which timestamps should be converted

	//Returns a full text-representation of the XML document
	//with the given URL.
	function getXMLSource($url)
	{
		$str = file_get_contents($url);
		return $str;
	}
	
	//Array of symbols	
	//$arrSymbols = array("EURUSD", "XAUUSD","XAGUSD");
	$arrSymbols = array("EURUSD", "XAUUSDOCOMP.fx","XAGUSDOCOMP.fx");
	$arrSymbols1 = array("XAUUSDOCOMP.fx","XAGUSDOCOMP.fx");
	//$arrSymbols2 = array("XPTUSDOCOMP.fx", "XPDUSDOCOMP.fx");
	//$arrSymbols2 = array("XPTUSDOZ", "XPDUSDOZ");
	$arrSymbols2 = array("XPTUSDOCOMP.fx","XPDUSDOCOMP.fx");
	//$arrSymbols3 = array("EURUSD"); //,"GBPUSD", "USDJPY", "USDCHF", "USDCAD", "EURJPY", "AUD/USD", "EUR/GBP", "EUR/CHF", "EUR/AUD", "EUR/CAD", "AUD/JPY", "CAD/JPY", "AUD/JPY", "GBP/AUD");
	
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
	
function decimal($val, $precision = 0) { 
    if ((float) $val) : 
        $val = round((float) $val, (int) $precision); 
        list($a, $b) = explode('.', $val); 
        if (strlen($b) < $precision) $b = str_pad($b, $precision, '0', STR_PAD_RIGHT); 
        return $precision ? $a.".".$b : $a; 
    else : // do whatever you want with values that do not have a float 
        return $val; 
    endif; 
} 
?>
<table id="thetable" cellpadding="1" cellspacing="0" border="0" class="form" style="position:relative;top:-30px;background-color:white">
<tr>
  <th class="libelles" align="center" colspan="2">
  </th>
	<th class="libelles" align="center"  nowrap>Paris Time</th>
	<th class="libelles" align="center" nowrap ><table border="0" cellpadding="0" cellspacing="0"><tr><td><!-- <img src="images/drapeuro.gif"          border=0/>--></td> <td><table border="0" cellpadding="10px" cellspacing="0"><tr><td width="200px"><b style="font-size:18px">Quantite: </br><1000g</b></font></td></tr><tr><td colspan="2" align="center">Prix net Eur/g (*)</td></tr></table></td></tr></table></th>
  <th class="libelles" align="center" nowrap ><table border="0" cellpadding="0" cellspacing="0"><tr><td><!-- <img src="images/drapeuro.gif"          border=0/>--></td> <td><table border="0" cellpadding="10px" cellspacing="0"><tr><td width="200px"><b style="font-size:18px">Quantite: </br>>2000 g</b></font></td></tr><tr><td colspan="2" align="center">Prix net Eur/g (*)</td></tr></table></td></tr></table></th>
  <th class="libelles" align="center" nowrap ><table border="0" cellpadding="0" cellspacing="0"><tr><td><!-- <img src="images/drapeuro.gif"          border=0/>--></td> <td><table border="0" cellpadding="10px" cellspacing="0"><tr><td width="200px"><b style="font-size:18px">Quantite: </br>>5000g</b></font></td></tr><tr><td colspan="2" align="center">Prix net Eur/g (*)</td></tr></table></td></tr></table></th>
</tr>
<tbody>


<?php

//	$i = 0;
//	$arrNames = array("EUR/USD","GBP/USD", "USD/JPY", "USD/CHF", "USD/CAD", "EUR/JPY", "AUD/USD", "EUR/GBP", "EUR/CHF", "EUR/AUD", "EUR/CAD", "AUD/JPY", "CAD/JPY", "AUD/JPY", "GBP/AUD");
	//Loop through and display data for each instrument
	foreach ($objXMLDom->quote as $quote) {
//		$strName = $arrNames[$i];
//		$i++;

		$strName = $quote["f25"];
		
		if ($strName == "EUR/USD" and $devise=="Euro")
		{$change = decimal(floatval($quote["f10"]), 4);}
		else if ($strName == "EUR/USD")
		{$eurBid = decimal(floatval($quote["f10"]), 4);$eurAsk = decimal(floatval($quote["f11"]), 4);}
		
		}
	$xml = null;
	
	$provider = "ms_dla";
	//$provider = "comstock_lite";
	//Create a string representation of the symbols, seperated by "|"
	$strSymbols = "";
	$start = 0;
	
	foreach($arrSymbols1 as $symbol)
	{
		$strSymbols = $strSymbols.$symbol."|";
	}
	
	$source = getXMLSource("http://balancer.netdania.com/StreamingServer/StreamingServer?xml=price&group=".$username."&pass=".$password."&source=".$provider."&symbols=".$strSymbols."&fields=10|11|14|15|25|4|2|3|1&time=".$dateTimeFormat."&tzone=".$timezone);
	//Load XML data source
	$objXMLDom = new SimpleXMLElement($source);
	
		//Loop through and display data for each instrument
	foreach ($objXMLDom->quote as $quote) {
		
		$strName = $quote["f25"];
		
		switch ($strName) {
		  case "Gold" :  $strName = "Gold</td><td class='separation0' align=right><!-- <font size=2>Zloto</font> --></td>"; $_SESSION['XAU/USD_bid'] = $quote["f10"]; $_SESSION['XAU/USD_ask'] = $quote["f11"]; break;
		  case "Silver" :  $strName = "Silver</td><td class='separation0' align=right><!--<font size=2>Srebro</font> --></td>";$_SESSION['XAG/USD_bid'] = $quote["f10"]; $_SESSION['XAG/USD_ask'] = $quote["f11"]; exit;
		  }

    

		$strBid = decimal(floatval($quote["f10"])/$change*$poidsconversion,4);
		$strAsk = decimal(floatval($quote["f11"])/$change*$poidsconversion,4);
		$strChange = $quote["f14"];
		$strPercChange = $quote["f15"];
		$strOpen = $quote["f4"];
		$strHigh = $quote["f2"];
		$strLow = $quote["f3"];
		$strClose = $quote["f1"];
		$strDateTime = $quote;
		
?>



<tr <?if ($strName == "EUR/USD") echo 'style="display:none"';?>>
	<TD class="separation0" align="left" style="border-left:#000 2px dashed" >Cotation Or 24K - SPOT SAAMP<?php //print($strName);?></TD>
  <td class="separation0" width="15px"  ></td>  	
	<? if ($poids == "gram" and ($quote["f25"] == "Gold")) {  ?>
  <TD class="separationTime" align="left" nowrap><?php print($strDateTime);?></TD>    
	<TD colspan=3 class="separation" align="center"><div><? if ($quote["f25"] == "Gold"){ ?><b><?php print(number_format  ( $strBid/$eurAsk *1000,0,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
 	
	<? } ?>
 
</tr>

<!-- ajout cotation particulier -->
<tr>
<TD class="separation0" align="left">OR 18KT MASSIF </TD>
<td class="separation0" width="15px"></td>  
<TD class="separationTime" align="left" nowrap><?php print($strDateTime);?></TD>    
<TD class="separation" align="right"><span style="float:left; padding-top: 10px; font-size:small;">72%</span><?php print(number_format  ( ($strBid/$eurAsk)*0.72 ,2,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></TD>
<TD class="separation" align="right"><span style="float:left; padding-top: 10px; font-size:small;">72,5%</span><?php print(number_format  ( ($strBid/$eurAsk)*0.725 ,2,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></TD>
<TD class="separation" align="right"><span style="float:left; padding-top: 10px; font-size:small;">73,5%</span><?php print(number_format  ( ($strBid/$eurAsk)*0.735 ,2,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></TD>

</tr>

<tr>
<TD class="separation0" align="left">OR 18KT MELE</TD>
<td class="separation0" width="15px"></td>  
<TD class="separationTime" align="left" nowrap><?php print($strDateTime);?></TD>    
<TD class="separation" align="right"><span style="float:left; padding-top: 10px; font-size:small;">70,5%</span><?php print(number_format  ( ($strBid/$eurAsk)*0.705 ,2,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></TD>
<TD class="separation" align="right"><span style="float:left; padding-top: 10px; font-size:small;">71%</span><?php print(number_format  ( ($strBid/$eurAsk)*0.71 ,2,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></TD>
<TD class="separation" align="right"><span style="float:left; padding-top: 10px; font-size:small;">71,5%</span><?php print(number_format  ( ($strBid/$eurAsk)*0.715 ,2,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></TD>
</tr>

<tr>
<TD class="separation0" align="left">PIECE OR 900</TD>
<td class="separation0" width="15px"></td>  
<TD class="separationTime" align="left" nowrap><?php print($strDateTime);?></TD>    
<TD class="separation" align="right"><span style="float:left; padding-top: 10px; font-size:small;">88%</span><?php print(number_format  ( ($strBid/$eurAsk)*0.88 ,2,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></TD>
<TD class="separation" align="right"><span style="float:left; padding-top: 10px; font-size:small;">88,5%</span><?php print(number_format  ( ($strBid/$eurAsk)*0.885 ,2,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></TD>
<TD class="separation" align="right"><span style="float:left; padding-top: 10px; font-size:small;">89%</span><?php print(number_format  ( ($strBid/$eurAsk)*0.89 ,2,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></TD>
</tr>

<tr>
<TD class="separation0" align="left">PIECE OR 916</TD>
<td class="separation0" width="15px"></td>  
<TD class="separationTime" align="left" nowrap><?php print($strDateTime);?></TD>    
<TD class="separation" align="right"><span style="float:left; padding-top: 10px; font-size:small;">89,5%</span><?php print(number_format  ( ($strBid/$eurAsk)*0.895 ,2,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></TD>
<TD class="separation" align="right"><span style="float:left; padding-top: 10px; font-size:small;">90%</span><?php print(number_format  ( ($strBid/$eurAsk)*0.90 ,2,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></TD>
<TD class="separation" align="right"><span style="float:left; padding-top: 10px; font-size:small;">90,5%</span><?php print(number_format  ( ($strBid/$eurAsk)*0.905 ,2,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></TD>
</tr>


<tr>
<TD class="separation0" align="left">OR DENTAIRE RICHE</TD>
<td class="separation0" width="15px"></td>  
<TD class="separationTime" align="left" nowrap><?php print($strDateTime);?></TD>    
<TD class="separation" align="right"><span style="float:left; padding-top: 10px; font-size:small;">76,5%</span><?php print(number_format  ( ($strBid/$eurAsk)*0.765 ,2,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></TD>
<TD class="separation" align="right"><span style="float:left; padding-top: 10px; font-size:small;">77%</span><?php print(number_format  ( ($strBid/$eurAsk)*0.77 ,2,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></TD>
<TD class="separation" align="right"><span style="float:left; padding-top: 10px; font-size:small;">77,5%</span><?php print(number_format  ( ($strBid/$eurAsk)*0.775 ,2,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></TD>
</tr>

<tr>
<TD class="separation0" align="left">OR 14KT</TD>
<td class="separation0" width="15px"></td>  
<TD class="separationTime" align="left" nowrap><?php print($strDateTime);?></TD>    
<TD class="separation" align="right"><span style="float:left; padding-top: 10px; font-size:small;">51%</span><?php print(number_format  ( ($strBid/$eurAsk)*0.51 ,2,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></TD>
<TD class="separation" align="right"><span style="float:left; padding-top: 10px; font-size:small;">51,5%</span><?php print(number_format  ( ($strBid/$eurAsk)*0.515 ,2,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></TD>
<TD class="separation" align="right"><span style="float:left; padding-top: 10px; font-size:small;">52%</span><?php print(number_format  ( ($strBid/$eurAsk)*0.52 ,2,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></TD>
</tr>

<tr>
<TD class="separation0" align="left">OR 9KT</TD>
<td class="separation0" width="15px"></td>  
<TD class="separationTime" align="left" nowrap><?php print($strDateTime);?></TD>    
<TD class="separation" align="right"><span style="float:left; padding-top: 10px; font-size:small;">31%</span><?php print(number_format  ( ($strBid/$eurAsk)*0.31 ,2,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></TD>
<TD class="separation" align="right"><span style="float:left; padding-top: 10px; font-size:small;">31,5%</span><?php print(number_format  ( ($strBid/$eurAsk)*0.315 ,2,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></TD>
<TD class="separation" align="right"><span style="float:left; padding-top: 10px; font-size:small;">32%</span><?php print(number_format  ( ($strBid/$eurAsk)*0.32 ,2,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></TD>
</tr>

<tr>
<TD class="separation0" align="left">OR FIN NON CERTIFIE</TD>
<td class="separation0" width="15px"></td>  
<TD class="separationTime" align="left" nowrap><?php print($strDateTime);?></TD>    
<TD class="separation" align="right"><span style="float:left; padding-top: 10px; font-size:small;">98%</span><?php print(number_format  ( ($strBid/$eurAsk)*0.98 ,2,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></TD>
<TD class="separation" align="right"><span style="float:left; padding-top: 10px; font-size:small;">98,5%</span><?php print(number_format  ( ($strBid/$eurAsk)*0.985 ,2,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></TD>
<TD class="separation" align="right"><span style="float:left; padding-top: 10px; font-size:small;">99%</span><?php print(number_format  ( ($strBid/$eurAsk)*0.99 ,2,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></TD>
</tr>

<!-- fin ajout cotation particulier -->

<?php
	}

	$xml = null;	
?>

<?php
	
	
	/**
 * Ajout d'un utilisateur
 *
 * @param array $frm Array with all fields data Array with all fields data
 * @return integer New user id
 */
function insere_cours()
{

$date_insert = date('Y-m-d H:i:s', time());

	$qid = query("INSERT INTO db_saamp_aem_cours (
		datetime
		, metal
		, ASK
    , BID		
	) VALUES (
		'" . nohtml_real_escape_string($date_insert) . "'
    , '" . nohtml_real_escape_string('XAU/USD') . "'
		, '" . nohtml_real_escape_string($_SESSION['XAU/USD_ask']) . "'
		, '" . nohtml_real_escape_string($_SESSION['XAU/USD_bid']) . "'
		)");
	
	$qid = query("INSERT INTO db_saamp_aem_cours (
		datetime
		, metal
		, ASK
    , BID		
	) VALUES (
		'" . nohtml_real_escape_string($date_insert) . "'
    , '" . nohtml_real_escape_string('XAG/USD') . "'
		, '" . nohtml_real_escape_string($_SESSION['XAG/USD_ask']) . "'
		, '" . nohtml_real_escape_string($_SESSION['XAG/USD_bid']) . "'
		)");
		
	$qid = query("INSERT INTO db_saamp_aem_cours (
		datetime
		, metal
		, ASK
    , BID		
	) VALUES (
		'" . nohtml_real_escape_string($date_insert) . "'
    , '" . nohtml_real_escape_string('XPT/USD') . "'
		, '" . nohtml_real_escape_string($_SESSION['XPT/USD_ask']) . "'
		, '" . nohtml_real_escape_string($_SESSION['XPT/USD_bid']) . "'
		)");

	return $qid;
}

//insere_cours();
?>
</tbody>
</td></tr>
</table>
<div style="display:none;">
<form class="entryform" method="post" action=""  enctype="multipart/form-data">
  <!-- XAU/USD_bid --><input type="hidden" name="Gold_bid" id="Gold_bid" value="<? print $_SESSION['XAU/USD_bid'] ?>" />
  <!-- XAU/USD_ask --> <input type="hidden" name="Gold_ask" id="Gold_ask" value="<? print $_SESSION['XAU/USD_ask'] ?>" /><br>
  <!-- XAG/USD_bid  --><input type="hidden" name="Silver_bid" id="Silver_bid" value="<? print $_SESSION['XAG/USD_bid'] ?>" />
  <!-- XAG/USD_ask  --><input type="hidden" name="Silver_ask" id="Silver_ask" value="<? print $_SESSION['XAG/USD_ask'] ?>" /><br>
  <!-- XPT/USD_bid  --><input type="hidden" name="XPT_USD_bid" id="XPT_USD_bid" value="<? print $_SESSION['XPT/USD_bid'] ?>" />
  <!-- XPT/USD_ask  --><input type="hidden" name="XPT_USD_ask" id="XPT_USD_ask" value="<? print $_SESSION['XPT/USD_ask'] ?>" /><br>  
  <!-- XPTG/USD_bid --><input type="hidden" name="XPTG_USD_bid" id="XPTG_USD_bid" value="<? print $_SESSION['XPTG/USD_bid'] ?>" />
  <!-- XPTG/USD_ask --><input type="hidden" name="XPTG_USD_ask" id="XPTG_USD_ask" value="<? print $_SESSION['XPTG/USD_ask'] ?>" /><br>
</form>
</div>

 


