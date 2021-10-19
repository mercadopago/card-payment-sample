<?php

require __DIR__  . '/vendor/autoload.php';

//REPLACE WITH YOUR ACCESS TOKEN AVAILABLE IN: https://www.mercadopago.com/developers/panel
MercadoPago\SDK::setAccessToken("YOUR_ACCESS_TOKEN");

$path = $_SERVER['REQUEST_URI'];

switch($path){
    case '':
    case '/':
        require __DIR__ . '/../../client/index.html';
        break;
    case '/process_payment':
        $payment = new MercadoPago\Payment();
        $payment->transaction_amount = (float)$_POST['transactionAmount'];
        $payment->token = $_POST['token'];
        $payment->description = $_POST['description'];
        $payment->installments = (int)$_POST['installments'];
        $payment->payment_method_id = $_POST['paymentMethodId'];
        $payment->issuer_id = (int)$_POST['issuer'];

        $payer = new MercadoPago\Payer();
        $payer->email = $_POST['email'];
        $payer->identification = array( 
            "type" => $_POST['docType'],
            "number" => $_POST['docNumber']
        );
        $payment->payer = $payer;

        $payment->save(); 

        $response = array(
            'status' => $payment->status,
            'message' => $payment->status_detail,
            'id' => $payment->id
        );
        echo json_encode($response);
        break; 
        
    //Serve static resources
    default:
        $file = __DIR__ . '/../../client' . $path;
        $extension = end(explode('.', $path));
        $content = 'text/html';
        switch($extension){
            case 'js': $content = 'application/javascript'; break;
            case 'css': $content = 'text/css'; break;
            case 'png': $content = 'image/png'; break;
        }
        header('Content-Type: '.$content);
        readfile($file);
        break;
}
