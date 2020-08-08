<?php

$RefId=$_POST['RefId'];
$ResCode=$_POST['ResCode'];
$SaleOrderId=$_POST['SaleOrderId'];
$SaleReferenceId=$_POST['SaleReferenceId'];

//echo $RefId."   ".$ResCode."     ".$SaleOrderId."     ".$SaleReferenceId;

include('all.php');
$mellat=new mellat();
$res=$mellat->bpVerify($SaleOrderId,$SaleReferenceId);
if($res=="yes"){
	echo $SaleReferenceId;
}else{
	echo "operation field";
}


?>