<?php
require_once('../../../../include/DBOperations.php');


if(isset($_POST['name'])  )
{	$parms=$_POST;
$sql="INSERT INTO brands(Name,NoOfPoints,CardTemplate) values('".$parms['name']."',".$parms['noOfPoints'].",'".$parms['cardTemplate']."');";
$res=$pdo->query($sql);
if($res)
{
	$sql="SELECT * FROM brands";
   $userData = $pdo->query($sql)->fetchAll();
   echo json_encode($userData);
}
else
	echo $sql;
}
else echo 'Not set';