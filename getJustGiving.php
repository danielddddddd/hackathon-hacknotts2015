<?php
// getJustGiving.php from HackNotts challenge
// @danieldainty and Mohammed Nuur, 28/11/15 #HackNotts 

const APIKEY = "900a398a";
const JUSTGIVINGBASEURL = "https://api.justgiving.com/900a398a/v1/fundraising/pages/";

class JustGivingFundraisingPage
{
	// construct the initial class object with default/placeholder stuff
	
	public $balance = 0;
	public $type = "JustGiving";
	public $label;
	public $publicUrl;
	
	function JustGivingFundraisingPage($myFundraisingPageUrl)
	{
		// this function is called when the object is created.
		
		// store the entire JSON response from the MyFundraisingPage call into the $myFundraisingPage variable
		$myFundraisingPage = $this->getMyFundraisingPage($myFundraisingPageUrl);
	
		
		// extract out the useful bits that we are interested in
		$this->balance = (float)$myFundraisingPage['grandTotalRaisedExcludingGiftAid'];
		$this->label   = $myFundraisingPage['title'];
		$this->publicUrl = "http://justgiving.com/" . $myFundraisingPageUrl;
		
		// finished!

	}

	function getMyFundraisingPage($myFundraisingPageUrl){

		// Set the URL, so our code isn't stupid long elsewhere
		$url = (JUSTGIVINGBASEURL ."/". $myFundraisingPageUrl);
		
		// make an object of type 'curl' so we can control it
		$ch = curl_init();
		// we want it to return the transfer, not print it out - set this as 'false' to display to screen (for debugging)
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// set content-type we want back to be application/json (otherwise we get xml)
		curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
		// tell $ch what page we want it to get
		curl_setopt($ch, CURLOPT_URL,$url);
		// do curl_exec and store the result in $result
		$result=curl_exec($ch);
		
		// error handling - did something bad happen? 'false' is flagged if it didn't finish properly
		if(curl_exec($ch) === false)
		{
			echo 'Curl error in JustGiving::getMyFundraisingPage: ' . curl_error($ch) . '<br />';
		}
		else
		{
			// all good - decode the result as json and give it back to whoever called this function
			// tidy up first
			curl_close($ch);
			return json_decode($result,true);
		}

	}
}
?>