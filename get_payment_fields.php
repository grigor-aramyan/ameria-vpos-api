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

$webService = $client-> GetPaymentFields($parms);

if ($webService->GetPaymentFieldsResult->respcode == '00') {

    $arr = array(
        "merchantid" => $webService->GetPaymentFieldsResult->merchantid,
        "terminalid" => $webService->GetPaymentFieldsResult->terminalid,
        "datetime" => $webService->GetPaymentFieldsResult->datetime,
        "amount" => $webService->GetPaymentFieldsResult->amount,
        "cardnumber" => $webService->GetPaymentFieldsResult->cardnumber,
        "clientname" => $webService->GetPaymentFieldsResult->clientname,
        "orderid" => $webService->GetPaymentFieldsResult->orderid,
        "stan" => $webService->GetPaymentFieldsResult->stan,
        "authcode" => $webService->GetPaymentFieldsResult->authcode,
        "mdorder" => $webService->GetPaymentFieldsResult->rrn,
        "trxnDetails" => $webService->GetPaymentFieldsResult->trxnDetails
    );

   echo json_encode($arr);
} else {
    $arr = array(
        "merchantid" => "",
        "terminalid" => "",
        "datetime" => "",
        "amount" => 0,
        "cardnumber" => "",
        "clientname" => "",
        "orderid" => 0,
        "stan" => "",
        "authcode" => "",
        "mdorder" => "",
        "trxnDetails" => ""
    );

   echo json_encode($arr);
}

?>
