<?php 
	require_once ('dbconfig.php'); 
	
	 if(!isset($_SESSION["userID"]) )
	
		 header('Location: login.php');
 
	   else
	  {
		  $userId=$_SESSION["userID"];
		  $UserType=$_SESSION["userType"];
		  $UserName=$_SESSION["userName"];
		 
		  }
	  ?>	