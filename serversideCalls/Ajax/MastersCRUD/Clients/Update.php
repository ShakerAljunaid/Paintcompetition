<?php
require_once('../../../../include/dbconfig.php');

if(isset($_POST['Id']) )
{	$parms=$_POST;
$sql="update clients
   set name='".$parms['name']."'
    ,PhoneNo='".$parms['phoneNo']."'
	,address='".$parms['address']."'

	
	where Id=".$parms['Id'];

$res=$pdo->query($sql);
if($res)
{
	$sql="SELECT * FROM clients";
   $DocData = $pdo->query($sql)->fetchAll();
   echo json_encode($DocData);
}
else
	echo $sql;
}
else echo 'Not set';