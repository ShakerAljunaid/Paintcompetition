<?php
require_once('../../../../include/dbconfig.php');

if(isset($_POST['userID']) )
{	$parms=$_POST;
$sql="update useraccount
   set userType='".$parms['userType']."'
    ,userName='".$parms['userName']."'
	,password='".md5($parms['password'])."'
	,status='".$parms['status']."'
	where userID=".$parms['userID'];

$res=$pdo->query($sql);
if($res)
{
	$sql="SELECT * FROM useraccount";
   $DocData = $pdo->query($sql)->fetchAll();
   echo json_encode($DocData);
}
else
	echo $sql;
}
else echo 'Not set';