<?php
require_once('../../../../include/dbconfig.php');

if(isset($_POST['Id']) )
{	$parms=$_POST;
$sql="insert into batches(BatchName,ClientId,BrandId,NoOfCoupons,Description)
  values('".$parms['BatchName']."'
    ,".$parms['ClientId']."
	,".$parms['BrandId']."
	,".$parms['NoOfCoupons']."
   ,'".$parms['Description']."')";
	
	

$res=$pdo->query($sql);
if($res)
{
	$sql="SELECT * FROM batches";
   $DocData = $pdo->query($sql)->fetchAll();
   echo json_encode($DocData);
}
else
	echo $sql;
}
else echo 'Not set';