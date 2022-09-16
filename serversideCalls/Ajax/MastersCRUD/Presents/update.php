<?php
require_once('../../../../include/dbconfig.php');

if(isset($_POST['Id']) )
{	$parms=$_POST;

$sql="update batches
   set BatchName='".$parms['BatchName']."'
    ,BrandId=".$parms['BrandId']."
	,	ClientId=".$parms['ClientId']."
	,		NoOfCoupons=".$parms['NoOfCoupons']."
        ,			Description='".$parms['Description']."'
	
	where Id=".$parms['Id'];

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