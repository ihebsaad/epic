
@extends('layouts.back')
 
 @section('content')
<div class="row">
<?php




    $translate['fr']['gold'] = 'Or';
  $translate['fr']['silver'] = 'Argent';
  $translate['fr']['platine'] = 'Platine';
  $translate['fr']['palladium'] = 'Palladium';
  $translate['fr']['time'] = 'Heure';
  $translate['fr']['bid'] = 'Achat';
  $translate['fr']['ask'] = 'Vente';
  $translate['fr']['kilogram'] = 'Kilogramme';
  $translate['fr']['gram'] = 'Gramme';
  $translate['fr']['once'] = 'Once';
  
  
  $translate['en']['gold'] = 'Gold';
  $translate['en']['silver'] = 'Silver';
  $translate['en']['platine'] = 'Platine';
  $translate['en']['palladium'] = 'Palladium';
  $translate['en']['time'] = 'Time';
  $translate['en']['bid'] = 'Bid';
  $translate['en']['ask'] = 'Ask';
  $translate['en']['kilogram'] = 'Kilogram';
  $translate['en']['gram'] = 'Gram';
  $translate['en']['once'] = 'Once';
 
  $translate['pl']['gold'] = 'Złoto';
  $translate['pl']['silver'] = 'Srebro';
  $translate['pl']['platine'] = 'Platyna';
  $translate['pl']['palladium'] = 'Paladium';
  $translate['pl']['time'] = 'Czas';
  $translate['pl']['bid'] = 'Oferta';
  $translate['pl']['ask'] = 'Zapytanie';
  $translate['pl']['kilogram'] = 'Kilogram';
  $translate['pl']['gram'] = 'Gram';
  $translate['pl']['once'] = 'Once'; 

	$provider = "netdania_fxa";
	$username = "saamp";
	$password = "1s3wAA8m9Pw";
        $devise = isset($_GET["q"]) ? $_GET["q"] : "Euro";
	$poids = isset($_GET["p"]) ? $_GET["p"] : "gram";
	//$devise = $_GET["q"];
	//$poids = $_GET["p"];
	$poidsconversion = "1";
	//devises
	

	//This is a PHP(4/5) script example on how eurofxref-daily.xml can be parsed
    //Read eurofxref-daily.xml file in memory 
    //For this command you will need the config option allow_url_fopen=On (default)

    $XMLContent=file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");
    //the file is updated daily between 2.15 p.m. and 3.00 p.m. CET
            
    foreach($XMLContent as $line){
       // if(preg_match("/currency='([[:alpha:]]+)'/",$line,$currencyCode)){
       //     if(preg_match("/rate='([[:graph:]]+)'/",$line,$rate)){
                //Output the value of 1EUR for a currency code
       //         echo'1&euro;='.$rate[1].' '.$currencyCode[1].'<br/>';
                //--------------------------------------------------
                //Here you can add your code for inserting
                //$rate[1] and $currencyCode[1] into your database
                //--------------------------------------------------
       //     }
      //  }
		
		 if(preg_match("/currency='(USD+)'/",$line,$currencyCode)){
         if(preg_match("/rate='([[:alnum:]]+)'/",$line,$rate)){
                    //      if(preg_match('/([0-9]+\.[0-9]+)/',$line,$rate)){
                //Output the value of 1EUR for a USD
				$EUUSD=$rate[0];
              //  echo'1&euro;='.$EUUSD.' '.$currencyCode[1].'<br/>';
                //--------------------------------------------------
                //Here you can add your code for inserting
                //$rate[1] and $currencyCode[1] into your database
                //--------------------------------------------------
            }
        }
		if(preg_match("/currency='(PLN+)'/",$line,$currencyCode)){
            //if(preg_match("/rate='([[:alnum:]]+)'/",$line,$rate)){
if(preg_match('/([0-9]+\.[0-9]+)/',$line,$rate)){
                //Output the value of 1EUR for a PLN
				$EUPLN=$rate[0];
              //  echo'1&euro;='.$EUPLN.' '.$currencyCode[1].'<br/>';
                //--------------------------------------------------
                //Here you can add your code for inserting
                //$rate[1] and $currencyCode[1] into your database
                //--------------------------------------------------
            }
        }
		if(preg_match("/currency='(RUB+)'/",$line,$currencyCode)){
            if(preg_match("/rate='([[:graph:]]+)'/",$line,$rate)){
                //Output the value of 1EUR for a RUB
				$EURUB=$rate[1];
              //  echo'1&euro;='.$EURUB.' '.$currencyCode[1].'<br/>';
                //--------------------------------------------------
                //Here you can add your code for inserting
                //$rate[1] and $currencyCode[1] into your database
                //--------------------------------------------------
            }
        }
//		if(preg_match("/currency='(LVL+)'/",$line,$currencyCode)){
//            if(preg_match("/rate='([[:graph:]]+)'/",$line,$rate)){
                //Output the value of 1EUR for a LVL
//				$EULVL=$rate[1];
              //  echo'1&euro;='.$EULVL.' '.$currencyCode[1].'<br/>';
                //--------------------------------------------------
                //Here you can add your code for inserting
                //$rate[1] and $currencyCode[1] into your database
                //--------------------------------------------------
 //           }
  //      }
		if(preg_match("/currency='(DKK+)'/",$line,$currencyCode)){
            if(preg_match("/rate='([[:graph:]]+)'/",$line,$rate)){
                //Output the value of 1EUR for a DKK
				$EUDKK=$rate[1];
              //  echo'1&euro;='.$EUDKK.' '.$currencyCode[1].'<br/>';
                //--------------------------------------------------
                //Here you can add your code for inserting
                //$rate[1] and $currencyCode[1] into your database
                //--------------------------------------------------
            }
        }
		if(preg_match("/currency='(CZK+)'/",$line,$currencyCode)){
            if(preg_match("/rate='([[:graph:]]+)'/",$line,$rate)){
                //Output the value of 1EUR for a CZK
				$EUCZK=$rate[1];
              //  echo'1&euro;='.$EUCZK.' '.$currencyCode[1].'<br/>';
                //--------------------------------------------------
                //Here you can add your code for inserting
                //$rate[1] and $currencyCode[1] into your database
                //--------------------------------------------------
            }
        }
		if(preg_match("/currency='(HUF+)'/",$line,$currencyCode)){
            if(preg_match("/rate='([[:graph:]]+)'/",$line,$rate)){
                //Output the value of 1EUR for a HUF
				$EUHUF=$rate[1];
               // echo'1&euro;='.$EUHUF.' '.$currencyCode[1].'<br/>';
                //--------------------------------------------------
                //Here you can add your code for inserting
                //$rate[1] and $currencyCode[1] into your database
                //--------------------------------------------------
            }
        }
}

//This is a PHP(4/5) script example on how eurofxref-daily.xml can be parsed    //Read eurofxref-daily.xml file in memory     //For this command you will need the config option allow_url_fopen=On (default)    $XMLContent=file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");    //the file is updated daily between 2.15 p.m. and 3.00 p.m. CET                foreach($XMLContent as $line){        if(preg_match("/currency='([[:alpha:]]+)'/",$line,$currencyCode)){			 echo'1&euro;='.$rate[1].' '.$currencyCode[1].'<br/>';            if(preg_match("/rate='([[:graph:]]+)'/",$line,$rate)){                //Output the value of 1EUR for a currency code                echo'1&euro;='.$rate[1].' '.$currencyCode[1].'<br/>';                //--------------------------------------------------                //Here you can add your code for inserting                //$rate[1] and $currencyCode[1] into your database                //--------------------------------------------------            }        }}
    //This is aPHP(5)script example on how eurofxref-daily.xml can be parsed
    //Read eurofxref-daily.xml file in memory
    //For the next command you will need the config option allow_url_fopen=On (default)
    //$XML=simplexml_load_file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");
    //the file is updated daily between 2.15 p.m. and 3.00 p.m. CET
            
    //foreach($XML->Cube->Cube->Cube as $rate){
        //Output the value of 1EUR for a currency code
     //   echo '1&euro;='.$rate["rate"].' '.$rate["currency"].'<br/>';
        //--------------------------------------------------
        //Here you can add your code for inserting
        //$rate["rate"] and $rate["currency"] into your database
        //--------------------------------------------------
    //}
  $eur = "1";
	//$czk = "24.585";
	$czk=$EUCZK;
	//$dkk = "7.4348";
	$dkk=$EUDKK;
	//$pln = "4.1243";
	$pln=$EUPLN;
	//$huf = "294.37";
	$huf=$EUHUF;
	//$rub = "38.48";
	$rub =$EURUB;
	$byr = "11482.00";
	//$lvl = "0.6966";
	//$lvl =$EULVL;
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
	//$timezone = "Europe/paris"; //The timezone to which timestamps should be converted
        $timezone = "CET"; //The timezone to which timestamps should be converted
	//Returns a full text-representation of the XML document
	//with the given URL.
	function getXMLSource($url)
	{
		$str = file_get_contents($url);
		return $str;
	}
	
	//Array of symbols	
	//$arrSymbols = array("EURUSD", "XAUUSD","XAGUSD");
//NEW
     // $arrSymbols = array("EURUSD", "USDDKK", "USDPLN","USDHUF","USDRUB", "XAUUSD","XAGUSD","XAUEUR","XAGEUR");
      // $arrSymbols = array("XAUUSD","XAGUSD");
     
//NEW
//OLD
	$arrSymbols = array("EURUSD", "XAUUSDOCOMP.fx","XAGUSDOCOMP.fx");
       //$arrSymbols = array("EURUSD", "XAUUS","XAGUS");
	$arrSymbols1 = array("XAUUSDOCOMP.fx","XAGUSDOCOMP.fx");
       // $arrSymbols1 = array("EURUSD","XAUUS","XAGUS");
//$arrSymbols1 = array("XAUUSD","XAGUSD");



//OLD
	$arrSymbols2 = array("XPTUSDOCOMP.fx", "XPDUSDOCOMP.fx");
	//$arrSymbols2 = array("XPTUSDOZ", "XPDUSDOZ");
//OLD
	//$arrSymbols2 = array("XPTUSDOCOMP.fx","XPDUSDOCOMP.fx");
//OLD
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


<table border="0" width="100%" class="maintable">



<tr><td colspan=2>

<TABLE  cellpadding="1" cellspacing="0" border="0" class="form">
<tr><th class="bijouxpieces" colspan="30"><table class="form" border="0" cellpadding="0" cellspacing="0"><tr><td class="bijouxpieces" width="1200px">Cours des métaux précieux</td></tr></table></th></tr>

<tr>
  <th class="libelles" align="center"  rowspan="2" colspan="3" style="border-left: 1px solid #c3a663;">
  <SELECT id="poids" NAME="poids"
       onChange="changeVar('<?echo $devise?>', this.options[selectedIndex].text);">
          <OPTION <?if ($poids=='gram') echo 'selected="selected"';?> ><?php echo $translate[$_GET['ln']]['gram'] ?></OPTION>
          <OPTION <?if ($poids=='kilogram') echo 'selected="selected"';?> ><?php echo $translate[$_GET['ln']]['kilogram'] ?></OPTION>
          <OPTION <?if ($poids=='once') echo 'selected="selected"';?> >once</OPTION>                    
  </SELECT>
  </th>
	<th class="libelles" align="center"  rowspan="2"><?php echo $translate[$_GET['ln']]['time'] ?></th>
  <th class="libelles" align="center" nowrap colspan="2"  width="80">PLN</th>	
	<th class="libelles" align="center" nowrap colspan=2  width="80">EUR</th>
	<th class="libelles" align="center" nowrap colspan=2  width="80">USD</th>
<!--  <th class="libelles" align="center" nowrap colspan=2  width="80">RUB</th> -->
<!--    <th class="libelles" align="center" nowrap colspan=2  width="80">LVL</th>
<!--  <th class="libelles" align="center" nowrap colspan=2  width="80">BYR</th> -->
  <th class="libelles" align="center" nowrap colspan=2  width="80">DKK</th>  
	<th class="libelles" align="center" nowrap colspan=2  width="80">CZK</th>	
	<th class="libelles" align="center" nowrap colspan=2  width="80">HUF</th>
	

	
	

	<!--
  <th class="libelles" align="center" nowrap colspan=2 width=40><img src="dr/uah.png" border=0/> UAH</th>     -->

</tr>

<tr>
  
	<th class="libelles2" nowrap><?php echo $translate[$_GET['ln']]['bid'] ?></th>
	<th class="libelles2" nowrap><?php echo $translate[$_GET['ln']]['ask'] ?></th>
	<th class="libelles2" nowrap><?php echo $translate[$_GET['ln']]['bid'] ?></th>
	<th class="libelles2" nowrap><?php echo $translate[$_GET['ln']]['ask'] ?></th>
	<th class="libelles2" nowrap><?php echo $translate[$_GET['ln']]['bid'] ?></th>
	<th class="libelles2" nowrap><?php echo $translate[$_GET['ln']]['ask'] ?></th>
<!--	<th class="libelles2" nowrap>Bid</th>
	<th class="libelles2" nowrap>Ask</th> -->
	<th class="libelles2" nowrap><?php echo $translate[$_GET['ln']]['bid'] ?></th>
	<th class="libelles2" nowrap><?php echo $translate[$_GET['ln']]['ask'] ?></th>
	<!--<th class="libelles2" nowrap>Bid</th>
	<th class="libelles2" nowrap>Ask</th> -->
	<th class="libelles2" nowrap><?php echo $translate[$_GET['ln']]['bid'] ?></th>
	<th class="libelles2" nowrap><?php echo $translate[$_GET['ln']]['ask'] ?></th>
    <th class="libelles2" nowrap><?php echo $translate[$_GET['ln']]['bid'] ?></th>
	<th class="libelles2" nowrap><?php echo $translate[$_GET['ln']]['ask'] ?></th>	
<!--  	<th class="libelles2" nowrap>Bid</th>
<!--  	<th class="libelles2" nowrap>Ask</th>
	
<!--	<th class="libelles" align="right" nowrap>Bid</th>
	<th class="libelles" align="right" nowrap>Ask</th>  -->

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
	//foreach($arrSymbols as $symbol)
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
		  case "Gold" :  $strName = "<div>".$translate[$_GET['ln']]['gold']."</div>"; $_SESSION['XAU/USD_bid'] = $quote["f10"]; $_SESSION['XAU/USD_ask'] = $quote["f11"]; break;
		  case "Silver" :  $strName = "<div>".$translate[$_GET['ln']]['silver']."</div>";$_SESSION['XAG/USD_bid'] = $quote["f10"]; $_SESSION['XAG/USD_ask'] = $quote["f11"]; break;
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



<tr <?if ($strName == "EUR/USD") echo 'style="display:none"'?>>
	<TD class="separation99" align="left" colspan=2><?php print($strName)?></TD>
  <td class="separation0" width="15px">
    <?
    if ($strChange > 0) 
      echo "<img width='10px' src='haut.gif'>";
    else
      echo "<img width='10px' src='bas.gif'>";
    ?>
  </td>  
  
 <?php  //echo $EUPLN ?>
		  
	<? if ($poids == "kilogram") {  ?>
  <TD class="separationTime" align="left" nowrap><?php print($strDateTime);?></TD>                                                                                            
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div4'?>"><?php print(number_format ( $strBid/$eurBid*$pln ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div4'?>"><?php print(number_format ( $strAsk/$eurBid*$pln ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div'?>"><? if ($quote["f25"] == "Gold") print "<b>"; ?><?php print(number_format(($strBid/$eurAsk), 0,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div'?>"><? if ($quote["f25"] == "Gold") print "<b>"; ?><?php print(number_format ( $strAsk/$eurBid ,0,'.',' ' ))?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div2'?>"><? if ($quote["f25"] == "Gold") print "<b>"; ?><?php print(number_format ( $strBid ,0,'.',' ' ))?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div2'?>"><? if ($quote["f25"] == "Gold") print "<b>"; ?><?php print(number_format ( $strAsk ,0,'.',' ' ))?></b><?//print (" ".$dev."/".$poids)?></div></TD>
<!--
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div9'?>"><?php print(number_format ( $strBid/$eurAsk*$rub ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div9'?>"><?php print(number_format ( $strAsk/$eurBid*$rub ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
-->
	<!--  <TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div8'?>"><?php print(number_format ( $strBid/$eurAsk*$lvl ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
<!--  	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div8'?>"><?php print(number_format ( $strAsk/$eurBid*$lvl ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
<!--
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div7'?>"><?php print(number_format ( $strBid/$eurAsk*$byr ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div7'?>"><?php print(number_format ( $strAsk/$eurBid*$byr ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
-->
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div6'?>"><?php print(number_format ( $strBid/$eurAsk*$dkk ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div6'?>"><?php print(number_format ( $strAsk/$eurBid*$dkk ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div3'?>"><?php print(number_format ( $strBid/$eurAsk*$czk ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div3'?>"><?php print(number_format ( $strAsk/$eurBid*$czk ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div5'?>"><?php print(number_format ( $strBid/$eurAsk*$huf ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div5'?>"><?php print(number_format ( $strAsk/$eurBid*$huf ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	
		
	
	
	
	<? } ?>
	
	<? if ($poids == "gram") {  ?>
  <TD class="separationTime" align="left" nowrap><?php print($strDateTime);?></TD>    
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div4'?>"><?php print(number_format ( $strBid/$eurAsk*$pln ,3,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div4'?>"><?php print(number_format ( $strAsk/$eurBid*$pln ,3,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>                                                                                          
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div'?>"><? if ($quote["f25"] == "Gold") print "<b>"; ?><?php print(number_format  ( $strBid/$eurAsk ,3,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div'?>"><? if ($quote["f25"] == "Gold") print "<b>"; ?><?php print(number_format  ( $strAsk/$eurBid ,3,'.',' ' ))?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div2'?>"><? if ($quote["f25"] == "Gold") print "<b>"; ?><?php print(number_format ( $strBid ,3,'.',' ' ))?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div2'?>"><? if ($quote["f25"] == "Gold") print "<b>"; ?><?php print(number_format ( $strAsk ,3,'.',' ' ))?></b><?//print (" ".$dev."/".$poids)?></div></TD>
<!--
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div9'?>"><?php print(number_format ( $strBid/$eurAsk*$rub ,3,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div9'?>"><?php print(number_format ( $strAsk/$eurBid*$rub ,3,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
-->
<!--  	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div8'?>"><?php print(number_format ( $strBid/$eurAsk*$lvl ,4,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
<!--  	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div8'?>"><?php print(number_format ( $strAsk/$eurBid*$lvl ,4,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
<!--
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div7'?>"><?php print(number_format ( $strBid/$eurAsk*$byr ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div7'?>"><?php print(number_format ( $strAsk/$eurBid*$byr ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
-->
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div6'?>"><?php print(number_format ( $strBid/$eurAsk*$dkk ,3,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div6'?>"><?php print(number_format ( $strAsk/$eurBid*$dkk ,3,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	
	
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div3'?>"><?php print(number_format ( $strBid/$eurAsk*$czk ,2,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div3'?>"><?php print(number_format ( $strAsk/$eurBid*$czk ,2,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div5'?>"><?php print(number_format ( $strBid/$eurAsk*$huf ,2,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div5'?>"><?php print(number_format ( $strAsk/$eurBid*$huf ,2,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	
	
	
	

	
	<? } ?>
	
	<? if ($poids == "once") {  ?>
  <TD class="separationTime" align="left" nowrap><?php print($strDateTime);?></TD>                                                                                            
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div4'?>"><?php print(number_format ( $strBid/$eurAsk*$pln ,1,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div4'?>"><?php print(number_format ( $strAsk/$eurBid*$pln ,1,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>

	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div'?>"><? if ($quote["f25"] == "Gold") print "<b>"; ?><?php print(number_format  ( $strBid/$eurAsk ,2,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div'?>"><? if ($quote["f25"] == "Gold") print "<b>"; ?><?php print(number_format  ( $strAsk/$eurBid ,2,'.',' ' ))?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div2'?>"><? if ($quote["f25"] == "Gold") print "<b>"; ?><?php print(number_format ( $strBid ,2,'.',' ' ))?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div2'?>"><? if ($quote["f25"] == "Gold") print "<b>"; ?><?php print(number_format ( $strAsk ,2,'.',' ' ))?></b><?//print (" ".$dev."/".$poids)?></div></TD>
<!--
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div9'?>"><?php print(number_format ( $strBid/$eurAsk*$rub ,1,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div9'?>"><?php print(number_format ( $strAsk/$eurBid*$rub ,1,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
-->
<!--  	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div8'?>"><?php print(number_format ( $strBid/$eurAsk*$lvl ,2,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
<!--  	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div8'?>"><?php print(number_format ( $strAsk/$eurBid*$lvl ,2,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
<!--
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div7'?>"><?php print(number_format ( $strBid/$eurAsk*$byr ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div7'?>"><?php print(number_format ( $strAsk/$eurBid*$byr ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
-->
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div6'?>"><?php print(number_format ( $strBid/$eurAsk*$dkk ,1,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div6'?>"><?php print(number_format ( $strAsk/$eurBid*$dkk ,1,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div3'?>"><?php print(number_format ( $strBid/$eurAsk*$czk ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div3'?>"><?php print(number_format ( $strAsk/$eurBid*$czk ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_bid_div5'?>"><?php print(number_format ( $strBid/$eurAsk*$huf ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php print(str_replace ('/','_',$quote["f25"])).'_ask_div5'?>"><?php print(number_format ( $strAsk/$eurBid*$huf ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	
	
	
	

	
	<? } ?>

</tr>
<?php
	}
	$xml = null;
	
	$provider = "ms_dla";
	//$provider = "comstock_lite";
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
	
		//Loop through and display data for each instrument
	foreach ($objXMLDom->quote as $quote) {
//		$strName = $arrNames[$i];
//		$i++;

		$strName = $quote["f25"];
		//$strName2 = $quote["f25"];
		
		switch ($strName) {
		  case "Gold" :  $strName = "Gold" ; break;
		  case "XAG/USD" :  $strName = "Silver"; break;
		  //case "Platinum/USD O" :  $strName2= "Platinum"; $strName = "Platinum</td><td class='separation0' align=right><font size=2>Platyna</font></td>"; $_SESSION['XPT/USD_bid'] = $quote["f10"]; $_SESSION['XPT/USD_ask'] = $quote["f11"];break;
		  //case "Palladium/USD O" :  $strName2= "Palladium"; $strName = "Palladium</td><td class='separation0' align=right><font size=2>Pallad</font></td>"; $_SESSION['XPTG/USD_bid'] = $quote["f10"]; $_SESSION['XPTG/USD_ask'] = $quote["f11"]; break;
		  case "Platinum/USD" :  $strName2= "Platinum"; $strName = "<div>".$translate[$_GET['ln']]['platine']."</div>"; $_SESSION['XPT/USD_bid'] = $quote["f10"]; $_SESSION['XPT/USD_ask'] = $quote["f11"];break;
		  case "Palladium/USD" :  $strName2= "Palladium"; $strName = "<div>".$translate[$_GET['ln']]['palladium']."</div>"; $_SESSION['XPTG/USD_bid'] = $quote["f10"]; $_SESSION['XPTG/USD_ask'] = $quote["f11"]; break;

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

<tr <?if ($strName == "EUR/USD") echo 'style="display:none"'?>>
  <TD class="separation99" align="left" nowrap=nowrap colspan=2><?php print($strName)?></TD>
	<td class="separation0">
    <?
    if ($strChange > 0) 
      echo "<img width='10px' src='haut.gif'>";
    else
      echo "<img width='10px' src='bas.gif'>";
    ?>
  </td>

	<? if ($poids == "kilogram") {  ?>
  <TD class="separationTime" align="left" nowrap><?php print($strDateTime);?></TD>                                                                                            
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div4'; else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div4';?>"><?php print(number_format ( $strBid/$eurAsk*$pln ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div4'; else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div4';?>"><?php print(number_format ( $strAsk/$eurBid*$pln ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>

	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div';  else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div';?>"><?php print(number_format(($strBid/$eurAsk),0,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div';  else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div';?>"><?php print(number_format ( $strAsk/$eurBid ,0,'.',' ' ))?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div2'; else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div2';?>"><?php print(number_format ( $strBid ,0,'.',' ' ))?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div2'; else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div2';?>"><?php print(number_format ( $strAsk ,0,'.',' ' ))?></b><?//print (" ".$dev."/".$poids)?></div></TD>
<!--
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div9'; else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div9';?>"><?php print(number_format ( $strBid/$eurAsk*$rub ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div9'; else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div9';?>"><?php print(number_format ( $strAsk/$eurBid*$rub ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
-->
<!--  	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div8'; else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div8';?>"><?php print(number_format ( $strBid/$eurAsk*$lvl ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
<!--  	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div8'; else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div8';?>"><?php print(number_format ( $strAsk/$eurBid*$lvl ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
<!--
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div7'; else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div7';?>"><?php print(number_format ( $strBid/$eurAsk*$byr ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div7'; else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div7';?>"><?php print(number_format ( $strAsk/$eurBid*$byr ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
-->
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div6'; else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div6';?>"><?php print(number_format ( $strBid/$eurAsk*$dkk ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div6'; else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div6';?>"><?php print(number_format ( $strAsk/$eurBid*$dkk ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div3'; else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div3';?>"><?php print(number_format ( $strBid/$eurAsk*$czk ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div3'; else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div3';?>"><?php print(number_format ( $strAsk/$eurBid*$czk ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div5'; else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div5';?>"><?php print(number_format ( $strBid/$eurAsk*$huf ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div5'; else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div5';?>"><?php print(number_format ( $strAsk/$eurBid*$huf ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	
	
	
	
	
	<? } ?>
	
	<? if ($poids == "gram") {  ?>
  <TD class="separationTime" align="left" nowrap><?php print($strDateTime);?></TD>                   
 	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div4'; else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div4';?>"><?php print(number_format ( $strBid/$eurAsk*$pln ,3,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div4'; else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div4';?>"><?php print(number_format ( $strAsk/$eurBid*$pln ,3,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
                                                                         
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div';  else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div';?>"><?php print(number_format(  $strBid/$eurAsk ,3,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div';  else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div';?>"><?php print(number_format ( $strAsk/$eurBid ,3,'.',' ' ))?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div2'; else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div2';?>"><?php print(number_format ( $strBid ,3,'.',' ' ))?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div2'; else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div2';?>"><?php print(number_format ( $strAsk ,3,'.',' ' ))?></b><?//print (" ".$dev."/".$poids)?></div></TD>
<!--
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div9'; else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div9';?>"><?php print(number_format ( $strBid/$eurAsk*$rub ,3,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div9'; else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div9';?>"><?php print(number_format ( $strAsk/$eurBid*$rub ,3,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
-->
<!--  	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div8'; else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div8';?>"><?php print(number_format ( $strBid/$eurAsk*$lvl ,4,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
<!--  	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div8'; else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div8';?>"><?php print(number_format ( $strAsk/$eurBid*$lvl ,4,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
<!--
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div7'; else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div7';?>"><?php print(number_format ( $strBid/$eurAsk*$byr ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div7'; else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div7';?>"><?php print(number_format ( $strAsk/$eurBid*$byr ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
-->
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div6'; else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div6';?>"><?php print(number_format ( $strBid/$eurAsk*$dkk ,3,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div6'; else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div6';?>"><?php print(number_format ( $strAsk/$eurBid*$dkk ,3,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div3'; else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div3';?>"><?php print(number_format ( $strBid/$eurAsk*$czk ,2,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div3'; else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div3';?>"><?php print(number_format ( $strAsk/$eurBid*$czk ,2,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div5'; else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div5';?>"><?php print(number_format ( $strBid/$eurAsk*$huf ,2,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div5'; else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div5';?>"><?php print(number_format ( $strAsk/$eurBid*$huf ,2,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	
	
	
	

	
	<? } ?>
	
	<? if ($poids == "once") {  ?>
  <TD class="separationTime" align="left" nowrap><?php print($strDateTime);?></TD>         
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div4'; else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div4';?>"><?php print(number_format ( $strBid/$eurAsk*$pln ,1,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div4'; else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div4';?>"><?php print(number_format ( $strAsk/$eurBid*$pln ,1,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>                                                                                     
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div';  else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div';?>"><?php print(number_format(  $strBid/$eurAsk ,2,'.',' ' )); ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div';  else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div';?>"><?php print(number_format ( $strAsk/$eurBid ,2,'.',' ' ))?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div2'; else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div2';?>"><?php print(number_format ( $strBid ,2,'.',' ' ))?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div2'; else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div2';?>"><?php print(number_format ( $strAsk ,2,'.',' ' ))?></b><?//print (" ".$dev."/".$poids)?></div></TD>
<!--
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div9'; else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div9';?>"><?php print(number_format ( $strBid/$eurAsk*$rub ,1,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div9'; else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div9';?>"><?php print(number_format ( $strAsk/$eurBid*$rub ,1,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
-->
<!--  	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div8'; else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div8';?>"><?php print(number_format ( $strBid/$eurAsk*$lvl ,2,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
<!--  	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div8'; else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div8';?>"><?php print(number_format ( $strAsk/$eurBid*$lvl ,2,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
<!--
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div7'; else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div7';?>"><?php print(number_format ( $strBid/$eurAsk*$byr ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div7'; else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div7';?>"><?php print(number_format ( $strAsk/$eurBid*$byr ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
-->
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div6'; else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div6';?>"><?php print(number_format ( $strBid/$eurAsk*$dkk ,1,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div6'; else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div6';?>"><?php print(number_format ( $strAsk/$eurBid*$dkk ,1,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div3'; else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div3';?>"><?php print(number_format ( $strBid/$eurAsk*$czk ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div3'; else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div3';?>"><?php print(number_format ( $strAsk/$eurBid*$czk ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>

	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_bid_div5'; else if ($strName2 == 'Palladium') print 'XPTG_USD_bid_div5';?>"><?php print(number_format ( $strBid/$eurAsk*$huf ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	<TD class="separation" align="right"><div id="<?php if ($strName2 == 'Platinum') print 'XPT_USD_ask_div5'; else if ($strName2 == 'Palladium') print 'XPTG_USD_ask_div5';?>"><?php print(number_format ( $strAsk/$eurBid*$huf ,0,'.',' ' )) ?></b><?//print (" ".$dev."/".$poids)?></div></TD>
	
	
	
	
	
	<? } ?>	
	

</tr>
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



</td></tr></table>
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
 


</div>

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

@endsection
