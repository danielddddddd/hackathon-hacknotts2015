<?
// Tell whoever that we are emitting json, not HTML
header('Content-Type: application/json');
require('getCapitalOne.php');
require('getJustGiving.php');
require('getPayPal.php');
$myJustGivingPageURLs = ["Team-PwC-Norwich-Half-Marthon","hack-cancer","Stan-Flight"];
$myCapitalOneAccounts = ["56241a12de4bf40b1711213b"];
$myPayPalAccounts 	  = ["me@danieldainty.com"];

foreach($myJustGivingPageURLs as $myJustGivingPageURL){
	$myJustGivingPage = new JustGivingFundraisingPage($myJustGivingPageURL);
	$myAccounts[] = $myJustGivingPage;
}
foreach($myCapitalOneAccounts as $capitalOneCustomerID){
	$myCapitalOneAccount = new CapitalOneAccount($capitalOneCustomerID);
	$myAccounts[] = $myCapitalOneAccount;
}
foreach($myPayPalAccounts as $payPalAccount){
	$myPayPalAccount = new PayPalAccount($payPalAccount);
	$myAccounts[] = $myPayPalAccount;
}


echo(json_encode($myAccounts));
?>

