<?php
require_once('../../../../include/DBOperations.php');


if(isset($_POST['name'])  )
{	$parms=$_POST;
$sql="INSERT INTO clients(name,PhoneNo,	address) values('".$parms['name']."','".$parms['phoneNo']."','".$parms['address']."');";
$res=$pdo->query($sql);
if($res)
{
	$sql="SELECT * FROM clients";
   $userData = $pdo->query($sql)->fetchAll();
   echo json_encode($userData);
}
else
	echo $sql;
}
else echo 'Not set';