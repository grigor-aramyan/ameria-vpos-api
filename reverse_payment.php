<?php

$clientId = $_POST['clientId'];
$username = $_POST['username'];
$password = $_POST['password'];
$orderId = $_POST['orderId'];
$amount = $_POST['amount'];

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
$parms['paymentfields']['PaymentAmount'] =   $amount; // payment amount

$webService = $client-> ReversePayment($parms);
if($webService->ReversePaymentResult->Respcode == '00') {
  // Success case
  $arr = array(
      "code" => $webService->ReversePaymentResult->Respcode,
      "message" => $webService->ReversePaymentResult->Respmessage
  );
  echo json_encode($arr);
} else {
  // Error case
  $arr = array(
      "code" => $webService->ReversePaymentResult->Respcode,
      "message" => $webService->ReversePaymentResult->Respmessage
  );
  echo json_encode($arr);
}

?>
