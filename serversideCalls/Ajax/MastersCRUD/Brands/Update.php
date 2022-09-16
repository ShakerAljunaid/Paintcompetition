<?php
require_once('../../../../include/dbconfig.php');

if(isset($_POST['Id']) )
{	$parms=$_POST;
$sql="update brands
   set name='".$parms['name']."'
    ,NoOfPoints='".$parms['noOfPoints']."'
	,CardTemplate='".$parms['cardTemplate']."'
	
	
	where Id=".$parms['Id'];

$res=$pdo->query($sql);
if($res)
{
	$sql="SELECT * FROM brands";
   $DocData = $pdo->query($sql)->fetchAll();
   echo json_encode($DocData);
}
else
	echo $sql;
}
else echo 'Not set';