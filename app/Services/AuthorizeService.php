<?php

namespace App\Services;

// require_once 'constants/SampleCodeConstants.php';

use App\Models\Business;
use Illuminate\Support\Str;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

define("AUTHORIZENET_LOG_FILE", "phplog");

class AuthorizeService {


function chargeCreditCard($validated, $amount = 5.00)
{

    /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName('2aDh57zQm'); // LOGIN ID
    $merchantAuthentication->setTransactionKey('3NR84b94vU25wj8Y'); // TRANSACTION KEY

    // Set the transaction's refId
    $refId = 'ref' . time();

    // Create the payment data for a credit card
    $creditCard = new AnetAPI\CreditCardType();
    // $creditCard->setCardNumber("4111111111111111");
    // $creditCard->setExpirationDate("2038-12");
    // $creditCard->setCardCode("123");

    $businessId = session('business_id');
    $businessDetail = Business::where('id', $businessId)->first();

    $creditCard->setCardNumber($validated['card_number']);
    $creditCard->setExpirationDate($validated['expiration_year'] . '-' . $validated['expiration_month']);
    $creditCard->setCardCode($validated['cvv']);

    // Add the payment data to a paymentType object
    $paymentOne = new AnetAPI\PaymentType();
    $paymentOne->setCreditCard($creditCard);

    // Create order information
    $order = new AnetAPI\OrderType();
    $order->setInvoiceNumber(mt_rand());
    $order->setDescription("Brand Payment");

    // Set the customer's Bill To address
    $customerAddress = new AnetAPI\CustomerAddressType();
    $customerAddress->setFirstName($businessDetail->first_name);
    $customerAddress->setLastName($businessDetail->last_name);
    $customerAddress->setCompany($businessDetail->role);
  //  $customerAddress->setAddress("14 Main Street");
    $customerAddress->setCity($businessDetail->city);
    $customerAddress->setState($businessDetail->state_province);
    // $customerAddress->setZip($businessDetail->postal_code);
    $customerAddress->setCountry($businessDetail->country);

    // Set the customer's identifying information
    $customerData = new AnetAPI\CustomerDataType();
    $customerData->setType("individual");
    $customerData->setId(mt_rand());
    $customerData->setEmail($businessDetail->email);

    // Add values for transaction settings
    $duplicateWindowSetting = new AnetAPI\SettingType();
    $duplicateWindowSetting->setSettingName("duplicateWindow");
    $duplicateWindowSetting->setSettingValue("60");

    // Add some merchant defined fields. These fields won't be stored with the transaction,
    // but will be echoed back in the response.
    $merchantDefinedField1 = new AnetAPI\UserFieldType();
    $merchantDefinedField1->setName("customerLoyaltyNum");
    $merchantDefinedField1->setValue("1128836273");

    $merchantDefinedField2 = new AnetAPI\UserFieldType();
    $merchantDefinedField2->setName("favoriteColor");
    $merchantDefinedField2->setValue("blue");

    // Create a TransactionRequestType object and add the previous objects to it
    $transactionRequestType = new AnetAPI\TransactionRequestType();
    $transactionRequestType->setTransactionType("authCaptureTransaction");
    $transactionRequestType->setAmount($amount);
    $transactionRequestType->setOrder($order);
    $transactionRequestType->setPayment($paymentOne);
    $transactionRequestType->setBillTo($customerAddress);
    $transactionRequestType->setCustomer($customerData);
    $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);
    $transactionRequestType->addToUserFields($merchantDefinedField1);
    $transactionRequestType->addToUserFields($merchantDefinedField2);

    // Assemble the complete transaction request
    $request = new AnetAPI\CreateTransactionRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setTransactionRequest($transactionRequestType);

    // Create the controller and get the response
    $controller = new AnetController\CreateTransactionController($request);
    $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);


    if ($response != null) {
        // Check to see if the API request was successfully received and acted upon
        if ($response->getMessages()->getResultCode() == "Ok") {
            // Since the API request was successful, look for a transaction response
            // and parse it to display the results of authorizing the card
            $tresponse = $response->getTransactionResponse();

            if ($tresponse != null && $tresponse->getMessages() != null) {
               // echo " Successfully created transaction with Transaction ID: " . $tresponse->getTransId() . "\n";
               // echo " Transaction Response Code: " . $tresponse->getResponseCode() . "\n";
               // echo " Message Code: " . $tresponse->getMessages()[0]->getCode() . "\n";
               // echo " Auth Code: " . $tresponse->getAuthCode() . "\n";
               // echo " Description: " . $tresponse->getMessages()[0]->getDescription() . "\n";
            } else {
                //echo "Transaction Failed \n";
                if ($tresponse->getErrors() != null) {
                  //  echo " Error Code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
                  //  echo " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
                }
            }
            // Or, print errors if the API request wasn't successful
        } else {
           // echo "Transaction Failed \n";
            $tresponse = $response->getTransactionResponse();

            if ($tresponse != null && $tresponse->getErrors() != null) {
               // echo " Error Code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
              //  echo " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
            } else {
              //  echo " Error Code  : " . $response->getMessages()->getMessage()[0]->getCode() . "\n";
              //  echo " Error Message : " . $response->getMessages()->getMessage()[0]->getText() . "\n";
            }
        }
    } else {
       // echo  "No response returned \n";
    }

    return $response;
}

}

?>
