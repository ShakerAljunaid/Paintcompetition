<?php
require_once('../../../../include/dbconfig.php');

if(isset($_POST['BatchId']) && isset($_POST['NoOfCoupons']) )
{	$parms=$_POST;
$sql="insert into coupons(BatchId,CouponNo,CouponHash) values";


for ($n = 0; $n < $_POST['NoOfCoupons']; $n++)
{
	$t=time();
	
   $value = rand(000,111).''.$t.'';
   
   $sql .=($n==0?"":",")."(".$_POST['BatchId'].",".$value.",'".md5($value)."')";
}
	
	
	

$res=$pdo->query($sql);
if($res)
{
	$sql="update batches set CouponsGenerated=1 where id= ".$_POST['BatchId'];
     $pdo->query($sql);
	$sql="SELECT * FROM batches";
    $BatchData = $pdo->query($sql)->fetchAll();
   echo json_encode( $BatchData);
  
}
else
	echo $sql;
}
else echo 'Not set';