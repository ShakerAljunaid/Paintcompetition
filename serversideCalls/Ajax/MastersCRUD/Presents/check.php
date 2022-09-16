
<?php 
//This checks if the card exists
require_once('../../../../include/dbconfig.php');
if(isset($_POST['couponNo']))
{$sql="select p.CouponId from  cleints_presents p join coupons c on c.id=p.CouponId  where CouponNo=".$_POST['couponNo'];
$res=current($pdo->query($sql)->fetchAll());
if(!empty($res['CouponId']))
 echo $res['CouponId'];
else 
	echo 0;
}
else $_POST['couponNo'];

