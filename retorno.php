<?php  
if(isset($_POST['notificationType']) && $_POST['notificationType'] == 'transaction'){

$email = 'souzahenrique.gabriel@outlook.com';
$token = '';

$url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/'.$_POST['notificationCode'].'?email='.$email.'&token='.$token;

$curl = curl_init($url);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($curl,CURL_RETURNTRANSFER,true);
$transaction = curl_exec($curl);
curl_close($curl);
if($transaction == 'Unauthorized'){
die('Um erro ocorreu');
}
$transaction = simplexml_load_string($transaction);
$transactionStatus = $transaction->status;
if($transactionStatus == 1){
	$transactionStatus = 'Aguardado pagamento';
}else if($transactionStatus == 2){
	$transactionStatus = 'Em análise'; 
}else if($transactionStatus == 3){
	$transactionStatus = 'Pago';
	$referenceId = $transaction->reference;
	\MySql::connect()->exec("UPDATE pedidos SET status = 'pago' WHERE reference_id = '$referenceId'");
}else if($transactionStatus == 4){
	$transactionStatus = 'Disponivel';
}else if($transactionStatus == 5){
	$transactionStatus = 'Em disputa';
}else if($transactionStatus == 6){
	$transactionStatus = 'Devolvida';
}else if($transactionStatus == 7){
	$transactionStatus = 'Cancelada';
}

}