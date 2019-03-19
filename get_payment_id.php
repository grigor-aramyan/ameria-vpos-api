<?php

$clientId = $_POST['clientId'];
$username = $_POST['username'];
$password = $_POST['password'];
$orderId = $_POST['orderId'];
$description = $_POST['description'];
$amount = $_POST['amount'];
$backUri = $_POST['backUri'];

$options = array(
					'soap_version'    => 'SOAP_1_1',
					'exceptions'      => true,
					'trace'           => 1,
					'wsdl_local_copy' => true
				);

$client = new SoapClient("https://testpayments.ameriabank.am/webservice/PaymentService.svc?wsdl", $options);

// Set Parameters

$parms['paymentfields']['ClientID']		 =   $clientId; // clientID from Ameriabank
$parms['paymentfields']['Username']		 =   $username; // username from Ameriabank
$parms['paymentfields']['Password']		 =   $password; // password from Ameriabank
$parms['paymentfields']['OrderID']		 =   $orderId; // unique ID for transaction
$parms['paymentfields']['Description']	 =	 $description; // Order Description
$parms['paymentfields']['PaymentAmount'] =   $amount; // payment amount
$parms['paymentfields']['backURL'] =		$backUri;   // after transaction redirect to this url (example php_example_statement.php)

// Generate unique payment ID

$webService = $client-> GetPaymentID($parms);
/*echo($webService->GetPaymentIDResult->Respcode." ");
echo($webService->GetPaymentIDResult->Respmessage." ");
echo($webService->GetPaymentIDResult->PaymentID." ");*/

if($webService->GetPaymentIDResult->Respcode == '1' && $webService->GetPaymentIDResult->Respmessage =='OK')
  {
  	//Redirect to Ameriabank server

    echo "https://testpayments.ameriabank.am/forms/frm_paymentstype.aspx?paymentid=" . $webService->GetPaymentIDResult->PaymentID;

  	/*echo "<script type='text/javascript'>\n";
  	echo "window.location.replace('https://testpayments.ameriabank.am/forms/frm_paymentstype.aspx?paymentid=".$webService->GetPaymentIDResult->PaymentID."');\n";
  	echo "</script>";*/

  } else {

  	// Error Message
    echo '';
  }

?>
