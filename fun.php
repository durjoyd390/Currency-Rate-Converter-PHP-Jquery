<?php
/*
This Script provided by Durjoysoft.
Email: helpdas@durjoysoft.com
Whatsapp & Direct:  +8801999737584 (08:00 am to 10:00 pm  BST )
Send a text SMS before making a call.
*/


if (isset($_POST['amount'],$_POST['from_vaule'],$_POST['to_vaule'])) {
$amount = $_POST['amount'];
$from_vaule = $_POST['from_vaule'];
$to_vaule = $_POST['to_vaule'];

if (empty($amount)) {
exit('<span style="color: red;">Please Enter Amount!</span>');
}
else if (!is_numeric($amount)) {
exit('<span style="color: red;">Please Enter Right Amount!</span>');
}else{

// ---------------- start converter -------------------------
$url = 'https://www.google.com/finance/quote/'.$from_vaule.'-'.$to_vaule;
$curl = curl_init();
        curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL =>$url, CURLOPT_USERAGENT =>'My Browser' ));
$html = curl_exec($curl);
        curl_close($curl);
$doc = new DOMDocument();
@$doc->loadHTML($html);
$xpath = new DOMXPath($doc);
$elements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' YMlKec fxKbKc ')]");
foreach ($elements as $element) {
   $converted_vaule =  $element->nodeValue;
}
$rate = str_replace(',', '', $converted_vaule);
// ---------------- End converter -------------------------
$return_amount = $amount*$rate;
$result = '<span style="color: green;">'.$amount.' '.$from_vaule.' = '.$return_amount.' '.$to_vaule.'</span>';
echo $result;

}
}
?>