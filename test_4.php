<?php
/*
require_once('API/sendinblue/vendor/autoload.php');

// Configure API key authorization: api-key
$config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api-key', 'Bearer');
// Configure API key authorization: partner-key
$config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('partner-key', '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');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('partner-key', 'Bearer');

$apiInstance = new SendinBlue\Client\Api\AccountApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getAccount();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AccountApi->getAccount: ', $e->getMessage(), PHP_EOL;
}
*/
include 'API/Mailin.php';
require_once('API/sendinblue/vendor/autoload.php');

                      /*                  $mailin = new Mailin('prisencoopen@icloud.com', 'TzvtyZUHhqMc84S7');
                                        $mailin->
                                        addTo('ceaika007@gmail.com', 'Prisen COOPEN')->
                                        setFrom('prisencoopen@icloud.com', 'Prisen COOPEN')->
                                        setReplyTo('prisencoopen@icloud.com','Prisen COOPEN')->
                                        setSubject('Entrer l\'objet ici')->
                                        setText('Bonjour')->
                                        setHtml('<strong>Bonjour</strong>');
                                        $res = $mailin->send();*/
                               //      Le message de succès sera renvoyé sous cette forme:
                                    //    {'result' => true, 'message' => 'Email envoyé'}






$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.sendinblue.com/v3/smtp/email",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"sender\":{\"name\":\"Ivan\",\"email\":\"prisencoopen@icloud.com\"},\"to\":[{\"email\":\"ceaika007@yahoo.com\",\"name\":\"Ivan\"}],\"replyTo\":{\"email\":\"prisencoopen@icloud.com\",\"name\":\"Prisen\"},\"htmlContent\":\"Ivan test\",\"textContent\":\"text Content\",\"subject\":\"subjest\",\"templateId\":24}",
  CURLOPT_HTTPHEADER => array(
    "accept: application/json",
    "api-key: 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",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
?>
