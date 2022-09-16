<!DOCTYPE html>
<html>
<head>
	<?php include('include/head.php'); ?>
	<link rel="stylesheet" href="vendors/styles/excel-table.css">
</head>
<body>
	<?php include('include/header.php'); ?>
	<?php include('include/sidebar.php'); ?>
	<?php
	//$DocumentStatus=1;
	//$DocumentType=$_REQUEST["type"];
	// if(isset($_REQUEST["TransactionId"]))
	// {
		// //$sql = "select * from transactionsheader where THID =".$_REQUEST["TransactionId"]; 
		 // // $HeaderData = $pdo->query($sql)->fetchAll();
		 // // $sql = "select * from transactionsbody where THID =".$_REQUEST["TransactionId"]; 
		 // // $bodyData = $pdo->query($sql)->fetchAll();
		 // // $DocumentStatus=2;
		  // // echo '<script> var JsHeaderData='.json_encode($HeaderData).';var JsBodyData='.json_encode($bodyData).';</script>';
		 
		 
	// }
	// echo '';//'<script> var JsDocumentStatus='.$DocumentStatus.';var JsDocumentType='.$DocumentType.'</script>';
	
	?>
	<div class="main-container">
		<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
		
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>تسليم الجوائز</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">الرئيسية</a></li>
									<li class="breadcrumb-item active" aria-current="page">تسليم الجوائز</li>
								</ol>
							</nav>
						</div>
						
					</div>
				</div>
				<form id="transactionForm">
				<!-- Default Basic Forms Start -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					
					
					<div class="row">
						<div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">رقم الكرت</label>
							<div class="col-sm-12 col-md-10">
									<input type="number" class="form-control vld" id="couponNo" name="couponNo"  required>
							</div>
						</div>
						</div>
					 <div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">موبايل المستلم</label>
							<div class="col-sm-12 col-md-10">
									<input type="number" class="form-control vld" id="WinnerPhone" name="WinnerPhone" required>
							</div>
						</div>
						</div>
						<div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">اسم المستلم</label>
							<div class="col-sm-12 col-md-10">
									<input type="text" class="form-control vld" id="WinnerName" name="WinnerName" required>
							</div>
						</div>
						</div>
						
						
					</div>
					<div class="row">
					  <div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">البطاقة الشخصية</label>
							<div class="col-sm-12 col-md-10">
								<input type="file" class="form-control vld" id="identityCard" name="identityCard"  required></select>
							</div>
						</div>
						</div>
					
					
						<div class="col-sm-4">
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">ملاحظات</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" id="Description" name="Description" />
							</div>
						</div>
						</div>
						
					</div>
				
				
					
					
				</div>
				<!-- Default Basic Forms End -->

				<!-- horizontal Basic Forms Start -->
		        	
				
					
				
						<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
							
							
					 <div class="table-responsive" style="max-height:20%">
                     
				
				</div>
				<div class="row">
				<div class="col-sm-5"></div>
				<div class="col-sm-4">
				<div class="col-sm-3">	<button  type="submit" id="submitTransaction" class="btn btn-outline-dark" >حفظ </button></div>
		       <div class="col-sm-3 "><button id="reset"  type="button" class="btn btn-outline-dark ">تهيئة</button></div>
			      </div>
				</div>
				</form>
				<!-- horizontal Basic Forms End -->

			
			
			<?php include('include/footer.php'); ?>
		</div>
	</div>
	<?php include('include/script.php'); ?>
	<script src="vendors/scripts/excel-table.js"></script>
	<script src="src/plugins/sweetalert2/sweetalert2.all.js"></script>
	<link rel="stylesheet" type="text/css" href="src/plugins/sweetalert2/sweetalert2.css">

	<script>
	var valid=false;
	$(document).ready(function(){
		$('#reset').on('click',function(e){
			 location.reload();
		});
		$('#couponNo').on('blur',function(ec){
			if($(this).val())
			  $.post('serversideCalls/Ajax/MastersCRUD/Presents/check.php',{couponNo:$(this).val()},function(r){
				
			   if(r==0)
			   { valid=true;
		    $('#submitTransaction').attr('disabled',false);
			   }
			 
			 else 
			 {valid=false;
		          alert('رقم الكرت هذا موجود مسبقاً');
				  $('#submitTransaction').attr('disabled',true);
				   
				  
			 }
		      });
			
		});
		
		var getCurrentDate=function(){
			var now = new Date();

var day = ("0" + now.getDate()).slice(-2);
var month = ("0" + (now.getMonth() + 1)).slice(-2);

var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
return today;
		};
		
		var getDate4OpeningStock=function(){
			var now = new Date();
             var FirsttDay = now.getFullYear()+"-01-01" ;
              return FirsttDay;
		};
		
		
		 var rows = "", TlInsTbl = 0;;
            for (let row = 0; row < 10; row++) {
                rows += "<tr >";
                rows += '<td class="hidden"><input type="hidden" name="rowId[]" value='+row+' /></td><td  onclick="removeRow(' + row + ')"  align="center" class="deleteRow dsblWnAprv hidebtn" > <a ><em class="fa fa-trash"></em></a>  </td><td>' + (row + 1) + '</td><td  ><select   class="form-control editable dsblWnAprv slcProducts checkQty " name="PID[]" ></select></td><td ><select   class="form-control editable dsblWnAprv slcUnits removeRedColor checkQty" name="unitID[]" onchange="setDefaultQty('+row+')" ></select></td><td><input type="number"  class="form-control editable dsblWnAprv removeRedColor checkQty"  name="quantity[]" onchange="calGross('+row+')"></td><td  class="hidden" ><input type="number" onchange="calGross('+row+')" value=1  class="form - control editable dsblWnAprv removeRedColor hidden" name="rate[]"></td><td name="gross[]"  class="hidden"></td><td><input type="text"  class="form - control editable dsblWnAprv" name="narration[]" ></td>';
                rows += "</tr>";
            }

            $(".excel-table tbody").html(rows);


            $(".excel-table").exceltable();
			
			
		
          $('.removeRedColor').on('keydown',function(e){
			  $(this).css('border','none');
		  });
       $('#transactionForm').on('submit',function(e){
		    e.preventDefault();
		   if(valid)
		   {
		   
		   var file_data = $('#identityCard').prop('files')[0];   
            var form_data = new FormData();                  
            form_data.append('file', file_data);
			 $.ajax({
        url: 'serversideCalls/Ajax/MastersCRUD/Presents/upload.php', // <-- point to server-side PHP script 
        dataType: 'text',  // <-- what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(php_script_response){
			var filename = $('#identityCard').val().replace(/.*(\/|\\)/, '');
           // alert(filename); // <-- display response from the PHP script, if any
			
			var dataS=  $('#transactionForm').serializeArray();
				dataS.push({'name':'WinnerIdentityAttachment','value': filename })
				 console.log(	dataS);
			 $.post('serversideCalls/Ajax/MastersCRUD/Presents/insert.php',dataS,function(r){
				
			 if(r==1)
				 alert('تم الحفظ بنجاج')
			 else 
				  alert('تأكد من صحة البيانات')
		  })
        }
     });
	
	
		  
		 
		 
		
		 
		  var dataS=  $('#transactionForm').serializeArray();
		  
/*dataS.push({'name':'identityCard','value':$("#identityCard")[0].files[0]})
		 console.log(	dataS);
	
	      $.post('serversideCalls/Ajax/MastersCRUD/Presents/insert.php',dataS,function(r){
			  console.log(r);
		  })*/
		 
		
		 
		   }

		 
		 
		 
		   
	   });
       
		$('input[name="DispalcedState"]').on('change',function(e){
			if($('#customRadio3').is(":checked"))
			$('#DisplacedDiv').css('display','block');
		else 
		$('#DisplacedDiv').css('display','none');
	}).trigger('change');;
	
	
	
	//Fill the fields if the document is created 
	if(JsDocumentStatus==2)
		{
			$.each(JsHeaderData,function(k,i){
				$('#THID').val(i.THID);
				$('#couponNo').val(i.couponNo);
				$('#VoucherDate').val(i.VoucherDate);
				$('#BID').val(i.BID);
				$('#BID').val(i.BID);
				$('#VID_CID').val(i.VID_CID);
				$('#Comment').val(i.Comment);
				
			});
			
		}
	});
	function setDefaultQty(rowId)
	{
		$('input[name="quantity[]"]').eq(rowId).val(1)
	}
		function calGross(rowId){
			if($('select[name="PID[]"]').eq(rowId).val()!=0 && $('select[name="unitID[]"]').eq(rowId).val()!=0  )
			{if( $('input[name="quantity[]"]').eq(rowId).val() && $('input[name="rate[]"]').eq(rowId).val())
			  $('td[name="gross[]"]').eq(rowId).html(parseFloat($('input[name="quantity[]"]').eq(rowId).val()) *parseFloat($('input[name="rate[]"]').eq(rowId).val()));
		         valid=true;
			}
			else {alert('الرجاء اختيار الصنف والوحدة'); 
			valid=false;
			}
			
		
		      
			
			
			
			
		};
		
	
		
	</script>
</body>
</html>