<!DOCTYPE html>
<html dir="rtl">
<head>
	<?php include('include/head.php'); ?>
</head>
<body >
	<?php include('include/header.php'); ?>
	<?php include('include/sidebar.php'); ?>
	<?php 
	$sql = 'SELECT * FROM useraccount';
$userata = $pdo->query($sql)->fetchAll();

 echo '<script> var JsUserData='.json_encode($userata).'; </script>'; ?>
	<div class="main-container">
		<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">الأدلة</a></li>
									<li class="breadcrumb-item active" aria-current="page">المستخدمين</li>
								</ol>
							</nav>
						</div>
						
					</div>
				</div>
				<!-- basic table  Start -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					<div class="clearfix mb-20">
						
						<div class="pull-right">
							<a href="#basic-table" id="btnAddNew" class="btn btn-primary btn-sm scroll-click" rel="content-y"  data-toggle="collapse" role="button"><i class="fa fa-plus"></i> اضافة مستخدم</a>
						</div>
					</div>
					<table class="table" id="userAccountsTabla" data-toggle="table" >
						<thead>
							<tr>
								 <th  data-field="userID" data-width="3%"  data-sortable="true">م</th>
								 <th  data-field="userType"  data-sortable="true">نوع المستخدم</th>
								 <th  data-field="userName"  data-sortable="true">اسم المستخدم </th>
								 <th  data-field="status"  data-sortable="true">الحالة </th>
							    <th data-formatter="EditUserFormatter" >تعديل</th>
								
							</tr>
						</thead>
						<tbody>
						
						</tbody>
					</table>
			<div class="modal fade" id="UserRegModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <form id="userForm">
	  <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <center><h4 class="modal-title" >بيانات المستخدم</h4></center>
            </div>
			
            <div class="modal-body" >
			          <input type="hidden" class="form-control" id="userID" value=0  name="userID"  />
	                  <div class="form-group"> <label >نوع المستخدم <span class="rqd">*</span> :</label><select class="form-control" id="userType"  name="userType"   required ><option value=1>مدخل بيانات</option><option value=2>مدير</option></select></div>
				      <div class="form-group"> <label >اسم المستخدم <span class="rqd">*</span> :</label><input type="text" class="form-control" id="userName"  name="userName"  required /></div>
					  <div class="form-group"> <label >كلمة السر </label><input type="password"  class="form-control" id="password"  name="password"  /></div>
                       <div>
                           <input type="radio" id="active" name="status" value="1" checked />
                      <label for="active">نشط</label><br>
                      <input type="radio" id="disactive" name="status" value="0" /> 
                      <label for="disactive">موقف</label><br>
                    </div>
                      
					
				 </div>
            <div class="modal-footer">
                <button type="submit" id="btnSubmit" class="btn btn-primary" >حفظ</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
               
                </div>     
            </div>
          </div>
        </form>
    </div>
			</div>
			<?php include('include/footer.php'); ?>
		</div>
	</div>
	<?php include('include/script.php'); ?>
	<script>


$(function(){
console.log(JsUserData);
	$('#userAccountsTabla').bootstrapTable('load',JsUserData);
	$('#userForm').on('submit',function(e){
		e.preventDefault();
		
	   let dataS=$('#userForm').serializeArray();
	   console.log(dataS);
		if($('#userID').val()>0)
		{
			$.post('serversideCalls/Ajax/MastersCRUD/Users/Update.php',dataS,function(r){
				if(r!='failed')
		       $('#userAccountsTabla').bootstrapTable('load',JSON.parse(r));
			 $('#UserRegModal').modal('hide');
			});
		}
		else
		{
			$.ajax({url:'serversideCalls/Ajax/MastersCRUD/Users/Insert.php',type:"post",data:dataS,success:function(r){
			if(r!='failed')
		       $('#userAccountsTabla').bootstrapTable('load',JSON.parse(r));
			 $('#UserRegModal').modal('hide');
			 
			 
		    }});
		}
		
		
		
	});
	
   $('#btnAddNew').on('click',function(e){
	    $('input[type="text"],input[type="number"]').val('');
		
       
	    $('#userID').val(0);
    $('#UserRegModal').modal('show');
   });

});
   function setData4Edit(qstdt)
    {
        var UserData = JSON.parse(decodeURIComponent(qstdt));
	

        $('#userID').val(UserData.userID);$('#userType').val(UserData.userType);$('#userName').val(UserData.userName); 
		$('#status').val(UserData.status); $('#password').val(UserData.password); 
        
        $('#UserRegModal').modal('show');
		 
    }

 function EditUserFormatter(value, row, index) {
        return [
            '<a class="like btnEditDataElement"  title="Like" href="javascript:void(0)" onclick="setData4Edit(\'' + encodeURIComponent(JSON.stringify(row)) + '\');">',
            '<i class="fa fa-edit"></i> <span class="label label-primary">تعديل</span>',
            '</a>'


        ].join('');


    }
	
	function setDataFormData4Delete(qstdt)
    {
       
		r = confirm("هل انت متأكد من حذف هذا السجل؟");
        if (r == true) {

        var UserData = JSON.parse(decodeURIComponent(qstdt));
		
	   $.post('Ajax/PatientCRUD/Delete.php',UserData,function(r){
			console.log((r));
			if(r!='failed')
		       $('#userAccountsTabla').bootstrapTable('load',JSON.parse(r));
			
			
		});
		}
		 
    }
function DeleteDoctorFormatter(value, row, index) {
        return [
            '<a class="like btnEditDataElement"  title="Like" href="javascript:void(0)" onclick="setDataFormData4Delete(\'' + encodeURIComponent(JSON.stringify(row)) + '\');">',
            '<i class="fa fa-remover"></i> <span class="label label-danger">حذف</span>',
            '</a>'


        ].join('');


    }	
	
</script>
</body>
</html>