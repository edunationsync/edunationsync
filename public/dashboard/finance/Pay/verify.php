<?php
//check if request was made with the right data
if(!$_SERVER['REQUEST_METHOD'] == 'POST' || !isset($_POST['reference'])){  
  $msg="Transaction reference not found";
}

//set reference to a variable @ref
$reference = $_POST['reference'];

//The parameter after verify/ is the transaction reference to be verified
$url = 'https://api.paystack.co/transaction/verify/'.$reference;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt(
  $ch, CURLOPT_HTTPHEADER, [
    'Authorization: sk_live_6d1bc2721d884769cc7fc3b4c25af5157f4ee8c4']
);

//send request
$request = curl_exec($ch);
//close connection
curl_close($ch);
//declare an array that will contain the result 
$result = array();

if ($request) {
  $result = json_decode($request, true);
}

if (array_key_exists('data', $result) && array_key_exists('status', $result['data']) && ($result['data']['status'] === 'success')) {
	$rsp="Succeed";
    $msg= "Payment was successfully made. You can now access your reciept now or go the school to get directions on how to access it/";
  ?>
	<meta http-equiv=refresh content="1.5 url=../reciept.php?ref=<?php echo $reference; ?>&status=seccess">
	<?php
  //Perform necessary action
}
else{
	$rsp="Failed";
    $msg= "Transaction was unsuccessful";
	?>
	<meta http-equiv=refresh content="1.5 url=./?status=fail">
	<?php
}
?>