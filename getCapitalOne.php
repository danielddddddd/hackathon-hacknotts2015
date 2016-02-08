<?php
// GetCapitalOneBalance from HackNotts challenge
// @danieldainty 28/11/15 #HackNotts 

const APIKEY = "d8c60a3104100fc4e3fee3882ffb4c9d";
const BASEURL = "http://api.reimaginebanking.com";

class CapitalOneAccount
{
	public $balance = 0;
	public $type = "Capital One";
	public $label;
	
	function CapitalOneAccount($myCustomerId)
	{
		$myAccounts = $this->getMyAccounts($myCustomerId);
		$myAccountId = $myAccounts[0]['_id'];
		
		$myAccountBalances = $this->getMyAccountBalance($myAccountId);
		$this->label = $myAccountBalances['nickname'];
		$this->balance = $myAccountBalances['balance']/100;
		
	}

	function getMyAccounts($myCustomerId){

		$url = (BASEURL ."/customers/" . $myCustomerId ."/accounts?key=" . APIKEY);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url);
		$result=curl_exec($ch);
		
		
		if(curl_exec($ch) === false)
		{
			echo 'Curl error in getMyAccounts: ' . curl_error($ch) . '<br />';
		}
		else
		{
			return json_decode($result,true);
		}
		curl_close($ch);

	}

	function getMyAccountBalance($myAccountId){

		$url = (BASEURL ."/accounts/" . $myAccountId ."/?key=" . APIKEY);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url);
		$result=curl_exec($ch);
		
		if(curl_exec($ch) === false)
		{
			echo 'Curl error in getMyAccountBalance: ' . curl_error($ch) . '<br />';
		}
		else
		{
			return json_decode($result,true);
		}
		curl_close($ch);

	}
}
?>


