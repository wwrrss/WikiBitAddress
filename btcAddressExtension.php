<?php
if(!defined('MEDIAWIKI')){
 die('This file is part of media wiki');
}
$wgExtensionFunctions[] = 'registerSampleTag';
$wgExtensionCredits['btcAddress'][] = array(
        'name' => 'BitcoinAddressBalanceTag',
        'author' => 'Willian Rodriguez',
        'url' => 'https://github/wwrrss/',
 );
 function registerSampleTag() {
      global $wgParser;
      $wgParser->setHook('btcAddress', 'getBtcAddress');
 }
 function getBtcAddress($input,$params){
	$ch = curl_init();
	$dir ="https://blockchain.info/rawaddr/".$input."?limit=0";
	curl_setopt($ch, CURLOPT_URL,$dir);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_NOBODY, FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$head = curl_exec($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	//echo $head; 
	$result=json_decode($head);
	return 'Total BTC:'.$result->{'total_received'}/100000000;
 } 



?>
