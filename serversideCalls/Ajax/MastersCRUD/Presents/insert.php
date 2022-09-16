<?php
require_once('../../../../include/dbconfig.php');

if(isset($_POST['couponNo']) )
{	$parms=$_POST;

$sql="select Id from coupons where CouponNo=".$parms['couponNo'];
$res=current($pdo->query($sql)->fetchAll());


$sql="insert into cleints_presents(WinnerName,	WinnerPhone,CouponId,WinnerIdentityAttachment,Description)
  values('".$parms['WinnerName']."'
    ,'".$parms['WinnerPhone']."'
	,".$res['Id']."
	,'".$parms['WinnerIdentityAttachment']."'
   ,'".$parms['Description']."')";
	
	

$res=$pdo->query($sql);
if($res)
{
	echo 1;
}
else
	echo $sql;

}
else echo 'Not set';