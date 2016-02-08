<?php
// getPayPal.php from HackNotts challenge
// @danieldainty, 29/11/15 #HackNotts 

class PayPalAccount
{
	// construct the initial class object with fake stuff
	
	public $balance = 0;
	public $type = "PayPal Basic";
	public $label = "Daniel's PayPal Account";
	
	function PayPalAccount(){
		$this->balance = rand(1000,100000)/100;
	}

}
?>