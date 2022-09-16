<?php
require_once('../../../../include/dbconfig.php');


if(isset($_POST['userName']) && !empty($_POST['userType']) )
{	$parms=$_POST;
$sql="INSERT INTO useraccount(userType,userName,password,status) values('".$parms['userType']."','".$parms['userName']."','".md5($parms['password'])."','".$parms['status']."');";
$res=$pdo->query($sql);
if($res)
{
	$sql="SELECT * FROM useraccount";
   $userData = $pdo->query($sql)->fetchAll();
   echo json_encode($userData);
}
else
	echo $sql;
}
else echo 'Not set';