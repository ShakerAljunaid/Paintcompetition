<!DOCTYPE html>
<html>
<head>
	<?php require('include/head.php'); ?>
</head>
<body>
	<div class="login-wrap customscroll d-flex align-items-center flex-wrap justify-content-center pd-20">
		<div class="login-box bg-white box-shadow pd-30 border-radius-5">
			<img src="vendors/images/login-img.png" alt="login" class="login-img">
			<h2 class="text-center mb-30">تسجيل الدخول</h2>
			<form id="frmLogin">
				<div class="input-group custom input-group-lg">
					<input type="text" id="username" name="username" class="form-control" placeholder="اسم المستخدم">
					<div class="input-group-append custom">
						<span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
					</div>
				</div>
				<div class="input-group custom input-group-lg">
					<input type="password" id="password" name="password" class="form-control" placeholder="**********">
					<div class="input-group-append custom">
						<span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="input-group">
							<!--
								use code for form submit
								<input class="btn btn-outline-primary btn-lg btn-block" type="submit" value="Sign In">
							-->
							<button type="submit"  class="btn btn-outline-primary btn-lg btn-block" >دخول</button>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="forgot-password padding-top-10 hidden"><a href="forgot-password.php">Forgot Password</a></div>
					</div>
				</div>
			</form>
		</div>
	
		<?php include('include/footer.php'); ?>
	</div>
		
	<?php include('include/script.php'); ?>
	<script>


$(function(){
$('#frmLogin').on('submit',function(e){
	e.preventDefault();

	console.log($(this).serializeArray());
	$.post('serversideCalls/Ajax/checkCred.php',$(this).serializeArray(),function(r){
		if(r==1)
	    window.location.replace('blank.php ');
		else if(r==2)
			 window.location.replace('index.php ');
	  else {alert('الرجاء التأكد من صحة البيانات');}
	});
	
});


	

});
</script>
</body>
</html>