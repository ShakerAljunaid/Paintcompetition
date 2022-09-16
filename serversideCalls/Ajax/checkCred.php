<?php
require_once('../../include/dbconfig.php');

if(isset($_POST['username']) && isset($_POST['password']) )
{	$parms=$_POST;
$sql="select userID,userType,userName from useraccount where username='". $parms['username']."' and password='".md5($parms['password'])."';";
$res=current($pdo->query($sql)->fetchAll());
//echo $sql;
if($res)
{$_SESSION["userID"] = $res['userID'];
			$_SESSION["userName"] = $res['userName'];
			$_SESSION["userType"] = $res['userType'];
		
			
			
	echo $res['userType'];
	}
else
	echo 'Failed';
}
else echo 'Not set';