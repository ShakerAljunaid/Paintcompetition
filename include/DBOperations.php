<?php 

require_once("dbconfig.php");
function select_stmt($tableName,$fields,$values)
{	$arrayLength=count($fields);
	$param='New';
	$res=0;
	
	try{
	  $sqlQuery="SELECT * FROM  ".$tableName." WHERE (";
	  for( $i=0;$i<$arrayLength;$i++)
	  {
		  $sqlQuery .=$fields[$i].'=:'.$fields[$i];
		  if($i<$arrayLength-1)
		    $sqlQuery .=" and " ;
		  else
		    $sqlQuery .=") "; 
	  } 
	 
      $sqlQuery .=' LIMIT :L ';
	  //Prepare statement for binding fields 
	 $stmt = $GLOBALS['pdo']->prepare($sqlQuery);
	//Bind parameters with procedure fields
	
	
       $ValuearrayLength=count($values);
	   
	   	//Clean the values before send them to the database
	
	    $Strng='';
		
	   for( $i=0;$i<$ValuearrayLength;$i++)
	     {	         
              $Strng.=$values[$i].',';
	         $stmt->bindParam($fields[$i],$values[$i]); 
	      }  	
		  $L=1;
		 $stmt->bindParam(':L',$L ); 
		  $limit=3;
          $stmt->execute() ;
           $res=$stmt->fetchAll();
		 //	echo  $sqlQuery.' v '.$Strng;
	
	}
	  catch(PDOException $e){
		  echo 'Error' +' $e';
	  }
	
	return  $res;
	
}


function bind_fields($tableName,$fields,$values)
{

	
	$arrayLength=count($fields);
	$param='New';
	
	try{
	  $sqlQuery="CALL  ".$tableName."(";
	  for( $i=0;$i<$arrayLength;$i++)
	  {
		  if($i<$arrayLength-1)
		    {$sqlQuery .=$fields[$i].",";}
		  else
		    {$sqlQuery .=$fields[$i].")"; } 
	  } 
	 
      
	  //Prepare statement for binding fields 
	 $stmt = $GLOBALS['pdo']->prepare($sqlQuery);
	//Bind parameters with procedure fields
	
	
       $ValuearrayLength=count($values);
	   
	   	//Clean the values before send them to the database
	
	    $Strng='';
	   for( $i=0;$i<$ValuearrayLength;$i++)
	     {	 
         
              //$Strng.=$values[$i].',';
	         $stmt->bindParam($fields[$i],$values[$i]); 
	 }  	
           
        $res=$stmt->execute();
		 	echo  $Strng;
	
	}
	  catch(PDOException $e){
		  echo 'Error' +' $e';
	  }
	
	return 1;
	
}

function bind_fields_new($tableName,$fields,$values)
{
	require_once("dbconfig.php");
$arrayLength=count($fields);
	$param='New';
	
	try{
	  $sqlQuery="CALL  ".$tableName."(";
	  for( $i=0;$i<$arrayLength;$i++)
	  {
		  if($i<$arrayLength-1)
		    {$sqlQuery .=$fields[$i].",";}
		  else
		    {$sqlQuery .=$fields[$i].")"; } 
	  } 
	 
      
	  //Prepare statement for binding fields 
	 $stmt = $GLOBALS['pdo']->prepare($sqlQuery);
	//Bind parameters with procedure fields
	
	
       $ValuearrayLength=count($values);
	   for( $i=0;$i<$ValuearrayLength;$i++)
	     {	 	 $stmt->bindParam($fields[$i],$values[$i]); }  	
              $res=$stmt->execute();
		    $outputArray = $GLOBALS['pdo']->query("select @Result")->fetchAll();;
		$stmt->closeCursor();
		foreach($outputArray as $row)
           {
		return $row['@Result'] ;
		   }
	
		
	}
	  catch(PDOException $e){
		 // echo 'Error' +' $e';
		 return 0;
	  }
	
	
	
}

function check_data($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


