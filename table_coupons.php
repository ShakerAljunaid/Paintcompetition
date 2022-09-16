
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Lux Competition | مسابقة دهانات لوكس</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="vendors/styles/bootstrap.min.css" rel="stylesheet" media='screen,print'>
	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<?php 
	require_once('include/dbconfig.php');
	if(isset($_REQUEST["BatchId"]))
	{
		$sql = "select * from coupons where BatchId =".$_REQUEST["BatchId"].' limit 12'; 
		 $CouponsData= $pdo->query($sql)->fetchAll();
		$sql = "select br.CardTemplate from batches bt inner join brands br on bt.brandId=br.id where bt.Id =".$_REQUEST["BatchId"]; 
		
		 $CardTemplateResult=current( $pdo->query($sql)->fetchAll());
		 $CardTemplate=$CardTemplateResult?$CardTemplateResult['CardTemplate']:'';
		  echo '<script> var JsCouponsData='.json_encode($CouponsData).';</script>';
		 
		
	}
?>
</head>
<body>

<?php 

foreach($CouponsData as $row) {?>


 
        <div class="col-sm-6 ">
            <div class="counter">
               
                <div class="counter-content">
                   
                    <span class="counter-value"><?php echo "<img width='650'  alt='testing'  src='include/barcode.php?codetype=Code128&size=27&text=".$row['CouponNo']."'/>"; ?></sp771641646216151641646216871641646216781641646216771641646216an>
                </div>
            </div>
        </div>
       
<?php } ?>
<style>
.counter{
	background-image: url("src/images/<?php echo $CardTemplate; ?>");
    background-repeat: no-repeat;
  background-size: 100% 100%;
    font-family: 'Poppins', sans-serif;
    text-align: center;
    padding: 25px ;
    margin: 10px 10px;
    position: relative;
	height: 420px
}

.counter .counter-content{
   
   
   
}


.counter.red .counter-icon{ color: #E44C4B; }
.counter.red .counter-content,
.counter.red .counter-content:before{
    background-color: rgba(228,76,75,0.9);
}
.counter.blue .counter-icon{ color: #027981; }
.counter.blue .counter-content,
.counter.blue .counter-content:before{
    background-color: rgba(2,121,129,0.9);
}
.counter.purple .counter-icon{ color: #3E6491; }
.counter.purple .counter-content,
.counter.purple .counter-content:before{
    background-color: rgba(62,100,145,0.9);
}

</style>



</body>
</html>